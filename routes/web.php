<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/search', [NewsController::class, 'search'])->name('search');

// Route spesifik harus di atas route dinamis
Route::get('/semua-berita', [NewsController::class, 'allNews'])->name('news.all');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/author/{username}', [AuthorController::class, 'show'])->name('author.show');

// Route dinamis untuk kategori di paling bawah
Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');