<?php
require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\TicketPackage;

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create test packages
TicketPackage::updateOrCreate(
    ['name' => 'Student Pass'],
    [
        'price' => 50000,
        'description' => 'Paket untuk pelajar SMP dan SMA',
        'benefits' => json_encode(['Akses semua acara', 'Goodie bag', 'Merchandise eksklusif']),
        'quota' => 500,
        'sold' => 0,
        'is_active' => true,
        'is_bundle' => false,
        'bundle_size' => 1,
        'valid_from' => now(),
        'valid_until' => now()->addMonths(1),
    ]
);

TicketPackage::updateOrCreate(
    ['name' => 'Bundle 3 Peserta'],
    [
        'price' => 120000,
        'description' => 'Paket hemat untuk 3 peserta',
        'benefits' => json_encode(['Hemat 10%', 'Akses semua acara', 'Goodie bag setiap peserta']),
        'quota' => 100,
        'sold' => 0,
        'is_active' => true,
        'is_bundle' => true,
        'bundle_size' => 3,
        'valid_from' => now(),
        'valid_until' => now()->addMonths(1),
    ]
);

echo "✓ Test packages created successfully!\n";
