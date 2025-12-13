<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{

    Schema::table('recipients', function (Blueprint $table) {

        if (Schema::hasColumn('recipients', 'unique_token')) {
            $table->dropColumn('unique_token');
        }
        
    });
    

    Schema::table('events', function (Blueprint $table) {

        if (Schema::hasColumn('events', 'unique_token')) {
            $table->dropColumn('unique_token');
        }
    });
}
};