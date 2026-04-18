<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about.index');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{slug}/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');

// Preview (temporary)
Route::get('/preview', function () {
    return view('pages.home-new', [
        'sliders'          => \App\Models\Slider::where('is_active', true)->orderBy('order')->get(),
        'featuredProducts' => \App\Models\Product::where('is_featured', true)->take(3)->get(), // ← ganti key
        'testimonials'     => \App\Models\Testimonial::where('is_active', true)->take(3)->get(),
        'posts'            => \App\Models\Post::latest()->take(3)->get(),
    ]);
});

// Contact form submission
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [MessageController::class, 'store'])->name('contact.store');
