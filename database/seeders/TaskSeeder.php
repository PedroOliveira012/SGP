<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('2', 'Gustavo', 'Instalar as portas no painel', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('4', 'Gustavo', 'Fazer recorte e furação na porta, teto ou flange', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('3', 'João Roberto', 'Conexão dos cabos de comando nos componentes', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('7', 'Ryan', 'Cortar trilho', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('1', 'Alan Silvino', 'Conexão dos cabos de comando nos componentes', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('6', 'Salatiel', 'Fazer marcações na porta, teto ou flange', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('1', 'Johann Patrick', 'Retirar as portas do quadro (Aço inox)', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('2', 'Otávio Silvino', 'Instalar a flange no quadro', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('3', 'João Roberto', 'Conexão dos cabos de potência nos componetes', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('4', 'Ryan', 'Cortar trilho', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('5', 'Alan Silvino', 'Retirar as tampas traseiras dos armários', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('4', 'Salatiel', 'Instalar canaleta', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('3', 'Claudmarcos', 'Fabricação do pallet', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('1', 'Alan Silvino', 'Fabricação dos cabos de comando', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('5', 'Otávio Silvino', 'Fixação da placa de montagem no painel', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('1', 'Claudmarcos', 'Retirar pendência', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('5', 'Alan Silvino', 'Instalar as portas no quadro (carbono)', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('9', 'Salatiel', 'Montagem das bases soleiras no pallet', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('10', 'Alan Silvino', 'Instalar trilho', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('11', 'João Roberto', 'Instalar trilho', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('12', 'João Roberto', 'Preparar a placa de montagem para a furação', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('13', 'Johann Patrick', 'Fixação da placa de montagem no quadro', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('14', 'Otávio Silvino', 'Iniciar o processo de furação da placa de montagem', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('15', 'Fernando', 'Embalar painel em plastico bolha e stretch', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('7', 'Fernando', 'Instalar fecho na porta do quadro', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('8', 'Fernando', 'Retirar as portas do quadro (Aço carbono)', '2022-01-01 00:00:00', 'Teste'));

        DB::insert('insert into tasks
        (id_projeto, funcionario, tarefa, envio_tarefa, Notas)
        values(?, ?, ?, ?, ?)',
        array('1', 'Johann Patrick', 'Retirar o teto do armários', '2022-01-01 00:00:00', 'Teste'));

    }
}
