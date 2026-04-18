{{-- resources/views/components/products-overview.blade.php --}}
{{-- Data: $products (collection) — field: name, slug, category, image, short_desc, origin, altitude, cupping_score, capacity --}}

<section id="products-overview" class="services section">
    <div class="container">

        <div class="section-title" data-aos="fade-up">
            <h2>Our Products</h2>
            <p>Specialty Coffee from The Heart of Java</p>
        </div>

        <div class="content">
            <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                @foreach ($products as $i => $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item h-100 d-flex flex-column">

                            {{-- Product Image --}}
                            @if ($product->thumbnail)
                                <div class="product-img" style="overflow:hidden; border-radius: 4px 4px 0 0;">
                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover; transition: transform 0.5s ease;">
                                </div>
                            @endif

                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                {{-- Category badge --}}
                                <span class="product-category text-uppercase"
                                    style="font-size: 12px; font-weight: 600; color: var(--accent-color); letter-spacing: 0.08em;">
                                    {{ $product->category ?? 'Coffee' }}
                                </span>

                                <h3 class="service-heading mt-2">{{ $product->name }}</h3>

                                <p class="flex-grow-1" style="font-size: 15px;">
                                    {{ $product->short_desc }}
                                </p>

                                {{-- Mini specs --}}
                                <div class="row g-2 mt-2 mb-3"
                                    style="border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%); padding-top: 12px;">
                                    @if ($product->origin)
                                        <div class="col-6">
                                            <small
                                                style="color: color-mix(in srgb, var(--default-color), transparent 50%); display:block; text-transform:uppercase; font-size:11px; letter-spacing:0.06em;">Origin</small>
                                            <strong style="font-size:13px;">{{ $product->origin }}</strong>
                                        </div>
                                    @endif
                                    @if ($product->cupping_score)
                                        <div class="col-6">
                                            <small
                                                style="color: color-mix(in srgb, var(--default-color), transparent 50%); display:block; text-transform:uppercase; font-size:11px; letter-spacing:0.06em;">Cupping
                                                Score</small>
                                            <strong style="font-size:13px;">{{ $product->cupping_score }}</strong>
                                        </div>
                                    @endif
                                    @if ($product->altitude)
                                        <div class="col-6">
                                            <small
                                                style="color: color-mix(in srgb, var(--default-color), transparent 50%); display:block; text-transform:uppercase; font-size:11px; letter-spacing:0.06em;">Altitude</small>
                                            <strong style="font-size:13px;">{{ $product->altitude }}</strong>
                                        </div>
                                    @endif
                                    @if ($product->capacity)
                                        <div class="col-6">
                                            <small
                                                style="color: color-mix(in srgb, var(--default-color), transparent 50%); display:block; text-transform:uppercase; font-size:11px; letter-spacing:0.06em;">Capacity</small>
                                            <strong style="font-size:13px;">{{ $product->capacity }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="d-flex align-items-center gap-1 mt-auto"
                                    style="font-weight: 600; color: var(--accent-color); font-size: 14px; text-decoration: none;">
                                    View Details
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Link to full products page --}}
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('products.index') }}" class="btn-get-started">
                    View All Products
                </a>
            </div>

        </div>
    </div>
</section>
