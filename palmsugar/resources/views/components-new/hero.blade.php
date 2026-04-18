<section id="hero" aria-labelledby="hero-heading" class="d-flex align-items-center py-5">

    <div class="hero-bg" aria-hidden="true"></div>

    <div class="container-xl position-relative">
        <div class="row align-items-center g-5">

            {{-- LEFT: Copy --}}
            <div class="col-lg-6">

                {{-- Badge --}}
                <div class="hero-badge mb-4">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor" aria-hidden="true">
                        <circle cx="6" cy="6" r="6" />
                    </svg>
                    Kopi PbG · Java Slamet Coffee
                </div>

                {{-- Headline --}}
                <h1 class="hero-title mb-4" id="hero-heading">
                    @translate('Expertly Sourced,', 'home', 'hero.title_line1')<br>
                    <em>@translate('Naturally Perfected', 'home', 'hero.title_line2')</em>
                </h1>

                {{-- Subheading --}}
                <p class="hero-subtitle mb-5">
                    @translate('Premium Indonesian specialty coffee from the volcanic slopes of Mount Slamet, Central Java. Arabica & Robusta green beans — traceable, certified, and export-ready.', 'home', 'hero.subtitle')
                </p>

                {{-- CTA Buttons --}}
                <div class="d-flex flex-wrap align-items-center gap-3 mb-5">
                    <a href="{{ route('products.index') }}" class="btn-hero-primary">
                        @translate('Explore Our Products', 'home', 'hero.cta_primary')
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                    <a href="{{ route('home') }}#contact" class="btn-hero-secondary">
                        @translate('Request a Sample', 'home', 'hero.cta_secondary')
                    </a>
                </div>

                {{-- Stats --}}
                <div class="hero-stats">
                    <div class="row g-4">
                        <div class="col-4">
                            <div class="hero-stat-value">740 MT</div>
                            <div class="hero-stat-label">@translate('Annual Capacity', 'home', 'hero.stat1_label')</div>
                        </div>
                        <div class="col-4">
                            <div class="hero-stat-value">770K</div>
                            <div class="hero-stat-label">@translate('Coffee Plants', 'home', 'hero.stat2_label')</div>
                        </div>
                        <div class="col-4">
                            <div class="hero-stat-value">4+</div>
                            <div class="hero-stat-label">@translate('Export Markets', 'home', 'hero.stat3_label')</div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Image Carousel --}}
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-image-wrap position-relative">

                    <div class="swiper hero-swiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/coffee/hero-coffee.jpeg') }}" alt="@translate('Coffee farmer harvesting red coffee cherries on the slopes of Mount Slamet, Central Java', 'home', 'hero.img_alt')"
                                    width="600" height="750" loading="eager" decoding="async">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/coffee/hero-coffee-2.jpeg') }}" alt="@translate('Green coffee beans drying on raised beds, Central Java', 'home', 'hero.img_alt2')"
                                    width="600" height="750" loading="lazy" decoding="async">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/coffee/hero-coffee-3.jpeg') }}" alt="@translate('Freshly harvested Arabica coffee cherries from Mount Slamet', 'home', 'hero.img_alt3')"
                                    width="600" height="750" loading="lazy" decoding="async">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/coffee/hero-coffee-4.jpeg') }}" alt="@translate('Freshly breweed coffee', 'home', 'hero.img_alt4')"
                                    width="600" height="750" loading="lazy" decoding="async">
                            </div>

                        </div>

                        {{-- Pagination dots --}}
                        {{-- <div class="swiper-pagination hero-swiper-pagination"></div> --}}
                    </div>

                    {{-- Badge tetap di atas carousel --}}
                    <div class="hero-image-badge">
                        <div class="hero-image-badge-label">
                            @translate('Cupping Score', 'home', 'hero.badge_label')
                        </div>
                        <div class="hero-image-badge-value">84.25 Arabica</div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.hero-swiper', {
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false,
                },
                speed: 900,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.hero-swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>
@endpush
