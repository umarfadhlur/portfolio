@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <style>
            /* ————— Resume-like Section Title ————— */
            .section-title h2 {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                color: #ffffff;
            }

            .portfolio-intro-text {
                font-size: 1.1rem;
                max-width: 720px;
                margin: 0 auto;
                color: #d0d6de;
                text-align: center;
            }

            /* ————— Filters ————— */
            .portfolio-filters li {
                cursor: pointer;
                padding: 6px 14px;
                border-radius: 20px;
                font-size: 0.9rem;
                font-weight: 500;
                color: #fff;
                background: #2a2f33;
                transition: 0.25s;
            }

            .portfolio-filters li.filter-active,
            .portfolio-filters li:hover {
                background: #00a2ff;
            }

            /* ————— Card ————— */
            .portfolio-card {
                background: #1e1f22;
                border: none;
                color: white;
                transition: 0.25s ease;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .portfolio-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.45);
            }

            .portfolio-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
                background: #2b2e30;
            }

            .portfolio-title {
                font-weight: 600;
                font-size: 1.05rem;
                color: #fff;
                margin-bottom: 6px;
            }

            .portfolio-desc {
                color: #cfd1d4;
                font-size: 0.9rem;
                margin-bottom: 10px;
                flex: 1;
            }

            /* ————— Badges ————— */
            .portfolio-badge {
                background: #2d3236;
                font-size: 0.75rem;
                color: #eee;
                padding: 4px 8px;
                border-radius: 6px;
                margin-right: 4px;
            }

            /* ————— Grid Align Left (Fix 5 items) ————— */
            .isotope-container {
                display: flex !important;
                flex-wrap: wrap !important;
                justify-content: flex-start !important;
                align-items: stretch !important;
            }

            .portfolio-item {
                display: flex;
            }
        </style>

        <section id="projects" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
            </div>

            <div class="container">

                <!-- Intro -->
                <p class="portfolio-intro-text" data-aos="fade-up" data-aos-delay="120">
                    A curated selection of the best Flutter, PHP, and ERP integration projects I’ve built.
                </p>

                <br>

                <!-- Filters -->
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-flutter">Flutter</li>
                        <li data-filter=".filter-php">PHP</li>
                    </ul>

                    <!-- Portfolio Grid -->
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        @forelse ($portfolios as $p)

                            @php
                                $photo = $p->photos->first();
                                $image = $photo ? Storage::url($photo->image_path) : null;

                                // Normalize tech stack
                                $techs = $p->tech_stack;
                                if (is_string($techs)) {
                                    $decoded = json_decode($techs, true);
                                    $techs =
                                        json_last_error() === JSON_ERROR_NONE && is_array($decoded)
                                            ? array_map('trim', $decoded)
                                            : array_map('trim', explode(',', $techs));
                                } elseif (!is_array($techs)) {
                                    $techs = [];
                                }

                                $isFlutter = collect($techs)->contains(
                                    fn($t) => str_contains(strtolower($t), 'flutter'),
                                );
                                $isPHP = collect($techs)->contains(fn($t) => str_contains(strtolower($t), 'php'));
                            @endphp

                            <div
                                class="col-lg-4 col-md-6 portfolio-item isotope-item
                            {{ $isFlutter ? 'filter-flutter' : '' }}
                            {{ $isPHP ? 'filter-php' : '' }}">

                                <!-- CARD -->
                                <div class="card portfolio-card">

                                    <!-- Image -->
                                    @if ($image)
                                        <a href="{{ route('portfolio.show', $p->slug) }}">
                                            <img src="{{ $image }}" class="portfolio-image">
                                        </a>
                                    @else
                                        <div
                                            class="portfolio-image d-flex justify-content-center align-items-center text-muted">
                                            <i class="bi bi-image fs-1"></i>
                                        </div>
                                    @endif

                                    <!-- Body -->
                                    <div class="card-body">

                                        <div class="portfolio-title">{{ $p->portfolio_name }}</div>

                                        <p class="portfolio-desc">
                                            {{ Str::limit($p->description, 120) }}
                                        </p>

                                        <div>
                                            @foreach ($techs as $tech)
                                                <span class="badge portfolio-badge">{{ $tech }}</span>
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
