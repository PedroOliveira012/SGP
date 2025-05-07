<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamados;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class ChamadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        $lista = Chamados::all();
        $status = request('escolher-status');

        if ($status == 'Reclamação'){
            $lista = Chamados::where([['tipo', '=', $status]])->get();
        }elseif ($status =='Sugestão'){
            $lista = Chamados::where([['tipo', '=', $status]])->get();
        }else{
            $lista = Chamados::all();
        }

        return view('chamados.chamados_index',compact('lista'));
    }


    public function novo()
    {
        return view('chamados.chamados_form');
    }

    public function adiciona(Request $request)
    {
        $chamado = new Chamados;
        $chamado->nome = Auth::user()->name;
        $chamado->data_e_hora = Carbon::now()->subHour(3);
        $chamado->tipo = $request->input('tipo');
        $chamado->assunto = $request->input('assunto');
        $chamado->conteudo = $request->input('conteudo');
        $chamado->status = 0;
        $chamado->save();

        return redirect('/Chamados/lista');
    }

    public function concluir($id){
        $chamado = Chamados::find($id);
        $chamado->status = 1;
        $chamado->save();

        return redirect('/Chamados/lista');
    }

    public function mostra($id){
        $chamado = Chamados::find($id);
        return view('chamados.chamados_mostra', compact('chamado'));
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
