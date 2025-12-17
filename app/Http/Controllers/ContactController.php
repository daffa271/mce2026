<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Setting::where('key', 'contact_info')->first();
        return view('contact.index', compact('contact'));
    }
}
