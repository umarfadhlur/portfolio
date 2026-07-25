<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#080b12">

    <title>@yield('title', 'Umar Fadhlurrachman') · Mobile Engineer</title>
    <meta name="description" content="@yield('meta_description', 'Portfolio of Umar Fadhlurrachman, a Mobile Engineer building production-ready Flutter, Laravel, ERP, warehouse, and payment integration solutions.')">
    <meta name="keywords" content="Flutter Developer, Mobile Engineer, Laravel Developer, ERP Integration, JD Edwards, iDempiere, Indonesia">
    <meta name="author" content="Umar Fadhlurrachman">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Umar Fadhlurrachman') · Mobile Engineer">
    <meta property="og:description" content="@yield('meta_description', 'Mobile Engineer focused on Flutter, Laravel, and enterprise integration.')">
    <meta property="og:image" content="{{ asset('assets/img/profile/umarf.png') }}">

    <link rel="icon" href="{{ asset('assets/img/favicon.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>document.documentElement.classList.add('js');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="site-body @yield('body-class')">
    <a class="skip-link" href="#main-content">Skip to content</a>

    @include('partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    <button class="scroll-top" type="button" aria-label="Back to top" data-scroll-top>
        <span aria-hidden="true">↑</span>
    </button>

    @stack('scripts')
</body>
</html>
