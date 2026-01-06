<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'discount_code_id')) {
                $table->foreignId('discount_code_id')->nullable()->constrained('discount_codes')->nullOnDelete()->after('ticket_package_id');
            }
            if (!Schema::hasColumn('registrations', 'discount_percentage')) {
                $table->unsignedInteger('discount_percentage')->default(0)->after('total_amount');
            }
            if (!Schema::hasColumn('registrations', 'original_amount')) {
                $table->decimal('original_amount', 12, 2)->default(0)->after('discount_percentage');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'discount_code_id')) {
                $table->dropForeign(['discount_code_id']);
                $table->dropColumn('discount_code_id');
            }
            if (Schema::hasColumn('registrations', 'discount_percentage')) {
                $table->dropColumn('discount_percentage');
            }
            if (Schema::hasColumn('registrations', 'original_amount')) {
                $table->dropColumn('original_amount');
            }
        });
    }
};
