<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Halaman daftar semua produk.
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();

        return view('pages.products.index', compact('products'));
    }

    /**
     * Halaman detail satu produk.
     */
    public function show(Product $product)
    {
        // Produk lain untuk bagian "Related Products"
        $related = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

        return view('pages.products.show', compact('product', 'related'));
    }
}
