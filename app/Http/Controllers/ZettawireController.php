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

    public function roteamento($id){
        $projeto = Project::find($id);
        $cabos = DB::table('cable_routing')
            ->where('project_id', $id)
            ->get();
        return view('zettawire.roteamento',['projeto' => $projeto, 'cabos' => $cabos]);
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

                $color_and_section = explode('-', $dados['CÓDIGO DO CABO']);
                $color =  $color_and_section[0];
                $section =  $color_and_section[1];

                DB::table('cable_routing')->insert([
                    'project_id' => $id,
                    'tag' => $dados['ANILHA'],
                    'origin' => $dados['ALVO'],
                    'origin_direction' => $dados['DIREÇÃO DO CABO (ALVO)'],
                    'target' => $dados['FONTE'],
                    'target_direction' => $dados['DIREÇÃO DO CABO (FONTE)'],
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
            $DBOriginValue = $cable->status; //0
            // Atualiza no banco
            DB::table('cable_routing')->where('id', $id)->update([
                'status' => $DBOriginValue + $RequestValue,
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
            $DBOriginValue = $cable->status; //0
            // Atualiza no banco
            DB::table('cable_routing')->where('id', $id)->update([
                'status' => $DBOriginValue + $RequestValue,
                'target_value' => $RequestValue = $RequestValue * -1,
            ]);   
        }
        return redirect()->back();
    }
}
