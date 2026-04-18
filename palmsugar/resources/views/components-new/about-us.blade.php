{{-- resources/views/components/home/about-us.blade.php --}}

<section id="about" class="about-snippet py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- LEFT: Image --}}
            <div class="col-lg-5 d-none d-lg-block" data-aos="fade-right">
                <div class="about-snippet-image position-relative">
                    <img src="{{ asset('storage/img/coffee/about-coffee.jpg') }}" alt="@translate('Java Slamet Coffee farm on the slopes of Mount Slamet', 'home', 'about.img_alt')"
                        class="img-fluid rounded-3 w-100" style="object-fit: cover; max-height: 480px;" loading="lazy"
                        decoding="async">

                    {{-- Floating badge --}}
                    <div class="about-snippet-badge">
                        <div class="about-snippet-badge-icon">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <div>
                            <div class="about-snippet-badge-label">@translate('Est.', 'home', 'about.badge_label')</div>
                            <div class="about-snippet-badge-value">Banyumas, Java</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Copy --}}
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">

                <span class="about-snippet-tag">
                    @translate('Who We Are', 'home', 'about.tag')
                </span>

                <h2 class="about-snippet-title mt-3 mb-4">
                    @translate('Indonesian Specialty Coffee,', 'home', 'about.title')
                    <em>@translate('Delivered to the World', 'home', 'about.title_em')</em>
                </h2>

                <p class="about-snippet-desc mb-4">
                    @translate('CV. Banyumas Bonanza Indonesia is a premier coffee producer and exporter operating under the brand', 'home', 'about.desc1')
                    <strong>Kopi PbG (Java Slamet Coffee)</strong> —
                    @translate('sourcing traceable Arabica and Robusta beans from the volcanic slopes of Mount Slamet and Mount Sindoro-Sumbing, Central Java.', 'home', 'about.desc1_end')
                </p>

                <p class="about-snippet-desc mb-5">
                    @translate('Our integrated operation covers the entire value chain — from farm-level sourcing and post-harvest processing to export readiness — delivering 100% natural coffee that meets international quality standards.', 'home', 'about.desc2')
                </p>

                <a href="{{ route('about.index') }}" class="btn-about-more">
                    @translate('Learn More About Us', 'home', 'about.cta')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>

            </div>
        </div>
    </div>
</section>

<style>
    .about-snippet {
        background-color: #faf8f4;
    }

    .about-snippet-image img {
        box-shadow: 0 12px 32px rgb(0 0 0 / 0.12);
    }

    .about-snippet-badge {
        position: absolute;
        bottom: 1.5rem;
        right: -1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: #fff;
        padding: 0.75rem 1.25rem;
        border-radius: 0.75rem;
        border: 1px solid #d8d0c4;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.10);
    }

    .about-snippet-badge-icon {
        width: 40px;
        height: 40px;
        background: #e4d7c8;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #5c3b1e;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .about-snippet-badge-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #7a6e62;
    }

    .about-snippet-badge-value {
        font-family: var(--font-display);
        font-size: 0.95rem;
        font-weight: 600;
        color: #261e14;
    }

    .about-snippet-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 1rem;
        background: #e4d7c8;
        color: #5c3b1e;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 9999px;
    }

    .about-snippet-title {
        font-family: var(--font-display);
        font-size: clamp(1.75rem, 1rem + 2vw, 2.75rem);
        line-height: 1.15;
        color: #261e14;
    }

    .about-snippet-title em {
        font-style: italic;
        color: #c26a2a;
    }

    .about-snippet-desc {
        font-size: 1rem;
        color: #7a6e62;
        line-height: 1.8;
        max-width: 60ch;
    }

    .btn-about-more {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: #5c3b1e;
        color: #faf8f4 !important;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 9999px;
        text-decoration: none;
        transition: background 180ms, box-shadow 180ms;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.10);
    }

    .btn-about-more:hover {
        background: #422a12;
        box-shadow: 0 8px 24px rgb(0 0 0 / 0.14);
    }
</style>
