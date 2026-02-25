@extends('layouts.app')

@section('content')
    <!-- Hero Section (Pasti ada karena sudah dibuat) -->
    @include('components.hero', ['sliders' => $sliders])

    <!-- Services Section (Cek dulu ada datanya gak) -->
    @if (count($services) > 0)
        @include('components.services', ['services' => $services])
    @endif

    <!-- About Section (Aman karena statis) -->
    @include('components.about')

    <!-- Testimonials Section -->
    @if (count($testimonials) > 0)
        @include('components.testimonials', ['testimonials' => $testimonials])
    @endif

    <!-- Recent Posts Section -->
    @if (count($posts) > 0)
        @include('components.recent-posts', ['posts' => $posts])
    @endif

    <!-- Call To Action (Aman statis) -->
    @include('components.cta')
@endsection
