<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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