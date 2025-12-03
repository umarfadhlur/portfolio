@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
<main class="main">

    <section id="projects" class="portfolio section">

        <!-- Title -->
        <div class="container section-title" data-aos="fade-up">
            <p><span class="description-title">Portfolio</span></p>
        </div>

        <div class="container">

            <!-- Intro Text -->
            <div class="mb-4" style="font-size:1.1rem;" data-aos="fade-up" data-aos-delay="120">
                A curated selection of the best Flutter, Laravel, and ERP integration projects I’ve built.
            </div>

            <!-- Portfolio Filters -->
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-flutter">Flutter</li>
                    <li data-filter=".filter-laravel">Laravel</li>
                </ul>

                <!-- Portfolio Grid -->
                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    @forelse ($portfolios as $p)

                        @php
                            $photo = $p->photos->first();
                            $image = $photo
                                ? Storage::url($photo->image_path)
                                : asset('assets/img/default.jpg');

                            // Convert tech stack safely
                            $techs = $p->tech_stack;
                            if (is_string($techs)) {
                                $decoded = json_decode($techs, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    $techs = $decoded;
                                } else {
                                    $techs = array_map('trim', explode(',', $techs));
                                }
                            }

                            $isFlutter = in_array('Flutter', $techs);
                            $isLaravel = in_array('Laravel', $techs);
                        @endphp

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item
                            {{ $isFlutter ? 'filter-flutter' : '' }}
                            {{ $isLaravel ? 'filter-laravel' : '' }}">

                            <a href="{{ route('portfolio.show', $p->slug) }}">
                                <img src="{{ $image }}" class="img-fluid" alt="{{ $p->portfolio_name }}">
                            </a>

                            <div class="portfolio-info">
                                <h4>{{ $p->portfolio_name }}</h4>
                                <p>{{ Str::limit($p->description, 100) }}</p>

                                <!-- Preview -->
                                <a href="{{ $image }}"
                                   title="{{ $p->portfolio_name }}"
                                   data-gallery="portfolio-gallery"
                                   class="glightbox preview-link">
                                    <i class="bi bi-zoom-in"></i>
                                </a>

                                <!-- Details -->
                                <a href="{{ route('portfolio.show', $p->slug) }}"
                                   title="Details"
                                   class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
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
