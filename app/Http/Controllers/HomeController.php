<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Cobradore;
use App\Models\Gasto;

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

    // Tu lógica para obtener los datos de la tabla de cobradores
    $cobradores = Cobradore::all();

    // Obtener el conteo de registros de la tabla cobradores
    $cobradorCount = $cobradores->count();

    // Tu lógica para obtener los datos de la tabla de prestamos
    $prestamos = Prestamo::all();

    // Obtener el conteo de préstamos que cumplen con la condición
    $prestamosActivos = 0;

    foreach ($prestamos as $prestamo) {
        // Verificar si val_pag_pre es diferente de tot_pre
        if ($prestamo->val_pag_pre != $prestamo->tot_pre) {
            $prestamosActivos++;
        }
    }

    // Obtener el conteo de cuotas que cumplen con la condición
    $cuotasActivas = 0;
    foreach ($prestamos as $prestamo) {
        $cuotas = $prestamo->cuotas;
        
        // Ordenar las cuotas por fec_cuo en orden descendente
        $cuotaMasReciente = $cuotas->sortByDesc('fec_cuo')->first();
        
        // Verificar si las propiedades necesarias no son nulas en la cuota más reciente
        if ($cuotaMasReciente && (
            is_null($cuotaMasReciente->pre_cuo) || 
            is_null($cuotaMasReciente->fec_cuo) || 
            is_null($cuotaMasReciente->val_cuo) || 
            is_null($cuotaMasReciente->tot_abo_cuo) || 
            is_null($cuotaMasReciente->sal_cuo) || 
            is_null($cuotaMasReciente->num_cuo)
        )) {
            $cuotasActivas++;
        }
    }

    // Tu lógica para obtener los datos de la tabla de gastos
    $gastos = Gasto::all();

    // Obtener el conteo de registros de la tabla gastos
    $gastoCount = $gastos->count();

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

    // Obtener los datos de gastos por mes
    $gastosPorMes = DB::table('gastos')
    ->select(
        DB::raw('MONTH(fec_gas) as mes'),
        DB::raw('YEAR(fec_gas) as anio'),
        DB::raw('SUM(mon_gas) as total')
    )
    ->groupBy('mes', 'anio')
    ->orderBy('anio', 'asc')
    ->orderBy('mes', 'asc')
    ->get();

    $datosGastos = array();
    foreach ($gastosPorMes as $gasto) {
    $mes = Carbon::createFromDate(null, $gasto->mes, null)->isoFormat('MMMM');
    $datosGastos[] = array(
        'mes' => $mes . ' ' . $gasto->anio,
        'total' => $gasto->total
    );
    }

    return view('home', [
        'prestamosPendientes' => $prestamosPendientes,
        'esAdmin' => $esAdmin,
        'datos' => $datos,
        'datosGastos' => $datosGastos,
        'cobradorCount' => $cobradorCount,
        'prestamosActivos' => $prestamosActivos,
        'gastoCount' => $gastoCount,
        'cuotasActivas' => $cuotasActivas,
    ]);
}
}