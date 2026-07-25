@extends('layouts.app')

@section('title', 'Welcome')
@section('body-class', 'home-page')

@section('content')
    <section class="page-hero">
        <div class="shell page-hero-grid">
            <div>
                <p class="eyebrow">Umar Fadhlurrachman</p>
                <h1>Mobile Engineer building reliable enterprise applications.</h1>
            </div>
            <div class="page-hero-copy">
                <p>Explore production-focused Flutter, Laravel, payment, warehouse, and ERP integration work.</p>
                <a href="{{ route('home') }}" class="button button-primary">Enter portfolio <span>→</span></a>
            </div>
        </div>
    </section>
@endsection
