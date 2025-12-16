@extends('layouts.app')

@section('title', 'Resume')

@section('body-class', 'resume-page')

@section('content')
    <main class="main">

        {{-- Education Section --}}
        @include('resume.section-education')

        {{-- Experience Section --}}
        @include('resume.section-experience')

    </main>
@endsection
