@extends('layouts.app')

@section('title', $project->portfolio_name)

@section('body-class', 'portfolio-detail-page')

@section('content')
    <main class="main">

        <section id="portfolio-detail" class="section portfolio-detail">

            <div class="container section-title" data-aos="fade-up">
                <!-- Breadcrumbs -->
                <nav class="mb-4" aria-label="breadcrumb" data-aos="fade-up">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/portfolio') }}">Portfolio</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $project->portfolio_name }}
                        </li>
                    </ol>
                </nav>

                <h2>{{ $project->portfolio_name }}</h2>
                <p class="text-muted">{{ $project->description }}</p>
            </div>

            <div class="container">

                <!-- Cover Image -->
                <div class="mb-4" data-aos="fade-up">
                    @if ($project->photos->first())
                        <img src="{{ Storage::url($project->photos->first()->image_path) }}"
                            class="img-fluid rounded-3 shadow-sm" style="max-height: 400px; object-fit: cover; width:100%;">
                    @endif
                </div>

                <!-- Tech Stack -->
                <h3 class="fw-bold mt-4">Tech Stack</h3>
                <div class="mb-3">
                    @foreach ($project->tech_stack as $tech)
                        <span class="badge bg-dark me-1">{{ $tech }}</span>
                    @endforeach
                </div>

                <!-- Roles -->
                <h3 class="fw-bold mt-4">Roles</h3>
                <ul>
                    @foreach ($project->roles as $role)
                        <li>{{ $role }}</li>
                    @endforeach
                </ul>

                <!-- Contributions -->
                <h3 class="fw-bold mt-4">Contributions</h3>
                <ul>
                    @foreach ($project->contributions as $c)
                        <li>{{ $c }}</li>
                    @endforeach
                </ul>

                <!-- Gallery -->
                @if ($project->photos->count() > 1)
                    <h3 class="fw-bold mt-4">Gallery</h3>
                    <div class="row gy-3">
                        @foreach ($project->photos->skip(1) as $photo)
                            <div class="col-md-4">
                                <img src="{{ Storage::url($photo->image_path) }}" class="img-fluid rounded shadow-sm"
                                    style="height: 200px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-5">
                    <a href="/portfolio" class="btn btn-dark">← Back to Portfolio</a>
                </div>

            </div>

        </section>

    </main>
@endsection
