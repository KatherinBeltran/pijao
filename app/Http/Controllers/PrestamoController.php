<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Barrio;
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
        $prestamos = Prestamo::paginate(10000);

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
        $prestamo = new Prestamo();
        $barrios = Barrio::all();

        // Obtener la fecha y hora actual en el formato adecuado
        $now = Carbon::now('America/Bogota')->toDateTimeString();
        
        return view('prestamo.create', compact('prestamo', 'barrios', 'now'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Mensajes de validación personalizados en español
        $messages = [
            'nom_cli_pre.required' => 'El nombre del cliente es obligatorio.',
            'num_ced_cli_pre.required' => 'La cédula del cliente es obligatoria.',
            'num_ced_cli_pre.unique' => 'Ya existe un cliente con esta cédula.',
            'num_cel_cli_pre.required' => 'El número de teléfono del cliente es obligatorio.',
            'dir_cli_pre.required' => 'La dirección del cliente es obligatoria.',
            'bar_cli_pre.required' => 'El barrio del cliente es obligatorio.',
            'pag_pre.required' => 'El cobros y/o pagos del prestamo es obligatorio.',
            'cuo_pre.required' => 'El número de cuotas del prestamo es obligatorio.',
            'cap_pre.required' => 'El capital del prestamo es obligatorio.',
        ];

        // Validación personalizada para verificar si la cédula ya existe
        $request->validate([
            'nom_cli_pre' => 'required',
            'num_ced_cli_pre' => 'required|unique:prestamos,num_ced_cli_pre',
            'num_cel_cli_pre' => 'required',
            'dir_cli_pre' => 'required',
            'bar_cli_pre' => 'required',
            'pag_pre' => 'required',
            'cuo_pre' => 'required',
            'cap_pre' => 'required',
        ], $messages);

        request()->validate(Prestamo::$rules);

        $fechaHoraActual = now()->setTimezone('America/Bogota')->toDateTimeString();

        // Establecer el valor de val_pag_pre a 0 e int_pre a 20 antes de crear el registro
        $data = $request->all();
        $data['fec_pre'] = $fechaHoraActual;
        $data['val_pag_pre'] = 0;
        $data['int_pre'] = 20;

        $prestamo = Prestamo::create($data);

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
        $prestamo = Prestamo::find($id);
        $barrios = Barrio::all();

        // Verificar si el campo de fecha y hora está vacío
        if (empty($prestamo->fec_pre)) {
            // Obtener la fecha y hora actual en el formato adecuado
            $now = now()->toDateTimeLocalString();
        } else {
            // Usar el valor existente
            $now = $prestamo->fec_pre;
        }
    
        return view('prestamo.edit', compact('prestamo', 'barrios', 'now'));
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