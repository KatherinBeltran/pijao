<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CuotaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('/update-order', [App\Http\Controllers\CuotaController::class, 'updateOrder'])->name('cuotas.updateOrder');
Route::get('paga-diario/excel', [App\Http\Controllers\PagaDiarioController::class, 'generarExcel'])->name('paga-diario.excel');
Route::get('/paga-diario/pdf', [App\Http\Controllers\PagaDiarioController::class, 'generarPDF'])->name('paga-diario.pdf');
Route::resource('paga-diario', App\Http\Controllers\PagaDiarioController::class);
Route::get('reportes/excel', [App\Http\Controllers\ReporteController::class, 'generarExcel'])->name('reportes.excel');
Route::get('/reportes/pdf', [App\Http\Controllers\ReporteController::class, 'generarPDF'])->name('reportes.pdf');
Route::resource('reportes', App\Http\Controllers\ReporteController::class);
Route::resource('gastos', App\Http\Controllers\GastoController::class);
Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
Route::resource('cobradores', App\Http\Controllers\CobradoreController::class);
Route::resource('cuotas', App\Http\Controllers\CuotaController::class);
Route::resource('prestamos', App\Http\Controllers\PrestamoController::class);
Route::resource('barrios', App\Http\Controllers\BarrioController::class);
Route::resource('zonas', App\Http\Controllers\ZonaController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('users', App\Http\Controllers\UserController::class)->only(['index', 'edit', 'update', 'destroy']);