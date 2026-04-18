@extends('layouts.app')

@section('title', 'Contact Us')
@section('meta_description',
    'Get in touch with CV. Banyumas Bonanza Indonesia. Request a sample, ask about export
    pricing, or start a partnership with our team.')
@section('og_title', 'Contact Us')
@section('og_description',
    'Get in touch with CV. Banyumas Bonanza Indonesia. Request a sample, ask about export
    pricing, or start a partnership with our team.')
@section('og_image', asset('assets/img/coffee/coffee.jpeg'))
@section('og_url', route('contact.index'))
@section('og_type', 'website')

@section('content')

    <section id="contact" class="contact-snippet py-5">
        <div class="container">

            {{-- Header --}}
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="contact-tag">
                    @translate('Get In Touch', 'home', 'contact.tag')
                </span>
                <h2 class="contact-title mt-3">
                    @translate('Send Us a', 'home', 'contact.title')
                    <em>@translate('Message', 'home', 'contact.title_em')</em>
                </h2>
                <p class="contact-subtitle mx-auto mt-3">
                    @translate('Interested in our products or have a business inquiry? Fill in the form and our team will get back to you shortly.', 'home', 'contact.subtitle')
                </p>
            </div>

            <div class="row g-5 justify-content-center">

                {{-- LEFT: Info --}}
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="contact-info-wrap">

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">@translate('Address', 'contact', 'info.address_label')</div>
                                <div class="contact-info-value">
                                    Arcawinangun Estate AC 4 No. 8,<br>
                                    Banyumas, Central Java, Indonesia
                                </div>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">@translate('Email', 'contact', 'info.email_label')</div>
                                <div class="contact-info-value">
                                    <a href="mailto:inquiry@banyumasbonanza.com">inquiry@banyumasbonanza.com</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">WhatsApp</div>
                                <div class="contact-info-value">
                                    <a href="https://wa.me/6287851708758" target="_blank" rel="noopener">
                                        +62 878-5170-8758
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-instagram"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">Instagram</div>
                                <div class="contact-info-value">
                                    <a href="https://instagram.com/kopipbg" target="_blank" rel="noopener">@kopipbg</a>
                                    &nbsp;&amp;&nbsp;
                                    <a href="https://instagram.com/banyumasbonanza" target="_blank"
                                        rel="noopener">@banyumasbonanza</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">@translate('Business Hours', 'contact', 'info.hours_label')</div>
                                <div class="contact-info-value">Mon – Fri, 08.00 – 17.00 WIB</div>
                            </div>
                        </div>

                    </div>

                    {{-- Map --}}
                    <div class="mt-4" data-aos="fade-up" data-aos-delay="100">
                        <iframe src="https://www.google.com/maps?q=-7.414752,109.256392&z=17&output=embed" width="100%"
                            height="260" style="border:0; border-radius:1rem; display:block;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Arcawinangun Estate AC 4 No. 8, Banyumas">
                        </iframe>
                        <a href="https://maps.google.com/?q=-7.414752,109.256392" target="_blank" rel="noopener"
                            style="display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.75rem; font-size:0.825rem; color:var(--nav-hover-color); text-decoration:none;">
                            <i class="bi bi-box-arrow-up-right"></i>
                            @translate('Open in Google Maps', 'contact', 'info.maps_link')
                        </a>
                    </div>
                </div>

                {{-- RIGHT: Form --}}
                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                    <form id="contactForm" class="contact-form" novalidate>
                        @csrf

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="contact-label" for="cf_name">
                                    @translate('Full Name', 'home', 'contact.field_name')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="cf_name" name="name" class="contact-input"
                                    placeholder="John Doe" required maxlength="100">
                                <div class="contact-error" id="err_name"></div>
                            </div>

                            <div class="col-sm-6">
                                <label class="contact-label" for="cf_email">
                                    @translate('Email Address', 'home', 'contact.field_email')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="cf_email" name="email" class="contact-input"
                                    placeholder="john@company.com" required maxlength="100">
                                <div class="contact-error" id="err_email"></div>
                            </div>

                            <div class="col-sm-6">
                                <label class="contact-label" for="cf_phone">
                                    @translate('Phone / WhatsApp', 'home', 'contact.field_phone')
                                </label>
                                <input type="text" id="cf_phone" name="phone" class="contact-input"
                                    placeholder="+62 812-xxxx-xxxx" maxlength="20">
                            </div>

                            <div class="col-sm-6">
                                <label class="contact-label" for="cf_subject">
                                    @translate('Subject', 'home', 'contact.field_subject')
                                </label>
                                <input type="text" id="cf_subject" name="subject" class="contact-input"
                                    placeholder="Product Inquiry" maxlength="150">
                            </div>

                            <div class="col-12">
                                <label class="contact-label" for="cf_message">
                                    @translate('Message', 'home', 'contact.field_message')
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea id="cf_message" name="message" class="contact-input contact-textarea"
                                    placeholder="Tell us about your inquiry..." required maxlength="2000" rows="5"></textarea>
                                <div class="contact-error" id="err_message"></div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn-contact-submit" id="contactSubmitBtn">
                                    <span class="btn-contact-text">
                                        @translate('Send Message', 'home', 'contact.submit')
                                    </span>
                                    <span class="btn-contact-loading d-none">
                                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        @translate('Sending...', 'home', 'contact.sending')
                                    </span>
                                </button>
                            </div>
                        </div>

                        {{-- Alert --}}
                        <div id="contactAlert" class="contact-alert d-none mt-4" role="alert"></div>

                    </form>
                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('contactSubmitBtn');
            const btnText = submitBtn.querySelector('.btn-contact-text');
            const btnLoad = submitBtn.querySelector('.btn-contact-loading');
            const alertEl = document.getElementById('contactAlert');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Reset errors
                ['name', 'email', 'message'].forEach(f => {
                    document.getElementById('err_' + f).textContent = '';
                    document.getElementById('cf_' + f).classList.remove('is-invalid');
                });
                alertEl.className = 'contact-alert d-none mt-4';
                alertEl.textContent = '';

                // Loading state
                submitBtn.disabled = true;
                btnText.classList.add('d-none');
                btnLoad.classList.remove('d-none');

                const formData = new FormData(form);

                try {
                    const res = await fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await res.json();

                    if (res.ok && data.success) {
                        alertEl.textContent = data.message;
                        alertEl.className = 'contact-alert success mt-4';
                        form.reset();
                    } else if (res.status === 422 && data.errors) {
                        Object.entries(data.errors).forEach(([field, msgs]) => {
                            const errEl = document.getElementById('err_' + field);
                            const inputEl = document.getElementById('cf_' + field);
                            if (errEl) errEl.textContent = msgs[0];
                            if (inputEl) inputEl.classList.add('is-invalid');
                        });
                    } else {
                        throw new Error('Unexpected error');
                    }

                } catch (err) {
                    alertEl.textContent = 'Something went wrong. Please try again.';
                    alertEl.className = 'contact-alert error mt-4';
                } finally {
                    submitBtn.disabled = false;
                    btnText.classList.remove('d-none');
                    btnLoad.classList.add('d-none');
                }
            });
        });
    </script>

@endsection
