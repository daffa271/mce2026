<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Add barcode column if not exists
            if (!Schema::hasColumn('registrations', 'barcode')) {
                $table->string('barcode')->nullable()->unique()->after('qr_code_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'barcode')) {
                $table->dropColumn('barcode');
            }
        });
    }
};
