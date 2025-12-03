@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="hero-content">
                        <h1 data-aos="fade-up" data-aos-delay="200">
                            Hello, I'm <span class="highlight">{{ $name ?? 'Umar Fadhlurrachman' }}</span>
                        </h1>
                        <h2 data-aos="fade-up" data-aos-delay="300">
                            Creative <span class="typed" data-typed-items="Mobile Developer, Web Developer"></span>
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="400">
                            {{ $bio ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...' }}
                        </p>
                        <div class="hero-actions" data-aos="fade-up" data-aos-delay="500">
                            <a href="{{ route('portfolio') }}" class="btn btn-primary">View My Work</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline">Get In Touch</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="hero-image" data-aos="zoom-in" data-aos-delay="300">
                        <div class="image-wrapper">
                            <img src="{{ asset('assets/img/profile/umarf.png') }}"
                                alt="{{ $name ?? 'Profile' }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
