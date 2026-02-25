@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <div class="post-img">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                    class="img-fluid">
                            </div>

                            <h2 class="title">{{ $post->title }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="#">{{ $post->user->name ?? 'Admin' }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="#"><time
                                                datetime="{{ $post->published_at }}">{{ $post->published_at->format('M d, Y') }}</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="#">{{ $post->comments()->where('is_approved', true)->count() }}
                                            Comments</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                {!! $post->content !!} <!-- Render HTML dari Rich Editor -->
                            </div><!-- End post content -->

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->

                <!-- Blog Comments Section -->
                <section id="blog-comments" class="blog-comments section">
                    <div class="container">

                        <h4 class="comments-count">{{ $post->comments()->where('is_approved', true)->count() }} Comments
                        </h4>

                        @foreach ($post->comments as $comment)
                            <div id="comment-{{ $comment->id }}" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img">
                                        <!-- Avatar (Bisa pakai Gravatar atau placeholder template) -->
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->name) }}&background=random"
                                            alt="{{ $comment->name }}">
                                    </div>
                                    <div>
                                        <h5>
                                            <a href="#">{{ $comment->name }}</a>
                                            <!-- Tombol Reply (Nanti bisa dikembangkan pakai JS) -->
                                            {{-- <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a> --}}
                                        </h5>
                                        <time
                                            datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('d M, Y') }}</time>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div><!-- End comment #{{ $comment->id }} -->
                        @endforeach

                    </div>
                </section>
                <!-- /Blog Comments Section -->

                <!-- Comment Form Section -->
                <section id="comment-form" class="comment-form section">
                    <div class="container">
                        <form id="commentForm" action="{{ route('blog.comment.store', $post->slug) }}" method="POST"
                            class="comment-form-inner">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <h4>Post Comment</h4>
                            <p>Your email address will not be published. Required fields are marked *</p>

                            <!-- Alert Messages -->
                            <div id="formAlert" class="alert" style="display: none;"></div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input name="name" type="text" class="form-control" placeholder="Your Name*"
                                        required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="email" type="email" class="form-control" placeholder="Your Email*"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="5" placeholder="Your Comment*" required></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Post Comment</button>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- /Comment Form Section -->

            </div>

            <!-- Sidebar (Optional) -->
            <div class="col-lg-4 sidebar">
                <div class="widgets-container">

                    <!-- Search Widget -->
                    <div class="search-widget widget-item">
                        <h3 class="widget-title">Search</h3>
                        <form action="">
                            <input type="text" name="search">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!--/Search Widget -->

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">
                        <h3 class="widget-title">Recent Posts</h3>
                        @foreach (\App\Models\Post::latest()->limit(5)->get() as $recent)
                            <div class="post-item">
                                <img src="{{ asset('storage/' . $recent->thumbnail) }}" alt=""
                                    class="flex-shrink-0">
                                <div>
                                    <h4><a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->title }}</a></h4>
                                    <time
                                        datetime="{{ $recent->published_at }}">{{ $recent->published_at->format('M d, Y') }}</time>
                                </div>
                            </div><!-- End recent post item-->
                        @endforeach
                    </div><!--/Recent Posts Widget -->

                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('commentForm');
            const submitBtn = document.getElementById('submitBtn');
            const formAlert = document.getElementById('formAlert');
            const commentsSection = document.querySelector('#blog-comments .container');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Posting...';

                try {
                    console.log('Submitting to:', form.action); // Debug

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData // FormData auto include @csrf field
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        form.reset();
                        showAlert('Comment submitted for approval!', 'success');
                        // appendNewComment(data.comment);
                        // updateCommentCount(data.comment_count);
                    } else {
                        showAlert(data.message || 'Error occurred', 'error');
                    }
                } catch (error) {
                    console.error('AJAX Error:', error);
                    showAlert('Network error. Please try again.', 'error');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Post Comment';
                }
            });

            function showAlert(message, type) {
                formAlert.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
                formAlert.textContent = message;
                formAlert.style.display = 'block';
                setTimeout(() => formAlert.style.display = 'none', 5000);
            }

            function appendNewComment(comment) {
                const commentHTML = `
            <div id="comment-${comment.id}" class="comment">
                <div class="d-flex">
                    <div class="comment-img">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(comment.name)}&background=random&size=48" alt="${comment.name}" class="rounded-circle">
                    </div>
                    <div>
                        <h5><a href="#" class="text-decoration-none">${comment.name}</a> <small class="text-muted">(Awaiting approval)</small></h5>
                        <time datetime="${comment.created_at}">${new Date(comment.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric', month: 'short', year: 'numeric'
                        })}</time>
                        <p>${comment.content}</p>
                    </div>
                </div>
            </div>
        `;

                const firstComment = commentsSection.querySelector('.comment');
                if (firstComment) {
                    firstComment.insertAdjacentHTML('beforebegin', commentHTML);
                } else {
                    const h4 = commentsSection.querySelector('h4');
                    h4.insertAdjacentHTML('afterend', commentHTML);
                }
            }

            function updateCommentCount(count) {
                const countElements = document.querySelectorAll('.comments-count, .meta-top li:last-child a');
                countElements.forEach(el => {
                    el.textContent = `${count} Comment${count !== 1 ? 's' : ''}`;
                });
            }
        });
    </script>
@endsection
