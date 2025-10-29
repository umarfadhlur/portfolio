@extends('layouts.app')

@section('title', 'Resume')

@section('body-class', 'resume-page')

@section('content')
    <main class="main">

        <section id="resume" class="resume section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Resume</h2>
            </div>

            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6">

                        <!-- Education -->
                        <div class="resume-item" data-aos="fade-up">
                            <h3 class="resume-title">Education</h3>
                            <div class="resume-content">
                                @foreach ($education as $edu)
                                    <article class="education-item" data-aos="slide-up">
                                        <h4>{{ $edu->name }}</h4>
                                        <h5>
                                            {{ date('Y', strtotime($edu->start_date)) }}
                                            -
                                            {{ $edu->end_date ? date('Y', strtotime($edu->end_date)) : 'Present' }}
                                        </h5>
                                        <p class="institution">
                                            <em>{{ $edu->client }}{{ $edu->location ? ', ' . $edu->location : '' }}</em>
                                        </p>
                                        <p>{{ $edu->description }}</p>
                                        @if (Str::contains($edu->description, "\n"))
                                            <ul>
                                                @foreach (explode("\n", $edu->description) as $line)
                                                    @if (trim($line) !== '')
                                                        <li>{{ $line }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>{{ $edu->description }}</p>
                                        @endif
                                    </article>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <!-- Work Experience -->
                        <div class="resume-item" data-aos="fade-up">
                            <h3 class="resume-title">Professional Experience</h3>
                            <div class="resume-content">
                                @foreach ($work as $exp)
                                    <article class="experience-item mb-4" data-aos="slide-up">
                                        <h4>{{ $exp->name }}</h4>
                                        <h5>
                                            {{ date('Y', strtotime($exp->start_date)) }}
                                            -
                                            {{ $exp->end_date ? date('Y', strtotime($exp->end_date)) : 'Present' }}
                                        </h5>
                                        <p class="company">
                                            <em>{{ $exp->client }}{{ $exp->location ? ', ' . $exp->location : '' }}</em>
                                        </p>

                                        {{-- kalau kamu mau simpan deskripsi pakai bullet list --}}
                                        @if (Str::contains($exp->description, "\n"))
                                            <ul>
                                                @foreach (explode("\n", $exp->description) as $line)
                                                    @if (trim($line) !== '')
                                                        <li>{{ $line }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>{{ $exp->description }}</p>
                                        @endif
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
