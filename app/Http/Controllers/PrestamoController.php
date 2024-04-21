<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;

/**
 * Class PrestamoController
 * @package App\Http\Controllers
 */
class PrestamoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:prestamos.index')->only('index');
        $this->middleware('can:prestamos.create')->only('create', 'store');
        $this->middleware('can:prestamos.show')->only('show');
        $this->middleware('can:prestamos.edit')->only('edit', 'update');
        $this->middleware('can:prestamos.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamo::paginate();

        return view('prestamo.index', compact('prestamos'))
            ->with('i', (request()->input('page', 1) - 1) * $prestamos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener los códigos de cliente (IDs)
        $clientes = Cliente::pluck('id', 'id');
        
        // Crear una nueva instancia de Prestamo
        $prestamo = new Prestamo();
        
        // Verificar si ya hay un valor en cli_pre
        $cliente_id = $prestamo->cli_pre ? $prestamo->cli_pre : null;
    
        // Obtener la fecha y hora actual en el formato adecuado
        $now = Carbon::now('America/Bogota')->toDateTimeString();
        
        // Pasar los clientes y el prestamo a la vista
        return view('prestamo.create', compact('clientes', 'prestamo', 'now', 'cliente_id'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Prestamo::$rules);

        $prestamo = Prestamo::create($request->all());

        return redirect()->route('prestamos.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Prestamo creado exitosamente.
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
        $prestamo = Prestamo::find($id);

        return view('prestamo.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Obtener los códigos de cliente y nombres
        $clientes = Cliente::pluck('id', 'id');
        $prestamo = Prestamo::find($id);
    
        // Verificar si ya hay un valor en cli_pre
        $cliente_id = $prestamo->cli_pre ?? null;
    
        // Verificar si el campo de fecha y hora está vacío
        if (empty($prestamo->fec_pre)) {
            // Obtener la fecha y hora actual en el formato adecuado
            $now = now()->toDateTimeLocalString();
        } else {
            // Usar el valor existente
            $now = $prestamo->fec_pre;
        }
    
        return view('prestamo.edit', compact('prestamo', 'clientes', 'cliente_id', 'now'));
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prestamo $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        request()->validate(Prestamo::$rules);

        $prestamo->update($request->all());

        return redirect()->route('prestamos.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Prestamo actualizado exitosamente.
                                </div>');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id)->delete();

        return redirect()->route('prestamos.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Prestamo eliminado exitosamente.
                                </div>');
    }
}
