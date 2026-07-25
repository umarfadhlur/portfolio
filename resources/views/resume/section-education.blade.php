<section class="resume-side-card education-card reveal">
    <span class="mono-label">EDUCATION</span>

    <div class="education-list">
        @forelse ($education as $edu)
            <article>
                <span>{{ $edu->start_date ? date('Y', strtotime($edu->start_date)) : '' }} — {{ $edu->end_date ? date('Y', strtotime($edu->end_date)) : 'Present' }}</span>
                <h3>{{ $edu->name }}</h3>
                <p>{{ $edu->client }}{{ $edu->location ? ' · ' . $edu->location : '' }}</p>
                @if (!empty($edu->description))
                    <small>{{ $edu->description }}</small>
                @endif
            </article>
        @empty
            <p>Education details are being prepared.</p>
        @endforelse
    </div>
</section>
