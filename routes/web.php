<?php

//use App\Http\Controllers\administrador;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;
use App\Mail\Correo;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [PrincipalController::class,'index']);
Route::post('/login', [PrincipalController::class,'ingresar'])->name('login');
Route::get('/logout', [PrincipalController::class,'logout'])-> name('logout');
Route::get('/inicio', [PrincipalController::class,'inicio'])->name('inicio');
Route::get('/reporte', [ReporteController::class,'solicitud'])->name('nuevo-reporte');
Route::get('/reporte/confirmacion/{id}', [ReporteController::class,'detalle'])->name('detalle-guardar');
Route::post('/reporte', [ReporteController::class,'solicitud'])->name('nuevo-reporte');
Route::get('/reporte/detalle/{id}/{ref}', [ReporteController::class,'detalle'])->name('detalle-reporte');
Route::get('/reporte/imprime/{id}', [ReporteController::class,'detalle'])->name('imprime-reporte');
Route::get('/consulta', [ReporteController::class,'consulta'])->name('consulta-reporte');
Route::get('/reporte/actualiza/{id}', [ReporteController::class,'actualiza'])->name('actualiza-reporte');
Route::post('/reporte/actualiza/{id}', [ReporteController::class,'actualiza'])->name('actualiza-reporte-fin');
Route::get('/administracion/admin',[AdministradorController::class,'datos'])->name('admin-reporte');
Route::get('/administracion/detalle/{id}/{ref}',[AdministradorController::class,'consulta'])->name('admin-consulta');
Route::get('/administracion/actualiza/{id}',[AdministradorController::class,'actualiza'])->name('admin-actualiza');
Route::post('/administracion/actualiza/{id}',[AdministradorController::class,'actualiza'])->name('admin-actualiza-fin');
