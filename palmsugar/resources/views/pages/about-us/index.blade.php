@extends('layouts.app')

@section('title', 'About Us')
@section('og_title', 'About Us')
@section('og_description', 'Learn about CV. Banyumas Bonanza Indonesia — premier coffee exporter from Central Java.')
@section('og_image', asset('assets/img/coffee/mount.jpeg'))
@section('og_url', route('about.index'))

@section('content')

    {{-- ── SECTION 1: About Us Header ── --}}
    <section id="about" aria-labelledby="about-heading" class="section light-background">
        <div class="container">

            <div class="text-center mb-5" data-aos="fade-up">
                <span class="contact-tag">
                    @translate('About Us', 'about', 'hero.tag')
                </span>
                <h2 class="contact-title mt-3" id="about-heading">
                    @translate('Premium Indonesian Coffee,', 'about', 'hero.title')
                    <em>@translate('Rooted in Java', 'about', 'hero.title_em')</em>
                </h2>
                <p class="contact-subtitle mx-auto mt-3">
                    @translate('CV. Banyumas Bonanza Indonesia is a premier Indonesian coffee producer and exporter from Central Java, specializing in Java Slamet Coffee (Kopi PbG).', 'about', 'hero.desc')
                </p>
            </div>

        </div>
    </section>

    {{-- ── SECTION 2: Who We Are ── --}}
    <section id="who-we-are" class="section">
        <div class="container">

            <div class="row gy-5 align-items-center justify-content-between">

                <div class="col-lg-6 order-lg-2 d-none d-lg-block" data-aos="zoom-out">
                    <div class="hero-image-wrap" style="aspect-ratio: 4/3;">
                        <img src="{{ asset('assets/img/coffee/mount.jpeg') }}" alt="@translate('Java Slamet Coffee on Mount Slamet', 'about', 'hero.img_alt')" loading="lazy"
                            decoding="async">
                    </div>
                </div>

                <div class="col-lg-5 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                    <span class="products-snippet-tag">
                        @translate('Who We Are', 'about', 'who.tag')
                    </span>
                    <h3 class="products-snippet-title mt-3 mb-4">
                        @translate('Indonesian Specialty Coffee,', 'about', 'who.title')
                        <em>@translate('Delivered with Care', 'about', 'who.title_em')</em>
                    </h3>
                    <p class="products-snippet-subtitle mb-4">
                        @translate('We source, process, and prepare high-quality Arabica and Robusta coffee from carefully selected growing regions in Central Java.', 'about', 'who.desc1')
                    </p>
                    <p class="products-snippet-subtitle mb-4">
                        @translate('Every shipment reflects our commitment to traceability, consistency, and export readiness — from farm-level sourcing to final preparation.', 'about', 'who.desc2')
                    </p>
                    <ul class="list-unstyled mb-4" style="display:flex; flex-direction:column; gap:0.65rem;">
                        <li
                            style="display:flex; align-items:flex-start; gap:0.6rem; font-size:0.9rem; color:var(--default-color);">
                            <i class="bi bi-check-circle-fill"
                                style="color:var(--nav-hover-color); flex-shrink:0; margin-top:2px;"></i>
                            @translate('Traceable single-origin sourcing from Central Java', 'about', 'who.check1')
                        </li>
                        <li
                            style="display:flex; align-items:flex-start; gap:0.6rem; font-size:0.9rem; color:var(--default-color);">
                            <i class="bi bi-check-circle-fill"
                                style="color:var(--nav-hover-color); flex-shrink:0; margin-top:2px;"></i>
                            @translate('740 MT yearly production capacity', 'about', 'who.check2')
                        </li>
                        <li
                            style="display:flex; align-items:flex-start; gap:0.6rem; font-size:0.9rem; color:var(--default-color);">
                            <i class="bi bi-check-circle-fill"
                                style="color:var(--nav-hover-color); flex-shrink:0; margin-top:2px;"></i>
                            @translate('100% natural coffee without additives', 'about', 'who.check3')
                        </li>
                    </ul>
                    <a href="{{ route('contact.index') }}" class="btn-hero-primary">
                        @translate('Get in Touch', 'about', 'who.cta')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ── SECTION 3: Heritage ── --}}
    <section id="heritage" class="section light-background">
        <div class="container">

            <div class="text-center mb-5" data-aos="fade-up">
                <span class="contact-tag">
                    @translate('Our Heritage', 'about', 'heritage.title')
                </span>
                <h2 class="contact-title mt-3">
                    @translate('Expertly Roasted,', 'about', 'heritage.subtitle')
                    <em>@translate('Naturally Perfected', 'about', 'heritage.subtitle_em')</em>
                </h2>
            </div>

            <div class="row gy-5 align-items-center justify-content-between">

                <div class="col-lg-5" data-aos="fade-right">
                    <div class="about-video-wrap">

                        {{-- Thumbnail dari canvas (otomatis dari frame video) --}}
                        <div class="about-video-thumb" id="videoThumb">
                            <canvas id="videoThumbnail" style="width:100%; height:100%; object-fit:cover; display:block;">
                            </canvas>
                            <button class="about-video-play-btn" id="videoPlayBtn" aria-label="Play video">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </button>
                        </div>

                        {{-- Video — hidden sampai diklik --}}
                        <video id="heritageVideo" controls preload="metadata"
                            style="display:none; width:100%; height:100%; object-fit:cover;">
                            <source src="{{ asset('assets/img/coffee/processing.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <p class="products-snippet-subtitle mb-4">
                        @translate('Rooted in the fertile volcanic slopes of Mount Slamet in Banyumas Raya and Mount Sindoro-Sumbing in Temanggung, our coffee benefits from ideal growing conditions and generations of farming expertise.', 'about', 'heritage.desc1')
                    </p>
                    <p class="products-snippet-subtitle mb-4">
                        @translate('We believe great coffee comes from long-term relationships, careful handling, and respect for the communities that cultivate it.', 'about', 'heritage.desc2')
                    </p>
                    <div class="row text-center g-3 mt-2">
                        <div class="col-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="hero-stat-value">740 MT</div>
                            <div class="hero-stat-label">@translate('Production / Year', 'about', 'heritage.stat1')</div>
                        </div>
                        <div class="col-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="hero-stat-value">770K+</div>
                            <div class="hero-stat-label">@translate('Coffee Plants', 'about', 'heritage.stat2')</div>
                        </div>
                        <div class="col-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="hero-stat-value">1,600+</div>
                            <div class="hero-stat-label">@translate('Max MASL', 'about', 'heritage.stat3')</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── SECTION 4: QUEST Values ── --}}
    <section id="quest-values" class="section">
        <div class="container">

            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between mb-5 gap-3"
                data-aos="fade-up">
                <div>
                    <span class="services-snippet-tag">
                        @translate('Our Core Values', 'about', 'quest.title_tag')
                    </span>
                    <h2 class="services-snippet-title mt-3 mb-0">
                        @translate('Our QUEST for the', 'about', 'quest.title')
                        <em>@translate('Perfect Cup', 'about', 'quest.title_em')</em>
                    </h2>
                    <p class="services-snippet-subtitle mt-3 mb-0">
                        @translate('The values that drive everything we do across sourcing, processing, and export.', 'about', 'quest.subtitle')
                    </p>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $questItems = [
                        [
                            'letter' => 'Q',
                            'icon' => 'bi-award',
                            'title' => 'Quality Excellence',
                            'title_key' => 'quest.q_title',
                            'desc' => 'Rigorous quality control from farm selection to final export.',
                            'desc_key' => 'quest.q_desc',
                        ],
                        [
                            'letter' => 'U',
                            'icon' => 'bi-shield-check',
                            'title' => 'Uncompromising Integrity',
                            'title_key' => 'quest.u_title',
                            'desc' => 'Transparency and fairness in every partnership.',
                            'desc_key' => 'quest.u_desc',
                        ],
                        [
                            'letter' => 'E',
                            'icon' => 'bi-file-earmark-check',
                            'title' => 'Enduring Commitment',
                            'title_key' => 'quest.e_title',
                            'desc' => 'Long-term partnership dedication and consistent quality.',
                            'desc_key' => 'quest.e_desc',
                        ],
                        [
                            'letter' => 'S',
                            'icon' => 'bi-tree',
                            'title' => 'Sustainable Practices',
                            'title_key' => 'quest.s_title',
                            'desc' => 'Environmentally responsible farming for future generations.',
                            'desc_key' => 'quest.s_desc',
                        ],
                        [
                            'letter' => 'T',
                            'icon' => 'bi-cpu',
                            'title' => 'Technology & Innovation',
                            'title_key' => 'quest.t_title',
                            'desc' => 'Modern processing backed by reliable production systems.',
                            'desc_key' => 'quest.t_desc',
                        ],
                        [
                            'letter' => '+',
                            'icon' => 'bi-globe',
                            'title' => 'Global Export Ready',
                            'title_key' => 'quest.plus_title',
                            'desc' => 'Structured shipment process for international buyers.',
                            'desc_key' => 'quest.plus_desc',
                        ],
                    ];
                @endphp

                @foreach ($questItems as $item)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article class="quest-card">
                            <div class="quest-card-body">
                                <span class="quest-card-badge">{{ $item['letter'] }}</span>
                                <div class="quest-card-icon">
                                    <i class="bi {{ $item['icon'] }}" style="font-size:1.5rem;"></i>
                                </div>
                                <h3 class="quest-card-title">
                                    @translate($item['title'], 'about', $item['title_key'])
                                </h3>
                                <p class="quest-card-desc">
                                    @translate($item['desc'], 'about', $item['desc_key'])
                                </p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ── CTA Strip ── --}}
    <div class="footer-cta">
        <div class="container">
            <div class="footer-cta-inner" data-aos="fade-up">
                <div>
                    <h3 class="footer-cta-title">
                        @translate('Ready to Start a Partnership?', 'about', 'cta.title')
                    </h3>
                    <p class="footer-cta-desc">
                        @translate('Contact our export team and let\'s discuss your coffee sourcing needs.', 'about', 'cta.desc')
                    </p>
                </div>
                <a href="{{ route('contact.index') }}" class="btn-footer-cta">
                    @translate('Get in Touch', 'about', 'cta.btn')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- ── Video Thumbnail Script ── --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const thumb = document.getElementById('videoThumb');
            const video = document.getElementById('heritageVideo');
            const playBtn = document.getElementById('videoPlayBtn');
            const canvas = document.getElementById('videoThumbnail');
            const ctx = canvas.getContext('2d');

            // Seek ke detik ke-3 setelah metadata siap
            video.addEventListener('loadedmetadata', function() {
                video.currentTime = 3; // ← ganti angka sesuai frame terbaik videomu
            });

            // Render frame ke canvas setelah seek selesai
            video.addEventListener('seeked', function() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                video.currentTime = 0; // reset ke awal
            });

            // Klik play: sembunyikan thumbnail, tampilkan & mainkan video
            playBtn.addEventListener('click', function() {
                thumb.style.display = 'none';
                video.style.display = 'block';
                video.currentTime = 0;
                video.play();
            });
        });
    </script>

@endsection
