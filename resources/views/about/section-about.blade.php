<section id="about" class="about section">
  <div class="container section-title" data-aos="fade-up">
    <h2>About</h2>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center justify-content-between gy-5 mb-5">
      <div class="col-lg-7" data-aos="fade-right" data-aos-delay="150">
        <div class="intro-content">
          <h2 class="headline">{{ $about->introduction ?? 'No introduction available' }}</h2>
          <p class="lead">
            {{ $about->summary ?? '' }}
          </p>
          <div class="cta-group">
            <a href="{{ route('portfolio') }}" class="btn-ghost">
              View My Work <i class="bi bi-arrow-up-right"></i>
            </a>

            @if(!empty($about->pdf))
              <a href="{{ asset('storage/' . $about->pdf) }}" target="_blank" class="link-underline">
                Download Resume <i class="bi bi-download"></i>
              </a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="250">
        <figure class="profile-figure text-center text-lg-end">
          <img src="{{ asset('assets/img/profile/profile-square-11.webp') }}"
               alt="Portrait" class="img-fluid profile-photo">
        </figure>
      </div>
    </div>



    {{-- <!-- Skills Grid kecil di dalam about -->
    <div class="mb-5">
      <div class="row g-4">
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="120">
          <div class="skill-item"><i class="bi bi-layout-text-window"></i><h3>UI/UX</h3><p>Vivamus sagittis lacus molestie placerat.</p></div>
        </div>
        <!-- dst, tinggal copy isi html -->
      </div>
    </div> --}}

    <!-- Timeline -->
    {{-- <div class="mb-5">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="120">
          <article class="timeline-item"><span class="dot"></span><time>2018</time><h4>B.A. in Design</h4><p>Quisque euismod turpis ut sapien luctus bibendum.</p></article>
        </div>
        <!-- dst -->
      </div>
    </div> --}}
  </div>
</section>

