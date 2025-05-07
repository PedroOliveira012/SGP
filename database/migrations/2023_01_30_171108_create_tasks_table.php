<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_projeto')->nullable();
            $table->string('funcionario');
            $table->string('tarefa');
            $table->dateTime('envio_tarefa');
            $table->dateTime('inicio_tarefa')->nullable();
            $table->dateTime('termino_tarefa')->nullable();
            $table->integer('visualizado')->default(1);
            $table->tinyText('Notas');
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
        Schema::dropIfExists('tasks');
    }
}
