<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipients', function (Blueprint $table) {
            if (!Schema::hasColumn('recipients', 'checkin_time')) {
                $table->timestamp('checkin_time')->nullable()->after('qr_code_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('recipients', function (Blueprint $table) {
            if (Schema::hasColumn('recipients', 'checkin_time')) {
                $table->dropColumn('checkin_time');
            }
        });
    }
};