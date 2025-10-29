<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ResumeController;

Route::get('/', function () {
    return view('index', [
        'name' => 'Umar Fadhlurrachman',
        'bio' => 'Software Engineer passionate about Flutter, APIs, and enterprise integration.'
    ]);
})->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/resume', [ResumeController::class, 'index'])->name('resume');

Route::view('/services', 'services')->name('services');
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::view('/contact', 'contact')->name('contact');

