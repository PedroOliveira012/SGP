<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Project;

class ZettawireController extends Controller
{

    public function index(){
        $lista = Project::all();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('zettawire.index', ['lista' => $lista, 'search' => $search]);
    }

    // ZETTAWIRE CABLE ROUTING

    public function roteamento(Request $request, $id){
        
        $cabos = DB::table('cable_routing')
        ->where('project_id', $id)
        ->get();

        $wire_harness = DB::table('cable_routing')
        ->where('project_id', $id)
        ->distinct()
        ->pluck('wire_harness');

        $projeto = Project::find($id);
        
        $colors = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('color');
        $tags = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('tag');
        $origins = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('origin');
        $targets = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('target');
        $cable_cross_sections = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('cable_cross_section');
        $status = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('status');
        $paineis = explode(';', $projeto->paineis);


        return view('zettawire.roteamento',[
            'projeto' => $projeto,
            'paineis' => $paineis,
            'cabos' => $cabos,
            'colors' => $colors,
            'tags' => $tags,
            'wire_harness' => $wire_harness,
            'origins' => $origins,
            'targets' => $targets,
            'cable_cross_sections' => $cable_cross_sections,
            'status' => $status,]);
    }

    public function upload(Request $request, $id){
        $request->validate([
            'file' => 'file|mimes:xlsx,csv,xls|max:2048',
        ]);

        $path = $request->file('file')->store('uploads');
        $filepath = storage_path("app/{$path}");

        $spreadsheet = IOFactory::load($filepath);

        $worksheetNames = [
            'Lista de Cabos Singelos',
            'Lista de Cabos Blindados'
        ];

        $painel = $request->input('painel');

        for ($i = 0; $i <= 1; $i++){
            $worksheet = $spreadsheet->getSheetByName($worksheetNames[$i]);
            $linhas = $worksheet->toArray();
    
            $cabecalho = array_map('trim', $linhas[3] ?? []);
    
            //O for ignora a ultima linha do arquivo porque la não tem nada
            for ($j = 4; $j < count($linhas) - 1; $j++) {
                $linha = array_map('trim', $linhas[$j]);
                
                if (count($cabecalho) === count($linha)) {
                    $dados = array_combine($cabecalho, $linha);
    
                    $tagValue = strval($dados['ANILHA']);

                    if ($worksheet->getTitle() == 'Lista de Cabos Singelos') {
                        // dd($worksheet->getTitle());
                        $color_and_section = explode('-', $dados['CÓDIGO DO CABO']);
                        if ($color_and_section !== false && count($color_and_section) >= 3) {
                            // Verifica se o array tem pelo menos 3 elementos
                            $color_and_section = array_map('trim', $color_and_section);
                        } else {
                            continue;
                        }
                        $color =  $color_and_section[0];
                        $section =  $color_and_section[1].' - '.$color_and_section[2];
                    }else{
                        $color = $dados['COR'];
                        $section = $dados['SEÇÃO TRANSVERSAL'];
                    }
    
    
                    DB::table('cable_routing')->insert([
                        'project_id' => $id,
                        'panel' => $painel,
                        'tag' => $tagValue,
                        'origin' => $dados['ALVO'],
                        'origin_direction' => $dados['DIREÇÃO DO CABO (ALVO)'],
                        'origin_terminal_type' => $dados['TERMINAL FONTE'],
                        'target' => $dados['FONTE'],
                        'target_direction' => $dados['DIREÇÃO DO CABO (FONTE)'],
                        'target_terminal_type' => $dados['TERMINAL ALVO'],
                        'cable_cross_section' => $section,
                        'color' => $color,
                        'wire_harness' => $dados['CHICOTE'],
                        'length' => $dados['COMPRIMENTO'],
                        'status' => 0,
                    ]);
                }
            }
            // dd($worksheet->getTitle(), $j);
        }
        Storage::delete($path);
        return back();
    }

    public function origem($id){
        $originValue = (int) request()->input('origin_value');
        $cable = DB::table('cable_routing')->find($id);

        if (!$cable) {
            return response()->json([
                'success' => false, 
                'message' => 'Cabo não encontrado'], 404);
        }

        $cableStatus = $cable->status;
        $newCalculatedStatus = $cableStatus + $originValue; 

        // dd($originValue, $id);

        DB::table('cable_routing')->where('id', $id)->update([
            'status' => $newCalculatedStatus,
            'origin_value' => $originValue * -1,
        ]);

        return response()->json([
            'success' => true,
            'new_status' => $newCalculatedStatus,
            'origin_value' => $originValue
        ]);
    }

    public function destino($id){
        $targetValue = (int) request()->input('target_value');
        $cable = DB::table('cable_routing')->find($id);

        if (!$cable) {
            return response()->json([
                'success' => false, 
                'message' => 'Cabo não encontrado'], 404);
        }

        $cableStatus = $cable->status;
        $newCalculatedStatus = $cableStatus + $targetValue; 

        DB::table('cable_routing')->where('id', $id)->update([
            'status' => $newCalculatedStatus,
            'target_value' => $targetValue * -1,
        ]);

        return response()->json([
            'success' => true,
            'new_status' => $newCalculatedStatus,
            'target_value' => $targetValue
        ]);
    }

    public function getButtons($id){
        $cable_routing = DB::table('cable_routing')->where('id', $id)->first();
        return view('partials.botao', compact('cable_routing'))->render();
    }

    public function finalizaCabo($id){
        $cable = DB::table('cable_routing')->find($id);//acha o cabo
        if ($cable){
            // $originValue = (int) request()->input('origin_value');
            // $originValue = 0;
            // $targetValue = (int) request()->input('target_value');
            // $targetValue = 0;

            if($cable->status == 2){
                $cableDone = 0;
                $originValue = 1;
                $targetValue = 1;
            }else{
                $cableDone = 2;
                $originValue = -1;
                $targetValue = -1;
            }
            DB::table('cable_routing')->where('id', $id)->update([
                'status' => $cableDone,
                'origin_value' => $originValue,
                'target_value' => $targetValue,
            ]);
        }
        return response()->json([
            'success' => true,
            'new_status' => $cableDone,
            'origin_value' => $originValue,
            'target_value' => $targetValue,
        ]);
    }

    public function alterarStatus(Request $request, $id){
        $cable = DB::table('cable_routing')->where('id', $id);

        if ($cable) {
            DB::table('cable_routing')
                ->where('id', $id)
                ->update([
                    'status' => 2,
                    'origin_value' => -1,
                    'target_value' => -1
                ]);

            return response()->json(['success' => true]);
        }
    }

    public function finishProject($id){
        // $project = Project::find($id);
        $project_cables = DB::table('cable_routing')->find($id);
        if ($project_cables) {
            // Exclui todos os cabos do projeto
            DB::table('cable_routing')->where('project_id', $id)->delete();
            // Marca o projeto como concluído
            $project_cables->save();
        }
        return redirect()->route('index_zettawire')->with('success', 'Projeto concluído com sucesso!');
    }

    // ZETTAWIRE CABLE CONFECCION

    public function confeccionIndex(){
        $lista = Project::all();
        $search = request('search');
        if($search){
            $lista = Project::where('num_projeto', 'like', '%'.$search.'%')->get();
        }else{
            $lista = Project::all();
        }
        return view('zettawire.index_confeccao', ['lista' => $lista, 'search' => $search]);
    }

    public function confeccao($id){
        $projeto = Project::find($id);
        $cabos = DB::table('cable_routing')
            ->where('project_id', $id)
            ->get();
        $colors = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('color');
        $tags = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('tag');
        $wire_harness = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('wire_harness');
        $cable_cross_sections = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('cable_cross_section');
        $status = DB::table('cable_routing')
            ->where('project_id', $id)
            ->distinct()
            ->pluck('status');

        return view('zettawire.confeccao',[
            'projeto' => $projeto, 
            'cabos' => $cabos,
            'colors' => $colors,
            'tags' => $tags,
            'wire_harness' => $wire_harness,
            'cable_cross_sections' => $cable_cross_sections,
            'status' => $status,]);
    }

    public function cableDone($id){
        $cable = DB::table('cable_routing')->find($id);//acha o cabo
        if ($cable) {
            $cableDone = $cable->isdone; //== 0 ? 0 : 1; // Inverte o valor de isdone
            if ($cableDone == 0){
                $cableDone = 1;
            }else{
                $cableDone = 0;
            }
            // dd($cable->isdone, $id, $cableDone);
            DB::table('cable_routing')->where('id', $id)->update([
                'isdone' => $cableDone,
            ]);
        }
        return response()->json([
            'success' => true,
            'done_status' => $cableDone,
        ]);
    }
}
