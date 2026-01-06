<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Add default empty string to optional fields
            $table->string('phone')->default('')->change();
            $table->string('school')->default('')->change();
            // grade is ENUM, keep it nullable
            $table->enum('grade', ['10', '11', '12'])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('phone')->change();
            $table->string('school')->change();
            $table->enum('grade', ['10', '11', '12'])->change();
        });
    }
};
