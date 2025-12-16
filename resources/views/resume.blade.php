@extends('layouts.app')

@section('title', 'Resume')

@section('body-class', 'resume-page')

@section('content')
    <main class="main">

        <section id="resume" class="resume section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Resume</h2>
                <p>My formal bio details, education, and experience.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-6">

                        {{-- Education Section --}}
                        @include('resume.section-education')

                    </div>

                    <div class="col-lg-6">

                        {{-- Experience Section --}}
                        @include('resume.section-experience')

                    </div>
                </div>

            </div>

        </section>
    @endsection
