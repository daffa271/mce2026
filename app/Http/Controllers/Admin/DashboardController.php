<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\User;
use App\Models\Registration;
use App\Models\Aspiration;
use App\Models\GuestAspiration;

class DashboardController extends Controller
{
    public function index()
    {
        // Total kampus
        $campusCount = Campus::count();

        // Total peserta yang melakukan registrasi (users dengan role 'user' yang punya registrasi)
        $participantCount = User::where('role', 'user')
            ->whereHas('registrations')
            ->distinct()
            ->count();

        // Total tiket terbeli (registrasi dengan payment_status='paid' DAN verification_status='verified')
        $ticketsSoldCount = Registration::where('payment_status', 'paid')
            ->where('verification_status', 'verified')
            ->count();

        // Total feedback (gabungan dari Aspiration dan GuestAspiration)
        $feedbackCount = Aspiration::count() + GuestAspiration::count();

        // Total menunggu verifikasi (payment_status='paid' tapi verification_status='pending')
        $pendingVerificationCount = Registration::where('payment_status', 'paid')
            ->where('verification_status', 'pending')
            ->count();

        // Total terverifikasi
        $verifiedCount = Registration::where('verification_status', 'verified')
            ->count();

        return view('admin.dashboard.index', compact(
            'campusCount',
            'participantCount',
            'ticketsSoldCount',
            'feedbackCount',
            'pendingVerificationCount',
            'verifiedCount'
        ));
    }
}
