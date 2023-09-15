<?php

use App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\TestController;
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

Route::get('/test', [TestController::class, 'test'])->name('test.blog');
Route::get('/test-article', [TestController::class, 'article'])->name('test.article');

Route::controller(ArticleController::class)
    ->name('articles.')
//    ->prefix('blog')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{article:slug}', 'show')->name('show');
    });
