<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('recipients', function (Blueprint $table) {
        $table->enum('rsvp_status', ['yes', 'no', 'maybe'])->nullable()->after('email');
    });
}


    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('recipients', function (Blueprint $table) {
        $table->dropColumn('rsvp_status');
    });
}

};
