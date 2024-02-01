<?php

namespace App\Exports;

use App\Models\Task;
// use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class TestExport implements FromQuery, ShouldAutoSize, WithEvents, WithHeadings{
    use Exportable;

    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function query(){
        return Task::query()
        ->select('painel', 'funcionario', 'tarefa', 'inicio_tarefa', 'termino_tarefa', 'tempo_total')
        ->where('id_projeto', $this->projectId);
    }

    public function headings(): array
    {
        return [
            'Painel',
            'Funcionário',
            'Tarefa',
            'Início da Tarefa',
            'Término da Tarefa',
            'Tempo Total',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                // Estilo para a primeira linha (cabeçalho)
                $sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '000000',
                        ],
                    ],
                ]);

                $tempoTotalProjeto = 0;
                for ($row = 2; $row <= $highestRow; $row++) {
                    $tempoTotalTarefa = $sheet->getCell('F'.$row)->getValue();
                    $tempoTotalProjeto += $tempoTotalTarefa;
                    if ($tempoTotalTarefa > 60){
                        $tempoFormatadoHora = floor($tempoTotalTarefa /60);
                        $tempoFormatadoMin = $tempoTotalTarefa % 60;
                        $novoTempo = sprintf('%d h e %d min', $tempoFormatadoHora, $tempoFormatadoMin);
                        $sheet->setCellValue('F'.$row, $novoTempo);
                    }else{{
                        $novoTempo = sprintf('%d min', $tempoTotalTarefa);
                        $sheet->setCellValue('F'.$row, $novoTempo);
                    }}

                    $style = ($row % 2 == 0) ? '4bacc6' : '31869b';

                    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => $style,
                            ],
                        ],
                        'font' => [
                            'color' => ['rgb' => 'FFFFFF'],
                        ],
                    ]);
                }
                $rowTempoTotalProjeto = $highestRow + 1;
                $tempoFormatadoHora = floor($tempoTotalProjeto /60);
                $tempoFormatadoMin = $tempoTotalProjeto % 60;
                $tempoTotalProjeto = sprintf('%d h e %d min', $tempoFormatadoHora, $tempoFormatadoMin);
                $sheet->setCellValue('F'.$rowTempoTotalProjeto, $tempoTotalProjeto);
            },
        ];
    }

    public function startCell(): string
    {
        return 'G1'; // Define a célula de início para B2
    }
}
