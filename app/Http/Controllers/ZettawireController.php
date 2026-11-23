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

    public function roteamento(Request $request, $id, $panel){
        
        $cabos = DB::table('cable_routing')
        ->where('project_id', $id)
        ->where('panel', $panel)
        ->get();

        $route_name = 'roteamento';

        $wire_harness = DB::table('cable_routing')
        ->where('project_id', $id)
        ->where('panel', $panel)
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

        $paineis = $projeto->paineis;
        if ($paineis != "E01"){
            $paineis = explode(';', $projeto->paineis);
        }

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
            'status' => $status,
            'selected_panel' => $panel,
            'route_name' => $route_name
        ]);
    }

    public function uploadXlsx(Request $request, $id){
        $request->validate([
            'file' => 'file|mimes:xlsx,csv,xls|max:2048',
        ]);

        $path = $request->file('xlsxFile')->store('uploads');
        $filepath = storage_path("app/{$path}");

        $spreadsheet = IOFactory::load($filepath);

        $worksheetNames = [
            'Lista de Cabos Singelos',
            'Lista de Cabos Blindados'
        ];

        $painel = $request->input('painel');

        for ($i = 0; $i <= 1; $i++){
            $worksheet = $spreadsheet->getSheetByName($worksheetNames[$i]);

            if ($worksheet === null) {
                continue;
            }

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

                    if ($id == '' ||
                    $painel == '' ||
                    $tagValue == '' ||
                    $dados['ALVO'] == '' ||
                    $dados['DIREÇÃO DO CABO (ALVO)'] == '' ||
                    $dados['TERMINAL FONTE'] == '' ||
                    $dados['FONTE'] == '' ||
                    $dados['DIREÇÃO DO CABO (FONTE)'] == '' ||
                    $dados['TERMINAL ALVO'] == '' ||
                    $dados['CHICOTE'] == '' ||
                    $dados['COMPRIMENTO'] == '' ||
                    $section == '' ||
                    $color == '' ||
                    $dados['ANILHA'] == '')
                    {
                        continue;
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
        return back()->with('success', 'Cabos gravados com sucesso.');
    }

    public function uploadPdf(Request $request, $id){
        $request->validate([
            'file' => 'file|mimes:pdf|max:15360',
        ]);

        $file = $request->file('pdfFile');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $directoryName = 'uploads/' . substr($fileName,0,14) . '/' . substr($fileName,14,3);
        $path = $file->storeAs($directoryName, $file->getClientOriginalName(), 'local');

        return back()->with('success', 'Diagrama do projeto salvo com sucesso.');
    }

    public function download($id, $panel){
        $project = Project::find($id);

        $diretorio = 'uploads/' . $project->num_projeto . '/' . $panel . '/';
        $arquivos = Storage::files($diretorio);
        if (!empty($arquivos)) {
            $caminhoArquivo = $arquivos[0];
            return Storage::download($caminhoArquivo);
        }
        return redirect()->back()->with('error', 'O arquivo solicitado não foi encontrado.');

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

    private const LIMITE_BUSCA = 300; //Constante que define o limite de cabos retornados na busca
    
    public function confeccao(Request $request, $id, $panel){
        $projeto = Project::findOrFail($id);
    
        // Regra da tela (antes aplicada em PHP, depois de carregar TODOS os cabos):
        // seção < 16 mm² OU anilha PE ligada a um destino "=-l."
        $regraConfeccao = function ($q) {
            $q->whereRaw("CAST(REPLACE(cable_cross_section, 'mm²', '') AS UNSIGNED) < 16")
              ->orWhere(function ($q2) {
                  $q2->where('tag', 'PE')->where('target', 'like', '%=-l.%');
                }
            );
        };
    
        // Query base: cabos DESTE painel que entram na confecção.
        $base = fn () => DB::table('cable_routing')
            ->where('project_id', $id)
            ->where('panel', $panel)
            ->where($regraConfeccao);
    
        $colunas = [
            'id', 'wire_harness', 'tag', 'cable_cross_section',
            'origin_terminal_type', 'origin', 'origin_direction',
            'target_terminal_type', 'target', 'target_direction',
            'color', 'length', 'isdone', 'panel',
        ];
    
        // 1) Chicotes do painel, com total e feitos. Uma query agrupada (poucas linhas).
        //    Ordem = ordem de primeira aparição (MIN(id)), igual à que o dropdown tinha.
        //    Para ordem alfabética, troque por ->orderBy('wire_harness').
        $chicotesPainel = $base()
            ->select(
                'wire_harness',
                DB::raw('COUNT(*) AS total'),
                DB::raw('SUM(CASE WHEN isdone = 1 THEN 1 ELSE 0 END) AS feitos'),
                DB::raw('MIN(id) AS primeiro_id')
            )
            ->groupBy('wire_harness')
            ->orderBy('primeiro_id')
            ->get();
    
        // 2) Progresso do PAINEL INTEIRO (sai da mesma query, sem custo extra)
        $progresso = [
            'total'  => (int) $chicotesPainel->sum('total'),
            'feitos' => (int) $chicotesPainel->sum('feitos'),
        ];
    
        // 3) Tipo (singelo x multivias): multivias = chicote com '=-' ou 'SH' no nome
        $tipo = in_array($request->query('tipo'), ['singelo', 'multi'], true)
            ? $request->query('tipo')
            : null;
    
        $ehMulti = fn ($nome) => str_contains($nome, '=-') || str_contains($nome, 'SH');
    
        $chicotes = $tipo === null ?
            $chicotesPainel : 
            $chicotesPainel->filter(
                fn ($c) => $tipo === 'multi' ? $ehMulti($c->wire_harness) : ! $ehMulti($c->wire_harness)
            )->values();
    
        // 4) Busca (em TODOS os cabos do painel) ou chicote atual
        $busca = trim((string) $request->query('busca', ''));
        $chicoteAtual = null;
        $totalBusca = null;
    
        if ($busca !== '') {
            $termo = '%' . addcslashes($busca, '%_\\') . '%';
    
            $consulta = $base()->where(function ($q) use ($termo) {
                $q->where('tag', 'like', $termo)            // anilha
                  ->orWhere('wire_harness', 'like', $termo) // chicote
                  ->orWhere('origin', 'like', $termo)       // componente origem
                  ->orWhere('target', 'like', $termo);      // componente destino
            });
    
            $totalBusca = (clone $consulta)->count();
            $cabos = $consulta->select($colunas)
                ->orderBy('id')
                ->limit(self::LIMITE_BUSCA)
                ->get();
        } else {
            // Chicote pedido na URL (se existir neste painel) ou o primeiro da lista
            $pedido = $request->query('chicote');
            $chicoteAtual = filled($pedido)
                ? $chicotesPainel->firstWhere('wire_harness', $pedido)
                : null;
            $chicoteAtual = $chicoteAtual ?? $chicotes->first();
    
            $cabos = $chicoteAtual
                ? $base()->select($colunas)
                    ->where('wire_harness', $chicoteAtual->wire_harness)
                    ->orderBy('id')
                    ->get()
                : collect();
        }
    
        return view('zettawire.confeccao', [
            'projeto'        => $projeto,
            'paineis'        => explode(';', $projeto->paineis),
            'cabos'          => $cabos,
            'chicotes'       => $chicotes,       // lista do dropdown (já filtrada pelo tipo)
            'chicoteAtual'   => $chicoteAtual,   // null no modo busca
            'tipo'           => $tipo,
            'busca'          => $busca,
            'totalBusca'     => $totalBusca,
            'progresso'      => $progresso,
            'selected_panel' => $panel,
            'route_name'     => 'confeccion',
        ]);
    }

    public function cableDone($id){
        $cable = DB::table('cable_routing')->find($id);//acha o cabo
        // dd($id);
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
