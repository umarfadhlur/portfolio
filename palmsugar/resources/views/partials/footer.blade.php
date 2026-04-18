{{-- resources/views/components/home/footer.blade.php --}}
{{-- CV. Banyumas Bonanza Indonesia --}}

<footer class="site-footer">
    {{-- Main Footer --}}
    <div class="footer-main">
        <div class="container">
            <div class="row g-5">

                {{-- Col 1: Brand --}}
                <div class="col-lg-4">
                    <a href="{{ url('/') }}" class="footer-brand">
                        <img src="{{ asset('assets/img/logo-light.png') }}" alt="CV. Banyumas Bonanza Indonesia"
                            height="48" onerror="this.style.display='none'">
                        <span class="footer-brand-text">Banyumas Bonanza<br><small>Indonesia</small></span>
                    </a>
                    <p class="footer-about mt-4">
                        @translate('Premium Indonesian specialty coffee producer and exporter from Central Java. Java Slamet Coffee (Kopi PbG) — traceable, certified, and export-ready.', 'home', 'footer.about')
                    </p>
                    <div class="footer-socials mt-4">
                        <a href="https://instagram.com/banyumasbonanza" class="footer-social-link"
                            aria-label="Instagram" target="_blank" rel="noopener">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://facebook.com/banyumasbonanza" class="footer-social-link" aria-label="Facebook"
                            target="_blank" rel="noopener">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://wa.me/6287851708758" class="footer-social-link" aria-label="WhatsApp"
                            target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="https://linkedin.com/company/banyumas-bonanza-indonesia" class="footer-social-link"
                            aria-label="LinkedIn" target="_blank" rel="noopener">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>

                {{-- Col 2: Quick Links --}}
                <div class="col-6 col-lg-2">
                    <h4 class="footer-heading">
                        @translate('Quick Links', 'home', 'footer.quicklinks_title')
                    </h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">@translate('Home', 'home', 'footer.nav_home')</a></li>
                        <li><a href="{{ route('about.index') }}">@translate('About Us', 'home', 'footer.nav_about')</a></li>
                        <li><a href="{{ route('products.index') }}">@translate('Products', 'home', 'footer.nav_products')</a></li>
                        <li><a href="{{ url('blog') }}">@translate('Blog', 'home', 'footer.nav_blog')</a></li>
                        <li><a href="{{ route('contact.index') }}">@translate('Contact', 'home', 'footer.nav_contact')</a></li>
                    </ul>
                </div>

                {{-- Col 3: Products --}}
                <div class="col-6 col-lg-2">
                    <h4 class="footer-heading">
                        @translate('Our Products', 'home', 'footer.products_title')
                    </h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('products.index') }}">Arabica Coffee</a></li>
                        <li><a href="{{ route('products.index') }}">Robusta Coffee</a></li>
                        <li><a href="{{ route('products.index') }}">Green Beans</a></li>
                        <li><a href="{{ route('products.index') }}">Roasted Beans</a></li>
                        <li><a href="{{ route('products.index') }}">Palm Sugar Coffee</a></li>
                    </ul>
                </div>

                {{-- Col 4: Contact Info --}}
                <div class="col-lg-4">
                    <h4 class="footer-heading">
                        @translate('Contact Info', 'home', 'footer.contact_title')
                    </h4>
                    <ul class="footer-contact-list">
                        <li>
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Banyumas, Central Java, Indonesia</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope-fill"></i>
                            <a href="mailto:inquiry@banyumasbonanza.com">inquiry@banyumasbonanza.com</a>
                        </li>
                        <li>
                            <i class="bi bi-whatsapp"></i>
                            <a href="https://wa.me/6287851708758" target="_blank" rel="noopener">+62 878-5170-8758</a>
                        </li>
                        {{-- <li>
                            <i class="bi bi-whatsapp"></i>
                            <a href="https://wa.me/628954229199" target="_blank" rel="noopener">+62 895-4229-199</a>
                        </li> --}}
                        <li>
                            <i class="bi bi-clock-fill"></i>
                            <span>Mon – Fri, 08.00 – 17.00 WIB</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} <strong>CV. Banyumas Bonanza Indonesia</strong>.
                    @translate('All rights reserved.', 'home', 'footer.copyright')
                </p>
                <p class="footer-credit">
                    @translate('Crafted with', 'home', 'footer.credit')
                    <i class="bi bi-heart-fill text-danger mx-1"></i>
                    @translate('in Banyumas, Central Java.', 'home', 'footer.credit_end')
                </p>
            </div>
        </div>
    </div>

</footer>
