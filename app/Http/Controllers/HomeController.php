<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Verificar si el usuario autenticado es un administrador
        $esAdmin = auth()->user()->hasRole('Administrador');

        // Tu lógica para obtener los datos de la tabla de prestamos
        $prestamos = Prestamo::all();
    
        // Verifica si hay prestamos pendientes
        $prestamosPendientes = $prestamos->contains('est_pag_pre', 'Pendiente');

        // Obtener los datos para el gráfico
        $prestamosPorMes = DB::table('prestamos')
        ->select(
            DB::raw('MONTH(fec_pre) as mes'),
            DB::raw('YEAR(fec_pre) as anio'),
            DB::raw('SUM(cap_pre) as total')
        )
        ->groupBy('mes', 'anio')
        ->orderBy('anio', 'asc')
        ->orderBy('mes', 'asc')
        ->get();

        $datos = array();
        foreach ($prestamosPorMes as $prestamo) {
            $mes = Carbon::createFromDate(null, $prestamo->mes, null)->isoFormat('MMMM');
            $datos[] = array(
                'mes' => $mes . ' ' . $prestamo->anio,
                'total' => $prestamo->total
            );
        }

        return view('home', [
            'prestamosPendientes' => $prestamosPendientes,
            'esAdmin' => $esAdmin,
            'datos' => $datos,
        ]);
    }
}