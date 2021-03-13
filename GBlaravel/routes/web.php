<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsConteroller;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
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


Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminNewsConteroller::class, 'index'])->name('index');
        Route::resource('/news', AdminNewsConteroller::class)->except('show');
        // Route::get('/news/create', [AdminNewsConteroller::class, 'create'])->name('news.create');
        // Route::post('/news', [AdminNewsConteroller::class, 'store'])->name('news.store');
        // Route::get('/news/{news}/edit', [AdminNewsConteroller::class, 'edit'])->name('news.edit');
        // Route::put('/news/{news}', [AdminNewsConteroller::class, 'update'])->name('news.update');
        // Route::delete('/news/{news}', [AdminNewsConteroller::class, 'destroy'])->name('news.destroy');
        Route::resource('/categories', AdminCategoryController::class)->except('show');

        Route::get('/download', [IndexController::class, 'download'])->name('download');
        // Route::get('/test2', [IndexController::class, 'test2'])->name('test2');
    });


Route::view('/about', 'about')->name('about');

Auth::routes();


