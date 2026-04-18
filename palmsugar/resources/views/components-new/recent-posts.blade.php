{{-- resources/views/components/recent-posts.blade.php --}}
{{-- Data: $posts (collection, max 3) — field: title, slug, image, excerpt, category, created_at --}}

<section id="recent-posts" class="recent-posts section light-background">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Latest Articles</h2>
      <p>From Our Blog</p>
    </div>

    <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

      @foreach ($posts->take(3) as $post)
      <div class="col-lg-4 col-md-6">
        <article class="post-item">

          <div class="post-img" style="position: relative; overflow: hidden;">
            <img src="{{ asset($post->image ?? 'assets/img/blog/default.jpg') }}"
              alt="{{ $post->title }}"
              class="img-fluid"
              style="height: 220px; width: 100%; object-fit: cover;">
            <div class="post-date">
              <span>{{ $post->created_at->format('d') }}</span>
              {{ $post->created_at->format('M Y') }}
            </div>
          </div>

          <div class="post-content">
            @if ($post->category)
            <div class="meta mb-2">
              <span style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: var(--accent-color); font-weight: 600;">
                <i class="bi bi-tag-fill me-1"></i>{{ $post->category->name ?? $post->category }}
              </span>
            </div>
            @endif

            <h3 class="post-title">
              <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>

            <p style="font-size: 14px; color: color-mix(in srgb, var(--default-color), transparent 30%); line-height: 1.6;">
              {{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}
            </p>

            <hr>

            <a href="{{ route('blog.show', $post->slug) }}" class="readmore">
              Read More <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </article>
      </div>
      @endforeach

    </div>

    <div class="text-center mt-5" data-aos="fade-up">
      <a href="{{ route('blog.index') }}" class="btn-get-started">
        View All Articles
      </a>
    </div>

  </div>
</section>
