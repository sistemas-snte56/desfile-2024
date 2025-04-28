<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CotejadorController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\MaestrosController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Admin\DelegacionController;
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

Route::get('maestro/generar-pdf/{codigo_id}',[PdfController::class,'generadorPDF'])->name('teacher.constancia');

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
        Route::resource('/delegacion', DelegacionController::class)->names('delegacion'); 

        Route::resource('teacher', MaestrosController::class)->names('teacher');


        // Ruta para que el admin marque como atendida la observación
        Route::put('/admin/observaciones/{observacion}/atender', [ObservacionController::class, 'atender'])->name('admin.atender.observacion');

    });
});

Route::prefix('usuario')
    ->middleware(['role:Usuario'])
    ->group(function () {
        route::get('/dashboard',[UsuarioController::class,'index'])->name('usuario.index');
        route::get('/{id}',[UsuarioController::class,'show'])->name('usuario.show');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuario.update');

        // Creando nuevo maestro
        Route::get('maestro/create', [TeacherController::class,'create'])->name('usuario.teacher.create');
        Route::post('maestro', [TeacherController::class,'store'])->name('usuario.teacher.store');
        Route::get('maestro/{slug}/edit', [TeacherController::class, 'edit'])->name('usuario.teacher.edit');
        Route::put('maestro/{slug}', [TeacherController::class, 'update'])->name('usuario.teacher.update');
        Route::delete('maestro/{slug}', [TeacherController::class,'destroy'])->name('usuario.teacher.destroy');

        Route::post('maestro/pdf/{codigo_id}',[PdfController::class,'generadorPDF'])->name('usuario.teacher.constancia');

        #Lo agregaremos afuera 
        // Route::get('maestro/generar-pdf/{codigo_id}',[PdfController::class,'generadorPDF'])->name('teacher.constancia');
});

Route::prefix('coordinador')
    ->middleware(['role:Coordinador'])
    ->group(function(){
        route::get('/dashboard',[CoordinadorController::class,'index'])->name('coordinador.index');
});

Route::prefix('cotejador')
    ->middleware(['role:Cotejador'])
    ->group(function(){
        route::get('/dashboard',[CotejadorController::class,'index'])->name('cotejador.index');
        route::get('/{id}',[CotejadorController::class,'show'])->name('cotejador.show');
        route::get('/{id}/listado',[CotejadorController::class,'showListadoTeachers'])->name('cotejador.listado');
        // Route::put('/{id}', [CotejadorController::class, 'update'])->name('cotejador.update');

        // Ruta para que el cotejador guarde una observación
        Route::post('/observaciones', [ObservacionController::class, 'store'])->name('observaciones.store');

});