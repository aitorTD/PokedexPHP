<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonesController;
use App\Http\Controllers\ObjetosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TiposController;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('pokemones', PokemonesController::class); // HACIENDO

Route::resource('objetos', ObjetosController::class);
Route::resource('usuarios', UserController::class);
Route::resource('tipos', TiposController::class);