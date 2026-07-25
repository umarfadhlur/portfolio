<nav class="site-nav" aria-label="Main navigation" data-site-nav>
    <a href="{{ route('home') }}#work" class="{{ request()->routeIs('home') ? 'active' : '' }}">Work</a>
    <a href="{{ route('home') }}#expertise">Expertise</a>
    <a href="{{ route('resume') }}" class="{{ request()->routeIs('resume') ? 'active' : '' }}">Experience</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    <a href="{{ route('portfolio') }}" class="{{ request()->is('portfolio*') ? 'active' : '' }}">All projects</a>
    <a href="{{ route('contact') }}" class="mobile-nav-contact {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
</nav>
