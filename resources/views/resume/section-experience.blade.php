<div class="resume-item" data-aos="fade-up" data-aos-delay="100">
    <h3 class="resume-title">Professional Experience</h3>

    <div class="resume-content">
        @foreach ($work as $exp)
            <article class="experience-item mb-4" data-aos="slide-up" data-aos-delay="{{ 100 + $loop->index * 100 }}">
                <h4>{{ $exp->name }}</h4>
                <h5>
                    {{ date('Y', strtotime($exp->start_date)) }}
                    -
                    {{ $exp->end_date ? date('Y', strtotime($exp->end_date)) : 'Present' }}
                </h5>
                <p class="company">
                    <em>{{ $exp->client }}{{ $exp->location ? ', ' . $exp->location : '' }}</em>
                </p>
                <p>{{ $exp->description }}</p>
            </article>
        @endforeach
    </div>
</div>
