<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\News\NewsController;
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

Route::view('/', 'index')->name('Home');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('News');
        Route::get('/novost-{id}', [NewsController::class, 'show'])->name('NewsOne');
        Route::get('/category/{slug}', [NewsController::class, 'category'])->name('NewsCategory');
    });

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/test1', [IndexController::class, 'test1'])->name('test1');
        Route::get('/test2', [IndexController::class, 'test2'])->name('test2');
    });

Route::view('/about', 'about')->name('About');
