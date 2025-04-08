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

Route::get('/auth/register', function () {
    return redirect()->route('auth.signup');
})->name('auth.register');
Route::delete('/properties/{property}', function (\App\Models\Property $property) {
    $property->delete();
    return redirect()->route('properties.index');
})->name('properties.destroy');
Route::delete('/projects/{project}', function (\App\Models\Project $project) {
    $project->delete();
    return redirect()->route('projects.index');
})->name('projects.destroy');
Route::delete('/professions/{profession}', [\App\Http\Controllers\ProfessionController::class, 'destroy'])->name('professions.destroy');

Route::get('/', function () {
    return redirect('/auth/login');
});
