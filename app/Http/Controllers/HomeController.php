<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Schedule;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $campuses = Campus::latest()->take(3)->get();
        $schedules = Schedule::orderBy('date', 'asc')->take(5)->get();
        $galleries = Gallery::latest()->take(6)->get();

        return view('home.index', compact('campuses', 'schedules', 'galleries'));
    }
}
