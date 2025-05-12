<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('num_projeto', 14);
            $table->string('cliente', 25);
            $table->string('unidade', 25);
            $table->string('nome_projeto', 100);
            $table->string('analista', 15);
            $table->string('projetista', 10);
            $table->date('data_fechamento');
            $table->date('data_entrega');
            $table->string('status');
            $table->int('tempo_total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
