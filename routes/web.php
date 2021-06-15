<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Models\User;


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

/*Route::get('/', function () {
    return view('welcome');
});*/

//rutas generadas por la gestión de usuarios:

Auth::routes(['verify' => true]);

Route::get('/', [JuegoController::class, 'index'])->name('main'); //home, lista de todos los juegos
Route::get('juego/create', [JuegoController::class, 'create'])->middleware('admin')->name('juego.create'); //form de creación de juegos para el admin
Route::get('juego/{juego}/edit', [JuegoController::class, 'edit'])->middleware('admin')->name('juego.edit'); //form de edición de juegos para el admin (necesario?)
Route::get('juego/{juego}', [JuegoController::class, 'show'])->name('juego.show'); //single para mostrar cada juego concreto
Route::post('juego/store', [JuegoController::class, 'store'])->name('juego.store');
Route::put('juego/update/{juego}', [JuegoController::class, 'update'])->name('juego.update');

Route::get('review/create', [ReviewController::class, 'create'])->middleware('auth')->name('review.create'); //form de creación de reviews para los usuarios
Route::get('review/{review}/edit', [ReviewController::class, 'edit'])->middleware('auth')->name('review.edit'); //permite al usuario modificar su propia review
Route::delete('review/{review}/destroy', [ReviewController::class, 'destroy'])->middleware('auth')->name('review.destroy');
Route::post('review/store', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');
Route::put('review/update/{review}', [ReviewController::class, 'update'])->name('review.update');

Route::get('user/index', [UserController::class, 'index'])->name('user.index'); //comunidad, lista de todos los users
Route::get('user/{user}', [UserController::class, 'show'])->name('user.show'); //single para mostrar un perfil de un usuario


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/{user}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->middleware('auth')->name('user/edit');
Route::put('user/update', [App\Http\Controllers\HomeController::class, 'update'])->name('user.update');

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
//Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

//Route::get('/home/create', [App\Http\Controllers\HomeController::class, 'create'])->name('home/create');