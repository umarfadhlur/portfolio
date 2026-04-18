{{-- resources/views/components/home/blog.blade.php --}}

@props(['posts' => collect()])

<section id="blog" class="blog-snippet py-5">
    <div class="container">

        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between mb-5 gap-3"
            data-aos="fade-up">
            <div>
                <span class="blog-snippet-tag">
                    @translate('Latest Updates', 'home', 'blog.tag')
                </span>
                <h2 class="blog-snippet-title mt-3 mb-0">
                    @translate('From Our', 'home', 'blog.title')
                    <em>@translate('Blog', 'home', 'blog.title_em')</em>
                </h2>
            </div>
            <a href="{{ url('blog') }}" class="btn-blog-all flex-shrink-0">
                @translate('All Posts', 'home', 'blog.all')
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
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
