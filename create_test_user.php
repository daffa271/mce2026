<?php

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create test user
User::firstOrCreate(
    ['email' => 'peserta@test.com'],
    [
        'name' => 'Peserta Test',
        'email' => 'peserta@test.com',
        'password' => Hash::make('password'),
        'role' => 'user',
        'email_verified_at' => now(),
    ]
);

echo "✓ Test user created: peserta@test.com / password\n";
