<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            // Field untuk bundle package
            $table->boolean('is_bundle')->default(false)->after('is_active');
            $table->integer('bundle_size')->default(1)->after('is_bundle')->comment('Jumlah peserta dalam 1 bundle (default: 1)');
        });
    }

    public function down(): void
    {
        Schema::table('ticket_packages', function (Blueprint $table) {
            $table->dropColumn(['is_bundle', 'bundle_size']);
        });
    }
};
