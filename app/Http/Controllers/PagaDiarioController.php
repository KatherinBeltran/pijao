<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PagaDiarioExport;
use App\Models\Cuota;
use App\Models\Prestamo;

class PagaDiarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:paga-diario.index')->only('index');
    }

    public function index(Request $request)
    {
        // Obtener la fecha actual en Bogotá, Colombia
        $fechaHoy = now()->setTimezone('America/Bogota')->toDateString();

        // Consultar la base de datos para obtener la suma de val_cuo
        $sumaValCuo = Cuota::whereDate('fec_cuo', $fechaHoy)->sum('val_cuo');

        // Consultar la base de datos para obtener la suma de cap_pre
        $sumaCapPre = Prestamo::whereDate('fec_pre', $fechaHoy)->sum('cap_pre');
    
        // Obtener los nuevos préstamos realizados hoy, junto con el nombre del cobrador
        $nuevosPrestamosCobrador = Prestamo::whereDate('fec_pre', $fechaHoy)
            ->join('cobradores', 'prestamos.reg_pre', '=', 'cobradores.num_ced_cob')
            ->select('cobradores.nom_cob', 'prestamos.val_cuo_pre')
            ->get();
    
        return view('paga-diario', compact('sumaValCuo', 'sumaCapPre', 'nuevosPrestamosCobrador'));
    }

    public function generarPDF(Request $request)
    {
        // Obtener la fecha actual en Bogotá, Colombia
        $fechaHoy = now()->setTimezone('America/Bogota')->toDateString();

        // Consultar la base de datos para obtener la suma de val_cuo
        $sumaValCuo = Cuota::whereDate('fec_cuo', $fechaHoy)->sum('val_cuo');

        // Consultar la base de datos para obtener la suma de cap_pre
        $sumaCapPre = Prestamo::whereDate('fec_pre', $fechaHoy)->sum('cap_pre');

        // Obtener los nuevos préstamos realizados hoy, junto con el nombre del cobrador
        $nuevosPrestamosCobrador = Prestamo::whereDate('fec_pre', $fechaHoy)
        ->join('cobradores', 'prestamos.reg_pre', '=', 'cobradores.num_ced_cob')
        ->select('cobradores.nom_cob', 'prestamos.val_cuo_pre')
        ->get();
    
        // Crear una instancia de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
    
        // Crear el contenido HTML del PDF
        $html = view('pdf.paga-diario', compact('sumaValCuo', 'sumaCapPre', 'nuevosPrestamosCobrador'))->render();
    
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
            'Content-Disposition' => 'inline; filename="paga-diario.pdf"'
        ]);
    }

    public function generarExcel(Request $request)
    {
       // Obtener la fecha actual en Bogotá, Colombia
       $fechaHoy = now()->setTimezone('America/Bogota')->toDateString();

       // Consultar la base de datos para obtener la suma de val_cuo
       $sumaValCuo = Cuota::whereDate('fec_cuo', $fechaHoy)->sum('val_cuo');

       // Consultar la base de datos para obtener la suma de cap_pre
       $sumaCapPre = Prestamo::whereDate('fec_pre', $fechaHoy)->sum('cap_pre');
       
        // Obtener los nuevos préstamos realizados hoy, junto con el nombre del cobrador
        $nuevosPrestamosCobrador = Prestamo::whereDate('fec_pre', $fechaHoy)
        ->join('cobradores', 'prestamos.reg_pre', '=', 'cobradores.num_ced_cob')
        ->select('cobradores.nom_cob', 'prestamos.val_cuo_pre')
        ->get();

        // Exportar a Excel
        return Excel::download(new PagaDiarioExport($sumaValCuo, $sumaCapPre, $nuevosPrestamosCobrador), 'paga-diario.xlsx');
    }
}