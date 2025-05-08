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
    public function andamento(){
        $nome = Auth::user()->name;
        $cargo = Auth::user()->cargo;
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            if($cargo == 'Coordenador de Engenharia' || $cargo == 'Admin'){
                $lista = Project::all();
            }else{
                $lista = Project::where('analista', '=', $nome)->get();
            }
        }
        return view('projetos.andamento_projetos', ['lista' => $lista, /*'search' => $search]*/]);
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

    public function liberado(){
        $lista = Project::all();
        $func = User::where('cargo', '=', 'Líder de montagem')->get();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('projetos.liberado_projetos', ['lista' => $lista, 'search' => $search, 'func' => $func]);
    }

    public function novo_registro(){
        $func = User::where('cargo', 'like', '%'.'Líder de montagem'.'%')->get();
        return view('projetos.formulario_projetos', ['func' => $func]);
    }

    public function adiciona(ProjetosRequest $request){
        $projeto = new Project;
        $projeto->num_projeto = $request->input('numero_projeto');
        $projeto->cliente = strtoupper($request->input('cliente'));
        $projeto->unidade = strtoupper($request->input('unidade'));
        $projeto->nome_projeto = strtoupper($request->input('nome_projeto'));
        $projeto->analista = strtoupper($request->input('analista'));
        $projeto->projetista = strtoupper($request->input('projetista'));
        $projeto->data_fechamento = $request->input('data_fechamento');
        $projeto->data_entrega = $request->input('data_entrega');
        $paineis ="";
        if ($request->input('paineis') != null){
            for ($i = 1; $i <= $request->input('paineis'); $i++){
                if ($i <= 9){
                    $paineis .= 'E0'.$i.';';
                }else{
                    $paineis .= 'E'.$i.';';
                }
            }
        }
        $projeto->paineis = $paineis; //criar um for para fazer a string de paineis
        $projeto->status = 'Liberado';
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function remove($id){
        $projeto = Project::find($id);
        $projeto->delete();
        return redirect('projeto/liberados');
    }

    public function liberar($id){
        $projeto = Project::find($id);
        $projeto->status = "Liberado";
        $projeto->save();
        return redirect('/projeto/liberados');
    }

    public function para_teste($id){
        $projeto = Project::find($id);
        $projeto->status = "Em teste";
        $projeto->save();
        return redirect()->back();
    }

    public function concluir($id){
        $projeto = Project::find($id);
        $projeto->status = "Finalizado";
        $projeto->save();
        return redirect('projeto/teste');
    }

    public function mostra($id){
        $busca = Project::find($id);
        $func = User::where('cargo', 'like', '%'.'Líder'.'%')->get();
        // $espera = request('espera');

        if (empty($busca)){
            return "Esse projeto não existe";
        }
        return view('projetos.show_projetos',['i' => $busca, 'func' => $func]);
    }

    public function editar($id){
        $busca = Project::findOrFail($id);
        $func = User::where('cargo', 'like', '%'.'Líder de montagem'.'%')->get();
        return view('projetos.editar_projetos', ['projeto'=>$busca, 'func' => $func]);
    }

    public function atualizar($id){
        $projeto = Project::find($id);
        return redirect()->action([ProjetosController::class, 'mostra'],['id' => $projeto->id]);
    }

    public function atualizarProjeto(Request $request, $id){
        $projeto = Project::find($id); //acha o projeto

        $projeto->num_projeto = $request->input('numero_projeto');
        $projeto->cliente = $request->input('cliente');
        $projeto->unidade = $request->input('unidade');
        $projeto->nome_projeto = $request->input('nome_projeto');
        $projeto->analista = $request->input('analista');
        $projeto->projetista = $request->input('projetista');
        $projeto->data_fechamento = $request->input('data_fechamento');
        $projeto->data_entrega = $request->input('data_entrega');
        $projeto->status = 'Liberado';
        $projeto->paineis = $request->input('paineis');
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function devolverLiberado($id){
        $projeto = Project::find($id);
        $projeto->status = "Liberado";
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function devolverTeste($id){
        $projeto = Project::find($id);
        $projeto->status = "Em teste";
        $projeto->save();

        return redirect('projeto/teste');
    }

}
