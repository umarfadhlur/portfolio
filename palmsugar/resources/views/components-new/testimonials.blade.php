{{-- resources/views/components/home/testimonials-snippet.blade.php --}}

@php
    $testimonials = [
        [
            'name' => 'Ahmad Fauzi',
            'company' => 'PT. Nusantara Trading Co.',
            'country' => 'Indonesia',
            'flag' => '🇮🇩',
            'avatar' => null,
            'rating' => 5,
            'message' =>
                'Kualitas kopi Arabica dari Java Slamet benar-benar luar biasa. Aroma dan cita rasanya konsisten di setiap shipment. Mitra terpercaya untuk bisnis kami.',
        ],
        [
            'name' => 'Hiroshi Tanaka',
            'company' => 'Tanaka Coffee Import',
            'country' => 'Japan',
            'flag' => '🇯🇵',
            'avatar' => null,
            'rating' => 5,
            'message' =>
                'We have been importing Java Slamet Robusta for 2 years. The quality is always excellent and the export documentation is always complete and on time.',
        ],
        [
            'name' => 'Mohammed Al-Rashid',
            'company' => 'Al-Rashid Commodities LLC',
            'country' => 'UAE',
            'flag' => '🇦🇪',
            'avatar' => null,
            'rating' => 5,
            'message' =>
                'Outstanding product quality and very professional team. Their traceable sourcing process gives us full confidence in every order we place.',
        ],
    ];
@endphp

<section id="testimonials" class="testimonials-snippet py-5">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="testimonials-tag">
                @translate('What Clients Say', 'home', 'testimonials.tag')
            </span>
            <h2 class="testimonials-title mt-3">
                @translate('Trusted by', 'home', 'testimonials.title')
                <em>@translate('Buyers Worldwide', 'home', 'testimonials.title_em')</em>
            </h2>
            <p class="testimonials-subtitle mx-auto mt-3">
                @translate('Our partners across Asia, the Middle East, and beyond share their experience working with us.', 'home', 'testimonials.subtitle')
            </p>
        </div>

        {{-- Cards --}}
        <div class="row g-4 justify-content-center">
            @foreach ($testimonials as $i => $t)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="testimonial-card">

                        {{-- Quote icon --}}
                        <div class="testimonial-quote-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#c26a2a" opacity="0.2"
                                aria-hidden="true">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>

                        {{-- Stars --}}
                        <div class="testimonial-stars mb-3">
                            @for ($s = 0; $s < $t['rating']; $s++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>

                        {{-- Message --}}
                        <p class="testimonial-message">"{{ $t['message'] }}"</p>

                        {{-- Author --}}
                        <div class="testimonial-author mt-4">
                            <div class="testimonial-avatar">
                                @if ($t['avatar'])
                                    <img src="{{ asset('storage/' . $t['avatar']) }}" alt="{{ $t['name'] }}">
                                @else
                                    <span>{{ strtoupper(substr($t['name'], 0, 1)) }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="testimonial-name">{{ $t['name'] }}</div>
                                <div class="testimonial-company">{{ $t['company'] }} {{ $t['flag'] }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
