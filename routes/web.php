<?php

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

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use Wave\Facades\Wave;

// Wave routes
Wave::routes();

Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
Route::delete('/professions/{profession}', [\App\Http\Controllers\ProfessionController::class, 'destroy'])->name('professions.destroy');

Route::get('/', function () {
    return redirect('/auth/login');
});
