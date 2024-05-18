<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteExport implements FromView
{
    protected $reporte;
    protected $fechaInicio;
    protected $fechaFin;
    protected $capitalPrestado;
    protected $totalRecolectado;
    protected $totalDineroPrestadoConIntereses;
    protected $totalUtilidad;
    protected $utilidadNetaConGastos;

    public function __construct($reporte, $fechaInicio, $fechaFin, $capitalPrestado, $totalRecolectado, $totalDineroPrestadoConIntereses, $totalUtilidad, $utilidadNetaConGastos)
    {
        $this->reporte = $reporte;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->capitalPrestado = $capitalPrestado;
        $this->totalRecolectado = $totalRecolectado;
        $this->totalDineroPrestadoConIntereses = $totalDineroPrestadoConIntereses;
        $this->totalUtilidad = $totalUtilidad;
        $this->utilidadNetaConGastos = $utilidadNetaConGastos;
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
            'utilidadNetaConGastos' => $this->utilidadNetaConGastos
        ]);
    }
}