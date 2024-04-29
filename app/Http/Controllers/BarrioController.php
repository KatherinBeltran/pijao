<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use Illuminate\Http\Request;
use App\Models\Zona;

/**
 * Class BarrioController
 * @package App\Http\Controllers
 */
class BarrioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:barrios.index')->only('index');
        $this->middleware('can:barrios.create')->only('create', 'store');
        $this->middleware('can:barrios.show')->only('show');
        $this->middleware('can:barrios.edit')->only('edit', 'update');
        $this->middleware('can:barrios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barrios = Barrio::paginate();

        return view('barrio.index', compact('barrios'))
            ->with('i', (request()->input('page', 1) - 1) * $barrios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barrio = new Barrio();
        $zonas = Zona::all();
        return view('barrio.create', compact('barrio', 'zonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Barrio::$rules);

        $barrio = Barrio::create($request->all());

        return redirect()->route('barrios.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Barrio creado exitosamente.
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
        $barrio = Barrio::find($id);

        return view('barrio.show', compact('barrio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barrio = Barrio::find($id);
        $zonas = Zona::all();

        return view('barrio.edit', compact('barrio', 'zonas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Barrio $barrio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barrio $barrio)
    {
        request()->validate(Barrio::$rules);

        $barrio->update($request->all());

        return redirect()->route('barrios.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Barrio actualizado exitosamente.
                                </div>');

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $barrio = Barrio::find($id)->delete();

        return redirect()->route('barrios.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Barrio eliminado exitosamente.
                                </div>');
    }
}
