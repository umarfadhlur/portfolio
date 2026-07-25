<header class="site-header" data-site-header>
    <div class="shell header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="Umar Fadhlurrachman home">
            <span class="brand-mark">UF</span>
            <span class="brand-copy">
                <strong>UMAR FADHLURRACHMAN</strong>
                <small>Mobile Engineer</small>
            </span>
        </a>

        @include('partials.navigation')

        <a href="{{ route('contact') }}" class="button button-sm button-primary header-cta">
            Let’s talk
            <span aria-hidden="true">↗</span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Open navigation" aria-expanded="false" data-nav-toggle>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
