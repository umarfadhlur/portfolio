<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Home') - CV. Banyumas Bonanza Indonesia</title>
    <meta name="description" content="@yield('meta_description', 'Premium Indonesian green coffee beans — Arabica and Robusta from Central Java. Specialty-grade, traceable origin, export-ready.')">
    <meta name="keywords" content="@yield('meta_keywords', 'indonesian coffee, arabica, robusta, green beans, central java, export')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ── Open Graph ── --}}
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Home') - CV. Banyumas Bonanza Indonesia">
    <meta property="og:description" content="@yield('og_description', 'Premium Indonesian green coffee beans — Arabica and Robusta from Central Java. Specialty-grade, traceable origin, export-ready.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/coffee/coffee.jpeg'))">
    <meta property="og:image:width" content="@yield('og_image_width', '1600')">
    <meta property="og:image:height" content="@yield('og_image_height', '1066')">

    {{-- ── Twitter Card ── --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="banyumasbonanza.com">
    <meta property="twitter:url" content="@yield('og_url', url()->current())">
    <meta name="twitter:title" content="@yield('og_title', 'Home') - CV. Banyumas Bonanza Indonesia">
    <meta name="twitter:description" content="@yield('og_description', 'Premium Indonesian green coffee beans — Arabica and Robusta from Central Java. Specialty-grade, traceable origin, export-ready.')">
    <meta name="twitter:image" content="@yield('og_image', asset('assets/img/coffee/coffee.jpeg'))">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main-coffee-theme.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    @include('partials.preloader')
    @include('partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- Stack untuk script tambahan dari views --}}
    @stack('scripts')

</body>

</html>
