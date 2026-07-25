@extends('layouts.app')

@section('title', $portfolio->portfolio_name)
@section('meta_description', Str::limit(strip_tags($portfolio->description), 150))
@section('body-class', 'project-detail-page')

@section('content')
    @php
        $toArray = static function ($value): array {
            if (is_array($value)) {
                return $value;
            }

            if (is_string($value)) {
                $decoded = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return $decoded;
                }

                return array_filter(array_map('trim', preg_split('/[\r\n,]+/', $value) ?: []));
            }

            return [];
        };

        $techs = collect($toArray($portfolio->tech_stack ?? []))->map(fn ($item) => trim((string) $item))->filter()->values();
        $roles = collect($toArray($portfolio->roles ?? []))->map(fn ($item) => trim((string) $item))->filter()->values();
        $contributions = collect($toArray($portfolio->contributions ?? []))->map(fn ($item) => trim((string) $item))->filter()->values();
        $photos = collect($portfolio->photos ?? []);
        $primaryPhoto = $photos->first();
    @endphp

    <section class="project-hero">
        <div class="shell">
            <a href="{{ route('portfolio') }}" class="back-link reveal"><span>←</span> Back to all projects</a>

            <div class="project-hero-grid">
                <div class="reveal">
                    <div class="tag-row project-role-row">
                        @forelse ($roles as $role)
                            <span>{{ $role }}</span>
                        @empty
                            <span>Software Engineering</span>
                        @endforelse
                    </div>

                    <h1>{{ $portfolio->portfolio_name }}</h1>
                    <p class="project-lead">{{ $portfolio->description }}</p>
                </div>

                <dl class="project-facts reveal reveal-delay-1">
                    @if (!empty($portfolio->client))
                        <div><dt>Client / Company</dt><dd>{{ $portfolio->client }}</dd></div>
                    @endif
                    <div><dt>Published</dt><dd>{{ optional($portfolio->created_at)->format('F Y') ?? 'Portfolio project' }}</dd></div>
                    @if ($techs->isNotEmpty())
                        <div><dt>Primary stack</dt><dd>{{ $techs->take(3)->implode(' · ') }}</dd></div>
                    @endif
                    @if (!empty($portfolio->website))
                        <div><dt>Project link</dt><dd><a href="{{ $portfolio->website }}" target="_blank" rel="noopener noreferrer">Visit website ↗</a></dd></div>
                    @endif
                </dl>
            </div>
        </div>
    </section>

    <section class="project-gallery-section">
        <div class="shell">
            <div class="project-gallery reveal" data-project-gallery>
                <div class="project-gallery-main">
                    @if ($primaryPhoto)
                        <img src="{{ Storage::url($primaryPhoto->image_path) }}" alt="{{ $portfolio->portfolio_name }} main preview" data-gallery-main>
                    @else
                        <div class="detail-placeholder">
                            <span class="mono-label">PROJECT CASE STUDY</span>
                            <strong>{{ $portfolio->portfolio_name }}</strong>
                        </div>
                    @endif
                </div>

                @if ($photos->count() > 1)
                    <div class="project-thumbnails" aria-label="Project screenshots">
                        @foreach ($photos as $photo)
                            <button type="button" class="{{ $loop->first ? 'active' : '' }}" data-gallery-thumb data-image="{{ Storage::url($photo->image_path) }}" aria-label="Show screenshot {{ $loop->iteration }}">
                                <img src="{{ Storage::url($photo->image_path) }}" alt="" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="project-content-section section-space">
        <div class="shell project-content-grid">
            <aside class="project-sidebar reveal">
                <span class="mono-label">TECHNOLOGY</span>
                <div class="stack-cloud">
                    @forelse ($techs as $tech)
                        <span>{{ $tech }}</span>
                    @empty
                        <span>Technology details available on request</span>
                    @endforelse
                </div>

                @if (!empty($portfolio->website))
                    <a href="{{ $portfolio->website }}" target="_blank" rel="noopener noreferrer" class="button button-secondary project-site-button">
                        View live project <span>↗</span>
                    </a>
                @endif
            </aside>

            <div class="project-story">
                <article class="story-block reveal">
                    <span class="mono-label">01 / OVERVIEW</span>
                    <h2>What this project involved</h2>
                    <p>{{ $portfolio->description }}</p>
                </article>

                <article class="story-block reveal">
                    <span class="mono-label">02 / MY CONTRIBUTION</span>
                    <h2>Responsibilities and implementation</h2>
                    @if ($contributions->isNotEmpty())
                        <ul class="contribution-list">
                            @foreach ($contributions as $contribution)
                                <li><span>✓</span><p>{{ $contribution }}</p></li>
                            @endforeach
                        </ul>
                    @else
                        <p>Detailed contribution notes are not yet published. Contact me for a walkthrough of my responsibilities, architecture decisions, and implementation challenges.</p>
                    @endif
                </article>

                <article class="story-block reveal">
                    <span class="mono-label">03 / ENGINEERING APPROACH</span>
                    <h2>Built around workflow clarity and maintainability</h2>
                    <div class="approach-grid">
                        <div>
                            <strong>Business flow first</strong>
                            <p>Understand actors, states, validations, and operational exceptions before translating them into screens.</p>
                        </div>
                        <div>
                            <strong>Clear integration boundaries</strong>
                            <p>Keep mobile, backend, database, and external-system responsibilities explicit and testable.</p>
                        </div>
                        <div>
                            <strong>Production-minded delivery</strong>
                            <p>Design for loading, failure, retries, edge cases, and maintainability—not only the happy path.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section-space-small next-project-section">
        <div class="shell">
            <div class="next-project-card reveal">
                <span class="mono-label">NEXT STEP</span>
                <h2>Want to discuss the architecture behind this work?</h2>
                <p>I can explain the system context, technical decisions, and exact scope of my contribution in an interview.</p>
                <div class="hero-actions">
                    <a href="{{ route('contact') }}" class="button button-primary">Start a conversation <span>↗</span></a>
                    <a href="{{ route('portfolio') }}" class="button button-secondary">Browse more work <span>→</span></a>
                </div>
            </div>
        </div>
    </section>
@endsection
