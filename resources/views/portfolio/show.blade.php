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

            <!-- Cover Image -->
            <div class="mb-4" data-aos="fade-up">
                @if ($portfolio->photos->first())
                    <img src="{{ Storage::url($portfolio->photos->first()->image_path) }}"
                        class="img-fluid rounded-3 shadow-sm"
                        style="height: 380px; width: 100%; object-fit: cover;">
                @endif
            </div>

            @php
                function safeArray($value) {
                    if (is_array($value)) return $value;
                    if (is_string($value)) {
                        $decoded = json_decode($value, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) return $decoded;
                        return array_filter(array_map('trim', explode(',', $value)));
                    }
                    return [];
                }

                $techs = safeArray($portfolio->tech_stack);
                $roles = safeArray($portfolio->roles);
                $contributions = safeArray($portfolio->contributions);
            @endphp


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
@endsection
