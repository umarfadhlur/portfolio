@extends('layouts.app')

@section('title', 'Umar Fadhlurrachman')
@section('meta_description', 'Mobile Engineer building reliable Flutter applications, Laravel backends, payment integrations, and enterprise workflows.')
@section('body-class', 'home-page')

@section('content')
    @php
        $featuredProjects = collect($featuredPortfolios ?? [])->take(4);
        $heroProject = $featuredProjects->first();
        $heroPhoto = $heroProject?->photos?->first();
        $heroImage = $heroPhoto ? Storage::url($heroPhoto->image_path) : null;
    @endphp

    <section class="hero-section section-space">
        <div class="hero-orb hero-orb-one"></div>
        <div class="hero-orb hero-orb-two"></div>

        <div class="shell hero-grid">
            <div class="hero-copy reveal">
                <div class="availability-pill">
                    <span class="status-dot"></span>
                    Open to new opportunities
                </div>

                <p class="eyebrow">Mobile Engineer · Flutter · Laravel · Enterprise Integration</p>
                <h1>
                    I build mobile products that work in
                    <span>real business operations.</span>
                </h1>
                <p class="hero-description">
                    {{ $bio ?? 'I develop production-ready Flutter applications and Laravel backends for warehouse operations, payments, ERP workflows, and system integrations.' }}
                </p>

                <div class="hero-actions">
                    <a href="#work" class="button button-primary">
                        View case studies
                        <span aria-hidden="true">↘</span>
                    </a>
                    <a href="{{ route('resume') }}" class="button button-secondary">
                        Explore experience
                        <span aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="hero-proof" aria-label="Professional highlights">
                    <div>
                        <strong>5+</strong>
                        <span>Years building software</span>
                    </div>
                    <div>
                        <strong>Mobile + Web</strong>
                        <span>From interface to backend</span>
                    </div>
                    <div>
                        <strong>Enterprise</strong>
                        <span>ERP, warehouse, and payments</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual reveal reveal-delay-1" aria-label="Umar's engineering profile">
                <div class="visual-grid-pattern"></div>

                <article class="product-preview-card">
                    <div class="preview-topbar">
                        <div class="window-dots"><span></span><span></span><span></span></div>
                        <span class="mono-label">production_app.dart</span>
                    </div>
                    <div class="phone-stage">
                        <div class="phone-frame">
                            <div class="phone-speaker"></div>
                            @if ($heroImage)
                                <img src="{{ $heroImage }}" alt="{{ $heroProject->portfolio_name }} application preview">
                            @else
                                <div class="phone-placeholder">
                                    <span class="mini-label">ENTERPRISE MOBILE</span>
                                    <strong>Build.<br>Integrate.<br>Deliver.</strong>
                                    <div class="placeholder-lines"><i></i><i></i><i></i></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>

                <article class="profile-float-card">
                    <img src="{{ asset('assets/img/profile/umarf.png') }}" alt="Umar Fadhlurrachman">
                    <div>
                        <strong>{{ $name ?? 'Umar Fadhlurrachman' }}</strong>
                        <span>Software Engineer · Indonesia</span>
                    </div>
                </article>

                <article class="stack-float-card">
                    <span class="mono-label">CORE STACK</span>
                    <div class="stack-list">
                        <span>Flutter</span>
                        <span>Laravel</span>
                        <span>REST API</span>
                        <span>Oracle</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="trust-strip" aria-label="Technology and domain experience">
        <div class="shell trust-track">
            <span>Flutter</span><i></i>
            <span>Laravel</span><i></i>
            <span>JD Edwards</span><i></i>
            <span>iDempiere</span><i></i>
            <span>Oracle</span><i></i>
            <span>Payment Integration</span>
        </div>
    </section>

    <section id="work" class="section-space work-section">
        <div class="shell">
            <div class="section-heading reveal">
                <div>
                    <p class="eyebrow">Selected work</p>
                    <h2>Systems built for more than just a demo.</h2>
                </div>
                <p>Projects focused on operational reliability, integration complexity, and measurable business workflows.</p>
            </div>

            @if ($featuredProjects->isNotEmpty())
                <div class="featured-project-grid">
                    @foreach ($featuredProjects as $project)
                        @php
                            $projectPhoto = $project->photos?->first();
                            $projectImage = $projectPhoto ? Storage::url($projectPhoto->image_path) : null;
                            $rawTechs = $project->tech_stack ?? [];
                            if (is_string($rawTechs)) {
                                $decodedTechs = json_decode($rawTechs, true);
                                $rawTechs = is_array($decodedTechs) ? $decodedTechs : explode(',', $rawTechs);
                            }
                            $projectTechs = collect(is_array($rawTechs) ? $rawTechs : [])->filter()->take(4);
                        @endphp
                        <article class="featured-project-card reveal {{ $loop->first ? 'featured-project-card-wide' : '' }}">
                            <a href="{{ route('portfolio.show', $project->slug) }}" class="project-media" aria-label="Open {{ $project->portfolio_name }} case study">
                                @if ($projectImage)
                                    <img src="{{ $projectImage }}" alt="{{ $project->portfolio_name }}" loading="lazy">
                                @else
                                    <div class="project-image-placeholder"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
                                @endif
                                <span class="project-open">↗</span>
                            </a>
                            <div class="project-card-body">
                                <div class="project-index mono-label">CASE STUDY / {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                <h3><a href="{{ route('portfolio.show', $project->slug) }}">{{ $project->portfolio_name }}</a></h3>
                                <p>{{ Str::limit($project->description, $loop->first ? 180 : 120) }}</p>
                                <div class="tag-row">
                                    @foreach ($projectTechs as $tech)
                                        <span>{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="featured-project-grid">
                    @foreach ([
                        ['01', 'Warehouse Management Mobile', 'Receiving, putaway, picking, and shipment workflows connected to enterprise inventory data.', ['Flutter', 'REST API', 'iDempiere']],
                        ['02', 'QRIS Payment Integration', 'A reliable payment status flow connecting mobile checkout, middleware, webhook, and reconciliation.', ['Flutter', 'Laravel', 'Espay']],
                        ['03', 'JD Edwards Mobile Approval', 'Mobile purchasing approval designed around actual enterprise roles, documents, and authorization flows.', ['Flutter', 'JDE', 'Orchestrator']],
                        ['04', 'Laravel Content Platform', 'A maintainable company website and CMS replacing static content with controlled business publishing.', ['Laravel', 'Filament', 'MySQL']],
                    ] as $item)
                        <article class="featured-project-card reveal {{ $loop->first ? 'featured-project-card-wide' : '' }}">
                            <a href="{{ route('portfolio') }}" class="project-media project-image-placeholder">
                                <span>{{ $item[0] }}</span>
                                <span class="project-open">↗</span>
                            </a>
                            <div class="project-card-body">
                                <div class="project-index mono-label">SELECTED CAPABILITY / {{ $item[0] }}</div>
                                <h3><a href="{{ route('portfolio') }}">{{ $item[1] }}</a></h3>
                                <p>{{ $item[2] }}</p>
                                <div class="tag-row">
                                    @foreach ($item[3] as $tech)<span>{{ $tech }}</span>@endforeach
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            <div class="section-link-row reveal">
                <a href="{{ route('portfolio') }}" class="text-link">Explore all projects <span>→</span></a>
            </div>
        </div>
    </section>

    <section id="expertise" class="section-space expertise-section">
        <div class="shell">
            <div class="section-heading reveal">
                <div>
                    <p class="eyebrow">Core expertise</p>
                    <h2>Engineering across the whole workflow.</h2>
                </div>
                <p>I am strongest where mobile UX meets backend logic, operational data, and enterprise constraints.</p>
            </div>

            <div class="expertise-grid">
                <article class="expertise-card reveal">
                    <span class="expertise-number mono-label">01</span>
                    <div class="expertise-icon">⌁</div>
                    <h3>Mobile Engineering</h3>
                    <p>Production Flutter applications with maintainable architecture, state management, API integration, and platform-aware UX.</p>
                    <ul>
                        <li>Flutter & Dart</li>
                        <li>BLoC / Cubit</li>
                        <li>Android integration</li>
                        <li>Performance optimization</li>
                    </ul>
                </article>

                <article class="expertise-card reveal reveal-delay-1">
                    <span class="expertise-number mono-label">02</span>
                    <div class="expertise-icon">{ }</div>
                    <h3>Backend & Integration</h3>
                    <p>APIs and Laravel services that connect mobile products to payments, business rules, databases, and external platforms.</p>
                    <ul>
                        <li>Laravel & PHP</li>
                        <li>REST API design</li>
                        <li>Webhook processing</li>
                        <li>Authentication & data flow</li>
                    </ul>
                </article>

                <article class="expertise-card reveal reveal-delay-2">
                    <span class="expertise-number mono-label">03</span>
                    <div class="expertise-icon">◇</div>
                    <h3>Enterprise Systems</h3>
                    <p>Technical implementation grounded in warehouse, purchasing, HR, payment, and ERP workflows—not isolated feature work.</p>
                    <ul>
                        <li>JD Edwards</li>
                        <li>iDempiere</li>
                        <li>Oracle & SQL</li>
                        <li>Operational workflow mapping</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="process-section section-space">
        <div class="shell process-grid">
            <div class="process-copy reveal">
                <p class="eyebrow">How I work</p>
                <h2>From messy process to dependable product.</h2>
                <p>I translate operational requirements into clear flows, stable integration boundaries, and interfaces people can actually use.</p>
                <a href="{{ route('about') }}" class="text-link">More about my approach <span>→</span></a>
            </div>

            <div class="process-list reveal reveal-delay-1">
                @foreach ([
                    ['01', 'Understand the workflow', 'Map users, approvals, data ownership, constraints, and failure points before writing UI code.'],
                    ['02', 'Design the system flow', 'Define API contracts, state transitions, validation, and fallback behaviour across mobile and backend.'],
                    ['03', 'Ship and improve', 'Deliver iteratively, inspect production behaviour, and optimize based on real operational use.'],
                ] as $step)
                    <article>
                        <span class="mono-label">{{ $step[0] }}</span>
                        <div><h3>{{ $step[1] }}</h3><p>{{ $step[2] }}</p></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-space home-cta-section">
        <div class="shell">
            <div class="cta-panel reveal">
                <div>
                    <p class="eyebrow">Available for the next challenge</p>
                    <h2>Need an engineer who understands the business behind the screen?</h2>
                </div>
                <div>
                    <p>I am open to Mobile Engineer, Flutter Developer, and enterprise application roles.</p>
                    <a href="{{ route('contact') }}" class="button button-light">Start a conversation <span>↗</span></a>
                </div>
            </div>
        </div>
    </section>
@endsection
