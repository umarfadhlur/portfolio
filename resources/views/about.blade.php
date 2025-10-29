@extends('layouts.app')

@section('title', 'About')

@section('body-class', 'about-page')

@section('content')
    <main class="main">
        @include('about.section-about')
    </main>
@endsection
