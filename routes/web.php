<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::get('/localizanos', 'HomeController@getMapa');
Route::get('/redes', 'HomeController@getRedesSociales');
Route::get('/biografia','HomeController@getBiografia');
Route::get('/ayuda','HomeController@getAyuda');
Route::get('/novedades','HomeController@getNovedades');
Route::get('politica-de-cookies', 'HomeController@politicas');
Route::get('politica-de-privacidad', 'HomeController@politicas');

//Obligatorio estar logueado y verificado
Route::group(['middleware' => 'auth', 'middleware' => 'verified'], function() {
    Route::get('/citas', 'HomeController@citas');
    Route::get('/entradas','HomeController@getEntradas');
    Route::get('/vip', 'HomeController@getVip');
    Route::get('/miPerfil','HomeController@getPerfil');
    Route::get('/editarPerfil', 'HomeController@editarPerfil');
    Route::post('/editarPerfil/{id}', 'HomeController@postEditarPerfil');
    Route::get('/calendario/action', 'HomeController@action')->name("calendario.action");
    Route::post('/pedirCita', 'HomeController@addReserva');
    Route::post('/anular-reserva', 'HomeController@cancelarReserva');
});

//CONTROL
Route::group(['middleware' => 'admin'], function() {
    Route::get('/control/usuarios', 'AdminController@users');
    Route::get('/control/usuarios/anadir', 'AdminController@addUser');
    Route::get('/control/usuarios/modificar/{id}', 'AdminController@updateUser');
    Route::post('/control/usuarios/modificar/{id}', 'AdminController@postUpdateUser');
    Route::post('/control/usuarios/anadir', 'AdminController@postAddUser');
    Route::post('/control/usuarios/eliminar', 'AdminController@deleteUser');

    Route::get('/control/dias-no-disponibles', 'AdminController@diasNoDisponibles');
    Route::get('/control/dias-no-disponibles/anadir', 'AdminController@addDiaNoDisponible');
    Route::post('/control/dias-no-disponibles/anadir', 'AdminController@postAddDiaNoDisponible');
    Route::post('/control/dias-no-disponibles/eliminar', 'AdminController@deleteDia');

    Route::get('/control/horarios', 'AdminController@horarios');
    Route::get('/control/horarios/anadir', 'AdminController@addHorario');
    Route::post('/control/horarios/anadir', 'AdminController@postAddHorario');
    Route::post('/control/horarios/eliminar', 'AdminController@deleteHorario');

    Route::get('/control/reservas', 'AdminController@reservas');
    Route::get('/control/reservas/anadir', 'AdminController@addReserva');
    Route::get('/control/reservas/calendarioNuevo/actionNuevo', 'AdminController@actionNuevo')->name("calendarioNuevo.actionNuevo");
    Route::post('/control/reservas/anadir', 'AdminController@postAddReserva');
    Route::get('/control/reservas/modificar/prueba/calendario','AdminController@actionUpdate')->name("prueba.calendario");
    Route::get('/control/reservas/modificar/{id}', 'AdminController@updateReserva');
    Route::post('/control/reservas/modificar/{id}', 'AdminController@postUpdateReserva');
    Route::post('/control/reservas/eliminar', 'AdminController@deleteReserva');

    Route::get('/control/banner', 'AdminController@banner');
    Route::post('/control/banner/modificar', 'AdminController@updateBanner');

    Route::get('/control/cortes', 'AdminController@cortes');
    Route::get('/control/cortes/anadir', 'AdminController@addCorte');
    Route::get('/control/cortes/modificar/{id}', 'AdminController@updateCorte');
    Route::post('/control/cortes/modificar/{id}', 'AdminController@postUpdateCorte');
    Route::post('/control/cortes/anadir', 'AdminController@postAddCorte');
    Route::post('/control/cortes/eliminar', 'AdminController@deleteCorte');
});

Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home');


/*
Route::get('/', function () {
    return view('welcome');
});
*/
