<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/one/{id}', [NewsController::class, 'show'])->name('show');
        Route::name('category.')
            ->group(function () {
                Route::get('/categories', [CategoryController::class, 'index'])->name('index');
                Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('show');
            });
    });


Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::match(['get', 'post'], '/create', [IndexController::class, 'create'])->name('create');
        Route::get('/download', [IndexController::class, 'download'])->name('download');
        // Route::get('/test2', [IndexController::class, 'test2'])->name('test2');
    });


Route::view('/about', 'about')->name('about');

Auth::routes();


