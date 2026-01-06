<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TicketPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin MCE',
            'email' => 'admin@mce2026.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Ticket Packages
        TicketPackage::create([
            'name' => 'Early Bird',
            'price' => 15000,
            'description' => 'Paket hemat untuk pendaftar awal',
            'benefits' => [
                'E-Ticket + QR Code',
                'Akses semua booth kampus',
                '1x Snack',
                'Certificate of attendance'
            ],
            'quota' => 100,
            'sold' => 0,
            'is_active' => true,
            'valid_from' => now(),
            'valid_until' => now()->addMonths(1),
        ]);

        TicketPackage::create([
            'name' => 'Regular',
            'price' => 25000,
            'description' => 'Paket standar dengan benefit lengkap',
            'benefits' => [
                'E-Ticket + QR Code',
                'Akses semua booth kampus',
                'Seminar 1 sesi',
                'Goodie bag eksklusif',
                'Certificate of attendance'
            ],
            'quota' => 200,
            'sold' => 0,
            'is_active' => true,
            'valid_from' => now(),
            'valid_until' => now()->addMonths(2),
        ]);

        TicketPackage::create([
            'name' => 'VIP',
            'price' => 50000,
            'description' => 'Paket premium dengan akses penuh',
            'benefits' => [
                'E-Ticket + QR Code',
                'Priority access ke semua booth',
                'Akses semua seminar & workshop',
                'Lunch + Snack premium',
                'Exclusive merchandise MCE 2026',
                'Konsultasi 1-on-1 dengan kampus',
                'Certificate of attendance'
            ],
            'quota' => 50,
            'sold' => 0,
            'is_active' => true,
            'valid_from' => now(),
            'valid_until' => now()->addMonths(2),
        ]);
    }
}
