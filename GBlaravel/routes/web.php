<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsConteroller;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::view('/', 'index')->name('home');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/one/{news}', [NewsController::class, 'show'])->name('show');
        Route::name('category.')
            ->group(function () {
                Route::get('/categories', [CategoryController::class, 'index'])->name('index');
                Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('show');
            });
    });

Route::name('user.')
    ->prefix('user')
    ->middleware('auth')
    ->group(function () {
        Route::match(['get', 'post'], '/profile', [ProfileController::class, 'update'])->name('updateProfile');
    });

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/', [AdminNewsConteroller::class, 'index'])->name('index');
        Route::resource('/news', AdminNewsConteroller::class)->except('show');
        Route::resource('/categories', AdminCategoryController::class)->except('show');
        Route::resource('/users', AdminUserController::class)->except('show');
        Route::post('/users', [AdminUserController::class, 'status'])->name('users.status');
        Route::get('/download', [IndexController::class, 'download'])->name('download');
        // Route::get('/test2', [IndexController::class, 'test2'])->name('test2');
    });


Route::view('/about', 'about')->name('about');

//Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('login', [LoginController::class, 'login']);
//Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//Route::post('logout', [LoginController::class, 'logout']);

Auth::routes();


