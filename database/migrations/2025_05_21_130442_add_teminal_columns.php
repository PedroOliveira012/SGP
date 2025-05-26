<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeminalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cable_routing', function (Blueprint $table) {
            $table->string('origin_terminal_type', 30)->after('origin_value');
            $table->string('target_terminal_type', 30)->after('target_value');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cable_routing', function (Blueprint $table) {
            //
        });
    }
}
