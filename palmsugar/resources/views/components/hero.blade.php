<section id="hero" class="hero section dark-background">

    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <!-- Loop Data dari Database -->
        @foreach ($sliders as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->headline }}">

                <div class="carousel-container">
                    <h2>{{ $slide->headline }}</h2>

                    @if ($slide->subheadline)
                        <p>{{ $slide->subheadline }}</p>
                    @endif

                    @if ($slide->cta_text && $slide->cta_url)
                        <a href="{{ $slide->cta_url }}" class="btn-get-started animate__animated animate__fadeInUp">
                            {{ $slide->cta_text }}
                        </a>
                    @endif
                </div>

            </div>
        @endforeach

        <!-- Navigasi Panah Kiri -->
        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <!-- Navigasi Panah Kanan -->
        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <!-- Kosongkan, biar JS hitung otomatis dari jumlah .carousel-item -->
        <ol class="carousel-indicators"></ol>

    </div>

</section>
