@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <section id="projects" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
            </div>

            <div class="container">

                <!-- Intro Text -->
                <div class="portfolio-intro-wrapper" data-aos="fade-up" data-aos-delay="120">
                    <p class="portfolio-intro-text text-center">
                        A curated selection of the best Flutter, PHP, and ERP integration projects I’ve built.
                    </p>
                </div>

                <br>

                <!-- Filters -->
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-flutter">Flutter</li>
                        <li data-filter=".filter-php">PHP</li>
                    </ul>

                    <!-- Grid -->
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        @forelse ($portfolios as $p)

                            @php
                                $photo = $p->photos->first();
                                $image = $photo ? Storage::url($photo->image_path) : null;

                                // Tech stack fix
                                $techs = $p->tech_stack;
                                if (is_string($techs)) {
                                    $decoded = json_decode($techs, true);
                                    $techs =
                                        json_last_error() === JSON_ERROR_NONE && is_array($decoded)
                                            ? $decoded
                                            : array_map('trim', explode(',', $techs));
                                }

                                $isFlutter = in_array('Flutter', $techs);
                                $isPHP = in_array('PHP', $techs);
                            @endphp

                            <div
                                class="col-lg-4 col-md-6 portfolio-item isotope-item
                            {{ $isFlutter ? 'filter-flutter' : '' }}
                            {{ $isPHP ? 'filter-php' : '' }}">

                                <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden"
                                    style="transition: 0.3s;">

                                    <!-- Photo -->
                                    @if ($image)
                                        <a href="{{ route('portfolio.show', $p->slug) }}">
                                            <img src="{{ $image }}" class="img-fluid"
                                                style="height: 200px; width:100%; object-fit: cover;">
                                        </a>
                                    @else
                                        <!-- No Image Placeholder -->
                                        <div
                                            style="
                                        height: 200px;
                                        width: 100%;
                                        background: #f3f3f3;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        color: #888;
                                        font-size: 2.2rem;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif

                                    <!-- Text -->
                                    <div class="p-3">

                                        <h4 class="fw-bold mb-2">{{ $p->portfolio_name }}</h4>

                                        <p class="text-muted small mb-2">
                                            {{ Str::limit($p->description, 120) }}
                                        </p>

                                        <!-- Tech Stack -->
                                        <div class="mt-2">
                                            @foreach ($techs as $tech)
                                                <span class="badge bg-dark me-1">{{ $tech }}</span>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                            </div>

                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">No projects available at the moment.</p>
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

        </section>

    </main>
@endsection
