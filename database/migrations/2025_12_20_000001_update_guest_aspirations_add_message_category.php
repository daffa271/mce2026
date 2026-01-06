<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('guest_aspirations')) {
            Schema::table('guest_aspirations', function (Blueprint $table) {
                if (!Schema::hasColumn('guest_aspirations', 'message')) {
                    $table->text('message')->after('id');
                }
                if (!Schema::hasColumn('guest_aspirations', 'category')) {
                    $table->string('category')->nullable()->after('message');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('guest_aspirations')) {
            Schema::table('guest_aspirations', function (Blueprint $table) {
                if (Schema::hasColumn('guest_aspirations', 'category')) {
                    $table->dropColumn('category');
                }
                if (Schema::hasColumn('guest_aspirations', 'message')) {
                    $table->dropColumn('message');
                }
            });
        }
    }
};
