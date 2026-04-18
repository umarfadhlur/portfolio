@extends('layouts.app')

@section('title', 'Our Products')
@section('meta_description', 'Explore our range of premium Indonesian green coffee beans — Arabica and Robusta from
    Central Java. Specialty-grade, traceable origin, export-ready.')
@section('og_title', 'Our Products')
@section('og_description', 'Explore our range of premium Indonesian green coffee beans — Arabica and Robusta from
    Central Java. Specialty-grade, traceable origin, export-ready.')
@section('og_image', asset('assets/img/coffee/coffee.jpeg'))
@section('og_url', route('products.index'))
@section('og_type', 'website')

@section('content')


    {{-- Products Snippet --}}
    <section id="products" class="products-snippet section">
        <div class="container">

            {{-- Header snippet (tanpa CTA di kanan) --}}
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between mb-5 gap-3"
                data-aos="fade-up">
                <div class="flex-grow-1">
                    <span class="products-snippet-tag">
                        @translate('Our Products', 'products', 'products.tag')
                    </span>
                    <h2 class="products-snippet-title mt-3 mb-0">
                        @translate('Specialty Green Coffee Beans from', 'products', 'products.title')
                        <em>@translate('Central Java', 'products', 'products.title_em')</em>
                    </h2>
                    <p class="products-snippet-subtitle mt-3 mb-0">
                        @translate('Premium Indonesian Arabica and Robusta coffee, traceable by origin and ready for export.', 'products', 'products.subtitle')
                    </p>
                </div>
            </div>

            @php
                $categories = $products->groupBy(fn($p) => $p->specifications['category'] ?? 'Other');
            @endphp

            @foreach ($categories as $category => $items)
                <div class="mb-5" data-aos="fade-up">
                    {{-- Category heading --}}
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <h3 style="font-size: 1.15rem; margin: 0; color: var(--heading-color);">
                            {{ $category }} Coffee
                        </h3>
                        <div
                            style="flex: 1; height: 1px; background: color-mix(in srgb, var(--default-color), transparent 88%);">
                        </div>
                        <span style="font-size: 13px; color: color-mix(in srgb, var(--default-color), transparent 45%);">
                            {{ $items->count() }} {{ Str::plural('product', $items->count()) }}
                        </span>
                    </div>

                    <div class="row g-4">
                        @foreach ($items as $product)
                            @php $specs = $product->specifications ?? []; @endphp

                            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <article class="product-card h-100">
                                    <a href="{{ route('products.show', $product->slug) }}" class="product-card-img-wrap"
                                        tabindex="-1" aria-hidden="true">
                                        <img src="{{ asset($product->thumbnail ?? 'assets/img/products/default.jpg') }}"
                                            alt="{{ $product->name }}" class="product-card-img" loading="lazy"
                                            decoding="async">
                                    </a>

                                    <div class="product-card-body">
                                        <div class="product-card-meta">
                                            <span class="product-card-badge">
                                                {{ $product->category }}
                                            </span>

                                            @if ($product->cupping_score)
                                                <span class="product-card-score">
                                                    ☕ {{ $product->cupping_score }} pts
                                                </span>
                                            @endif
                                        </div>

                                        <h3 class="product-card-name">
                                            <a href="{{ route('products.show', $product->slug) }}"
                                                style="color:inherit; text-decoration:none;">
                                                {{ $product->name }}
                                            </a>
                                        </h3>

                                        <p class="product-card-desc">
                                            {{ $product->short_description }}
                                        </p>

                                        <ul class="product-card-specs">
                                            @if (!empty($specs['origin']))
                                                <li>
                                                    <span class="spec-key">Origin</span>
                                                    <span class="spec-val">{{ Str::limit($specs['origin'], 30) }}</span>
                                                </li>
                                            @endif
                                            @if (!empty($specs['altitude']))
                                                <li>
                                                    <span class="spec-key">Altitude</span>
                                                    <span class="spec-val">{{ $specs['altitude'] }}</span>
                                                </li>
                                            @endif
                                            @if (!empty($specs['process']))
                                                <li>
                                                    <span class="spec-key">Process</span>
                                                    <span class="spec-val">{{ $specs['process'] }}</span>
                                                </li>
                                            @endif
                                            @if (!empty($specs['annual_capacity']))
                                                <li>
                                                    <span class="spec-key">Capacity</span>
                                                    <span class="spec-val">{{ $specs['annual_capacity'] }}</span>
                                                </li>
                                            @endif
                                        </ul>

                                        @if (!empty($specs['taste_notes']))
                                            <div class="product-card-tags">
                                                @foreach ($specs['taste_notes'] as $note)
                                                    <span class="product-card-tag">{{ $note }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <a href="{{ route('products.show', $product->slug) }}" class="product-card-cta">
                                            View Full Details
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    {{-- CTA Strip --}}
    <div class="footer-cta">
        <div class="container">
            <div class="footer-cta-inner" data-aos="fade-up">
                <div>
                    <h3 class="footer-cta-title">
                        @translate('Interested in Our Coffee Products?', 'products', 'cta.title')
                    </h3>
                    <p class="footer-cta-desc">
                        @translate('Request a sample or get a competitive export quote from our team.', 'products', 'cta.desc')
                    </p>
                </div>
                <a href="{{ route('contact.index') }}" class="btn-footer-cta">
                    @translate('Request a Sample', 'products', 'cta.btn')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

@endsection
