<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            if (Schema::hasColumn('events', 'user_id')) {
                // kalau ada foreign key
                try {
                    $table->dropForeign(['user_id']);
                } catch (\Throwable $e) {
                    // ignore kalau tidak ada FK
                }

                $table->dropColumn('user_id');
            }
        });
    }

    public function down(): void
    {
        // tidak perlu dikembalikan
    }
};
