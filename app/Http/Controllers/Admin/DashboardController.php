<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Schedule;
use App\Models\Gallery;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index()
    {
        $campusCount = Campus::count();
        $scheduleCount = Schedule::count();
        $galleryCount = Gallery::count();
        $feedbackCount = Feedback::count();

        return view('dashboard.index', compact('campusCount', 'scheduleCount', 'galleryCount', 'feedbackCount'));
    }
}
