<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/article/detail', function () {
    return view('detailArticle');
})->name('article.detail');

Route::get('/dashboard', function (){
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/add/article', function (){
    return view('admin.addArticle');
})->name('add.article');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.detail');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');


Route::get('daftar/artikel', [ListArticleController::class, 'index'])->name('articles.list');

Route::get('/about', [AboutController::class, 'index'])->name('about');
