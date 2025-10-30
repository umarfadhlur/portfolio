@extends('layouts.app')

@section('title', 'Contact')

@section('body-class', 'contact-page')

@section('content')
    <main class="main">
        <section id="contact" class="contact section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-12">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">

                            {{-- ✅ Form Contact --}}
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf

                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" placeholder="Your Name"
                                            required value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email"
                                            required value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <input type="text" name="subject" class="form-control" placeholder="Subject"
                                            required value="{{ old('subject') }}">
                                        @error('subject')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <textarea name="message" rows="6" class="form-control" placeholder="Message" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- ✅ Notifikasi sukses/error --}}
                                    <div class="col-12 text-center mt-3">
                                        @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- ✅ Tombol Kirim --}}
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">
                                            <span class="btn-text">Send Message</span>
                                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                        </button>
                                    </div>

                                </div>
                            </form>

                            {{-- ✅ Loading animasi --}}
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const form = document.querySelector(".php-email-form");
                                    const submitBtn = document.getElementById("submit-btn");
                                    const btnText = submitBtn.querySelector(".btn-text");
                                    const spinner = submitBtn.querySelector(".spinner-border");

                                    form.addEventListener("submit", function() {
                                        btnText.textContent = "Sending...";
                                        spinner.classList.remove("d-none");
                                        submitBtn.disabled = true;
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
