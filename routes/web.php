<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('Jugador',JugadorController::class)->middleware('auth');
//middleware('auth') sirve para que si no estas autentificado no puedas acceder a las zonas de creacion, borrado y
//edicion de ususarios y jugadores
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [JugadorController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [JugadorController::class, 'index'])->name('home');
});
