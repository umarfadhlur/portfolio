<section class="section-space-small skills-section">
    <div class="shell">
        <div class="section-heading reveal">
            <div>
                <p class="eyebrow">Technical toolkit</p>
                <h2>Tools I use to ship reliable systems.</h2>
            </div>
            <p>Experience is shown through context and application—not arbitrary percentage bars.</p>
        </div>

        <div class="skill-grid">
            @foreach ($skills as $skill)
                <article class="skill-card reveal">
                    <span class="mono-label">{{ $skill->start_year ? 'SINCE ' . $skill->start_year : 'TOOLKIT' }}</span>
                    <h3>{{ $skill->name }}</h3>
                    @if (!empty($skill->level))
                        <p>{{ $skill->level }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
