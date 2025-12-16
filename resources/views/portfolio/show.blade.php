@extends('layouts.app')

@section('title', $portfolio->portfolio_name)
@section('body-class', 'portfolio-details-page')

@section('content')
    <main class="main">

        <section id="portfolio-details" class="portfolio-details section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @php
                    // helpers
                    function safeArray($value)
                    {
                        if (is_array($value)) {
                            return $value;
                        }

                        if (is_string($value)) {
                            $decoded = json_decode($value, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                return $decoded;
                            }
                            return array_filter(array_map('trim', explode(',', $value)));
                        }

                        return [];
                    }

                    $techs = safeArray($portfolio->tech_stack);

                    // roles -> project badges
                    $roles = safeArray($portfolio->roles);
                    $roles = array_values(array_filter(array_map('trim', $roles)));

                    // contributions -> key features
                    $contributions = safeArray($portfolio->contributions);
                    $contributions = array_values(array_filter(array_map('trim', $contributions)));

                    $projectDate = $portfolio->created_at ? $portfolio->created_at->format('F Y') : null;

                    $photos = $portfolio->photos ?? collect();
                    $hasPhotos = $photos->count() > 0;
                @endphp

                <div class="row gy-4">
                    <!-- Left: Media -->
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="portfolio-details-media">

                            <div class="main-image">
                                <div class="portfolio-details-slider swiper init-swiper" data-aos="zoom-in">
                                    <script type="application/json" class="swiper-config">
                                        {
                                          "loop": true,
                                          "speed": 1000,
                                          "autoplay": { "delay": 6000 },
                                          "effect": "creative",
                                          "creativeEffect": {
                                            "prev": { "shadow": true, "translate": [0,0,-400] },
                                            "next": { "translate": ["100%",0,0] }
                                          },
                                          "slidesPerView": 1,
                                          "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" }
                                        }
                                    </script>

                                    <div class="swiper-wrapper">
                                        @if ($hasPhotos)
                                            @foreach ($photos as $photo)
                                                <div class="swiper-slide">
                                                    <img src="{{ Storage::url($photo->image_path) }}"
                                                        alt="{{ $portfolio->portfolio_name }}" class="img-fluid">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="swiper-slide">
                                                <img src="{{ asset('assets/img/placeholder.webp') }}"
                                                    alt="{{ $portfolio->portfolio_name }}" class="img-fluid">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>

                            <!-- Thumbnails -->
                            @if ($hasPhotos)
                                <div class="thumbnail-grid" data-aos="fade-up" data-aos-delay="200">
                                    <div class="row g-2 mt-3">
                                        @foreach ($photos->take(8) as $photo)
                                            <div class="col-3">
                                                <a href="{{ Storage::url($photo->image_path) }}" class="glightbox"
                                                    data-gallery="portfolio-gallery">
                                                    <img src="{{ Storage::url($photo->image_path) }}" alt="Gallery Image"
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Tech stack badges -->
                            @if (count($techs))
                                <div class="tech-stack-badges" data-aos="fade-up" data-aos-delay="300">
                                    @foreach ($techs as $t)
                                        @if (!empty(trim($t)))
                                            <span>{{ $t }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Right: Content -->
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="portfolio-details-content">

                            <div class="project-meta">
                                <div class="badge-wrapper">
                                    @if (count($roles))
                                        @foreach ($roles as $r)
                                            <span class="project-badge">{{ $r }}</span>
                                        @endforeach
                                    @else
                                        <span class="project-badge">Project</span>
                                    @endif
                                </div>

                                <div class="date-client">
                                    @if ($projectDate)
                                        <div class="meta-item">
                                            <i class="bi bi-calendar-check"></i>
                                            <span>{{ $projectDate }}</span>
                                        </div>
                                    @endif

                                    @if (!empty($portfolio->client))
                                        <div class="meta-item">
                                            <i class="bi bi-buildings"></i>
                                            <span>{{ $portfolio->client }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h2 class="project-title">{{ $portfolio->portfolio_name }}</h2>

                            @if (!empty($portfolio->website))
                                <div class="project-website">
                                    <i class="bi bi-link-45deg"></i>
                                    <a href="{{ $portfolio->website }}" target="_blank" rel="noopener noreferrer">
                                        {{ $portfolio->website }}
                                    </a>
                                </div>
                            @endif

                            <div class="project-overview">
                                <p class="lead">{{ $portfolio->description }}</p>
                            </div>

                            <!-- Key Features (1 kolom ke bawah) -->
                            <div class="project-features" data-aos="fade-up" data-aos-delay="300">
                                <h3><i class="bi bi-stars"></i> Contributions</h3>

                                @if (count($contributions))
                                    <ul class="feature-list">
                                        @foreach ($contributions as $c)
                                            <li><i class="bi bi-check2-circle"></i> {{ $c }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="feature-list">
                                        <li><i class="bi bi-check2-circle"></i> Contribution details not provided.</li>
                                    </ul>
                                @endif
                            </div>

                            <div class="cta-buttons" data-aos="fade-up" data-aos-delay="400">
                                @if (!empty($portfolio->website))
                                    <a href="{{ $portfolio->website }}" class="btn-view-project" target="_blank"
                                        rel="noopener noreferrer">
                                        View Live Project
                                    </a>
                                @endif

                                <a href="{{ route('portfolio') }}" class="btn-next-project">Back to Portfolio <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // init glightbox (template pakai glightbox) [file:2]
            if (window.GLightbox) {
                window.GLightbox({
                    selector: '.glightbox'
                });
            }
        });
    </script>
@endsection
