<header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        @if(config('site.logo') || config('site.show_logo', false))
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            @if(config('site.logo'))
            <img src="{{ asset(config('site.logo')) }}" alt="{{ config('app.name') }}">
            @endif
            <h1 class="sitename">{{ config('app.name', 'FolioOne') }}</h1>
        </a>
        @endif

        @include('partials.navigation')

        <div class="header-social-links">
            @if(config('site.social.twitter'))
                <a href="{{ config('site.social.twitter') }}" class="twitter"><i class="bi bi-twitter-x"></i></a>
            @endif
            @if(config('site.social.facebook'))
                <a href="{{ config('site.social.facebook') }}" class="facebook"><i class="bi bi-facebook"></i></a>
            @endif
            @if(config('site.social.instagram'))
                <a href="{{ config('site.social.instagram') }}" class="instagram"><i class="bi bi-instagram"></i></a>
            @endif
            @if(config('site.social.linkedin'))
                <a href="{{ config('site.social.linkedin') }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
            @endif
        </div>

    </div>
</header>
