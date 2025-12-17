<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // 📝 Form kirim aspirasi (publik, anonim)
    public function create()
    {
        return view('feedback.form');
    }

    // 💾 Simpan aspirasi ke database
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'category' => 'nullable|string|max:100',
        ]);

        Feedback::create([
            'message' => $request->message,
            'category' => $request->category ?? 'Umum',
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas aspirasi dan sarannya!');
    }

    // 📋 Ketua BPH melihat semua feedback
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('feedback.index', compact('feedbacks'));
    }

    // ✅ Tandai sudah ditindaklanjuti (opsional)
    public function markAddressed(Feedback $feedback)
    {
        $feedback->update(['addressed' => true]);
        return redirect()->back()->with('success', 'Feedback telah ditandai sudah ditindaklanjuti.');
    }
}
