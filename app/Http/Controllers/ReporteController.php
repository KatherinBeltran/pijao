<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use DB;
use App\Models\Prestamo;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;
use App\Models\Cobrador;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reportes.index')->only('index');
    }

    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        // Obtener la lista de categorías y la suma de los montos asociados a cada una
        $reporte = Categoria::select('nom_cat', DB::raw('SUM(g.mon_gas) as suma_montos'))
            ->leftJoin('gastos as g', 'categorias.id', '=', 'g.cat_gas')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('g.fec_gas', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('categorias.id', 'nom_cat')
            ->get();
        
        // Filtrar los préstamos según la fecha de préstamo
        $prestamos = Prestamo::when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fec_pre', [$fechaInicio, $fechaFin]);
        })
        ->get();
    
        // Calcular los valores para la segunda tabla
        $capitalPrestado = $prestamos->sum('cap_pre');
        $totalRecolectado = $prestamos->sum('val_pag_pre');
        $totalDineroPrestadoConIntereses = $prestamos->sum('tot_pre');
        $totalUtilidad = $totalDineroPrestadoConIntereses - $capitalPrestado;
        $utilidadNetaConGastos = $totalUtilidad - $reporte->sum('suma_montos');
    
        $deuda = $totalDineroPrestadoConIntereses - $totalRecolectado;
    
        // Calcular bonos a cobradores
        $bonosCobradores = Prestamo::select('cobradores.nom_cob', DB::raw('SUM(CASE WHEN pag_pre = "Diario" THEN val_cuo_pre ELSE tot_pre / 30 END) as total_bono'))
            ->join('cobradores', 'prestamos.reg_pre', '=', 'cobradores.num_ced_cob')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fec_pre', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('cobradores.nom_cob')
            ->get();
    
        return view('reportes', compact('reporte', 'fechaInicio', 'fechaFin', 'capitalPrestado', 'totalRecolectado', 'totalDineroPrestadoConIntereses', 'totalUtilidad', 'utilidadNetaConGastos', 'deuda', 'bonosCobradores'));
    }    

    public function generarPDF(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        // Obtener el reporte de gastos
        $reporte = Categoria::select('nom_cat', DB::raw('SUM(g.mon_gas) as suma_montos'))
            ->leftJoin('gastos as g', 'categorias.id', '=', 'g.cat_gas')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('g.fec_gas', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('categorias.id', 'nom_cat')
            ->get();
    
        // Obtener los préstamos
        $prestamos = Prestamo::when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fec_pre', [$fechaInicio, $fechaFin]);
        })
        ->get();
    
        // Calcular los valores para la segunda tabla
        $capitalPrestado = $prestamos->sum('cap_pre');
        $totalRecolectado = $prestamos->sum('val_pag_pre');
        $totalDineroPrestadoConIntereses = $prestamos->sum('tot_pre');
        $totalUtilidad = $totalDineroPrestadoConIntereses - $capitalPrestado;
        $utilidadNetaConGastos = $totalUtilidad - $reporte->sum('suma_montos');
    
        $deuda = $totalDineroPrestadoConIntereses - $totalRecolectado;
    
        // Calcular bonos a cobradores
        $bonosCobradores = Prestamo::select('cobradores.nom_cob', DB::raw('SUM(CASE WHEN pag_pre = "Diario" THEN val_cuo_pre ELSE tot_pre / 30 END) as total_bono'))
            ->join('cobradores', 'prestamos.reg_pre', '=', 'cobradores.num_ced_cob')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fec_pre', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('cobradores.nom_cob')
            ->get();
    
        // Crear una instancia de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
    
        $html = view('pdf.reporte', compact('reporte', 'fechaInicio', 'fechaFin', 'capitalPrestado', 'totalRecolectado', 'totalDineroPrestadoConIntereses', 'totalUtilidad', 'utilidadNetaConGastos', 'deuda', 'bonosCobradores'))->render();
    
        // Cargar el contenido HTML al Dompdf
        $dompdf->loadHtml($html);
    
        // Establecer el tamaño de papel y la orientación
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $dompdf->render();
    
        // Obtener el contenido del PDF como una cadena
        $output = $dompdf->output();
    
        // Devolver el PDF como una respuesta HTTP
        return Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"'
        ]);
    }    

    public function generarExcel(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        // Obtener el reporte de gastos
        $reporte = Categoria::select('nom_cat', DB::raw('SUM(g.mon_gas) as suma_montos'))
            ->leftJoin('gastos as g', 'categorias.id', '=', 'g.cat_gas')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('g.fec_gas', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('categorias.id', 'nom_cat')
            ->get();
    
        // Obtener los préstamos
        $prestamos = Prestamo::when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fec_pre', [$fechaInicio, $fechaFin]);
        })
        ->get();
    
        // Calcular los valores para la segunda tabla
        $capitalPrestado = $prestamos->sum('cap_pre');
        $totalRecolectado = $prestamos->sum('val_pag_pre');
        $totalDineroPrestadoConIntereses = $prestamos->sum('tot_pre');
        $totalUtilidad = $totalDineroPrestadoConIntereses - $capitalPrestado;
        $utilidadNetaConGastos = $totalUtilidad - $reporte->sum('suma_montos');
    
        $deuda = $totalDineroPrestadoConIntereses - $totalRecolectado;
    
        // Calcular bonos a cobradores
        $bonosCobradores = Prestamo::select('cobradores.nom_cob', DB::raw('SUM(CASE WHEN pag_pre = "Diario" THEN val_cuo_pre ELSE tot_pre / 30 END) as total_bono'))
            ->join('cobradores', 'prestamos.reg_pre', '=', 'cobradores.num_ced_cob')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fec_pre', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('cobradores.nom_cob')
            ->get();
        
        return Excel::download(new ReporteExport($reporte, $fechaInicio, $fechaFin, $capitalPrestado, $totalRecolectado, $totalDineroPrestadoConIntereses, $totalUtilidad, $utilidadNetaConGastos, $deuda, $bonosCobradores), 'reporte.xlsx');
    }    
}
