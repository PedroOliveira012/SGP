<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103685.00.P-22', 'GAROTO', 'CAÇAPAVA-SP', 'PAINÉIS ELÉTRICOS DE ILUMINAÇÃO E CLIMATIZAÇÃO - PROJETO KOSMOS', 'Renato E.', 'João H', 'Pedro', 80374.24, 45, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103672.00.P-22', 'NESTLÉ', 'ARARAS-SP', 'PAINEL ELÉTRICO REMOTA GOLD', 'Jemilly B.', 'Danilo Muller', 'Daniel', 47541.29, 45, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103646.00.P-22', 'NESTLÉ', 'IBIÁ-MG', 'PAINEL ELÉTRICO AMPLIAÇÃO CCM LINHA LÁCTEOS', 'Thiago R.', 'Fanti', 'Douglas', 226807.98, 90, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103677.02.P-22', 'NESTLÉ', 'ARARAS-SP', 'PAINÉIS ELÉTRICOS REMOTAS NECAFÉ', 'Thiago S.', 'Danilo Muller', 'Douglas', 356946.05, 150, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103657.00.P-22', 'ALDORO', 'RIO CLARO-SP', 'PAINÉIS ELÉTRICOS PRÉDIO PP', 'Staffan M.', 'Vinicius', 'Daniel', 239300.51, 90, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103692.00.P-22', 'CPW', 'CAÇAPAVA-SP', 'PAINÉIS ELÉTRICOS PROJETO PALLET ROLLERS', 'Alexandre N.', 'Vinicius', 'Douglas', 1095276.94, 150, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103698.00.P-22', 'CPW', 'CAÇAPAVA-SP', 'PAINÉIS ELÉTRICOS PROJETO SUPERNOVA E ROLOS PELLET', 'Alexandre N.', 'Vinicius', 'Daniel', 487853.43, 150, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103531.00.P-21', 'ROBOPAC', 'BENTO GONÇALVES–RS', 'PAINEL ELETRICO DE FORÇA E COMANDO ENVOLVEDOR DE PALETES', 'Nícolas M.', 'João H', 'Pedro', 98619.39, 90,'Aguardando aprovação cliente', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103628.00.P-22 ', 'NESTLÉ', 'ARARAS-SP', 'SERVIÇO DE LEVANTAMENTO E AS BUILT DE PROJETOS', 'Thiago S.', 'Fanti', 'Pedro', 123820, 0, 'Aguardando data para serviço', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103686.00.P-22', 'INFIBRA', 'LEME-SP', 'ADICIONAL PAINÉIS ELÉTRICOS PROJETO ADEQUAÇÃO NR10 HATSCHECK', 'César H.', 'Danilo Muller', 'Daniel', 34336.25, 90,'Analise crítica', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103644.00.P-22', 'NESTLÉ', 'IBIÁ-MG', 'PAINEL ELÉTRICO NÓ 33', 'Thiago R.', 'Fanti', 'Daniel', 106762.19, 45, 'Analise crítica', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103684.00.P-22', 'NESTLÉ', 'ITUIUTABA-MG', 'PAINÉIS ELÉTRICOS REMOTAS SAFETY EGRON', 'Reginaldo T.', 'Vinicius', 'Pedro', 179969.19, 45, 'Analise crítica', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103716.00.P-22', 'NESTLÉ', 'ARARAS-SP', 'PAINEL ELÉTRICO FORÇA E CONTROLE QUEIMADOR WEISHAUPT', 'Fernando C.', 'Fanti', 'Douglas', 123600.16, 30, 'Analise crítica', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103545.00.P-22 ', 'CPW', 'CAÇAPAVA-SP', 'PAINÉIS ELÉTRICOS PROJETO DRY MIX', 'Alexandre N.', 'Vinicius', 'Pedro', 59089.62, 90, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

        DB::insert('insert into projects
        (num_projeto, cliente, unidade, nome_projeto, Responsavel_tecnico, analista, projetista, valor_contratado, prazo_entrega, observacoes, data_fechamento, data_entrega, liberado, fase_teste, finalizado, responsavel)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array('103678.00.P-22', 'PURINA', 'RIBEIRÃO PRETO', 'PAINÉIS ELÉTRICOS PROJETO CORTINA DE AR', 'Emerson R.', 'João H', 'Daniel', 181771.8, 45, 'Em desenvolvimento', '2000-01-01', '2000-01-01', 0, 0, 0, 'Sem responsável'));

    }
}
