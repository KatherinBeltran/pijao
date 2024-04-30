<?php

namespace App\Http\Controllers;

use App\Models\Cobradore;
use Illuminate\Http\Request;
use App\Models\Barrio;
use App\Models\Zona;
use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * Class CobradoreController
 * @package App\Http\Controllers
 */
class CobradoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:cobradores.index')->only('index');
        $this->middleware('can:cobradores.create')->only('create', 'store');
        $this->middleware('can:cobradores.show')->only('show');
        $this->middleware('can:cobradores.edit')->only('edit', 'update');
        $this->middleware('can:cobradores.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobradores = Cobradore::paginate(10000);

        return view('cobradore.index', compact('cobradores'))
            ->with('i', (request()->input('page', 1) - 1) * $cobradores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cobradore = new Cobradore();
        $barrios = Barrio::all();
        $zonas = Zona::all();

        return view('cobradore.create', compact('cobradore', 'barrios', 'zonas'));
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
            'nom_cob.required' => 'El nombre del cobrador es obligatorio.',
            'num_ced_cob.required' => 'La cédula del cobrador es obligatoria.',
            'num_ced_cob.unique' => 'Ya existe un cobrador con esta cédula.',
            'num_cel_cob.required' => 'El número de teléfono del cobrador es obligatorio.',
            'cor_ele_cob.required' => 'El correo electrónico del cobrador es obligatorio.',
            'dir_cob.required' => 'La dirección del cobrador es obligatoria.',
            'bar_cob.required' => 'El barrio del cobrador es obligatorio.',
        ];

        // Validación personalizada para verificar si la cédula ya existe
        $request->validate([
            'nom_cob' => 'required',
            'num_ced_cob' => 'required|unique:cobradores,num_ced_cob',
            'num_cel_cob' => 'required',
            'cor_ele_cob' => 'required',
            'dir_cob' => 'required',
            'bar_cob' => 'required',
        ], $messages);

        $cobradores = Cobradore::create($request->all());

        $user = new User([
            'name' => $cobradores->nom_cob,
            'email' => $cobradores->cor_ele_cob,
            'password' => bcrypt('Inv' . $cobradores->num_ced_cob),
        ]);
        $user->save();

        $cobradoreRole = Role::where('name', 'Cobrador')->first();
        $user->assignRole($cobradoreRole);

        return redirect()->route('cobradores.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Cobrador creado exitosamente.
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
        $cobradore = Cobradore::find($id);

        return view('cobradore.show', compact('cobradore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cobradore = Cobradore::find($id);
        $barrios = Barrio::all();
        $zonas = Zona::all();
        
        return view('cobradore.edit', compact('cobradore', 'barrios', 'zonas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cobradore $cobradore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cobradore $cobradore)
    {
        request()->validate(Cobradore::$rules);

        $cobradore->update($request->all());

        return redirect()->route('cobradores.index')
            ->with('success', '<div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                    Cobrador actualizado exitosamente.
                                </div>');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cobradore = Cobradore::find($id)->delete();

        return redirect()->route('cobradores.index')
                ->with('success', '<div class="alert alert-success alert-dismissible">
                                      <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                      Cobrador eliminado exitosamente.
                                    </div>');
    }
}