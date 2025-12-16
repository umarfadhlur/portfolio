@extends('layouts.app')

@section('title', $portfolio->portfolio_name)

@section('body-class', 'portfolio-detail-page')

@section('content')
    <main class="main">

        <section id="portfolio-details" class="portfolio-details section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio Details</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit. Sed ut perspiciatis
                    unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam</p>
            </div><!-- End Section Title -->

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
                    $roles = safeArray($portfolio->roles);
                    $contributions = safeArray($portfolio->contributions);
                    $projectBadge = count($techs) ? $techs[0] : 'Project';
                    $projectDate = $portfolio->created_at ? $portfolio->created_at->format('F Y') : null;
                    $features = safeArray($portfolio->features ?? []);
                @endphp

                <div class="row gy-4">
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
                                        @if ($portfolio->photos->count())
                                            @foreach ($portfolio->photos as $photo)
                                                <div class="swiper-slide">
                                                    <img src="{{ Storage::url($photo->image_path) }}" alt="Portfolio Image"
                                                        class="img-fluid">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="swiper-slide">
                                                <img src="{{ asset('assets/img/placeholder.png') }}" alt="Portfolio Image"
                                                    class="img-fluid">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>

                            <div class="thumbnail-grid" data-aos="fade-up" data-aos-delay="200">
                                <div class="row g-2 mt-3">
                                    @foreach ($portfolio->photos as $photo)
                                        <div class="col-3">
                                            <img src="{{ Storage::url($photo->image_path) }}" alt="Gallery Image"
                                                class="img-fluid glightbox">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tech-stack-badges" data-aos="fade-up" data-aos-delay="300">
                                @foreach ($techs as $t)
                                    <span>{{ $t }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="portfolio-details-content">
                            <div class="project-meta">
                                <div class="badge-wrapper">
                                    <span class="project-badge">{{ $projectBadge }}</span>
                                </div>
                                <div class="date-client">
                                    <div class="meta-item">
                                        <i class="bi bi-calendar-check"></i>
                                        <span>{{ $projectDate }}</span>
                                    </div>
                                    @if ($portfolio->client)
                                        <div class="meta-item">
                                            <i class="bi bi-buildings"></i>
                                            <span>{{ $portfolio->client }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h2 class="project-title">{{ $portfolio->portfolio_name }}</h2>

                            @if ($portfolio->website)
                                <div class="project-website">
                                    <i class="bi bi-link-45deg"></i>
                                    <a href="{{ $portfolio->website }}" target="_blank">{{ $portfolio->website }}</a>
                                </div>
                            @endif

                            <div class="project-overview">
                                <p class="lead">{{ $portfolio->description }}</p>

                                <div class="accordion project-accordion" id="portfolio-details-projectAccordion">
                                    <div class="accordion-item" data-aos="fade-up">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#portfolio-details-collapse-1" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="bi bi-clipboard-data me-2"></i> Project Overview
                                            </button>
                                        </h2>
                                        <div id="portfolio-details-collapse-1" class="accordion-collapse collapse show"
                                            data-bs-parent="#portfolio-details-projectAccordion">
                                            <div class="accordion-body">
                                                <p>{{ $portfolio->description }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#portfolio-details-collapse-2"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="bi bi-exclamation-diamond me-2"></i> The Challenge
                                            </button>
                                        </h2>
                                        <div id="portfolio-details-collapse-2" class="accordion-collapse collapse"
                                            data-bs-parent="#portfolio-details-projectAccordion">
                                            <div class="accordion-body">
                                                <p>{{ $portfolio->challenge ?? 'Challenge details not provided.' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#portfolio-details-collapse-3"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <i class="bi bi-award me-2"></i> The Solution
                                            </button>
                                        </h2>
                                        <div id="portfolio-details-collapse-3" class="accordion-collapse collapse"
                                            data-bs-parent="#portfolio-details-projectAccordion">
                                            <div class="accordion-body">
                                                <p>{{ $portfolio->solution ?? 'Solution details not provided.' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="project-features" data-aos="fade-up" data-aos-delay="300">
                                <h3><i class="bi bi-stars"></i> Key Features</h3>
                                <div class="row g-3">
                                    @if (count($features))
                                        @foreach (array_chunk($features, ceil(count($features) / 2)) as $col)
                                            <div class="col-md-6">
                                                <ul class="feature-list">
                                                    @foreach ($col as $f)
                                                        <li><i class="bi bi-check2-circle"></i> {{ $f }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-6">
                                            <ul class="feature-list">
                                                <li><i class="bi bi-check2-circle"></i> Real-time Data Visualization</li>
                                                <li><i class="bi bi-check2-circle"></i> User Role Management</li>
                                                <li><i class="bi bi-check2-circle"></i> Secure Authentication</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="feature-list">
                                                <li><i class="bi bi-check2-circle"></i> Customizable Dashboards</li>
                                                <li><i class="bi bi-check2-circle"></i> Data Export Options</li>
                                                <li><i class="bi bi-check2-circle"></i> Multi-device Support</li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="cta-buttons" data-aos="fade-up" data-aos-delay="400">
                                @if ($portfolio->website)
                                    <a href="{{ $portfolio->website }}" class="btn btn-view-project btn-primary"
                                        target="_blank">View Live Project</a>
                                @endif
                                @php $next = \App\Models\Portfolio::where('id', '>', $portfolio->id)->orderBy('id')->first(); @endphp
                                <a href="{{ $next ? route('portfolio.show', $next->slug) : route('portfolio') }}"
                                    class="btn btn-next-project">{{ $next ? 'Next Project' : 'Back to Portfolio' }} <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <div class="mt-5">
            <a href="{{ route('portfolio') }}" class="btn btn-dark">← Back to Portfolio</a>
        </div>

    </main>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap');

        /* Section title font + warna terang */
        .container.section-title h2,
        .section-title h2 {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            font-weight: 700;
            color: #ffffff !important;
        }

        /* Subtitle / description */
        .container.section-title p,
        .section-title p {
            color: #cfefff !important;
            /* light blue */
        }

        /* Project badge and title */
        .project-badge {
            display: inline-block;
            background: #2d3236;
            color: #fff;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .project-title {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            font-weight: 700;
            color: #ffffff !important;
            font-size: 2.1rem;
            margin-top: 0.5rem;
        }

        /* Breadcrumbs / kecil di show.blade */
        .breadcrumb,
        .breadcrumb-item,
        .breadcrumb a,
        .breadcrumbs,
        .page-breadcrumb,
        nav.breadcrumb {
            color: #e6f7ff !important;
            /* very light blue */
            background: transparent !important;
        }

        /* Breadcrumb links */
        .breadcrumb a,
        .breadcrumbs a,
        nav.breadcrumb a {
            color: #bfe9ff !important;
            text-decoration: none;
        }

        .breadcrumb a:hover,
        .breadcrumbs a:hover,
        nav.breadcrumb a:hover {
            color: #ffffff !important;
            text-decoration: underline;
        }

        /* Ensure high specificity override if needed */
        .section-title .breadcrumb,
        .section-title .breadcrumbs {
            color: #e6f7ff !important;
        }
    </style>
@endsection
