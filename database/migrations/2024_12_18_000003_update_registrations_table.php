<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_package_id')->nullable()->after('user_id')->constrained()->onDelete('set null');

            // Payment fields
            $table->enum('payment_status', ['pending', 'paid', 'expired', 'cancelled'])->default('pending')->after('interested_campuses');
            $table->string('payment_method', 50)->nullable()->after('payment_status');
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->decimal('total_amount', 10, 2)->default(0)->after('payment_proof');
            $table->timestamp('paid_at')->nullable()->after('total_amount');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ticket_package_id']);
            $table->dropColumn([
                'user_id',
                'ticket_package_id',
                'payment_status',
                'payment_method',
                'payment_proof',
                'total_amount',
                'paid_at'
            ]);
        });
    }
};
