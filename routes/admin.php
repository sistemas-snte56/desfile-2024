<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DelegacionController;
use App\Http\Controllers\Admin\PermissionController;

#route::resource('/',AdminDashboardController::class)->names('admin.principal');

    // route::resource('/', AdminController::class)->names('admin');
    // route::resource('/role', RoleController::class)->names('role');
    // route::resource('/permission', PermissionController::class)->names('permission');
    // route::resource('/user', UserController::class)->names('user');