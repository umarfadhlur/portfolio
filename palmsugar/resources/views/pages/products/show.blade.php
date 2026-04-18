@extends('layouts.app')

@section('title', $product->name)
@section('og_title', $product->name)
@section('og_description', $product->short_description)
@section('og_image', asset($product->thumbnail ?? 'assets/img/coffee/coffee.jpeg'))
@section('og_url', route('products.show', $product->slug))

@section('content')

    @php $specs = $product->specifications ?? []; @endphp

    <section class="section light-background">
        <div class="container">
            <div class="row gy-5">

                {{-- ── LEFT: Image + Quick Specs ── --}}
                <div class="col-lg-5" data-aos="fade-right">

                    {{-- Main image --}}
                    <div class="product-detail-hero">
                        <img src="{{ asset($product->thumbnail ?? 'assets/img/products/default.jpg') }}"
                            alt="{{ $product->name }}" loading="eager" decoding="async">
                    </div>

                    {{-- Quick Specs Card --}}
                    <div class="product-specs-card">
                        <div class="product-specs-label">Quick Specifications</div>

                        @php
                            $quickSpecs = [
                                'category' => 'Category',
                                'origin' => 'Origin',
                                'altitude' => 'Altitude',
                                'process' => 'Process',
                                'screen_size' => 'Screen Size',
                                'moisture' => 'Moisture',
                                'defect_rate' => 'Defect Rate',
                                'annual_capacity' => 'Annual Capacity',
                                'min_order' => 'Min. Order',
                            ];
                        @endphp

                        <table class="product-specs-table">
                            @foreach ($quickSpecs as $key => $label)
                                @if (!empty($specs[$key]))
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>{{ $specs[$key] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>

                        {{-- Taste Notes --}}
                        @if (!empty($specs['taste_notes']))
                            <div class="mt-3">
                                <div class="product-specs-label mb-2">Taste Notes</div>
                                <div class="product-tag-list">
                                    @foreach ($specs['taste_notes'] as $note)
                                        <span class="product-taste-tag">{{ $note }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Certifications --}}
                        @if (!empty($specs['certifications']))
                            <div class="mt-3">
                                <div class="product-specs-label mb-2">Certifications & Documents</div>
                                <div class="product-tag-list">
                                    @foreach ($specs['certifications'] as $cert)
                                        <span class="product-cert-tag">
                                            <i class="bi bi-patch-check-fill me-1"></i>{{ $cert }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Packaging --}}
                        @if (!empty($specs['packaging']))
                            <div class="mt-3" style="font-size:0.85rem; color:#5a4535;">
                                <i class="bi bi-box-seam me-1" style="color:#c26a2a;"></i>
                                <strong>Packaging:</strong> {{ $specs['packaging'] }}
                            </div>
                        @endif
                    </div>

                    {{-- Brochure --}}
                    @if ($product->brochure_file)
                        <a href="{{ asset($product->brochure_file) }}" download class="product-brochure-btn">
                            <i class="bi bi-file-earmark-pdf-fill" style="font-size:1.1rem;"></i>
                            Download Product Brochure (PDF)
                        </a>
                    @endif

                </div>

                {{-- ── RIGHT: Description + Chart + CTA ── --}}
                <div class="col-lg-7" data-aos="fade-left">

                    {{-- Eyebrow + Title + Score --}}
                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                        <div>
                            <div class="product-detail-eyebrow">
                                {{ $specs['category'] ?? 'Coffee' }}
                                @if (!empty($specs['process']))
                                    · {{ $specs['process'] }}
                                @endif
                            </div>
                            <h1 class="product-detail-title">{{ $product->name }}</h1>
                        </div>
                        @if ($product->cupping_score)
                            <div class="text-end flex-shrink-0">
                                <div class="product-detail-score-value">{{ $product->cupping_score }}</div>
                                <div class="product-detail-score-label">Cupping Score</div>
                            </div>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div class="product-detail-desc mb-4">
                        {!! $product->description !!}
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="{{ route('contact.index') }}" class="btn-product-primary">
                            <i class="bi bi-envelope"></i>
                            Request a Sample
                        </a>
                        <a href="https://wa.me/6287851708758?text={{ urlencode('Hi, I am interested in ' . $product->name . '. Could you send me more details?') }}"
                            target="_blank" rel="noopener noreferrer" class="btn-product-wa">
                            <i class="bi bi-whatsapp"></i>
                            Inquire via WhatsApp
                        </a>
                    </div>

                    {{-- Flavor Profile Chart (Pure CSS) --}}
                    @if (!empty($product->flavor_profile))
                        <div class="flavor-profile-card">
                            <div class="flavor-profile-header">
                                <h4 class="flavor-profile-title">Flavor Profile</h4>
                                @if ($product->cupping_score)
                                    <span class="flavor-profile-total">
                                        Total Cupping Score:
                                        <strong>{{ $product->cupping_score }}</strong> / 100
                                    </span>
                                @endif
                            </div>

                            <div class="cupping-chart">
                                @foreach ($product->flavor_profile as $attr => $score)
                                    @php
                                        $score = (float) $score;
                                        $max = 10;
                                        $pct = round(($score / $max) * 100, 1);
                                        $high = $score >= 9;
                                    @endphp
                                    <div class="cupping-row">
                                        <div class="cupping-attr">{{ $attr }}</div>
                                        <div class="cupping-bar-wrap">
                                            <div class="cupping-bar {{ $high ? 'cupping-bar--high' : '' }}"
                                                style="--bar-pct: {{ $pct }}%" role="progressbar"
                                                aria-valuenow="{{ $score }}" aria-valuemin="0"
                                                aria-valuemax="{{ $max }}"
                                                aria-label="{{ $attr }}: {{ $score }}">
                                            </div>
                                        </div>
                                        <div class="cupping-score">{{ number_format($score, 2) }}</div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif

                </div>
            </div>

            {{-- ── Related Products ── --}}
            @if ($related->count() > 0)
                <div class="related-section">
                    <h3 class="related-title">Other Products You May Like</h3>
                    <div class="row g-4">
                        @foreach ($related as $rel)
                            @php $relSpecs = $rel->specifications ?? []; @endphp
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <a href="{{ route('products.show', $rel->slug) }}" class="related-card">
                                    <img src="{{ $rel->thumbnail ? asset($rel->thumbnail) : asset('assets/img/products/default.jpg') }}"
                                        alt="{{ $rel->name }}" class="related-card-img" loading="lazy">
                                    <div>
                                        <div class="related-card-eyebrow">
                                            {{ $relSpecs['category'] ?? 'Coffee' }}
                                            @if (!empty($rel->cupping_score))
                                                · {{ $rel->cupping_score }} pts
                                            @endif
                                        </div>
                                        <div class="related-card-name">{{ $rel->name }}</div>
                                        <div class="related-card-desc">
                                            {{ Str::limit($rel->short_description, 70) }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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
