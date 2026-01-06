<?php

require_once 'vendor/autoload.php';
// Get the Laravel application instance
$app = require_once 'bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Bootstrap the console kernel so Eloquent and helpers are available
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Single shared admin credentials (can be used by multiple admins)
$defaultEmail = 'admin@mce2026.com';
$defaultPassword = 'admin123';

$email = getenv('ADMIN_EMAIL') ?: $defaultEmail;
$password = getenv('ADMIN_PASSWORD') ?: $defaultPassword;

$admin = User::updateOrCreate(
    ['email' => $email],
    [
        'name' => 'Admin MCE',
        'password' => Hash::make($password),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]
);

echo "\xE2\x9C\x93 Admin account ready: {$email} / {$password}\n";
