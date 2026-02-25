@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets/img/page-title-bg.jpg') }}');">
        <div class="container position-relative">
            <h1>Blog</h1>
            <p>Berita dan informasi terbaru seputar dunia pertanian dan ekspor.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Blog</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section (Recent Posts Style) -->
    <section id="blog-posts" class="recent-posts section">
        
        <div class="container">
            <div class="row gy-5">
                @forelse ($posts as $post)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up"
                            data-aos-delay="{{ 100 + $loop->index * 100 }}">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/img/blog/blog-1.jpg') }}"
                                    class="img-fluid" alt="{{ $post->title }}">
                                <span class="post-date">{{ $post->published_at->format('F d') }}</span>
                            </div>
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        <span class="ps-2">{{ $post->user->name ?? 'Admin' }}</span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i>
                                        <span class="ps-2">{{ $post->category ?? 'News' }}</span>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('blog.show', $post->slug) }}" class="readmore stretched-link">
                                    <span>Read More</span><i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End post item -->
                @empty
                    <div class="col-12">
                        <p class="text-center">Belum ada post. <a href="{{ route('filament.admin.posts.create') }}">Buat
                                sekarang!</a></p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if ($posts->hasPages())
            <div class="container mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </section><!-- /Blog Posts Section -->
@endsection
