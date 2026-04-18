@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->body), 160))
@section('og_title', $post->title)
@section('og_description', $post->excerpt ?? Str::limit(strip_tags($post->body), 160))
@section('og_image', $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/img/coffee/coffee.jpeg'))
@section('og_url', route('blog.show', $post->slug))
@section('og_type', 'article')

@section('content')
    <section class="blog-detail-page py-5 light-background">
        <div class="container">
            <div class="row g-5">

                {{-- MAIN CONTENT --}}
                <div class="col-lg-8">

                    {{-- Article --}}
                    <article>
                        {{-- Hero Image --}}
                        @if ($post->thumbnail)
                            <div class="blog-post-hero">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" loading="eager"
                                    decoding="async">
                            </div>
                        @endif

                        {{-- Title --}}
                        <h1 class="blog-post-title">{{ $post->title }}</h1>

                        {{-- Meta --}}
                        <div class="blog-post-meta">
                            <span>
                                <i class="bi bi-person"></i>
                                {{ $post->user->name ?? 'Admin' }}
                            </span>
                            <span class="blog-post-meta-divider">·</span>
                            <span>
                                <i class="bi bi-calendar3"></i>
                                <time datetime="{{ $post->published_at }}">
                                    {{ $post->published_at->format('M d, Y') }}
                                </time>
                            </span>
                            <span class="blog-post-meta-divider">·</span>
                            <span>
                                <i class="bi bi-folder2"></i>
                                {{ $post->category->name ?? 'News' }}
                            </span>
                            <span class="blog-post-meta-divider">·</span>
                            <span>
                                <i class="bi bi-chat-dots"></i>
                                {{ $post->comments()->where('is_approved', true)->count() }} Comments
                            </span>
                        </div>

                        {{-- Content --}}
                        <div class="blog-post-content">
                            {!! $post->content !!}
                        </div>
                    </article>

                    {{-- Comments --}}
                    <div class="blog-comments-section">
                        <h2 class="blog-comments-title">
                            {{ $post->comments()->where('is_approved', true)->count() }} Comments
                        </h2>

                        @forelse ($post->comments()->where('is_approved', true)->get() as $comment)
                            <div id="comment-{{ $comment->id }}" class="comment-item">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->name) }}&background=e4d7c8&color=5c3b1e&size=48"
                                    alt="{{ $comment->name }}" class="comment-avatar">
                                <div class="flex-grow-1">
                                    <div class="comment-author">{{ $comment->name }}</div>
                                    <time class="comment-date" datetime="{{ $comment->created_at }}">
                                        {{ $comment->created_at->format('d M, Y') }}
                                    </time>
                                    <p class="comment-text">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @empty
                            <p style="color:#a08060; font-size:0.9rem;">
                                No comments yet. Be the first to share your thoughts!
                            </p>
                        @endforelse
                    </div>

                    {{-- Comment Form --}}
                    <div class="comment-form-section">
                        <h2 class="comment-form-title">Leave a Comment</h2>
                        <p class="comment-form-note">
                            Your email address will not be published. Required fields are marked *
                        </p>

                        <div id="commentAlert" style="display:none; margin-bottom:1rem;"></div>

                        <form id="commentForm" action="{{ route('blog.comment.store', $post->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="comment-form-input"
                                        placeholder="Your Name *" required maxlength="100">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="comment-form-input"
                                        placeholder="Your Email *" required maxlength="100">
                                </div>
                                <div class="col-12">
                                    <textarea name="content" class="comment-form-input comment-form-textarea" placeholder="Write your comment here... *"
                                        required maxlength="1000" rows="5"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-comment-submit" id="commentSubmitBtn">
                                        <span id="btnText">
                                            <i class="bi bi-send"></i>
                                            Post Comment
                                        </span>
                                        <span id="btnLoad" style="display:none;">
                                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                            Posting...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="col-lg-4">
                    <aside class="blog-sidebar">

                        {{-- Search --}}
                        <div class="sidebar-widget">
                            <h3 class="sidebar-widget-title">Search</h3>
                            <form action="{{ url('blog') }}" method="GET">
                                <div class="sidebar-search">
                                    <input type="text" name="search" class="sidebar-search-input"
                                        placeholder="Search posts..." value="{{ request('search') }}">
                                    <button type="submit" class="sidebar-search-btn" aria-label="Search">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Recent Posts --}}
                        <div class="sidebar-widget">
                            <h3 class="sidebar-widget-title">Recent Posts</h3>
                            @foreach (\App\Models\Post::published()->latest()->limit(5)->get() as $recent)
                                <div class="sidebar-recent-item">
                                    <img src="{{ $recent->thumbnail ? asset('storage/' . $recent->thumbnail) : asset('assets/img/blog/blog-placeholder.jpg') }}"
                                        alt="{{ $recent->title }}" class="sidebar-recent-img" loading="lazy">
                                    <div>
                                        <a href="{{ route('blog.show', $recent->slug) }}" class="sidebar-recent-title">
                                            {{ Str::limit($recent->title, 55) }}
                                        </a>
                                        <time class="sidebar-recent-date" datetime="{{ $recent->published_at }}">
                                            {{ $recent->published_at->format('M d, Y') }}
                                        </time>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </aside>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA Strip --}}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('commentForm');
            const submitBtn = document.getElementById('commentSubmitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoad = document.getElementById('btnLoad');
            const alertEl = document.getElementById('commentAlert');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoad.style.display = 'inline-flex';
                alertEl.style.display = 'none';

                const formData = new FormData(form);

                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData,
                    });

                    const data = await res.json();

                    if (data.success) {
                        form.reset();
                        showAlert(
                            'Your comment has been submitted and is awaiting approval. Thank you!',
                            'success');
                    } else {
                        showAlert(data.message || 'Something went wrong. Please try again.', 'error');
                    }
                } catch (err) {
                    showAlert('Network error. Please check your connection and try again.', 'error');
                } finally {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline-flex';
                    btnLoad.style.display = 'none';
                }
            });

            function showAlert(message, type) {
                alertEl.textContent = message;
                alertEl.className = type === 'success' ? 'contact-alert success' : 'contact-alert error';
                alertEl.style.display = 'block';
                setTimeout(() => alertEl.style.display = 'none', 6000);
            }
        });
    </script>
@endsection
