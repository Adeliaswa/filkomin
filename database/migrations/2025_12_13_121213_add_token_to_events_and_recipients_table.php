<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Kolom token untuk link e-vite utama
            $table->uuid('token')->unique()->nullable()->after('description'); 
        });

        Schema::table('recipients', function (Blueprint $table) {
            // Kolom token untuk link personal tamu
            // $table->uuid('token')->unique()->nullable()->after('name'); 
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('token');
        });

        Schema::table('recipients', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
};