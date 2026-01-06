<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('guest_aspirations')) {
            Schema::create('guest_aspirations', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->string('school')->nullable();
                $table->text('message');
                $table->string('category')->nullable(); // venue, schedule, organization, facilities, communication, other
                $table->string('type')->default('suggestion'); // suggestion, praise, complaint
                $table->integer('rating')->nullable(); // 1-5
                $table->boolean('allow_contact')->default(false);
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_aspirations');
    }
};
