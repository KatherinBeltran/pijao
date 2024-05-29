<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PagaDiarioExport implements FromView
{
    protected $sumaValCuo;
    protected $sumaCapPre;

    public function __construct($sumaValCuo, $sumaCapPre)
    {
        $this->sumaValCuo = $sumaValCuo;
        $this->sumaCapPre = $sumaCapPre;
    }

    public function view(): View
    {
        return view('excel.paga-diario', [
            'sumaValCuo' => $this->sumaValCuo,
            'sumaCapPre' => $this->sumaCapPre
        ]);
    }
}