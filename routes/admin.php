<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DelegacionController;

#route::resource('/',AdminDashboardController::class)->names('admin.principal');

    route::resource('/', AdminController::class)->names('admin');
    route::resource('/user', UserController::class)->names('admin.user');