<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|min:10|max:1000',
            'category' => 'nullable|in:venue,schedule,organization,facilities,communication,other',
            'type' => 'nullable|in:suggestion,praise,complaint',
            'rating' => 'nullable|integer|between:1,5',
            'allow_contact' => 'nullable|boolean',
        ]);

        // Create feedback/aspiration record
        \App\Models\Aspiration::create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'category' => $validated['category'] ?? null,
            'type' => $validated['type'] ?? 'suggestion',
            'rating' => $validated['rating'] ?? null,
            'allow_contact' => isset($validated['allow_contact']) ? true : false,
            'status' => 'pending', // Will be reviewed by admin
        ]);

        return back()->with('success', 'Terima kasih! Feedback Anda telah dikirim dan akan ditinjau oleh tim panitia.');
    }

    public function history()
    {
        return view('feedback.history');
    }

    public function guestForm()
    {
        return view('feedback.guest');
    }

    public function storeGuest(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|min:10|max:1000',
            'category' => 'nullable|in:Acara,Publikasi,Konsumsi,Dokumentasi,Sponsorship,Teknis,Lainnya',
        ]);

        // Simpan hanya kolom yang dipastikan ada: message + category
        \App\Models\GuestAspiration::create([
            'message' => $validated['message'],
            'category' => $validated['category'] ?? null,
        ]);

        return back()->with('success', 'Terimakasih atas Aspirasi Anda');
    }
}
