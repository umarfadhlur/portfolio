<section id="about" class="about section">
  <div class="container section-title" data-aos="fade-up">
    <h2>About</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit...</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center justify-content-between gy-5 mb-5">
      <div class="col-lg-7" data-aos="fade-right" data-aos-delay="150">
        <div class="intro-content">
          <span class="eyebrow">Hello there</span>
          <h2 class="headline">Hi, I'm Brandon - a calm-minded creative developer crafting serene digital journeys</h2>
          <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus.
          </p>
          <p>
            Integer posuere lacus in mi fringilla, eget luctus risus pulvinar. Curabitur a arcu a nisl tempus sagittis.
          </p>
          <div class="cta-group">
            <a href="{{ route('portfolio') }}" class="btn-ghost">View My Work <i class="bi bi-arrow-up-right"></i></a>
            <a href="#" class="link-underline">Download Resume <i class="bi bi-download"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="250">
        <figure class="profile-figure text-center text-lg-end">
          <img src="{{ asset('assets/img/profile/profile-square-11.webp') }}" alt="Portrait" class="img-fluid profile-photo">
        </figure>
      </div>
    </div>
    <!-- Skills Grid kecil di dalam about -->
    <div class="mb-5">
      <div class="row g-4">
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="120">
          <div class="skill-item"><i class="bi bi-layout-text-window"></i><h3>UI/UX</h3><p>Vivamus sagittis lacus molestie placerat.</p></div>
        </div>
        <!-- dst, tinggal copy isi html -->
      </div>
    </div>

    <!-- Timeline -->
    <div class="mb-5">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="120">
          <article class="timeline-item"><span class="dot"></span><time>2018</time><h4>B.A. in Design</h4><p>Quisque euismod turpis ut sapien luctus bibendum.</p></article>
        </div>
        <!-- dst -->
      </div>
    </div>

    <!-- Quote -->
    <blockquote class="personal-quote text-center mb-5" data-aos="fade-down" data-aos-delay="200">
      <p>"Building clean and meaningful experiences through thoughtful code and quiet design."</p>
    </blockquote>

    <!-- Fun Facts -->
    <div class="row g-3 justify-content-center">
      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="120">
        <div class="fact-pill"><i class="bi bi-magic"></i><span>Minimalism</span></div>
      </div>
      <!-- dst -->
    </div>
  </div>
</section>
