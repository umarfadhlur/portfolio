@extends('layouts.app')

@section('title', 'Portfolio')

@section('body-class', 'portfolio-page')

@section('content')
    <main class="main">

        <style>
            /* -- NAVBAR FIX ------------------------------------------------------
                           Memaksa header/navbar berada di atas (fixed) dan memberi ruang
                           pada <main> agar konten tidak tertutup. Sesuaikan --header-h.
                        -------------------------------------------------------------------*/
            :root {
                --header-h: 72px;
            }

            header,
            nav,
            .navbar,
            .site-header {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 9999 !important;
                background: rgba(10, 15, 18, 0.92) !important;
                /* semi-transparan agar tetap gelap */
                backdrop-filter: blur(4px);
            }

            /* beri ruang pada main agar tidak tertutup navbar */
            main.main {
                padding-top: var(--header-h);
            }

            /* kecilkan margin top section-title jika ada */
            .container.section-title {
                margin-top: 6px !important;
                padding-top: 18px;
            }

            /* stylistic / existing card rules (tetap ada) */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap');

            /* Layout container */
            @extends('layouts.app') @section('title', 'Portfolio') @section('body-class', 'portfolio-page') @section('content') <main class="main"><section id="portfolio" class="portfolio section">< !-- Section Title --><div class="container section-title" data-aos="fade-up"><h2>Portfolio</h2><p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam</p></div>< !-- End Section Title --><div class="container" data-aos="fade-up" data-aos-delay="100"><div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order"><ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200"><li data-filter="*" class="filter-active">All</li><li data-filter=".filter-strategy">Strategy</li><li data-filter=".filter-finance">Finance</li><li data-filter=".filter-operations">Operations</li><li data-filter=".filter-technology">Technology</li></ul>< !-- End Portfolio Filters --><div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">@php
                // helper: safely parse arrays from JSON/CSV/string
                if (!function_exists('blade_safe_array')) {
                    function blade_safe_array($value)
                    {
                        if (is_array($value)) {
                            return $value;
                        }
                        if (is_string($value)) {
                            $decoded = json_decode($value, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                return $decoded;
                            }
                            return array_filter(array_map('trim', explode(',', $value)));
                        }
                        return [];
                    }
                }
            @endphp @forelse ($portfolios as $p)@php
                // derive tag/category list (try common fields)
                $tags = blade_safe_array($p->tags ?? ($p->categories ?? ($p->portfolio_tags ?? [])));

                // fallback to tech stack if no tags
                if (empty($tags)) {
                    $tags = blade_safe_array($p->tech_stack ?? []);
                }

                // map tags to static filter classes used by the template
                $categoryClasses = [];
                foreach ($tags as $t) {
                    if (stripos($t, 'strategy') !== false) {
                        $categoryClasses[] = 'filter-strategy';
                    } elseif (stripos($t, 'finance') !== false) {
                        $categoryClasses[] = 'filter-finance';
                    } elseif (stripos($t, 'operation') !== false) {
                        $categoryClasses[] = 'filter-operations';
                    } elseif (stripos($t, 'tech') !== false || stripos($t, 'technology') !== false) {
                        $categoryClasses[] = 'filter-technology';
                    }
                }

                // default to technology if nothing matched
                $categoryClass = count($categoryClasses)
                    ? implode(' ', array_unique($categoryClasses))
                    : 'filter-technology';

                $photo = $p->photos->first();
                $image = $photo ? Storage::url($photo->image_path) : asset('assets/img/portfolio/portfolio-1.webp');
            @endphp <div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ $categoryClass }}"><div class="portfolio-card"><div class="portfolio-img"><img src="{{ $image }}" alt="Portfolio Item" class="img-fluid"><div class="portfolio-overlay">@if ($photo)<a href="{{ Storage::url($photo->image_path) }}" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>@else <a href="{{ asset('assets/img/portfolio/portfolio-1.webp') }}" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>@endif<a href="{{ route('portfolio.show', $p->slug) }}" class="portfolio-details-link"><i class="bi bi-link"></i></a></div></div><div class="portfolio-info"><h4>{{ $p->portfolio_name }}</h4><p>{{ $p->subtitle ?? Str::limit($p->description, 80) }}</p><div class="portfolio-tags">@foreach ($tags as $t)<span>{{ $t }}</span>@endforeach</div></div></div></div>@empty <div class="col-12 text-center"><p class="text-muted">No projects available at the moment.</p></div>@endforelse</div>< !-- End Portfolio Items Container --></div><div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400"><a href="#portfolio" class="btn btn-primary">View All Case Studies</a></div></div></section>< !-- /Portfolio Section --></main><script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Ensure Isotope re-layout after images are loaded
                    if (window.Isotope) {
                        const grid = document.querySelector('.isotope-container');
                        if (grid) {
                            const iso = window.Isotope.data ? window.Isotope.data(grid) : null;
                            const imgs = grid.querySelectorAll('img');
                            let loaded = 0;
                            if (imgs.length === 0) {
                                iso && iso.layout();
                            } else {
                                imgs.forEach(img => {
                                    if (img.complete) {
                                        loaded++;
                                    } else {
                                        img.addEventListener('load', () => {
                                            loaded++;
                                            if (loaded === imgs.length) iso && iso.layout();
                                        });
                                        img.addEventListener('error', () => {
                                            loaded++;
                                            if (loaded === imgs.length) iso && iso.layout();
                                        });
                                    }
                                });
                                if (loaded === imgs.length) iso && iso.layout();
                            }
                        }
                    }
                });
            </script>@endsection $techs =array_map('trim', $techs);
