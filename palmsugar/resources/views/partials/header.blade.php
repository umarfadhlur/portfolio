<header id="header" class="header d-flex align-items-center position-relative">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Banyumas Bonanza" style="height: 75px; width: 75px; ">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        @translate('Home', 'layout', 'nav.home')
                    </a>
                </li>

                <li>
                    <a href="{{ route('about.index') }}"
                        class="{{ request()->routeIs('about.index') ? 'active' : '' }}">
                        @translate('About Us', 'layout', 'nav.about')
                    </a>
                </li>

                {{-- <li><a href="#">@translate('Our Services', 'layout', 'nav.services')</a></li> --}}

                <li>
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                        @translate('Our Products', 'layout', 'nav.products')
                    </a>
                </li>

                {{-- <li>
                    <a href="#" class="{{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
                        @translate('Testimonials', 'layout', 'nav.testimonials')
                    </a>
                </li> --}}

                <li>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                        @translate('Blog', 'layout', 'nav.blog')
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact.index') }}"
                        class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
                        @translate('Contact', 'layout', 'nav.contact')
                    </a>
                </li>
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @include('components.language-switcher')

    </div>
</header>
