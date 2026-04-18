@extends('layouts.app')

@section('title', 'Blog')
@section('meta_description', 'Read the latest news, insights, and stories about Indonesian specialty coffee, farming
    practices, and export updates from CV. Banyumas Bonanza Indonesia.')
@section('og_title', 'Blog')
@section('og_description', 'Read the latest news, insights, and stories about Indonesian specialty coffee, farming
    practices, and export updates from CV. Banyumas Bonanza Indonesia.')
@section('og_image', asset('assets/img/coffee/coffee.jpeg'))
@section('og_url', route('blog.index'))
@section('og_type', 'website')

@section('content')
    <section id="blog" class="blog-snippet py-5 light-background">
        <div class="container">

            {{-- Header --}}
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between mb-5 gap-3"
                data-aos="fade-up">
                <div>
                    <span class="blog-snippet-tag">
                        @translate('Our Stories', 'blog', 'blog.tag')
                    </span>
                    <h2 class="blog-snippet-title mt-3 mb-0">
                        @translate('Coffee Insights &', 'blog', 'blog.title')
                        <em>@translate('Field Notes', 'blog', 'blog.title_em')</em>
                    </h2>
                    <p class="blog-snippet-subtitle mt-2 mb-0" style="max-width:52ch; color:#7a6e62; line-height:1.8;">
                        @translate('Stories, tips, and updates from our farms and export journey in Central Java.', 'blog', 'blog.subtitle')
                    </p>
                </div>
            </div>

            {{-- Grid --}}
            <div class="row g-4">
                @forelse ($posts as $post)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article class="blog-card">

                            {{-- Thumbnail --}}
                            <a href="{{ url('blog/' . $post->slug) }}" class="blog-card-img-wrap" tabindex="-1"
                                aria-hidden="true">
                                <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/img/blog/blog-placeholder.jpg') }}"
                                    alt="{{ $post->title }}" class="blog-card-img" loading="lazy" decoding="async">

                                {{-- Date badge --}}
                                @if ($post->published_at)
                                    <div class="blog-card-date">
                                        <span class="blog-card-date-day">{{ $post->published_at->format('d') }}</span>
                                        <span class="blog-card-date-month">{{ $post->published_at->format('M') }}</span>
                                    </div>
                                @endif
                            </a>

                            {{-- Body --}}
                            <div class="blog-card-body">

                                {{-- Meta --}}
                                <div class="blog-card-meta">
                                    <span>
                                        <i class="bi bi-person"></i>
                                        {{ $post->user->name ?? 'Admin' }}
                                    </span>
                                    <span class="blog-card-meta-divider">·</span>
                                    <span>
                                        <i class="bi bi-folder2"></i>
                                        {{ $post->category->name ?? 'News' }}
                                    </span>
                                </div>

                                {{-- Title --}}
                                <h3 class="blog-card-title">
                                    <a href="{{ url('blog/' . $post->slug) }}">{{ $post->title }}</a>
                                </h3>

                                {{-- Excerpt --}}
                                @if ($post->excerpt ?? ($post->short_description ?? null))
                                    <p class="blog-card-excerpt">
                                        {{ Str::limit($post->excerpt ?? $post->short_description, 90) }}
                                    </p>
                                @endif

                                {{-- Read More --}}
                                <a href="{{ url('blog/' . $post->slug) }}" class="blog-card-readmore">
                                    @translate('Read More', 'home', 'blog.read_more')
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>

                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        @translate('No posts available yet.', 'home', 'blog.empty')
                    </div>
                @endforelse
            </div>

        </div>
    </section>
    <div class="footer-cta">
        <div class="container">
            <div class="footer-cta-inner" data-aos="fade-up">
                <div>
                    <h3 class="footer-cta-title">
                        @translate('Want to Know More About Our Coffee?', 'blog', 'cta.title')
                    </h3>
                    <p class="footer-cta-desc">
                        @translate('Get in touch and we\'ll answer all your questions about sourcing Indonesian specialty coffee.', 'blog', 'cta.desc')
                    </p>
                </div>
                <a href="{{ url('/contact') }}" class="btn-footer-cta">
                    @translate('Talk to Us', 'blog', 'cta.btn')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection
