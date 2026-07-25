@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Contact Umar Fadhlurrachman for Mobile Engineer, Flutter Developer, Laravel, and enterprise application opportunities.')
@section('body-class', 'contact-page')

@section('content')
    <section class="page-hero contact-hero">
        <div class="shell contact-hero-grid">
            <div class="reveal">
                <p class="eyebrow">Contact</p>
                <h1>Let’s talk about the problem your team needs to solve.</h1>
                <p>I am open to full-time opportunities and selected software projects involving mobile products, backend integration, or enterprise workflows.</p>
            </div>

            <div class="contact-quick-links reveal reveal-delay-1">
                @if (config('site.email'))
                    <a href="mailto:{{ config('site.email') }}">
                        <span>Email</span>
                        <strong>{{ config('site.email') }}</strong>
                        <i>↗</i>
                    </a>
                @endif
                @if (config('site.social.linkedin'))
                    <a href="{{ config('site.social.linkedin') }}" target="_blank" rel="noopener noreferrer">
                        <span>LinkedIn</span>
                        <strong>Connect professionally</strong>
                        <i>↗</i>
                    </a>
                @endif
                @if (config('site.social.github'))
                    <a href="{{ config('site.social.github') }}" target="_blank" rel="noopener noreferrer">
                        <span>GitHub</span>
                        <strong>Review public code</strong>
                        <i>↗</i>
                    </a>
                @endif
                <div class="contact-location">
                    <span>Location</span>
                    <strong>Indonesia · GMT+7</strong>
                    <i>●</i>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-section section-space-small">
        <div class="shell contact-layout">
            <div class="contact-form-intro reveal">
                <span class="mono-label">SEND A MESSAGE</span>
                <h2>Share the role, product, or challenge.</h2>
                <p>A little context helps: team, position, expected responsibilities, technology, and preferred timeline.</p>

                <div class="response-note">
                    <span class="status-dot"></span>
                    <p>I review genuine professional messages personally.</p>
                </div>
            </div>

            <div class="contact-form-card reveal reveal-delay-1">
                @if (session('success'))
                    <div class="form-alert form-alert-success" role="status">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-alert form-alert-error" role="alert">
                        <strong>Please review the form:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" data-contact-form>
                    @csrf

                    <div class="form-grid">
                        <label class="form-field">
                            <span>Your name</span>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Jane Doe" autocomplete="name" required>
                            @error('name')<small>{{ $message }}</small>@enderror
                        </label>

                        <label class="form-field">
                            <span>Email address</span>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="jane@company.com" autocomplete="email" required>
                            @error('email')<small>{{ $message }}</small>@enderror
                        </label>

                        <label class="form-field form-field-full">
                            <span>Subject</span>
                            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Mobile Engineer opportunity" required>
                            @error('subject')<small>{{ $message }}</small>@enderror
                        </label>

                        <label class="form-field form-field-full">
                            <span>Message</span>
                            <textarea name="message" rows="7" placeholder="Tell me about the role, project, or challenge..." required>{{ old('message') }}</textarea>
                            @error('message')<small>{{ $message }}</small>@enderror
                        </label>
                    </div>

                    <div class="form-footer">
                        <p>By sending this form, you agree to be contacted about this inquiry.</p>
                        <button type="submit" class="button button-primary" data-submit-button>
                            <span data-submit-label>Send message</span>
                            <span class="button-loader" aria-hidden="true"></span>
                            <span aria-hidden="true">↗</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
