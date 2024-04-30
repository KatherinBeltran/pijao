<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;

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

        return view('home', [
            'prestamosPendientes' => $prestamosPendientes,
            'esAdmin' => $esAdmin,
        ]);
    }
}