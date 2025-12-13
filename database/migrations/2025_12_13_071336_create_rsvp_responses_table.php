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
        Schema::create('rsvp_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recipient_id')
                ->unique()
                ->constrained('recipients')
                ->onDelete('cascade');

            $table->enum('status', ['Hadir', 'Tidak Hadir', 'Belum Pasti']);
            $table->integer('total_guests')->default(1);
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvp_responses');
    }
};
