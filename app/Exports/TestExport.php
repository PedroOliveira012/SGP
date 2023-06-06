<?php

namespace App\Exports;

use App\Models\Task;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class TestExport implements FromQuery
{
    use Exportable;

    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function query()
    {
        return Task::query()
        ->select('painel', 'funcionario', 'inicio_tarefa', 'termino_tarefa', 'tempo_total')
        ->where('id_projeto', $this->projectId);
    }
}
