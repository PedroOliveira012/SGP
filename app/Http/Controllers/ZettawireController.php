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

    public function roteamento($id){
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

        return view('zettawire.roteamento',[
            'projeto' => $projeto, 
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

        $worksheet = $spreadsheet->getSheet(0);
        $linhas = $worksheet->toArray();

        $cabecalho = array_map('trim', $linhas[3] ?? []);

        //O for ignora a ultima linha do arquivo porque la não tem nada
        for ($i = 4; $i < count($linhas) - 1; $i++) {
            $linha = array_map('trim', $linhas[$i]);

            if (count($cabecalho) === count($linha)) {
                $dados = array_combine($cabecalho, $linha);

                $tagValue = strval($dados['ANILHA']);

                $color_and_section = explode('-', $dados['CÓDIGO DO CABO']);
                $color =  $color_and_section[0];
                $section =  $color_and_section[1].' - '.$color_and_section[2];

                DB::table('cable_routing')->insert([
                    'project_id' => $id,
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
        Storage::delete($path);
        return back();
    }

    public function origem($id){
        $RequestValue = (int) request()->input('origin_value'); //1 ou -1
        // Busca o valor atual
        $cable = DB::table('cable_routing')->find($id);//acha o cabo
        if ($cable) {
            $cableDone = $cable->status; //0
            // Atualiza no banco
            DB::table('cable_routing')->where('id', $id)->update([
                'status' => $cableDone + $RequestValue,
                'origin_value' => $RequestValue = $RequestValue * -1,
            ]);   
        }

        return redirect()->back();
    }

    public function destino($id){
        $RequestValue = (int) request()->input('target_value'); //1 ou -1
        // Busca o valor atual
        $cable = DB::table('cable_routing')->find($id);//acha o cabo
        if ($cable) {
            $cableDone = $cable->status; //0
            // Atualiza no banco
            DB::table('cable_routing')->where('id', $id)->update([
                'status' => $cableDone + $RequestValue,
                'target_value' => $RequestValue = $RequestValue * -1,
            ]);   
        }
        return redirect()->back();
    }

    public function buscar(Request $request){
        $query = $request->get('query');

        $cable_routing = DB::table('cable_routing')->where('origin', 'like', "%{$query}%")->get();

        return response()->json($cable_routing);
    }

    public function getButtons($id){
        $cable_routing = DB::table('cable_routing')->where('id', $id)->first();
        return view('partials.botao', compact('cable_routing'))->render();
    }

    public function finalizaCabo($id){
        $cable = DB::table('cable_routing')->find($id);//acha o cabo
        if ($cable){
            $originValue = (int) request()->input('origin_value');
            $targetValue = (int) request()->input('target_value');
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
        return redirect()->back();
    }

    public function alterarStatus(Request $request, $id){
        $cable = DB::table('cable_routing')->where('id', $id)->first();

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
        return response()->json(['success' => false, 'message' => 'Cabo não encontrado'], 404);
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
            $cableDone = $cable->isdone ? false : true; // Inverte o valor de isdone
            DB::table('cable_routing')->where('id', $id)->update([
                'isdone' => $cableDone,
            ]);
        }
        return redirect()->back();
    }
}
