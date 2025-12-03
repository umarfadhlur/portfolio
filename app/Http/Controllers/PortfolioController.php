<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // LIST PAGE
    public function index()
    {
        $portfolios = Portfolio::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('portfolio.index', compact('portfolios'));
    }

    // DETAIL PAGE
    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();

        return view('portfolio.show', compact('portfolio'));
    }
}
