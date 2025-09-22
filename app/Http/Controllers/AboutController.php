<?php

namespace App\Http\Controllers;

use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil record pertama dari tabel abouts
        $about = About::first();

        // Kirim data ke view 'sections.about'
        return view('about', compact('about'));
    }
}
