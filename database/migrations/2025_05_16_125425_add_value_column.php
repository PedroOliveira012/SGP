<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cable_routing', function (Blueprint $table) {
            $table->integer('origin_value')->default(1)->after('origin_direction');
            $table->integer('target_value')->default(1)->after('target_direction');
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
