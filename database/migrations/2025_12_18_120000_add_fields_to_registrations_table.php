<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Hanya tambah field yang belum ada
            if (!Schema::hasColumn('registrations', 'verification_status')) {
                $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending')->after('payment_status');
            }

            if (!Schema::hasColumn('registrations', 'quantity')) {
                $table->integer('quantity')->default(1)->after('verification_status');
            }

            if (!Schema::hasColumn('registrations', 'bundle_participants')) {
                $table->json('bundle_participants')->nullable()->after('quantity')->comment('Array of participant data for bundle packages');
            }

            if (!Schema::hasColumn('registrations', 'payment_notes')) {
                $table->text('payment_notes')->nullable()->after('paid_at');
            }

            if (!Schema::hasColumn('registrations', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('payment_notes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $columns = [
                'verification_status',
                'quantity',
                'bundle_participants',
                'payment_notes',
                'verified_at'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('registrations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
