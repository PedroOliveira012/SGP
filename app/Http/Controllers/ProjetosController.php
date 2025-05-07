<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ProjetosRequest;
use App\Models\Project;
use App\Models\Comments;
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
            //$lista = Project::all();
            if($cargo == 'Diretor' || $cargo == 'Coordenador de Engenharia' || $cargo == 'Admin'){
                $lista = Project::all();
            }else{
                $lista = Project::where('analista', '=', $nome)->get();
            }
        }
        return view('projetos.andamento_projetos', ['lista' => $lista, /*'search' => $search]*/]);
    }

    public function encerrado(){
        $lista = Project::where('finalizado', '=', 1)->get();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('projetos.encerrados_projetos', ['lista' => $lista, 'search' => $search]);
    }

    public function teste(){
        $lista = Project::where('fase_teste', '=', 1)->get();
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
        $projeto->cliente = $request->input('cliente');
        $projeto->unidade = $request->input('unidade');
        $projeto->nome_projeto = $request->input('nome_projeto');
        $projeto->Responsavel_tecnico = $request->input('responsavel');
        $projeto->analista = $request->input('analista');
        $projeto->projetista = $request->input('projetista');
        $projeto->valor_contratado = $request->input('valor');
        $projeto->prazo_entrega = $request->input('prazo');
        $projeto->observacoes = $request->input('obs');
        $projeto->data_fechamento = $request->input('data_fechamento');
        $projeto->data_entrega = Carbon::parse($projeto->data_fechamento)->addDays($projeto->prazo_entrega);
        $projeto->liberado = 1;
        $projeto->finalizado = 0;
        $projeto->fase_teste = 0;
        $projeto->responsavel = $request->input('responsavel_select');
        $projeto->paineis = $request->input('paineis');
        $projeto->save();

        return redirect('projeto/andamento');
    }

    public function remove($id){
        $projeto = Project::find($id);
        $projeto->delete();
        return redirect('projeto/andamento');
    }

    public function liberar($id){
        $projeto = Project::find($id);
        $projeto->liberado = 1;
        $projeto->save();
        return redirect('/projeto/andamento');
    }

    public function para_teste($id){
        $projeto = Project::find($id);
        $projeto->fase_teste = 1;
        $projeto->liberado = 0;
        $projeto->save();
        return redirect()->back();
    }

    public function concluir($id){
        $projeto = Project::find($id);
        $projeto->finalizado = 1;
        $projeto->fase_teste = 0;
        $projeto->save();
        return redirect('projeto/teste');
    }

    public function mostra($id){
        $busca = Project::find($id);
        $progresso = $busca->progresso;
        $func = User::where('cargo', 'like', '%'.'Líder'.'%')->get();
        $comentario = Comments::where('id_projeto', 'like', $id)->get();
        // $espera = request('espera');

        if (empty($busca)){
            return "Esse projeto não existe";
        }
        return view('projetos.show_projetos',['i' => $busca, 'comentario' => $comentario, 'func' => $func, 'progresso' => $progresso]);
    }

    public function editar($id){
        $busca = Project::findOrFail($id);
        $func = User::where('cargo', 'like', '%'.'Líder de montagem'.'%')->get();
        return view('projetos.editar_projetos', ['projeto'=>$busca, 'func' => $func]);
    }

    public function atualizar($id){
        $projeto = Project::find($id);
        if ($projeto->responsavel == ''){
            $projeto->responsavel = 'nenhum';
        }else{
            $projeto->responsavel = request('responsavel_select');
        }
        $projeto->save();
        return redirect()->action([ProjetosController::class, 'mostra'],['id' => $projeto->id]);
    }

    public function atualizarProgresso($id, $idButton){
        $projeto = Project::find($id);

        if ($projeto->progresso == $idButton){
            $projeto->progresso -= 1;
        }else {
            $projeto->progresso = $idButton;
        }

        $projeto->save();
        return redirect()->action([ProjetosController::class, 'mostra'],['progresso'=>$projeto->progresso, 'id' => $projeto->id]);

    }

    public function atualizarProjeto(Request $request, $id){
        $projeto = Project::find($id); //acha o projeto

        $projeto->num_projeto = $request->input('numero_projeto');
        $projeto->cliente = $request->input('cliente');
        $projeto->unidade = $request->input('unidade');
        $projeto->nome_projeto = $request->input('nome_projeto');
        $projeto->Responsavel_tecnico = $request->input('responsavel');
        $projeto->analista = $request->input('analista');
        $projeto->projetista = $request->input('projetista');
        $projeto->valor_contratado = $request->input('valor');
        $projeto->prazo_entrega = $request->input('prazo');
        $projeto->observacoes = $request->input('obs') ?? '';
        $projeto->data_fechamento = $request->input('data_fechamento');
        $projeto->data_entrega = Carbon::parse($projeto->data_fechamento)->addDays($projeto->prazo_entrega);
        $projeto->liberado = 1;
        $projeto->finalizado = 0;
        $projeto->fase_teste = 0;
        $projeto->responsavel = $request->input('responsavel_select');
        $projeto->paineis = $request->input('paineis');
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function devolverLiberado($id){
        $projeto = Project::find($id);
        $projeto->fase_teste = 0;
        $projeto->liberado = 1;
        $projeto->save();

        return redirect('projeto/liberados');
    }

    public function devolverTeste($id){
        $projeto = Project::find($id);
        $projeto->fase_teste = 1;
        $projeto->finalizado = 0;
        $projeto->save();

        return redirect('projeto/teste');
    }

    public function add_comentario(Request $request){
        $comentario = new Comments;
        $comentario->id_projeto = $request->input('id_projeto');
        $comentario->comentario = $request->input('comentario');
        $comentario->usuario = Auth::user()->name;
        $comentario->save();

        return redirect()->action([ProjetosController::class, 'mostra'],['id' => $comentario->id_projeto]);
    }

}
