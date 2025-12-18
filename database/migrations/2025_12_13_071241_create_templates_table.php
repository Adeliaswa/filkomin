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
    Schema::create('templates', function (Blueprint $table) {
        $table->id();

        // Template identity
        $table->string('title');
        $table->string('category'); 
        // formal | semi-formal | speaker

        // Blade view path
        $table->string('path')->unique();
        // contoh: invitations.formal

        // Description for admin
        $table->text('description')->nullable();

        // Admin control
        $table->boolean('is_active')->default(true);

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('templates');
}

};
