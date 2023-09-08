<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Users\AdminController;
use App\Http\Controllers\Users\UserController;
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

Route::middleware('guest:web')->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login_process');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth:web')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');

    Route::group(['middleware' => ['can:dashboard']], function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
    });

    Route::group(['middleware' => ['can:manage-users'], 'prefix' => 'manage'], function () {
        Route::group(['prefix' => 'user'], function() {
            Route::resource('admins', AdminController::class)->only(['index', 'store', 'create', 'edit', 'update', 'destroy']);
            Route::get('admins/data', [AdminController::class, 'getData']); // it's ajax request
            Route::resource('users', UserController::class)->only(['index', 'store', 'create', 'edit', 'update', 'destroy']);
            Route::get('users/data', [UserController::class, 'getData']); // it's ajax request
        });
        Route::resource('roles', RoleController::class)->only(['index', 'store', 'create', 'edit', 'update', 'destroy']);
        Route::get('roles/data', [RoleController::class, 'getData']); // it's ajax request
        Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'create', 'edit', 'update', 'destroy']);
        Route::get('permissions/data', [PermissionController::class, 'getData']); // it's ajax request
    });

    Route::group(['middleware' => ['can:products']], function () {
        Route::resource('products', ProductController::class)->only(['index', 'store', 'create', 'edit', 'update', 'destroy']);
        Route::get('products/data', [ProductController::class, 'getData']); // it's ajax request
    });
});
