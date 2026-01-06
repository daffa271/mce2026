<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with(['user', 'ticketPackage'])->latest();

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('payment_status', 'pending');
            } elseif ($request->status === 'paid') {
                $query->where('payment_status', 'paid')->where('verification_status', 'pending');
            } elseif ($request->status === 'verified') {
                $query->where('verification_status', 'verified');
            } elseif ($request->status === 'rejected') {
                $query->where('verification_status', 'rejected');
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('registration_code', 'like', "%{$search}%")
                    ->orWhere('school', 'like', "%{$search}%");
            });
        }

        $registrations = $query->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total' => Registration::count(),
            'pending' => Registration::where('payment_status', 'pending')->count(),
            'awaiting_verification' => Registration::where('payment_status', 'paid')->where('verification_status', 'pending')->count(),
            'verified' => Registration::where('verification_status', 'verified')->count(),
            'rejected' => Registration::where('verification_status', 'rejected')->count(),
        ];

        return view('admin.registrations.index', compact('registrations', 'stats'));
    }

    public function show(Registration $registration)
    {
        $registration->load(['user', 'ticketPackage']);
        return view('admin.registrations.show', compact('registration'));
    }

    public function verify(Registration $registration)
    {
        $registration->update([
            'verification_status' => 'verified',
            'verified_at' => now(),
        ]);

        return back()->with('success', 'Registrasi berhasil diverifikasi!');
    }

    public function reject(Request $request, Registration $registration)
    {
        $registration->update([
            'verification_status' => 'rejected',
            'payment_notes' => $request->input('reason', 'Ditolak oleh admin'),
        ]);

        return back()->with('success', 'Registrasi ditolak.');
    }

    public function export()
    {
        // TODO: Implement export functionality
        return back()->with('info', 'Fitur ekspor dalam pengembangan.');
    }
}
