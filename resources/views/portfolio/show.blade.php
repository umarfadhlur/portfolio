@extends('layouts.app')

@section('title', $portfolio->portfolio_name)

@section('body-class', 'portfolio-detail-page')

@section('content')
    <main class="main">

        <section id="portfolio-detail" class="section portfolio section">

            <div class="container">

                <!-- Breadcrumbs -->
                <nav class="mb-4" aria-label="breadcrumb" data-aos="fade-up">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                        <li class="breadcrumb-item">{{ $portfolio->portfolio_name }}</li>
                    </ol>
                </nav>

                <!-- Title & Description -->
                <div class="section-title" data-aos="fade-up">
                    <h2 class="portfolio-detail-title">{{ $portfolio->portfolio_name }}</h2>

                    <p class="portfolio-detail-description">
                        {{ $portfolio->description }}
                    </p>
                </div>

                @php
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

                    // project meta
                    $projectBadge = count($techs) ? $techs[0] : 'Project';
                    $projectDate = $portfolio->created_at ? $portfolio->created_at->format('F Y') : null;
                @endphp

                <!-- Media / Slider -->
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
                                          "slidesPerView": 1,
                                          "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" }
                                        }
                                    </script>
                                    <div class="swiper-wrapper">
                                        @foreach ($portfolio->photos as $photo)
                                            <div class="swiper-slide">
                                                <img src="{{ Storage::url($photo->image_path) }}" alt="Portfolio Image"
                                                    class="img-fluid">
                                            </div>
                                        @endforeach
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

                        <!-- Project Meta (moved to right column) -->
                        <div class="portfolio-details-content">
                            <div class="project-meta mb-3">
                                <div class="badge-wrapper mb-2">
                                    <span class="project-badge">{{ $projectBadge }}</span>
                                </div>
                                <div class="date-client d-flex gap-3">
                                    <div class="meta-item">
                                        <i class="bi bi-calendar-check"></i>
                                        <span>{{ $projectDate }}</span>
                                    </div>
                                    {{-- client/company not available by default --}}
                                </div>
                            </div>

                            <h2 class="project-title">{{ $portfolio->portfolio_name }}</h2>

                            @if($portfolio->website)
                                <div class="project-website mb-3">
                                    <i class="bi bi-link-45deg"></i>
                                    <a href="{{ $portfolio->website }}" target="_blank">{{ $portfolio->website }}</a>
                                </div>
                            @endif

                            <div class="project-overview mb-3">
                                <p class="lead">{{ $portfolio->description }}</p>
                            </div>

                            <div class="accordion project-accordion mb-3" id="portfolio-details-projectAccordion">
                                <div class="accordion-item" data-aos="fade-up">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#portfolio-details-collapse-1" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="bi bi-clipboard-data me-2"></i> Project Overview
                                        </button>
                                    </h2>
                                    <div id="portfolio-details-collapse-1" class="accordion-collapse collapse show" data-bs-parent="#portfolio-details-projectAccordion">
                                        <div class="accordion-body">
                                            <p>{{ $portfolio->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#portfolio-details-collapse-2" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="bi bi-exclamation-diamond me-2"></i> The Challenge
                                        </button>
                                    </h2>
                                    <div id="portfolio-details-collapse-2" class="accordion-collapse collapse" data-bs-parent="#portfolio-details-projectAccordion">
                                        <div class="accordion-body">
                                            <p>{{ $portfolio->challenge ?? 'Challenge details not provided.' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#portfolio-details-collapse-3" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="bi bi-award me-2"></i> The Solution
                                        </button>
                                    </h2>
                                    <div id="portfolio-details-collapse-3" class="accordion-collapse collapse" data-bs-parent="#portfolio-details-projectAccordion">
                                        <div class="accordion-body">
                                            <p>{{ $portfolio->solution ?? 'Solution details not provided.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        <!-- Tech Stack -->
                        <div class="resume-item" data-aos="fade-up">
                            <h3 class="resume-title">Tech Stack</h3>
                            <div class="resume-content">
                                @foreach ($techs as $t)
                                    <span class="badge bg-dark me-1 mb-2">{{ $t }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Roles -->
                        <div class="resume-item" data-aos="fade-up">
                            <h3 class="resume-title">Roles</h3>
                            <div class="resume-content">
                                <ul>
                                    @foreach ($roles as $r)
                                        <li>{{ $r }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Contributions -->
                        <div class="resume-item" data-aos="fade-up">
                            <h3 class="resume-title">Contributions</h3>
                            <div class="resume-content">
                                <ul>
                                    @foreach ($contributions as $c)
                                        <li>{{ $c }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Gallery -->
                        @if ($portfolio->photos->count() > 1)
                            <div class="resume-item" data-aos="fade-up">
                                <h3 class="resume-title">Gallery</h3>
                                <div class="row gy-3">
                                    @foreach ($portfolio->photos->skip(1) as $photo)
                                        <div class="col-md-4">
                                            <img src="{{ Storage::url($photo->image_path) }}"
                                                class="img-fluid rounded shadow-sm"
                                                style="height: 200px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-5">
                            <a href="{{ route('portfolio') }}" class="btn btn-dark">← Back to Portfolio</a>
                        </div>

                    </div>
        </section>

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
