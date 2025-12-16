<div class="resume-item" data-aos="fade-up">
    <h3 class="resume-title">Education</h3>

    <div class="resume-content">
        @foreach ($education as $edu)
            <article class="education-item mb-4" data-aos="slide-up" data-aos-delay="{{ 100 + $loop->index * 100 }}">
                <h4>{{ $edu->name }}</h4>
                <h5>
                    {{ date('Y', strtotime($edu->start_date)) }}
                    -
                    {{ $edu->end_date ? date('Y', strtotime($edu->end_date)) : 'Present' }}
                </h5>
                <p class="institution">
                    <em>{{ $edu->client }}{{ $edu->location ? ', ' . $edu->location : '' }}</em>
                </p>
                <p>{{ $edu->description }}</p>
            </article>
        @endforeach
    </div>
</div>
