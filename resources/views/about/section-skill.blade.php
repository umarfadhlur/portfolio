<section id="skills" class="skills section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Skills</h2>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            @foreach ($skills as $index => $skill)
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ 120 + $index * 60 }}">
                    <article class="timeline-item">
                        <span class="dot"></span>
                        <time>{{ $skill->start_year }}</time>
                        <h4>{{ $skill->name }}</h4>
                        <p>{{ $skill->level }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
