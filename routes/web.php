<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('index', [
        'name' => 'Umar Fadhlurrachman',
        'bio' => 'Software Engineer passionate about Flutter, APIs, and enterprise integration.'
    ]);
})->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/resume', [ResumeController::class, 'index'])->name('resume');

// ✅ halaman contact + form POST
Route::get('/contact', [MessageController::class, 'index'])->name('contact');
Route::post('/contact', [MessageController::class, 'submit'])->name('contact.submit');

// contoh tambahan:
Route::view('/services', 'services')->name('services');
// portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

