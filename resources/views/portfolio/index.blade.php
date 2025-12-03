@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <style>
            /* -- NAVBAR FIX ------------------------------------------------------
               Memaksa header/navbar berada di atas (fixed) dan memberi ruang
               pada <main> agar konten tidak tertutup. Sesuaikan --header-h.
            -------------------------------------------------------------------*/
            :root {
                --header-h: 72px;
            }

            header,
            nav,
            .navbar,
            .site-header {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 9999 !important;
                background: rgba(10, 15, 18, 0.92) !important;
                /* semi-transparan agar tetap gelap */
                backdrop-filter: blur(4px);
            }

            /* beri ruang pada main agar tidak tertutup navbar */
            main.main {
                padding-top: var(--header-h);
            }

            /* kecilkan margin top section-title jika ada */
            .container.section-title {
                margin-top: 6px !important;
                padding-top: 18px;
            }

            /* stylistic / existing card rules (tetap ada) */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap');

            /* Layout container */
            .isotope-container {
                display: flex !important;
                flex-wrap: wrap !important;
                justify-content: flex-start !important;
                align-items: stretch;
                gap: 1.5rem;
            }

            /* Make each isotope item use full height and participate in flex layout */
            .portfolio-item {
                display: flex;
                align-items: stretch;
            }

            /* Card - full height and column layout so footer stays bottom */
            .card.portfolio-card {
                background: #1d1f21 !important;
                color: #fff !important;
                border: 0 !important;
                transition: 0.25s;
                display: flex;
                flex-direction: column;
                height: 100%;
                /* biar flex memperlakukan semua kartu sama tinggi */
                min-height: 320px;
                overflow: hidden;
            }

            /* Media / image area */
            .card.portfolio-card .card-img-top,
            .card.portfolio-card .portfolio-image {
                width: 100%;
                height: 180px;
                object-fit: cover;
                background: #2b2e30;
                display: block;
            }

            /* Body grows to fill available space */
            .card.portfolio-card .card-body {
                flex: 1 1 auto;
                padding: 1.1rem;
                display: flex;
                flex-direction: column;
            }

            /* Title + excerpt layout */
            .card.portfolio-card h4 {
                color: #fff !important;
                margin-bottom: .6rem;
                line-height: 1.15;
            }

            .card.portfolio-card p {
                color: #cfcfcf !important;
                margin-bottom: .75rem;
                flex: 1 1 auto;
            }

            /* Footer / badges row sticks at bottom */
            .card.portfolio-card .card-footer,
            .card .portfolio-badges {
                margin-top: .75rem;
                padding: .75rem 1rem;
                background: transparent;
            }

            /* Hover */
            .portfolio-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 6px 22px rgba(0, 0, 0, 0.45);
            }

            /* Filters / intro */
            .portfolio-intro-text {
                font-size: 1.15rem;
                max-width: 700px;
                margin: 0 auto;
                color: #e6eef8;
                text-align: center;
            }

            /* Section title: different font + brighter color */
            .container.section-title h2 {
                font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
                font-weight: 700;
                color: #ffffff;
                letter-spacing: 0.2px;
            }

            .container.section-title p {
                color: #cfefff;
            }

            /* Breadcrumbs (if present in this view) */
            .breadcrumb,
            .breadcrumb a,
            .breadcrumbs,
            nav.breadcrumb {
                color: #e6f7ff !important;
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // jika isotope tersedia: minta re-layout setelah semua gambar load
            if (window.Isotope) {
                const grid = document.querySelector('.isotope-container');
                if (grid) {
                    const iso = window.Isotope.data ? window.Isotope.data(grid) : null;
                    // fallback: trigger a layout after images loaded
                    const imgs = grid.querySelectorAll('img');
                    let loaded = 0;
                    if (imgs.length === 0) {
                        iso && iso.layout();
                    } else {
                        imgs.forEach(img => {
                            if (img.complete) {
                                loaded++;
                            } else {
                                img.addEventListener('load', () => {
                                    loaded++;
                                    if (loaded === imgs.length) iso && iso.layout();
                                });
                                img.addEventListener('error', () => {
                                    loaded++;
                                    if (loaded === imgs.length) iso && iso.layout();
                                });
                            }
                        });
                        if (loaded === imgs.length) iso && iso.layout();
                    }
                }
            }
        });
    </script>
@endsection
