{{-- resources/views/components/home/products.blade.php --}}

<section id="products" class="products-snippet py-5">
    <div class="container">

        {{-- Header --}}
        <div class="products-snippet-header text-center mb-5" data-aos="fade-up">
            <span class="products-snippet-tag">
                @translate('What We Offer', 'home', 'products.tag')
            </span>
            <h2 class="products-snippet-title mt-3">
                @translate('Our', 'home', 'products.title')
                <em>@translate('Products', 'home', 'products.title_em')</em>
            </h2>
            <p class="products-snippet-subtitle mx-auto mt-3">
                @translate('Premium Indonesian specialty products — traceable, natural, and export-ready.', 'home', 'products.subtitle')
            </p>
        </div>

        {{-- Grid --}}
        <div class="row g-4 justify-content-center">
            @forelse ($featuredProducts as $product)
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('products.show', $product->slug) }}" class="product-card">

                        {{-- Thumbnail --}}
                        <div class="product-card-img-wrap">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="product-card-img" loading="lazy" decoding="async">
                            @else
                                <div class="product-card-img-placeholder">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="product-card-body">

                            {{-- Category badge --}}
                            @if ($product->category)
                                <span class="product-card-category">{{ $product->category }}</span>
                            @endif

                            <h3 class="product-card-name">{{ $product->name }}</h3>

                            {{-- Nutrition highlights (max 2 items) --}}
                            <ul class="product-card-specs">
                                @if ($product->calories)
                                    <li>
                                        <span class="spec-key">Calories</span>
                                        <span class="spec-val">{{ $product->calories }} kcal</span>
                                    </li>
                                @endif
                                @if ($product->protein)
                                    <li>
                                        <span class="spec-key">Protein</span>
                                        <span class="spec-val">{{ $product->protein }}g</span>
                                    </li>
                                @endif
                            </ul>

                            {{-- Certifications --}}
                            @if ($product->certifications)
                                <div class="product-card-certs">
                                    @foreach (array_slice((array) $product->certifications, 0, 2) as $cert)
                                        <span class="product-cert-tag">
                                            <i class="bi bi-patch-check-fill me-1"></i>{{ $cert }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="product-card-cta">
                                @translate('View Details', 'home', 'products.cta')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </div>

                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    @translate('No featured products yet.', 'home', 'products.empty')
                </div>
            @endforelse
        </div>

        {{-- View All --}}
        @if ($featuredProducts->isNotEmpty())
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('products.index') }}" class="btn-view-all">
                    @translate('View All Products', 'home', 'products.view_all')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @endif

    </div>
</section>
