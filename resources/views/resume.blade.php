@extends('layouts.app')

@section('title', 'Experience')
@section('meta_description', 'Professional experience and education of Umar Fadhlurrachman, Mobile Engineer and enterprise application developer.')
@section('body-class', 'resume-page')

@section('content')
    <section class="page-hero compact-page-hero">
        <div class="shell page-hero-grid">
            <div class="reveal">
                <p class="eyebrow">Experience</p>
                <h1>Software engineering grounded in production systems.</h1>
            </div>
            <div class="page-hero-copy reveal reveal-delay-1">
                <p>More than five years working across mobile development, backend services, enterprise integration, and operational software.</p>
                <a href="{{ route('contact') }}" class="text-link">Discuss an opportunity <span>↗</span></a>
            </div>
        </div>
    </section>

    <section class="resume-summary-section section-space-small">
        <div class="shell resume-summary-grid">
            <div class="resume-profile-card reveal">
                <img src="{{ asset('assets/img/profile/umarf.png') }}" alt="Umar Fadhlurrachman">
                <div>
                    <h2>Umar Fadhlurrachman</h2>
                    <p>Mobile Engineer · Software Developer</p>
                    <span>Indonesia · Open to opportunities</span>
                </div>
            </div>

            <div class="resume-summary-copy reveal reveal-delay-1">
                <span class="mono-label">PROFESSIONAL SUMMARY</span>
                <p>Mobile-focused software engineer experienced in building Flutter applications from scratch, integrating enterprise platforms, implementing Laravel and PHP services, and working with Oracle and SQL-backed business workflows.</p>
            </div>
        </div>
    </section>

    <section class="section-space resume-content-section">
        <div class="shell resume-columns">
            <div>
                @include('resume.section-experience')
            </div>
            <aside>
                @include('resume.section-education')

                <div class="resume-side-card reveal">
                    <span class="mono-label">CORE STRENGTHS</span>
                    <div class="resume-chip-list">
                        <span>Flutter</span>
                        <span>Dart</span>
                        <span>Laravel</span>
                        <span>REST API</span>
                        <span>Oracle</span>
                        <span>SQL</span>
                        <span>JD Edwards</span>
                        <span>iDempiere</span>
                        <span>Agile</span>
                    </div>
                </div>

                <div class="resume-side-card reveal">
                    <span class="mono-label">LANGUAGE & CREDENTIALS</span>
                    <ul class="plain-list">
                        <li><strong>English</strong><span>TOEFL ITP 570</span></li>
                        <li><strong>Informatics</strong><span>Universitas Jenderal Soedirman</span></li>
                        <li><strong>Mobile Programming</strong><span>BNSP certified</span></li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    <section class="section-space-small">
        <div class="shell">
            <div class="cta-panel reveal">
                <div>
                    <p class="eyebrow">The next chapter</p>
                    <h2>Looking for a mobile engineer who can see beyond the mobile layer?</h2>
                </div>
                <div>
                    <p>Let’s talk about the product, integration, and business workflow your team needs to solve.</p>
                    <a href="{{ route('contact') }}" class="button button-light">Contact Umar <span>↗</span></a>
                </div>
            </div>
        </div>
    </section>
@endsection
