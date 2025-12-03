@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <style>
            /* Make sure isotope aligns left */
            .isotope-container {
                display: flex !important;
                flex-wrap: wrap !important;
                justify-content: flex-start !important;
            }

            /* Dark cards aesthetic */
            .portfolio-card {
                background: #1d1f21 !important;
                color: #fff !important;
                border: 0 !important;
                transition: 0.25s;
            }

            .portfolio-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
            }

            .portfolio-card h4 {
                color: #fff !important;
            }

            .portfolio-card p {
                color: #cfcfcf !important;
            }

            .portfolio-badge {
                background: #2c2f33 !important;
                color: #eee !important;
                font-weight: 500;
            }

            /* Intro text center style */
            .portfolio-intro-text {
                font-size: 1.15rem;
                max-width: 700px;
                margin: 0 auto;
                color: #ddd;
                text-align: center;
            }
        </style>

        <section id="projects" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
            </div>

            <div class="container">

                <!-- Intro Text -->
                <div class="portfolio-intro-wrapper" data-aos="fade-up" data-aos-delay="120">
                    <p class="portfolio-intro-text">
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

                    <!-- Portfolio Cards Grid -->
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        @forelse ($portfolios as $p)

                            @php
                                $photo = $p->photos->first();
                                $image = $photo ? Storage::url($photo->image_path) : null;

                                // Normalize tech stack to array of trimmed strings
                                $techs = $p->tech_stack;
                                if (is_string($techs)) {
                                    $decoded = json_decode($techs, true);
                                    $techs =
                                        json_last_error() === JSON_ERROR_NONE && is_array($decoded)
                                            ? array_map('trim', $decoded)
                                            : array_map('trim', explode(',', $techs));
                                } elseif (is_array($techs)) {
                                    $techs = array_map('trim', $techs);
                                } else {
                                    $techs = [];
                                }

                                // match partial + case-insensitive (e.g., "PHP 8" matches "php")
                                $isFlutter = false;
                                $isPHP = false;
                                foreach ($techs as $t) {
                                    if (!$isFlutter && stripos($t, 'flutter') !== false) {
                                        $isFlutter = true;
                                    }
                                    if (!$isPHP && stripos($t, 'php') !== false) {
                                        $isPHP = true;
                                    }
                                    if ($isFlutter && $isPHP) {
                                        break;
                                    }
                                }
                            @endphp

                            <!-- FILTER CLASSES -->
                            <div
                                class="col-lg-4 col-md-6 portfolio-item isotope-item
                            {{ $isFlutter ? 'filter-flutter' : '' }}
                            {{ $isPHP ? 'filter-php' : '' }}">

                                <!-- CARD -->
                                <div class="card portfolio-card shadow-sm h-100 rounded-3 overflow-hidden">

                                    <!-- Image -->
                                    @if ($image)
                                        <a href="{{ route('portfolio.show', $p->slug) }}">
                                            <img src="{{ $image }}" class="img-fluid" alt="{{ $p->portfolio_name }}"
                                                style="height: 200px; width: 100%; object-fit: cover;">
                                        </a>
                                    @else
                                        <div
                                            style="
                                        height: 200px;
                                        width: 100%;
                                        background: #2a2d30;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        color: #777;
                                        font-size: 2.2rem;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif

                                    <!-- Content -->
                                    <div class="p-3">

                                        <h4 class="fw-bold mb-2">
                                            {{ $p->portfolio_name }}
                                        </h4>

                                        <p class="small mb-2">
                                            {{ Str::limit($p->description, 120) }}
                                        </p>

                                        <!-- Tech Stack -->
                                        <div class="mt-2">
                                            @foreach ($techs as $tech)
                                                <span class="badge portfolio-badge me-1">{{ $tech }}</span>
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
