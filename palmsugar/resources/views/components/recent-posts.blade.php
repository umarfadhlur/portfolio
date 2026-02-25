<!-- Recent Posts Section -->
<section id="recent-posts" class="recent-posts section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Recent Posts</h2>
        <p>Latest updates and news from our industry</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-5">

            @foreach ($posts as $post)
                <div class="col-xl-4 col-md-6">
                    <div class="post-item position-relative h-100" data-aos="fade-up"
                        data-aos-delay="{{ 100 + $loop->index * 100 }}">

                        <div class="post-img position-relative overflow-hidden">
                            <!-- Cek ada thumbnail gak, kalau gak ada pakai placeholder -->
                            <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/img/blog/blog-1.jpg') }}"
                                class="img-fluid" alt="{{ $post->title }}">

                            <!-- Tanggal Post -->
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
                                    <span class="ps-2">News</span> <!-- Bisa diganti Category kalau nanti ada -->
                                </div>
                            </div>

                            <hr>

                            <!-- Link ke Detail Post (Slug) -->
                            <a href="{{ url('blog/' . $post->slug) }}" class="readmore stretched-link">
                                <span>Read More</span><i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    </div>
                </div><!-- End post item -->
            @endforeach

        </div>

    </div>

</section>
<!-- /Recent Posts Section -->
