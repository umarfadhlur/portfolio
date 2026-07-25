<section class="page-hero about-hero">
    <div class="shell about-hero-grid">
        <div class="reveal">
            <p class="eyebrow">About me</p>
            <h1>{{ $about->introduction ?? 'I turn complicated operational processes into software people can depend on.' }}</h1>
        </div>

        <div class="about-intro reveal reveal-delay-1">
            <p>{{ $about->summary ?? 'I am Umar, a software engineer focused on mobile applications, backend integration, and enterprise workflows. I enjoy bridging product experience with the realities of APIs, databases, ERP systems, and operational users.' }}</p>
            <div class="hero-actions">
                <a href="{{ route('portfolio') }}" class="button button-primary">See my work <span>↗</span></a>
                @if (!empty($about->pdf))
                    <a href="{{ asset('storage/' . $about->pdf) }}" target="_blank" rel="noopener noreferrer" class="button button-secondary">Download resume <span>↓</span></a>
                @else
                    <a href="{{ route('resume') }}" class="button button-secondary">View experience <span>→</span></a>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="about-profile-section section-space-small">
    <div class="shell about-profile-grid">
        <div class="about-photo-card reveal">
            <div class="about-photo-frame">
                <img src="{{ asset('assets/img/profile/umarf.png') }}" alt="Umar Fadhlurrachman">
            </div>
            <div class="about-photo-caption">
                <span class="status-dot"></span>
                Based in Indonesia · Open to opportunities
            </div>
        </div>

        <div class="about-story reveal reveal-delay-1">
            <span class="mono-label">MY ENGINEERING STORY</span>
            <h2>Mobile is my main craft. Understanding the whole system is my advantage.</h2>
            <p>I specialize in Flutter, but I do not stop at the screen. My work often includes Laravel or PHP services, REST APIs, SQL and Oracle data, payment gateways, and enterprise platforms such as JD Edwards and iDempiere.</p>
            <p>That background helps me ask better questions: where the data comes from, who owns each status, what happens when an integration fails, and how the product supports the real process—not just the ideal flow.</p>

            <dl class="about-facts">
                <div><dt>Primary focus</dt><dd>Flutter & mobile engineering</dd></div>
                <div><dt>Additional strength</dt><dd>Laravel, APIs, and integration</dd></div>
                <div><dt>Domain exposure</dt><dd>Warehouse, payment, purchasing, HRIS</dd></div>
                <div><dt>Working style</dt><dd>Agile, collaborative, production-minded</dd></div>
            </dl>
        </div>
    </div>
</section>

<section class="section-space about-capabilities-section">
    <div class="shell">
        <div class="section-heading reveal">
            <div>
                <p class="eyebrow">Capabilities</p>
                <h2>What I bring to an engineering team.</h2>
            </div>
            <p>A combination of hands-on development, workflow analysis, and cross-system problem solving.</p>
        </div>

        <div class="capability-list">
            <article class="capability-row reveal">
                <span class="mono-label">01</span>
                <h3>Build maintainable mobile applications</h3>
                <p>Structured Flutter code, predictable state, reusable UI, API handling, error states, and performance-conscious delivery.</p>
            </article>
            <article class="capability-row reveal">
                <span class="mono-label">02</span>
                <h3>Connect products to business systems</h3>
                <p>Translate ERP, payment, database, and backend constraints into stable integration flows and understandable user experiences.</p>
            </article>
            <article class="capability-row reveal">
                <span class="mono-label">03</span>
                <h3>Communicate across technical contexts</h3>
                <p>Collaborate with business users, consultants, backend engineers, QA, and stakeholders while keeping implementation details grounded.</p>
            </article>
        </div>
    </div>
</section>

@if (isset($skills) && count($skills))
    @include('about.section-skill')
@endif

<section class="section-space-small">
    <div class="shell">
        <div class="cta-panel reveal">
            <div>
                <p class="eyebrow">Let’s build something useful</p>
                <h2>I am ready for a role with real product ownership and technical depth.</h2>
            </div>
            <div>
                <p>Mobile Engineer, Flutter Developer, or software roles involving integration and enterprise workflows.</p>
                <a href="{{ route('contact') }}" class="button button-light">Get in touch <span>↗</span></a>
            </div>
        </div>
    </div>
</section>
