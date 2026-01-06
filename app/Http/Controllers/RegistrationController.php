<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registrations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:150',
            'school'              => 'required|string|max:150',
            'grade'               => 'required|in:10,11,12',
            'email'               => 'required|email|unique:registrations,email',
            'phone'               => 'required|string|max:30',
            'interested_majors'   => 'nullable|string|max:500',
            'interested_campuses' => 'nullable|string|max:500',
        ]);

        $data['registration_code'] = 'MCE-' . now()->format('Y') . '-' . str_pad((Registration::max('id') + 1), 4, '0', STR_PAD_LEFT);

        // Generate QR payload
        $payload = json_encode([
            'code'   => $data['registration_code'],
            'name'   => $data['name'],
            'school' => $data['school'],
        ]);

        // Save QR to storage (use SVG to avoid Imagick dependency)
        $qrImage = QrCode::format('svg')->size(320)->errorCorrection('H')->generate($payload);
        $qrPath  = 'qrcodes/' . $data['registration_code'] . '.svg';
        Storage::disk('public')->put($qrPath, $qrImage);
        $data['qr_code_path'] = $qrPath;

        $registration = Registration::create($data);

        return view('registrations.success', compact('registration'));
    }
}
