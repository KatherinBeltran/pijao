<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\Request;
use App\Models\Prestamo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class CuotaController
 * @package App\Http\Controllers
 */
class CuotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:cuotas.index')->only('index');
        $this->middleware('can:cuotas.create')->only('create', 'store');
        $this->middleware('can:cuotas.show')->only('show');
        $this->middleware('can:cuotas.edit')->only('edit', 'update');
        $this->middleware('can:cuotas.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
    
        if (!$user) {
            return "No estás autenticado.";
        }
    
        $cobradoreEmail = $user->email;
    
        // Verificar si el correo del usuario coincide con el correo en la tabla de cobradores
        $cobradore = DB::table('cobradores')->where('cor_ele_cob', $cobradoreEmail)->first();
    
        if ($cobradore) {
            // El usuario es un cobrador, obtener las cuotas asociadas a su zona
            $cuotas = Cuota::select('cuotas.*')
                ->join(DB::raw('(SELECT MAX(id) AS id FROM cuotas GROUP BY pre_cuo) AS sub'), function ($join) {
                    $join->on('cuotas.id', '=', 'sub.id');
                })
                ->join('prestamos', 'cuotas.pre_cuo', '=', 'prestamos.id')
                ->join('barrios', 'prestamos.bar_cli_pre', '=', 'barrios.id')
                ->where('barrios.zon_bar', $cobradore->zon_cob)
                ->paginate(10000);
    
            $prestamos = Prestamo::all();
    
            return view('cuota.index', compact('cuotas', 'prestamos'))
                ->with('i', (request()->input('page', 1) - 1) * $cuotas->perPage());
        } else {
            // El usuario no es un cobrador, mostrar todas las cuotas
            $cuotas = Cuota::select('cuotas.*')
                ->join(DB::raw('(SELECT MAX(id) AS id FROM cuotas GROUP BY pre_cuo) AS sub'), function ($join) {
                    $join->on('cuotas.id', '=', 'sub.id');
                })
                /*->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('prestamos')
                    ->whereRaw('prestamos.cuo_pre = cuotas.num_cuo')
                    ->whereRaw('cuotas.pre_cuo IS NOT NULL')
                    ->whereRaw('cuotas.fec_cuo IS NOT NULL')
                    ->whereRaw('cuotas.val_cuo IS NOT NULL')
                    ->whereRaw('cuotas.tot_abo_cuo IS NOT NULL')
                    ->whereRaw('cuotas.sal_cuo IS NOT NULL')
                    ->whereRaw('cuotas.num_cuo IS NOT NULL');
                })*/
                ->paginate(10000);
    
            $prestamos = Prestamo::all();
    
            return view('cuota.index', compact('cuotas', 'prestamos'))
                ->with('i', (request()->input('page', 1) - 1) * $cuotas->perPage());
        }
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener el código de prestamo (IDs)
        $prestamos = Prestamo::pluck('id', 'id');
    
        $cuota = new Cuota();

        // Asignar la fecha y hora actual al campo fec_cuo
        $cuota->fec_cuo = Carbon::now('America/Bogota')->toDateTimeString();
    
        // Verificar si ya hay un valor en pre_cuo
        $prestamo_id = $cuota->pre_cuo ? $cuota->pre_cuo : null;
    
        $primer_prestamo_id = $prestamos->first();
        $prestamo = Prestamo::findOrFail($primer_prestamo_id);
    
        return view('cuota.create', compact('cuota', 'prestamos', 'prestamo_id', 'prestamo'));
    }
    
    public function obtenerTotPre($prestamo_id)
    {
        // Busca el préstamo en la base de datos
        $prestamo = Prestamo::findOrFail($prestamo_id);
    
        // Obtiene el valor de tot_pre del préstamo
        return $prestamo->tot_pre;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cuota::$rules);

        $cuota = Cuota::create($request->all());

        return redirect()->route('cuotas.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Cuota creada exitosamente.
                                </div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuota = Cuota::find($id);

        // Recuperar registro con pre_cuo iguales
        $registrosIguales = Cuota::where('pre_cuo', $cuota->pre_cuo)
                                ->get();

        return view('cuota.show', compact('cuota', 'registrosIguales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Obtener el código de prestamo (IDs)
        $prestamos = Prestamo::pluck('id', 'id');
    
        $cuota = Cuota::find($id);
    
        // Asignar la fecha y hora actual al campo fec_cuo
        $cuota->fec_cuo = Carbon::now('America/Bogota')->toDateTimeString();
    
        // Verificar si ya hay un valor en pre_cuo
        $prestamo_id = $cuota->pre_cuo ?? null;
    
        $prestamo = Prestamo::findOrFail($cuota->pre_cuo);
    
        return view('cuota.edit', compact('cuota', 'prestamos', 'prestamo_id', 'prestamo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cuota $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuota $cuota)
    {
        // Validar los datos de entrada
        $request->validate(Cuota::$rules);

        // Obtener el préstamo asociado a esta cuota
        $prestamo = Prestamo::findOrFail($request->pre_cuo);

        // Verificar si el número de cuotas existentes es igual a cuo_pre
        $cuotas_existentes = Cuota::where('pre_cuo', $request->pre_cuo)->count();
        if ($cuotas_existentes < $prestamo->cuo_pre) {
            // Incrementar el número de cuotas existentes
            $cuotas_existentes++;

            // Crear un nuevo registro de cuota con los campos específicos
            Cuota::create([
                'pre_cuo' => $request->pre_cuo,
                'num_cuo' => $cuotas_existentes,
            ]);

            // Actualizar el registro actual con los campos editados que el usuario ha proporcionado
            $cuota->update([
                'fec_cuo' => $request->fec_cuo,
                'val_cuo' => $request->val_cuo,
                'tot_abo_cuo' => $request->tot_abo_cuo,
                'sal_cuo' => $request->sal_cuo,
                'obs_cuo' => $request->obs_cuo,
            ]);

            // Después de realizar la actualización de la cuota, obtenemos el valor de num_cuo
            $num_cuo = $cuota->num_cuo;

            // Actualizamos el campo cuo_pag_pre del préstamo asociado
            $prestamo->cuo_pag_pre = $num_cuo;

            // Obtener el total abonado
            $tot_abo_cuo = $request->tot_abo_cuo;

            // Asignar el total abonado al campo val_pag_pre del préstamo asociado
            $prestamo->val_pag_pre = $tot_abo_cuo;

            // Actualizamos el campo sig_cuo_pre del préstamo asociado con el valor de cuotas_existentes
            $prestamo->sig_cuo_pre = $cuotas_existentes;

            // Calcular el número de cuotas pendientes
            $cuo_pen_pre = $prestamo->cuo_pre - $prestamo->cuo_pag_pre;

            // Actualizar el campo cuo_pen_pre del préstamo asociado con el valor calculado
            $prestamo->cuo_pen_pre = $cuo_pen_pre;

            // Calcular el valor de las cuotas pendientes
            $val_cuo_pen_pre = $prestamo->tot_pre - $prestamo->val_pag_pre;

            // Actualizar el campo val_cuo_pen_pre del préstamo asociado con el valor calculado
            $prestamo->val_cuo_pen_pre = $val_cuo_pen_pre;

            // Guardamos los cambios en el préstamo
            $prestamo->save();

            return redirect()->route('cuotas.index')
                ->with('success', '<div class="alert alert-success alert-dismissible">
                                        <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                        Cuota actualizada exitosamente.
                                    </div>');
        }

        // Si el número de cuotas existentes ya es igual a cuo_pre, solo actualizamos el registro actual
        $cuota->update([
            'pre_cuo' => $request->pre_cuo,
            'fec_cuo' => $request->fec_cuo,
            'val_cuo' => $request->val_cuo,
            'tot_abo_cuo' => $request->tot_abo_cuo,
            'sal_cuo' => $request->sal_cuo,
            'obs_cuo' => $request->obs_cuo,
        ]);

        // Después de realizar la actualización de la cuota, obtenemos el valor de num_cuo
        $num_cuo = $cuota->num_cuo;

        // Actualizamos el campo cuo_pag_pre del préstamo asociado
        $prestamo->cuo_pag_pre = $num_cuo;

        // Obtener el total abonado
        $tot_abo_cuo = $request->tot_abo_cuo;

        // Asignar el total abonado al campo val_pag_pre del préstamo asociado
        $prestamo->val_pag_pre = $tot_abo_cuo;

        // Actualizamos el campo sig_cuo_pre del préstamo asociado con el valor de cuotas_existentes
        $prestamo->sig_cuo_pre = $cuotas_existentes;

        // Calcular el número de cuotas pendientes
        $cuo_pen_pre = $prestamo->cuo_pre - $prestamo->cuo_pag_pre;

        // Actualizar el campo cuo_pen_pre del préstamo asociado con el valor calculado
        $prestamo->cuo_pen_pre = $cuo_pen_pre;

        // Calcular el valor de las cuotas pendientes
        $val_cuo_pen_pre = $prestamo->tot_pre - $prestamo->val_pag_pre;

        // Actualizar el campo val_cuo_pen_pre del préstamo asociado con el valor calculado
        $prestamo->val_cuo_pen_pre = $val_cuo_pen_pre;

        // Guardamos los cambios en el préstamo
        $prestamo->save();

        return redirect()->route('cuotas.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Cuota actualizada exitosamente.
                                </div>');
    }    

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cuota = Cuota::find($id)->delete();

        return redirect()->route('cuotas.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Cuota eliminada exitosamente.
                                </div>');
    }
}