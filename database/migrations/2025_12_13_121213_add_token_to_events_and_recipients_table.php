<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    // token column already exists in events and recipients
}

<<<<<<< HEAD
        Schema::table('recipients', function (Blueprint $table) {
            // Kolom token untuk link personal tamu
            // $table->uuid('token')->unique()->nullable()->after('name'); 
        });
    }
=======
public function down(): void
{
    //
}
>>>>>>> origin/feature-phi

};