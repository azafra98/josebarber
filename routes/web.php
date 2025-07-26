<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;  // ← IMPORTA tu controlador
use App\Http\Controllers\AdminController;  // ← IMPORTA tu controlador
use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\Auth\LoginController;

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

// RUTAS PÚBLICAS
Route::get('/', [HomeController::class, 'index']);
Route::get('/localizanos', [HomeController::class, 'getMapa']);
Route::get('/redes', [HomeController::class, 'getRedesSociales']);
Route::get('/biografia', [HomeController::class, 'getBiografia']);
Route::get('/ayuda', [HomeController::class, 'getAyuda']);
Route::get('/novedades', [HomeController::class, 'getNovedades']);
Route::get('/politica-de-cookies', [HomeController::class, 'politicas']);
Route::get('/politica-de-privacidad', [HomeController::class, 'politicas']);

// AUTH: login, registro, verificación de email, reset de password...
Auth::routes(['verify'=>true]);

// RUTA HOME DESPUÉS DE LOGIN
Route::get('/home', 'HomeController@index')->name('home');

// RUTAS PROTEGIDAS (usuario autenticado y verificado)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/citas', [HomeController::class, 'citas']);
    Route::get('/entradas', [HomeController::class, 'getEntradas']);
    Route::get('/vip', [HomeController::class, 'getVip']);
    Route::get('/miPerfil', [HomeController::class, 'getPerfil']);
    Route::get('/editarPerfil', [HomeController::class, 'editarPerfil']);
    Route::post('/editarPerfil/{id}', [HomeController::class, 'postEditarPerfil']);
    Route::get('/calendario/action', [HomeController::class, 'action'])->name('calendario.action');
    Route::post('/pedirCita', [HomeController::class, 'addReserva']);
    Route::post('/anular-reserva', [HomeController::class, 'cancelarReserva']);
});

// RUTAS DE ADMIN CONTROL (middleware personalizado “admin”)
Route::middleware('admin')->prefix('control')->group(function () {
    // Usuarios
    Route::get('/usuarios', [AdminController::class, 'users']);
    Route::get('/usuarios/anadir', [AdminController::class, 'addUser']);
    Route::post('/usuarios/anadir', [AdminController::class, 'postAddUser']);
    Route::get('/usuarios/modificar/{id}', [AdminController::class, 'updateUser']);
    Route::post('/usuarios/modificar/{id}', [AdminController::class, 'postUpdateUser']);
    Route::post('/usuarios/eliminar', [AdminController::class, 'deleteUser']);

    // Días no disponibles
    Route::get('/dias-no-disponibles', [AdminController::class, 'diasNoDisponibles']);
    Route::get('/dias-no-disponibles/anadir', [AdminController::class, 'addDiaNoDisponible']);
    Route::post('/dias-no-disponibles/anadir', [AdminController::class, 'postAddDiaNoDisponible']);
    Route::post('/dias-no-disponibles/eliminar', [AdminController::class, 'deleteDia']);

    // Horarios
    Route::get('/horarios', [AdminController::class, 'horarios']);
    Route::get('/horarios/anadir', [AdminController::class, 'addHorario']);
    Route::post('/horarios/anadir', [AdminController::class, 'postAddHorario']);
    Route::post('/horarios/eliminar', [AdminController::class, 'deleteHorario']);

    // Reservas
    Route::get('/reservas', [AdminController::class, 'reservas']);
    Route::get('/reservas/anadir', [AdminController::class, 'addReserva']);
    Route::post('/reservas/anadir', [AdminController::class, 'postAddReserva']);
    Route::get('/reservas/calendarioNuevo/actionNuevo', [AdminController::class, 'actionNuevo'])
         ->name('calendarioNuevo.actionNuevo');
    Route::get('/reservas/modificar/{id}', [AdminController::class, 'updateReserva']);
    Route::post('/reservas/modificar/{id}', [AdminController::class, 'postUpdateReserva']);
    Route::post('/reservas/eliminar', [AdminController::class, 'deleteReserva']);

    // Banner
    Route::get('/banner', [AdminController::class, 'banner']);
    Route::post('/banner/modificar', [AdminController::class, 'updateBanner']);

    // Cortes
    Route::get('/cortes', [AdminController::class, 'cortes']);
    Route::get('/cortes/anadir', [AdminController::class, 'addCorte']);
    Route::post('/cortes/anadir', [AdminController::class, 'postAddCorte']);
    Route::get('/cortes/modificar/{id}', [AdminController::class, 'updateCorte']);
    Route::post('/cortes/modificar/{id}', [AdminController::class, 'postUpdateCorte']);
    Route::post('/cortes/eliminar', [AdminController::class, 'deleteCorte']);
});


/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Deshuso
/*
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/