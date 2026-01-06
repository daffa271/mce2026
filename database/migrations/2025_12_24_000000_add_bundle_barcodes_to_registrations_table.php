<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds bundle_barcodes column to store QR codes for each participant in a bundle
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'bundle_barcodes')) {
                $table->json('bundle_barcodes')->nullable()->after('bundle_participants')
                    ->comment('Array of barcode data for each bundle participant: [{number, name, school, barcode, qr_code_path, is_checked_in, checked_in_at}]');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'bundle_barcodes')) {
                $table->dropColumn('bundle_barcodes');
            }
        });
    }
};
