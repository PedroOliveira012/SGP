<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoverColunaProjeto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('projects', function (Blueprint $table) {
        //     $table->dropColumn("Responsavel_tecnico");
        //     $table->dropColumn("valor_contratado");
        //     $table->dropColumn("prazo_entrega");
        //     $table->dropColumn("observacoes");
        //     $table->dropColumn("liberado");
        //     $table->dropColumn("fase_teste");
        //     $table->dropColumn("finalizado");
        //     $table->dropColumn("responsavel");
        //     $table->dropColumn("created_at");
        //     $table->dropColumn("updated_at");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
}
