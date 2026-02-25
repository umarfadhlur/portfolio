<?php

namespace App\Http\Controllers;

use App\Models\Slider;
// use App\Models\Service;      // <-- Comment dulu
// use App\Models\Testimonial;  // <-- Comment dulu
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Slider (Ini udah READY)
        $sliders = Slider::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        // 2. Data Lainnya (KOSONGIN DULU biar gak error)
        $services = [];     // Service::limit(4)->get();
        $testimonials = []; // Testimonial::where('is_active', true)->get();
        $posts = Post::latest()->limit(3)->get();

        // Kirim semua data (termasuk yang kosong) ke view
        return view('pages.home', compact(
            'sliders',
            'services',
            'testimonials',
            'posts'
        ));
    }
}
