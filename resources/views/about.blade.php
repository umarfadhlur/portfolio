@extends('layouts.app')

@section('title', 'About')

@section('body-class', 'about-page')

@section('content')
  @include('about.section-about')
  @include('about.section-skill')
  {{-- @include('about.section-stats')
  @include('about.section-testimonials') --}}
@endsection
