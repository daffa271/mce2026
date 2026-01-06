<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    /**
     * Verify registrasi dan generate barcode
     * Untuk bundle: generate QR code untuk setiap peserta
     */
    public function verify(Registration $registration)
    {
        // Jika sudah ada barcode/QR code, return
        if ($registration->barcode) {
            return back()->with('info', 'QR Code tiket ini sudah di-generate sebelumnya');
        }

        // Hanya bisa generate jika sudah verified pembayaran
        if ($registration->verification_status !== 'verified') {
            return back()->with('error', 'Tiket hanya bisa di-generate untuk registrasi yang sudah terverifikasi');
        }

        try {
            // Check if this is a bundle ticket
            $isBundle = $registration->ticketPackage?->is_bundle && !empty($registration->bundle_participants);

            if ($isBundle) {
                // Generate QR codes for each participant in the bundle
                return $this->generateBundleTickets($registration);
            } else {
                // Generate single ticket for non-bundle
                return $this->generateSingleTicket($registration);
            }
        } catch (\Exception $e) {
            return back()->with('error', '❌ Gagal generate QR Code: ' . $e->getMessage());
        }
    }

    /**
     * Generate single ticket for non-bundle registration
     */
    private function generateSingleTicket(Registration $registration)
    {
        // Generate unique barcode
        $barcode = 'MCE2026-' . Str::upper(Str::random(12));

        // Generate QR Code payload
        $payload = json_encode([
            'barcode' => $barcode,
            'name' => $registration->name,
            'school' => $registration->school,
            'ticket_package' => $registration->ticketPackage?->name ?? 'Standard',
            'verified_at' => now()->toDateString(),
        ]);

        // Generate SVG QR code
        $svgData = QrCode::format('svg')->size(320)->errorCorrection('H')->generate($payload);
        $qrPath = 'qrcodes/' . $barcode . '.svg';
        Storage::disk('public')->put($qrPath, $svgData);

        // Update registration
        $registration->update([
            'barcode' => $barcode,
            'qr_code_path' => $qrPath,
        ]);

        return back()->with('success', '✅ QR Code tiket berhasil di-generate! Peserta sudah bisa melihat tiket mereka di menu "Tiket Saya".');
    }

    /**
     * Generate tickets for each participant in a bundle
     */
    private function generateBundleTickets(Registration $registration)
    {
        $participants = $registration->bundle_participants;
        $bundleBarcodes = [];

        foreach ($participants as $index => $participant) {
            $participantNumber = $index + 1;
            $participantName = $participant['name'] ?? "Peserta {$participantNumber}";
            $participantSchool = $participant['school'] ?? $registration->school;

            // Generate unique barcode for each participant
            $barcode = 'MCE2026-B' . $participantNumber . '-' . Str::upper(Str::random(10));

            // Generate QR Code payload with participant data
            $payload = json_encode([
                'barcode' => $barcode,
                'name' => $participantName,
                'school' => $participantSchool,
                'ticket_package' => $registration->ticketPackage?->name ?? 'Bundle',
                'bundle_number' => $participantNumber,
                'total_bundle' => count($participants),
                'registration_code' => $registration->registration_code,
                'verified_at' => now()->toDateString(),
            ]);

            // Generate SVG QR code
            $svgData = QrCode::format('svg')->size(320)->errorCorrection('H')->generate($payload);
            $qrPath = 'qrcodes/' . $barcode . '.svg';
            Storage::disk('public')->put($qrPath, $svgData);

            // Store barcode data for each participant
            $bundleBarcodes[] = [
                'number' => $participantNumber,
                'name' => $participantName,
                'school' => $participantSchool,
                'barcode' => $barcode,
                'qr_code_path' => $qrPath,
                'is_checked_in' => false,
                'checked_in_at' => null,
            ];
        }

        // Use first participant's barcode as main barcode
        $mainBarcode = $bundleBarcodes[0]['barcode'] ?? null;
        $mainQrPath = $bundleBarcodes[0]['qr_code_path'] ?? null;

        // Update registration with all bundle barcodes
        $registration->update([
            'barcode' => $mainBarcode,
            'qr_code_path' => $mainQrPath,
            'bundle_barcodes' => $bundleBarcodes,
        ]);

        $participantCount = count($bundleBarcodes);
        return back()->with('success', "✅ {$participantCount} QR Code tiket bundle berhasil di-generate! Setiap peserta memiliki tiket dengan nama masing-masing.");
    }

    /**
     * Show ticket page untuk user
     */
    public function show(Registration $registration)
    {
        // Check if user owns this registration
        if ($registration->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return abort(403);
        }

        return view('tickets.show', compact('registration'));
    }

    /**
     * Download ticket as PDF
     */
    public function download(Registration $registration)
    {
        if ($registration->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return abort(403);
        }

        if (!$registration->qr_code_path) {
            return back()->with('error', 'Ticket belum di-generate');
        }

        // Simple download of stored QR (supports svg or jpg)
        $filePath = storage_path('app/public/' . $registration->qr_code_path);
        $isSvg = str_ends_with($registration->qr_code_path, '.svg');
        $downloadName = 'ticket-' . $registration->barcode . ($isSvg ? '.svg' : '.jpg');
        $contentType = $isSvg ? 'image/svg+xml' : 'image/jpeg';
        return response()->download($filePath, $downloadName, [
            'Content-Type' => $contentType
        ]);
    }

    /**
     * API endpoint untuk scan barcode
     * Supports both single tickets and bundle tickets
     */
    public function scan(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string'
        ]);

        $barcode = trim($request->barcode);

        // Debug log
        Log::info('Scan barcode attempt: ' . $barcode);

        // First check main barcode
        $registration = Registration::where('barcode', $barcode)->first();

        // If not found, check in bundle_barcodes
        if (!$registration) {
            $registration = Registration::whereNotNull('bundle_barcodes')
                ->get()
                ->first(function ($reg) use ($barcode) {
                    $bundleBarcodes = $reg->bundle_barcodes ?? [];
                    foreach ($bundleBarcodes as $bundle) {
                        if (($bundle['barcode'] ?? '') === $barcode) {
                            return true;
                        }
                    }
                    return false;
                });
        }

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan'
            ], 404);
        }

        if ($registration->verification_status !== 'verified') {
            return response()->json([
                'success' => false,
                'message' => 'Tiket belum diverifikasi',
                'data' => [
                    'name' => $registration->name,
                    'school' => $registration->school,
                    'status' => $registration->verification_status,
                ]
            ], 400);
        }

        // Check if this is a bundle ticket
        $bundleBarcodes = $registration->bundle_barcodes ?? [];
        $isBundle = !empty($bundleBarcodes);
        $participantData = null;

        if ($isBundle) {
            // Find the specific participant by barcode
            foreach ($bundleBarcodes as $index => $bundle) {
                if (($bundle['barcode'] ?? '') === $barcode) {
                    // Check if already checked in
                    if (!empty($bundle['is_checked_in'])) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Peserta ini sudah check-in sebelumnya',
                            'data' => [
                                'name' => $bundle['name'],
                                'school' => $bundle['school'] ?? '',
                                'checked_in_at' => $bundle['checked_in_at'],
                                'status' => 'already_checked_in'
                            ]
                        ], 400);
                    }

                    // Update check-in status for this participant
                    $bundleBarcodes[$index]['is_checked_in'] = true;
                    $bundleBarcodes[$index]['checked_in_at'] = now()->format('Y-m-d H:i:s');

                    $registration->update([
                        'bundle_barcodes' => $bundleBarcodes,
                    ]);

                    $participantData = $bundle;
                    break;
                }
            }

            if ($participantData) {
                return response()->json([
                    'success' => true,
                    'message' => 'Check-in berhasil!',
                    'data' => [
                        'name' => $participantData['name'],
                        'school' => $participantData['school'] ?? '',
                        'ticket_package' => $registration->ticketPackage?->name ?? 'Bundle',
                        'bundle_info' => "Peserta {$participantData['number']} dari " . count($bundleBarcodes) . " tiket bundle",
                        'verified_at' => $registration->verified_at->format('d M Y H:i'),
                        'checked_in_at' => now()->format('d M Y H:i'),
                        'status' => 'checked_in'
                    ]
                ]);
            }
        }

        // Single ticket check-in
        if ($registration->is_checked_in) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket ini sudah digunakan untuk check-in',
                'data' => [
                    'name' => $registration->name,
                    'school' => $registration->school,
                    'checked_in_at' => $registration->checked_in_at->format('d M Y H:i'),
                    'status' => 'already_checked_in'
                ]
            ], 400);
        }

        // Update check-in for single ticket
        $registration->update([
            'is_checked_in' => true,
            'checked_in_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in berhasil!',
            'data' => [
                'name' => $registration->name,
                'school' => $registration->school,
                'ticket_package' => $registration->ticketPackage?->name ?? 'Standard',
                'verified_at' => $registration->verified_at->format('d M Y H:i'),
                'checked_in_at' => $registration->checked_in_at->format('d M Y H:i'),
                'status' => 'checked_in'
            ]
        ]);
    }

    /**
     * Get recent check-ins
     */
    public function recentCheckins()
    {
        $checkins = Registration::where('is_checked_in', true)
            ->orderBy('checked_in_at', 'desc')
            ->limit(20)
            ->get()
            ->map(fn($reg) => [
                'name' => $reg->name,
                'school' => $reg->school,
                'checked_in_at' => $reg->checked_in_at->format('d M Y H:i'),
                'ticket_package' => $reg->ticketPackage?->name ?? 'Standard',
            ]);

        return response()->json($checkins);
    }

    /**
     * Show scan page
     */
    public function scanPage()
    {
        if (Auth::user()->role !== 'admin') {
            return abort(403);
        }

        return view('tickets.scan');
    }

    /**
     * Show check-in index page (panitia lihat daftar check-in)
     */
    public function checkInIndex()
    {
        if (Auth::user()->role !== 'admin') {
            return abort(403);
        }

        // Get all checked-in participants (single ticket)
        $checkins = Registration::where('is_checked_in', true)
            ->with('ticketPackage')
            ->orderBy('checked_in_at', 'desc')
            ->paginate(20);

        return view('admin.checkin.index', compact('checkins'));
    }
}
