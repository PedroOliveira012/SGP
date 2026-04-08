<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $fechamento = DB::table('projects')
        ->selectRaw('MONTH(data_fechamento) as mes, COUNT(*) as total') // seleciona o mês e conta quantos projetos foram fechados em cada mês
        ->groupBy('mes') // agrupa os resultados por mês
        ->orderBy('mes') // ordena os resultados em ordem ascendente pelo mês
        ->get();

        $entregue = DB::table('projects')
        ->selectRaw('MONTH(data_entrega) as mes, COUNT(*) as total')
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();

        // dd($fechamento, $entregue);

        $meses = [];
        $fechamentoArr = [];
        $entregueArr = [];

        $entregueMap = [];
        // cria um "mapa" para os dados de entrega, onde a chave é o mês e o valor é o total de entregas naquele mês
        foreach ($entregue as $item) {
            $entregueMap[$item->mes] = $item->total;
        }

        // percorre os dados de fechamento, preenchendo os arrays de meses, fechamento e entrega. 
        // Para o array de entrega, ele usa o "mapa" criado anteriormente para obter o total de entregas para o mês correspondente, ou 0 se não houver entregas naquele mês
        foreach ($fechamento as $item) {
            $mes = $item->mes;

            $meses[] = $mes;
            $fechamentoArr[] = $item->total;

            $entregueArr[] = $entregueMap[$mes] ?? 0;
        }

        return response()->json([
            'meses' => $meses,
            'fechamento' => $fechamentoArr,
            'entregue' => $entregueArr
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
