<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ProjetosRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Laravel\Ui\Presets\React;

class ProjetosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function formAdicionaProjeto(){
        return view('projetos.formulario_projetos',);
    }
    public function encerrado(){
        $lista = Project::where('status', '=', 'Finalizado')->get();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('projetos.encerrados_projetos', ['lista' => $lista, 'search' => $search]);
    }

     public function devolverParaTeste($id){
        $projeto = Project::find($id);
        $projeto->status = "Em teste";
        $projeto->save();

        return redirect('projeto/teste');
    }
    
    public function teste(){
        $lista = Project::where('status', '=', 'Em teste')->get();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('projetos.teste_projetos', ['lista' => $lista, 'search' => $search]);
    }

   public function devolverParaLiberados($id){
        $projeto = Project::find($id);
        $projeto->status = "Liberado";
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function moverParaFinalizados($id){
        $projeto = Project::find($id);
        $projeto->status = "Finalizado";
        $projeto->save();
        return redirect('projeto/teste');
    }

    public function liberado(){
        $lista = Project::all();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('projetos.liberado_projetos', ['lista' => $lista, 'search' => $search]);
    }

    public function moverParaTeste($id){
        $projeto = Project::find($id);
        $projeto->status = "Em teste";
        $projeto->save();
        return redirect()->back();
    }

    public function adiciona(ProjetosRequest $request){
        $projeto = new Project;
        $projeto->num_projeto = $request->input('numero_projeto');
        $projeto->cliente = strtoupper($request->input('cliente'));
        $projeto->unidade = strtoupper($request->input('cidade')).'-'.strtoupper($request->input('UF'));
        $projeto->nome_projeto = strtoupper($request->input('nome_projeto'));
        $projeto->analista = strtoupper($request->input('analista'));
        $projeto->projetista = strtoupper($request->input('projetista'));
        $projeto->data_fechamento = $request->input('data_fechamento');
        $projeto->data_entrega = $request->input('data_entrega');
        $paineis ="";
        if ($request->input('paineis') != null){
            for ($i = 1; $i <= $request->input('paineis'); $i++) {
                if ($i > 1) {
                    $paineis .= ';';
                }
                $paineis .= 'E' . str_pad($i, 2, '0', STR_PAD_LEFT);
            }
        }
        $projeto->paineis = $paineis;
        $projeto->status = 'Liberado';
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function remove($id){
        $projeto = Project::find($id);
        $projeto->delete();
        return redirect('projeto/liberados');
    }

    public function mostra($id){
        $busca = Project::find($id);
        return view('projetos.show_projetos',['i' => $busca, 'paineis' => explode(';', $busca->paineis)]);
    }
}
