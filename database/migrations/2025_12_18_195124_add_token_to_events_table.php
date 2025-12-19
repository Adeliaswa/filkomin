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
        // Cek apakah kolom 'token' sudah ada di tabel 'events'
        if (!Schema::hasColumn('events', 'token')) {
            Schema::table('events', function (Blueprint $table) {
                $table->uuid('token')->nullable()->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('events', 'token')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('token');
            });
        }
    }
};