@extends('layouts.app')

@section('title', 'Home')
@section('meta_description',
    'Premium Indonesian green coffee beans — Arabica and Robusta from Central Java.
    Specialty-grade, traceable origin, export-ready.')

@section('content')

    {{-- ======================== HERO ======================== --}}
    @include('components-new.hero')
    {{-- /Hero --}}

    {{-- ======================== ABOUT (SINGKAT) ======================== --}}
    @include('components-new.about-us')
    {{-- /About --}}


    {{-- ======================== OUR PRODUCTS ======================== --}}
    @include('components-new.products')
    {{-- /Products --}}


    {{-- ======================== TESTIMONIALS ======================== --}}
    @include('components-new.testimonials')
    {{-- /Testimonials --}}


    {{-- ======================== RECENT POSTS / BLOG ======================== --}}
    @include('components-new.blog')
    {{-- /Blog --}}


    {{-- ======================== CONTACT ======================== --}}
    @include('components-new.contact')
    {{-- /Contact --}}

    <div class="footer-cta">
        <div class="container">
            <div class="footer-cta-inner" data-aos="fade-up">
                <div>
                    <h3 class="footer-cta-title">
                        @translate('Ready to Source Premium Indonesian Products?', 'home', 'footer.cta_title')
                    </h3>
                    <p class="footer-cta-desc">
                        @translate('Let\'s discuss your requirements. Our export team is ready to assist you.', 'home', 'footer.cta_desc')
                    </p>
                </div>
                <a href="#contact" class="btn-footer-cta">
                    @translate('Contact Us Now', 'home', 'footer.cta_btn')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

@endsection
