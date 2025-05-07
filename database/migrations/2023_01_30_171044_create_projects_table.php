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
            $table->string('Responsavel_tecnico', 15);
            $table->string('analista', 15);
            $table->string('projetista', 10);
            $table->float('valor_contratado', 10, 2);
            $table->integer('prazo_entrega');
            $table->tinytext('observacoes');
            $table->date('data_fechamento');
            $table->date('data_entrega');
            $table->integer('progresso')->default(0);
            $table->integer('liberado')->default(0);
            $table->integer('fase_teste')->default(0);
            $table->integer('finalizado')->default(0);
            $table->string('responsavel');
            $table->timestamps();
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
