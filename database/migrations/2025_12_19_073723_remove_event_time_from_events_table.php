<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'event_time')) {
                $table->dropColumn('event_time');
            }
        });
    }

    public function down(): void
    {
        // tidak perlu rollback
    }
};
