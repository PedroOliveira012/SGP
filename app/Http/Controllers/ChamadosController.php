<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\chamados;

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
        $lista = chamados::all();
        return view('chamados.chamados_index',compact('lista'));
    }


    public function novo()
    {
        return view('chamados.chamados_form');
    }

    public function adiciona(Request $request)
    {
        $chamado = new chamados;
        $chamado->nome = Auth::user()->name;
        $chamado->data_e_hora = Carbon::now()->subHour(3);
        $chamado->tipo = $request->input('tipo');
        $chamado->assunto = $request->input('assunto');
        $chamado->conteudo = $request->input('conteudo');
        $chamado->status = 0;
        $chamado->save();

        return redirect('/chamados/lista');
    }

    public function concluir($id){
        $chamado = chamados::find($id);
        $chamado->status = 1;
        $chamado->save();

        return redirect('/chamados/lista');
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
