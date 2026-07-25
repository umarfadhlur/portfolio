@extends('layouts.app')

@section('title', 'Projects')
@section('meta_description', 'Selected Flutter, Laravel, payment, warehouse, and enterprise integration projects by Umar Fadhlurrachman.')
@section('body-class', 'portfolio-page')

@section('content')
    <section class="page-hero compact-page-hero">
        <div class="shell page-hero-grid">
            <div class="reveal">
                <p class="eyebrow">Project archive</p>
                <h1>Work built around real users, data, and operations.</h1>
            </div>
            <p class="page-hero-copy reveal reveal-delay-1">
                A selection of mobile, web, payment, and enterprise systems I have designed, implemented, integrated, or improved.
            </p>
        </div>
    </section>

    <section class="portfolio-archive section-space-small">
        <div class="shell">
            <div class="filter-bar reveal" data-project-filters>
                <button type="button" class="active" data-filter="all">All work</button>
                <button type="button" data-filter="mobile">Mobile</button>
                <button type="button" data-filter="backend">Backend</button>
                <button type="button" data-filter="enterprise">Enterprise</button>
            </div>

            <div class="archive-grid" data-project-grid>
                @forelse ($portfolios as $project)
                    @php
                        $photo = $project->photos?->first();
                        $image = $photo ? Storage::url($photo->image_path) : null;

                        $rawTechs = $project->tech_stack ?? [];
                        if (is_string($rawTechs)) {
                            $decoded = json_decode($rawTechs, true);
                            $rawTechs = is_array($decoded) ? $decoded : explode(',', $rawTechs);
                        }
                        $techs = collect(is_array($rawTechs) ? $rawTechs : [])->map(fn ($item) => trim((string) $item))->filter();
                        $searchableTech = strtolower($techs->implode(' ') . ' ' . ($project->portfolio_name ?? '') . ' ' . ($project->description ?? ''));

                        $categories = ['all'];
                        if (str_contains($searchableTech, 'flutter') || str_contains($searchableTech, 'android') || str_contains($searchableTech, 'mobile')) {
                            $categories[] = 'mobile';
                        }
                        if (str_contains($searchableTech, 'laravel') || str_contains($searchableTech, 'php') || str_contains($searchableTech, 'api') || str_contains($searchableTech, 'backend')) {
                            $categories[] = 'backend';
                        }
                        if (str_contains($searchableTech, 'jde') || str_contains($searchableTech, 'oracle') || str_contains($searchableTech, 'idempiere') || str_contains($searchableTech, 'erp') || str_contains($searchableTech, 'warehouse')) {
                            $categories[] = 'enterprise';
                        }
                    @endphp

                    <article class="archive-card reveal" data-project-card data-categories="{{ implode(' ', array_unique($categories)) }}">
                        <a href="{{ route('portfolio.show', $project->slug) }}" class="archive-media">
                            @if ($image)
                                <img src="{{ $image }}" alt="{{ $project->portfolio_name }}" loading="lazy">
                            @else
                                <div class="archive-placeholder">
                                    <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <small>PROJECT PREVIEW</small>
                                </div>
                            @endif
                            <span class="project-open">↗</span>
                        </a>

                        <div class="archive-card-body">
                            <div class="archive-card-meta">
                                <span class="mono-label">PROJECT {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                @if (!empty($project->client))
                                    <span>{{ $project->client }}</span>
                                @endif
                            </div>

                            <h2><a href="{{ route('portfolio.show', $project->slug) }}">{{ $project->portfolio_name }}</a></h2>
                            <p>{{ Str::limit($project->description, 155) }}</p>

                            <div class="tag-row">
                                @foreach ($techs->take(5) as $tech)
                                    <span>{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <span class="mono-label">NO PROJECTS YET</span>
                        <h2>The project archive is being prepared.</h2>
                        <p>Please check back soon or contact me for a private walkthrough of relevant work.</p>
                    </div>
                @endforelse
            </div>

            @if (is_object($portfolios) && method_exists($portfolios, 'links'))
                <div class="pagination-wrap">{{ $portfolios->links() }}</div>
            @endif
        </div>
    </section>

    <section class="section-space-small">
        <div class="shell">
            <div class="cta-panel reveal">
                <div>
                    <p class="eyebrow">Looking for a specific capability?</p>
                    <h2>Let’s discuss the workflow, not just the framework.</h2>
                </div>
                <div>
                    <p>I can walk through architecture decisions, integration challenges, and my exact contribution privately.</p>
                    <a href="{{ route('contact') }}" class="button button-light">Contact me <span>↗</span></a>
                </div>
            </div>
        </div>
    </section>
@endsection
