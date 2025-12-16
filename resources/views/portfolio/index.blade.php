@extends('layouts.app')

@section('title', 'Portfolio')
@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <section id="portfolio" class="portfolio section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>My selected portfolios showcasing my skills in Flutter, PHP, and ERP integrations.</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-flutter">Flutter</li>
                        <li data-filter=".filter-php">PHP</li>
                    </ul>

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">
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

                            <div
                                class="col-lg-4 col-md-6 portfolio-item isotope-item
              {{ $isFlutter ? 'filter-flutter' : '' }}
              {{ $isPHP ? 'filter-php' : '' }}">
                                <div class="portfolio-card">
                                    <div class="portfolio-img">
                                        @if ($image)
                                            <img src="{{ $image }}" alt="{{ $p->portfolio_name }}" class="img-fluid">
                                        @else
                                            {{-- Kalau kamu punya placeholder, pakai ini. Kalau tidak, boleh hapus dan biarkan kosong --}}
                                            <img src="{{ asset('assets/img/placeholder.webp') }}"
                                                alt="{{ $p->portfolio_name }}" class="img-fluid">
                                        @endif

                                        <div class="portfolio-overlay">
                                            @if ($image)
                                                <a href="{{ $image }}" class="glightbox portfolio-lightbox"
                                                    data-gallery="portfolio-gallery">
                                                    <i class="bi bi-plus"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('portfolio.show', $p->slug) }}"
                                                class="portfolio-details-link">
                                                <i class="bi bi-link"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="portfolio-info">
                                        <h4>{{ $p->portfolio_name }}</h4>
                                        <p>{{ Str::limit($p->description, 60) }}</p>

                                        <div class="portfolio-tags">
                                            @foreach ($techs as $tech)
                                                @if (!empty($tech))
                                                    <span>{{ $tech }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">No portfolios available at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                </div>

                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                    <a href="#portfolio" class="btn btn-primary">View All Case Studies</a>
                </div>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // init glightbox kalau vendor-nya ada
            if (window.GLightbox) {
                window.GLightbox({
                    selector: '.glightbox'
                });
            }

            // relayout isotope after images loaded (masonry)
            if (window.Isotope) {
                const grid = document.querySelector('.isotope-container');
                if (!grid) return;

                const iso = window.Isotope.data ? window.Isotope.data(grid) : null;
                const imgs = grid.querySelectorAll('img');
                let loaded = 0;

                if (imgs.length === 0) {
                    iso && iso.layout();
                    return;
                }

                imgs.forEach(img => {
                    const done = () => {
                        loaded++;
                        if (loaded === imgs.length) iso && iso.layout();
                    };

                    if (img.complete) done();
                    else {
                        img.addEventListener('load', done);
                        img.addEventListener('error', done);
                    }
                });
            }
        });
    </script>
@endsection
