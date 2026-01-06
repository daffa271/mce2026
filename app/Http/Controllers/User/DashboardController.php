<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dapatkan semua registrasi user
        $registrations = $user->registrations()->latest()->get();

        // Hitung statistik
        $ticketsPurchased = $registrations->count();
        $ticketsVerified = $registrations->where('verification_status', 'verified')->count();
        $ticketsPending = $registrations->where('payment_status', 'paid')
            ->where('verification_status', 'pending')
            ->count();
        $totalAmount = $registrations->sum('total_amount');

        // Ambil 3 registrasi terbaru untuk preview
        $recentRegistrations = $registrations->take(3);

        return view('user.dashboard', [
            'ticketsPurchased' => $ticketsPurchased,
            'ticketsVerified' => $ticketsVerified,
            'ticketsPending' => $ticketsPending,
            'totalAmount' => $totalAmount,
            'recentRegistrations' => $recentRegistrations,
        ]);
    }
}
