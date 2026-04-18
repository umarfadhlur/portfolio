{{-- resources/views/components/cta.blade.php --}}
{{-- Static CTA closing section --}}

<section id="cta" class="call-to-action section dark-background">

  {{-- Background image overlay --}}
  <div style="
    position: absolute; inset: 0;
    background-image: url('{{ asset('assets/img/cta-bg.jpg') }}');
    background-size: cover; background-position: center;
    z-index: 0; opacity: 0.18;">
  </div>

  <div class="container position-relative" style="z-index: 1;">
    <div class="content text-center" data-aos="zoom-in" data-aos-delay="100">

      <h3 style="font-family: var(--heading-font); font-size: 2rem; font-weight: 300; text-transform: uppercase; color: #fff; margin-bottom: 16px;">
        Let's <strong>Grow Together</strong>
      </h3>

      <p style="font-size: 1.1rem; color: rgba(255,255,255,0.8); max-width: 600px; margin: 0 auto 32px;">
        We welcome inquiries from coffee importers, specialty roasters, and distributors worldwide.
        Contact us to discuss your sourcing needs and receive product samples.
      </p>

      <div class="d-flex gap-3 justify-content-center flex-wrap">
        <a href="{{ route('contact') }}" class="btn-get-started">
          Get in Touch
        </a>
        <a href="https://wa.me/6287851708758" target="_blank" rel="noopener noreferrer"
          class="btn-get-started"
          style="background: #25D366; border-color: #25D366; display:inline-flex; align-items:center; gap:8px;">
          <i class="bi bi-whatsapp"></i>
          WhatsApp Us
        </a>
      </div>

      <p class="mt-4" style="font-size: 13px; color: rgba(255,255,255,0.5);">
        Sample orders from <strong style="color:rgba(255,255,255,0.8);">5 kg</strong> ·
        Lead time <strong style="color:rgba(255,255,255,0.8);">2–4 weeks</strong> ·
        Export to <strong style="color:rgba(255,255,255,0.8);">worldwide</strong>
      </p>

    </div>
  </div>
</section>
