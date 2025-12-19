<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('eo_id')->constrained('users')->onDelete('cascade');

            $table->string('title');
            $table->string('category');
            $table->string('organizer_name');
            $table->string('organizer_unit');
            $table->text('description');

            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();

            $table->string('location_type');
            $table->string('location')->nullable();
            $table->string('meeting_link')->nullable();

            $table->string('dress_code')->nullable();
            $table->text('notes')->nullable();

            $table->string('invitation_type'); // link / pdf

            $table->string('pic_name');
            $table->string('pic_whatsapp');
            $table->string('pic_email')->nullable();
            $table->text('request_notes')->nullable();

            $table->string('status')->default('draft');

            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
