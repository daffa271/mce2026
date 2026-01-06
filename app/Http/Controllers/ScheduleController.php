<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Preview untuk guest (terbatas)
    public function preview()
    {
        $schedules = Schedule::orderBy('date', 'asc')->take(5)->get();
        return view('schedule.preview', compact('schedules'));
    }

    // Full index untuk user login
    public function index()
    {
        $schedules = Schedule::orderBy('date', 'asc')->get();
        return view('schedule.index', compact('schedules'));
    }

    // Admin index
    public function adminIndex()
    {
        $schedules = Schedule::orderBy('date', 'asc')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Schedule::create($request->all());

        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }
}
