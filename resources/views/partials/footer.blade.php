<footer class="site-footer">
    <div class="shell footer-grid">
        <div>
            <a href="{{ route('home') }}" class="footer-brand">UMAR FADHLURRACHMAN</a>
            <p>Building reliable mobile products and enterprise integrations from Indonesia.</p>
        </div>

        <div class="footer-links">
            <a href="{{ route('portfolio') }}">Projects</a>
            <a href="{{ route('resume') }}">Resume</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>

        <div class="footer-socials">
            @if (config('site.social.linkedin'))
                <a href="{{ config('site.social.linkedin') }}" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a>
            @endif
            @if (config('site.social.github'))
                <a href="{{ config('site.social.github') }}" target="_blank" rel="noopener noreferrer">GitHub ↗</a>
            @endif
            @if (config('site.social.instagram'))
                <a href="{{ config('site.social.instagram') }}" target="_blank" rel="noopener noreferrer">Instagram ↗</a>
            @endif
        </div>
    </div>

    <div class="shell footer-bottom">
        <span>© {{ now()->year }} Umar Fadhlurrachman.</span>
        <span>Designed and built with Laravel.</span>
    </div>
</footer>
