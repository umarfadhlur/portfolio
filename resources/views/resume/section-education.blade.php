<section id="education" class="resume section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Education</h2>
        <p>Perjalanan akademik saya dan fondasi yang membentuk dasar pengetahuan teknologi.</p>
    </div>

    <div class="container">
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
</section>
