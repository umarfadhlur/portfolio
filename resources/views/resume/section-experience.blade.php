<section class="resume-block">
    <div class="resume-block-heading reveal">
        <p class="eyebrow">Career</p>
        <h2>Professional experience</h2>
    </div>

    <div class="timeline-list">
        @forelse ($work as $exp)
            @php
                $startYear = $exp->start_date ? date('Y', strtotime($exp->start_date)) : null;
                $endYear = $exp->end_date ? date('Y', strtotime($exp->end_date)) : 'Present';
                $descriptionLines = collect(preg_split('/[\r\n]+|(?<=\.)\s+(?=[A-Z])/', (string) $exp->description) ?: [])
                    ->map(fn ($line) => trim($line))
                    ->filter()
                    ->take(5);
            @endphp

            <article class="timeline-entry reveal">
                <div class="timeline-marker"><span></span></div>
                <div class="timeline-content">
                    <div class="timeline-topline">
                        <span class="mono-label">{{ $startYear }} — {{ $endYear }}</span>
                        @if (!empty($exp->location))<span>{{ $exp->location }}</span>@endif
                    </div>
                    <h3>{{ $exp->name }}</h3>
                    <p class="timeline-company">{{ $exp->client }}</p>

                    @if ($descriptionLines->count() > 1)
                        <ul class="experience-points">
                            @foreach ($descriptionLines as $line)
                                <li>{{ rtrim($line, '.') }}.</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="timeline-description">{{ $exp->description }}</p>
                    @endif
                </div>
            </article>
        @empty
            <div class="empty-state compact-empty-state">
                <h3>Experience data is being prepared.</h3>
            </div>
        @endforelse
    </div>
</section>
