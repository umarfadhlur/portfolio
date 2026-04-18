@props([
    'title' => 'Ready to Start a Partnership?',
    'desc' => "Contact our export team and let's discuss your coffee sourcing needs.",
    'btnText' => 'Get in Touch',
    'btnHref' => '/contact',
    'aosDelay' => '0',
])

<div class="footer-cta">
    <div class="container">
        <div class="footer-cta-inner" data-aos="fade-up" data-aos-delay="{{ $aosDelay }}">
            <div>
                <h3 class="footer-cta-title">{{ $title }}</h3>
                <p class="footer-cta-desc">{{ $desc }}</p>
            </div>
            <a href="{{ $btnHref }}" class="btn-footer-cta">
                {{ $btnText }}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
