<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SdpcController;

/*
|--------------------------------------------------------------------------
| SDPC Static Web Routes (No DB, No Auth, No Search Bar)
|--------------------------------------------------------------------------
*/

Route::get('/', [SdpcController::class, 'home'])->name('home');
Route::get('/videos', [SdpcController::class, 'videos'])->name('videos.index');
Route::get('/videos/{slug}', [SdpcController::class, 'videoShow'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('videos.show');
Route::get('/categories', [SdpcController::class, 'categories'])->name('categories.index');
Route::get('/doctor', [SdpcController::class, 'doctorProfile'])->name('doctor.profile');
Route::get('/about', [SdpcController::class, 'contact'])->name('about');
Route::get('/contact', [SdpcController::class, 'contact'])->name('contact');
Route::get('/offline', [SdpcController::class, 'offline'])->name('offline');
