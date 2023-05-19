<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('area');
            $table->string('processo');
            $table->string('titulo');
            $table->string('objetivo');
            $table->string('areas_envolvidas');
            $table->string('material');
            $table->string('ferramentas');
            $table->string('EPI');
            $table->mediumText('descricao');
            $table->string('referencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedures');
    }
}
