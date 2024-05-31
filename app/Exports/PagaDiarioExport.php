<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PagaDiarioExport implements FromView
{
    protected $sumaValCuo;
    protected $sumaCapPre;
    protected $nuevosPrestamosCobrador;

    public function __construct($sumaValCuo, $sumaCapPre, $nuevosPrestamosCobrador)
    {
        $this->sumaValCuo = $sumaValCuo;
        $this->sumaCapPre = $sumaCapPre;
        $this->nuevosPrestamosCobrador = $nuevosPrestamosCobrador;
    }

    public function view(): View
    {
        return view('excel.paga-diario', [
            'sumaValCuo' => $this->sumaValCuo,
            'sumaCapPre' => $this->sumaCapPre,
            'nuevosPrestamosCobrador' => $this->nuevosPrestamosCobrador,
        ]);
    }
}