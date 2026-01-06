<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\GuestAspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function index()
    {
        // Get both user and guest feedback
        $userFeedback = Aspiration::with('user')->orderBy('created_at', 'desc')->paginate(10);
        $guestFeedback = GuestAspiration::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.aspirations.index', compact('userFeedback', 'guestFeedback'));
    }

    public function show($id)
    {
        return view('admin.aspirations.show');
    }

    public function destroy($id)
    {
        return back();
    }

    public function export()
    {
        return back();
    }
}
