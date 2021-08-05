<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlacetopayController;
use App\Http\Controllers\PseController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/webcheckout', [PlacetopayController::class, 'index'])->name('app.index');
Route::post('/create-session', [PlacetopayController::class, 'store'])->name('app.create-session');

Route::get('/pse', [PseController::class, 'index'])->name('app.pse');
Route::post('/create-pse-session', [PseController::class, 'store'])->name('app.create-pse-session');
