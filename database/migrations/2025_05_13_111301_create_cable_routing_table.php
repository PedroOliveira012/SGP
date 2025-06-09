<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCableRoutingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cable_routing', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('tag', 10);
            $table->string('origin', 20);
            $table->string('origin_direction');
            $table->string('target', 20);
            $table->string('target_direction');
            $table->string('cable_cross_section', 6);
            $table->string('color', 5);
            $table->string('wire_harness', 10);
            $table->float('length', 5, 3);
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cable_routing');
    }
}
