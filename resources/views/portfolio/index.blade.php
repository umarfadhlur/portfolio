@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <section id="portfolio" class="portfolio section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p class="mt-2 text-muted">
                    A curated selection of the best Flutter, Laravel, and ERP integration projects I’ve built.
                </p>
            </div>

            <div class="container" data-aos="fade-up">

                <!-- Filter Tabs -->
                <div class="d-flex justify-content-center gap-3 mb-4">
                    <a href="{{ url('/portfolio') }}"
                        class="btn btn-sm {{ request('category') == null ? 'btn-dark' : 'btn-outline-dark' }}">
                        All
                    </a>

                    <a href="{{ url('/portfolio?category=flutter') }}"
                        class="btn btn-sm {{ request('category') == 'flutter' ? 'btn-dark' : 'btn-outline-dark' }}">
                        Flutter
                    </a>

                    <a href="{{ url('/portfolio?category=laravel') }}"
                        class="btn btn-sm {{ request('category') == 'laravel' ? 'btn-dark' : 'btn-outline-dark' }}">
                        Laravel
                    </a>
                </div>

                <!-- Grid -->
                <div class="row gy-4">
                    @foreach ($projects as $p)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">

                            <a href="{{ url('/portfolio/' . $p->slug) }}" class="text-decoration-none text-dark">
                                <div class="card border-0 shadow-sm h-100">

                                    @if ($p->photos->first())
                                        <img src="{{ Storage::url($p->photos->first()->image_path) }}" class="card-img-top"
                                            style="height: 220px; object-fit: cover;">
                                    @endif

                                    <div class="card-body">

                                        <h5 class="fw-bold">{{ $p->portfolio_name }}</h5>

                                        <p class="small text-muted">
                                            {{ Str::limit($p->description, 120) }}
                                        </p>

                                        <div class="mt-2">
                                            @foreach ($p->tech_stack as $tech)
                                                <span class="badge bg-dark">{{ $tech }}</span>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforeach
                </div>

            </div>

        </section>

    </main>
@endsection
