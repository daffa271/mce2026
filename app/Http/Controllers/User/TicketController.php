<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\TicketPackage;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    /**
     * Display list of user's tickets
     */
    public function index()
    {
        $registrations = Registration::with('ticketPackage')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $hasActiveRegistration = $this->userHasActiveRegistration();

        return view('user.tickets.index', compact('registrations', 'hasActiveRegistration'));
    }

    /**
     * Show available packages to purchase
     */
    public function selectPackage()
    {
        if ($this->userHasActiveRegistration()) {
            return redirect()
                ->route('user.tickets.index')
                ->with('info', 'Setiap akun hanya dapat melakukan 1 pembelian tiket.');
        }

        $packages = TicketPackage::where('is_active', true)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->get();

        return view('user.tickets.select', compact('packages'));
    }

    /**
     * Create a new ticket registration (first step)
     * Shows: "Registrasi berhasil. Lakukan pembayaran sekarang."
     * Does NOT decrement quota yet
     */
    public function checkout(Request $request)
    {
        if ($this->userHasActiveRegistration()) {
            return redirect()->route('user.tickets.index')
                ->with('info', 'Akun Anda sudah memiliki pembelian tiket.');
        }

        $validated = $request->validate([
            'ticket_package_id' => 'required|exists:ticket_packages,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $ticketPackage = TicketPackage::findOrFail($validated['ticket_package_id']);
        $quantity = $validated['quantity'];

        // Check if package is still available
        $availableQuota = $ticketPackage->quota - $ticketPackage->sold;
        if ($availableQuota < $quantity) {
            return back()->with('error', 'Kuota tiket tidak cukup. Sisa kuota: ' . $availableQuota);
        }

        // Create registration with pending status
        $user = Auth::user();
        $totalAmount = $ticketPackage->price * $quantity;

        $data = [
            'user_id' => Auth::id(),
            'ticket_package_id' => $ticketPackage->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '',
            'school' => $user->school ?? '',
            'grade' => $user->grade ?? null,
            'registration_code' => $this->generateRegistrationCode(),
            'total_amount' => $totalAmount,
            'quantity' => $quantity,
            'payment_status' => 'pending',
            'verification_status' => 'pending',
            'payment_method' => null,
            'payment_proof' => null,
            'payment_notes' => null,
            'bundle_participants' => null,
        ];

        // Add discount columns only if they've been migrated
        if (Schema::hasColumn('registrations', 'original_amount')) {
            $data['original_amount'] = $totalAmount;
        }
        if (Schema::hasColumn('registrations', 'discount_percentage')) {
            $data['discount_percentage'] = 0;
        }
        if (Schema::hasColumn('registrations', 'discount_code_id')) {
            $data['discount_code_id'] = null;
        }

        $registration = Registration::create($data);

        // Redirect to payment page
        return redirect()
            ->route('user.tickets.payment', $registration->id)
            ->with('success', 'Registrasi berhasil! Silakan lakukan pembayaran sekarang.');
    }

    /**
     * Show payment page with bank details
     */
    public function payment(Request $request, $registrationId)
    {
        $registration = Registration::with('ticketPackage')
            ->findOrFail($registrationId);

        // Check if user owns this registration
        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        // Check if already verified (prevent re-upload)
        if ($registration->isVerified()) {
            return redirect()->route('user.tickets.index')
                ->with('info', 'Tiket ini sudah diverifikasi.');
        }

        return view('user.tickets.payment', compact('registration'));
    }

    /**
     * Upload payment proof (second step)
     * Shows: "Bukti pembayaran berhasil dikirim, tunggu verifikasi admin"
     * DECREMENTS quota at this point
     * Bundle packages must include participant data
     */
    public function uploadProof(Request $request, $registrationId)
    {
        $registration = Registration::with('ticketPackage')
            ->findOrFail($registrationId);

        // Check authorization
        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        // Validate payment proof upload
        $validated = $request->validate([
            'payment_method' => 'required|in:bank_transfer,qris,other',
            'payment_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120',
            'payment_notes' => 'nullable|string|max:500',
        ]);

        // Handle bundle packages
        if ($registration->ticketPackage->is_bundle) {
            $bundleParticipants = [];
            for ($i = 1; $i <= $registration->ticketPackage->bundle_size; $i++) {
                $nameKey = "participant_{$i}_name";
                $schoolKey = "participant_{$i}_school";

                if (!$request->filled($nameKey)) {
                    throw ValidationException::withMessages([
                        $nameKey => "Nama peserta {$i} harus diisi untuk paket bundle",
                    ]);
                }

                $bundleParticipants[] = [
                    'number' => $i,
                    'name' => $request->input($nameKey),
                    'school' => $request->input($schoolKey, ''),
                ];
            }
            $validated['bundle_participants'] = $bundleParticipants;
        }

        try {
            // Store payment proof file
            $filePath = $request->file('payment_proof')
                ->store('payment_proofs/' . Auth::id(), 'public');

            // Update registration
            $registration->update([
                'payment_status' => 'paid',
                'payment_method' => $validated['payment_method'],
                'payment_proof' => $filePath,
                'payment_notes' => $validated['payment_notes'],
                'bundle_participants' => $validated['bundle_participants'] ?? null,
                'paid_at' => now(),
            ]);

            // DECREMENT quota ONLY after payment proof uploaded
            $registration->ticketPackage->increment('sold', $registration->quantity);

            return redirect()
                ->route('user.tickets.payment', $registration->id)
                ->with('success', 'Bukti pembayaran berhasil dikirim! Tunggu verifikasi admin. Proses verifikasi biasanya memakan waktu 1-2 jam.');
        } catch (\Exception $e) {
            Log::error('Payment proof upload failed', [
                'user_id' => Auth::id(),
                'registration_id' => $registrationId,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->with('error', 'Gagal mengunggah bukti pembayaran. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Download e-ticket (only for verified registrations)
     */
    public function download(Request $request, $registrationId)
    {
        $registration = Registration::with('ticketPackage')
            ->findOrFail($registrationId);

        // Check authorization
        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        // Check if verified
        if (!$registration->isVerified()) {
            return back()->with('error', 'Tiket belum diverifikasi. Tunggu sampai admin memverifikasi pembayaran Anda.');
        }

        // TODO: Generate PDF e-ticket with QR code
        return back()->with('info', 'Fitur download e-ticket sedang dipersiapkan.');
    }

    /**
     * Apply discount code to an existing registration (before upload proof)
     */
    public function applyDiscount(Request $request, $registrationId)
    {
        $registration = Registration::with('ticketPackage')->findOrFail($registrationId);

        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }
        if ($registration->isPaid() || $registration->isVerified()) {
            return back()->with('error', 'Diskon tidak dapat diterapkan setelah pembayaran atau verifikasi.');
        }

        $validated = $request->validate([
            'code' => 'required|string',
        ]);

        $codeStr = strtoupper($validated['code']);
        $discount = DiscountCode::where('code', $codeStr)->first();

        if (!$discount) {
            return back()->with('error', 'Kode diskon tidak ditemukan.');
        }

        if (!$discount->isValid()) {
            return back()->with('error', 'Kode diskon tidak valid, sudah kadaluwarsa, atau kuota sudah habis.');
        }

        // Check if discount already applied to this registration
        if (Schema::hasColumn('registrations', 'discount_code_id') && $registration->discount_code_id == $discount->id) {
            return back()->with('info', 'Kode diskon ini sudah diterapkan.');
        }

        // Calculate discount
        $baseAmount = $registration->ticketPackage->price * $registration->quantity;
        $finalAmount = $discount->getFinalPrice($baseAmount);

        $update = [
            'total_amount' => $finalAmount,
        ];
        if (Schema::hasColumn('registrations', 'discount_code_id')) {
            $update['discount_code_id'] = $discount->id;
        }
        if (Schema::hasColumn('registrations', 'discount_percentage')) {
            $update['discount_percentage'] = (int) $discount->discount_percentage;
        }
        if (Schema::hasColumn('registrations', 'original_amount')) {
            $update['original_amount'] = $baseAmount;
        }

        $registration->update($update);

        // INCREMENT used_count for the discount code
        $discount->increment('used_count');

        return redirect()
            ->route('user.tickets.payment', $registration->id)
            ->with('success', 'Kode diskon diterapkan! Total pembayaran: Rp ' . number_format($finalAmount, 0, ',', '.'));
    }
    /**
     * Generate unique registration code
     */
    private function generateRegistrationCode(): string
    {
        $prefix = 'MCE-';
        $timestamp = date('Ymd');
        $random = strtoupper(substr(uniqid(), -6));
        return $prefix . $timestamp . '-' . $random;
    }

    private function userHasActiveRegistration(): bool
    {
        return Registration::where('user_id', Auth::id())
            ->where('verification_status', '!=', 'rejected')
            ->exists();
    }
}
