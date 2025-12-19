<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            if (!Schema::hasColumn('events', 'location_type')) {
                $table->string('location_type')->nullable();
            }

            if (!Schema::hasColumn('events', 'meeting_link')) {
                $table->string('meeting_link')->nullable();
            }

            if (!Schema::hasColumn('events', 'dress_code')) {
                $table->string('dress_code')->nullable();
            }

            if (!Schema::hasColumn('events', 'notes')) {
                $table->text('notes')->nullable();
            }

            if (!Schema::hasColumn('events', 'invitation_type')) {
                $table->string('invitation_type')->nullable();
            }

            if (!Schema::hasColumn('events', 'pic_name')) {
                $table->string('pic_name')->nullable();
            }

            if (!Schema::hasColumn('events', 'pic_whatsapp')) {
                $table->string('pic_whatsapp')->nullable();
            }

            if (!Schema::hasColumn('events', 'pic_email')) {
                $table->string('pic_email')->nullable();
            }

            if (!Schema::hasColumn('events', 'request_notes')) {
                $table->text('request_notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        // sengaja dikosongkan
        // karena kita tidak mau drop kolom yang mungkin sudah dipakai
    }
};
