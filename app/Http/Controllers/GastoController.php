<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Carbon\Carbon;

/**
 * Class GastoController
 * @package App\Http\Controllers
 */
class GastoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gastos.index')->only('index');
        $this->middleware('can:gastos.create')->only('create', 'store');
        $this->middleware('can:gastos.show')->only('show');
        $this->middleware('can:gastos.edit')->only('edit', 'update');
        $this->middleware('can:gastos.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::paginate();

        return view('gasto.index', compact('gastos'))
            ->with('i', (request()->input('page', 1) - 1) * $gastos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gasto = new Gasto();
        $categorias = Categoria::all();

        // Obtener la fecha y hora actual en el formato adecuado
        $now = Carbon::now('America/Bogota')->toDateTimeString();

        return view('gasto.create', compact('gasto', 'categorias', 'now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Gasto::$rules);

        $gasto = Gasto::create($request->all());

        return redirect()->route('gastos.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Gasto creado exitosamente.
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
        $gasto = Gasto::find($id);

        return view('gasto.show', compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = Gasto::find($id);
        $categorias = Categoria::all();

        // Verificar si el campo de fecha y hora está vacío
        if (empty($prestamo->fec_pre)) {
            // Obtener la fecha y hora actual en el formato adecuado
            $now = now()->toDateTimeLocalString();
        } else {
            // Usar el valor existente
            $now = $prestamo->fec_pre;
        }

        return view('gasto.edit', compact('gasto', 'categorias', 'now'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Gasto $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasto $gasto)
    {
        request()->validate(Gasto::$rules);

        $gasto->update($request->all());

        return redirect()->route('gastos.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Gasto actualizado exitosamente.
                                </div>');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $gasto = Gasto::find($id)->delete();

        return redirect()->route('gastos.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Gasto eliminado exitosamente.
                                </div>');
    }
}
