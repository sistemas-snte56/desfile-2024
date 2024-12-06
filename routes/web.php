<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Admin\PermissionController;

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


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Ruta Principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Grupo de rutas con el prefijo 'admin' y middleware 'role:administrador'
    Route::prefix('admin')->middleware('role:Administrador')->group(function () {
        Route::resource('/', AdminController::class)->names('admin');
        Route::resource('/role', RoleController::class)->names('role');
        Route::resource('/permission', PermissionController::class)->names('permission');
        Route::resource('/user', UserController::class)->names('user'); 
    });



});


Route::group(['prefix'=>'usuario','middleware'=>['role:Usuario']],function(){
    // Grupo de rutas con el prefijo 'usuario' y middleware 'role:usuario'
    Route::resource('/', UsuarioController::class)->names('usuario');
});



/*
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');




    // Ruta para el Usuario

   
});


/*


Route::group(['prefix'=>'admin'],function(){
    Route::resource('/', AdminController::class)->names('admin');
    Route::resource('/role', RoleController::class)->names('role');
    Route::resource('/permission', PermissionController::class)->names('permission');
    Route::resource('/user', UserController::class)->names('user');     
})->middleware(['auth:sanctum', 'verified', 'role:administrador']);

Route::resource('/usuario', UsuarioController::class)
    ->names('usuario')
    ->middleware(['auth:sanctum', 'verified', 'role:usuario']);

    */