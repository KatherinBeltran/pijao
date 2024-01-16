<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pi;

class PiSecHaciendaDashController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pi-sec-hacienda-dash.index')->only('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entidadResponsable = 'SECRETARÍA DE HACIENDA'; // Reemplaza con el nombre de la entidad deseada
    
        $consecutivos = Pi::where('entidad_responsable', $entidadResponsable)->get();
    
        // Multiplicar los valores por 100
        foreach ($consecutivos as $consecutivo) {
            $consecutivo->eficiencia_2023_avance_financiero_2023 *= 100;
            $consecutivo->efectividad_2023 *= 100;
            $consecutivo->eficiencia_acumulada_avance_fisico *= 100;
        }
    
        // Calcular los promedios
        $averages['averageEficiencia'] = round(Pi::where('entidad_responsable', $entidadResponsable)->avg('eficiencia_2023_avance_financiero_2023') * 100);
        $averages['averageEficiencia1'] = round(Pi::where('entidad_responsable', $entidadResponsable)->avg('efectividad_2023') * 100);
        $averages['averageEficiencia2'] = round(Pi::where('entidad_responsable', $entidadResponsable)->avg('eficiencia_acumulada_avance_fisico') * 100);
    
        $averages['totalCompromisos'] = Pi::where('entidad_responsable', $entidadResponsable)->sum('total_compromisos_2023');
        $averages['totalCompromisos1'] = Pi::where('entidad_responsable', $entidadResponsable)->sum('total_obligaciones');
    
        return view('reporte-pi-sec-hacienda', ['consecutivos' => $consecutivos, 'averages' => $averages]);
    }
}
    