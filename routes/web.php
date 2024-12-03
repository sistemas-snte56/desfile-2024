<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('usuario/profile/',   [ProfileController::class, 'index'])->name('profile.user');
    // Route::put('usuario/profile/',   [ProfileController::class, 'update'])->name('profile.update');

    // route::resource('usuario/profile', ProfileController::class)->names('usuario.profile');
    Route::resource('usuario/profile', ProfileController::class)
    ->except(['create', 'store', 'show', 'edit', 'destroy'])
    ->names('usuario.profile');


});
