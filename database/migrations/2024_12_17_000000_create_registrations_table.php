<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_code')->unique();
            $table->string('name');
            $table->string('school');
            $table->enum('grade', ['10', '11', '12']);
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('interested_majors')->nullable();
            $table->text('interested_campuses')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->boolean('is_checked_in')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
