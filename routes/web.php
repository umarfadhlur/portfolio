<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    return view('index', [
        'name' => 'Umar Fadhlurrachman',
        'bio' => 'Software Engineer passionate about Flutter, APIs, and enterprise integration.'
    ]);
})->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::view('/resume', 'resume')->name('resume');
Route::view('/services', 'services')->name('services');
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::view('/contact', 'contact')->name('contact');

