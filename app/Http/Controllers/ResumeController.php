<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class ResumeController extends Controller
{
    public function index()
    {
        $education = Experience::where('type_id', 2)
            ->orderByRaw('CASE WHEN end_date IS NULL THEN 1 ELSE 0 END DESC')
            ->orderByDesc('end_date')
            ->orderByDesc('start_date')
            ->get();

        $work = Experience::where('type_id', 1)
            ->orderByRaw('CASE WHEN end_date IS NULL THEN 1 ELSE 0 END DESC')
            ->orderByDesc('end_date')
            ->orderByDesc('start_date')
            ->get();

        return view('resume', compact('education', 'work'));
    }
}
