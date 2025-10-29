<section id="experience" class="resume section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Professional Experience</h2>
        <p>Riwayat karier dan pengalaman profesional dalam berbagai proyek dan teknologi.</p>
    </div>

    <div class="container">
        <div class="resume-content">
            @foreach ($work as $exp)
                <article class="experience-item mb-4"">
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
</section>
