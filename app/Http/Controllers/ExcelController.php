<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Exports\TestExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export($id){
        $projeto = Project::find($id);
        $nomeArquivo = strval($projeto->num_projeto) . '.xlsx';
        return Excel::download(new TestExport($projeto->id), $nomeArquivo);
    }
}
