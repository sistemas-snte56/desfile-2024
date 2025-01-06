<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Coordinador\CoordinadorController;

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

Route::get('/enlinea', function()
{
    return view('enlinea');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Ruta Principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Grupo de rutas con el prefijo 'admin' y middleware 'role:administrador'
    Route::prefix('admin')->middleware('role:Administrador')->group(function () {
        Route::resource('/', AdminController::class)->names('admin');
        Route::resource('/role', RoleController::class)->names('role');
        Route::put('/role/{id}/updateRolePermission', [RoleController::class, 'updateRolePermission'])->name('role.updateRolePermission');
        Route::resource('/permission', PermissionController::class)->names('permission');
        Route::resource('/user', UserController::class)->names('user'); 
        Route::resource('/region', RegionController::class)->names('region'); 
    });
});

Route::prefix('usuario')
    ->middleware(['role:Usuario'])
    ->group(function () {
        route::get('/dashboard',[UsuarioController::class,'index'])->name('usuario.index');
        route::get('/{id}',[UsuarioController::class,'show'])->name('usuario.show');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
});

Route::prefix('coordinador')
    ->middleware(['role:Coordinador'])
    ->group(function(){
        route::get('/dashboard',[CoordinadorController::class,'index'])->name('coordinador.index');
});