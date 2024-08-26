<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ReporteExport implements FromView, WithColumnFormatting
{
    protected $reporte;
    protected $fechaInicio;
    protected $fechaFin;
    protected $capitalPrestado;
    protected $totalRecolectado;
    protected $totalDineroPrestadoConIntereses;
    protected $totalUtilidad;
    protected $utilidadNetaConGastos;
    protected $deuda;
    protected $bonosCobradores;

    public function __construct($reporte, $fechaInicio, $fechaFin, $capitalPrestado, $totalRecolectado, $totalDineroPrestadoConIntereses, $totalUtilidad, $utilidadNetaConGastos, $deuda, $bonosCobradores)
    {
        $this->reporte = $reporte;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->capitalPrestado = $capitalPrestado;
        $this->totalRecolectado = $totalRecolectado;
        $this->totalDineroPrestadoConIntereses = $totalDineroPrestadoConIntereses;
        $this->totalUtilidad = $totalUtilidad;
        $this->utilidadNetaConGastos = $utilidadNetaConGastos;
        $this->deuda = $deuda;
        $this->bonosCobradores = $bonosCobradores; 
    }

    public function view(): View
    {
        return view('excel.reporte', [
            'reporte' => $this->reporte,
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'capitalPrestado' => $this->capitalPrestado,
            'totalRecolectado' => $this->totalRecolectado,
            'totalDineroPrestadoConIntereses' => $this->totalDineroPrestadoConIntereses,
            'totalUtilidad' => $this->totalUtilidad,
            'utilidadNetaConGastos' => $this->utilidadNetaConGastos,
            'deuda' => $this->deuda,
            'bonosCobradores' => $this->bonosCobradores 
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0', // Formato personalizado para separar miles con punto
        ];
    }
}