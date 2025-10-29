<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Skill;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $skills = Skill::orderBy('start_year', 'asc')->get();

        return view('about', compact('about', 'skills'));
    }
}
