<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PagaDiarioExport implements FromView, WithColumnFormatting
{
    protected $sumaValCuo;
    protected $sumaCapPre;
    protected $valorARecoger;
    protected $nuevosPrestamosCobrador;

    public function __construct($sumaValCuo, $sumaCapPre, $valorARecoger, $nuevosPrestamosCobrador)
    {
        $this->sumaValCuo = $sumaValCuo;
        $this->sumaCapPre = $sumaCapPre;
        $this->valorARecoger = $valorARecoger;
        $this->nuevosPrestamosCobrador = $nuevosPrestamosCobrador;
    }

    public function view(): View
    {
        return view('excel.paga-diario', [
            'sumaValCuo' => $this->sumaValCuo,
            'sumaCapPre' => $this->sumaCapPre,
            'valorARecoger' => $this->valorARecoger,
            'nuevosPrestamosCobrador' => $this->nuevosPrestamosCobrador,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0', // Formato personalizado para separar miles con punto
        ];
    }
}