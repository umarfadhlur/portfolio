import './bootstrap';

const ready = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
        return;
    }

    callback();
};

ready(() => {
    const body = document.body;
    const header = document.querySelector('[data-site-header]');
    const nav = document.querySelector('[data-site-nav]');
    const navToggle = document.querySelector('[data-nav-toggle]');
    const scrollTopButton = document.querySelector('[data-scroll-top]');

    const syncScrollState = () => {
        const hasScrolled = window.scrollY > 18;
        header?.classList.toggle('scrolled', hasScrolled);
        scrollTopButton?.classList.toggle('visible', window.scrollY > 500);
    };

    syncScrollState();
    window.addEventListener('scroll', syncScrollState, { passive: true });

    const closeNavigation = () => {
        nav?.classList.remove('open');
        body.classList.remove('nav-open');
        navToggle?.setAttribute('aria-expanded', 'false');
        navToggle?.setAttribute('aria-label', 'Open navigation');
    };

    navToggle?.addEventListener('click', () => {
        const willOpen = !nav?.classList.contains('open');
        nav?.classList.toggle('open', willOpen);
        body.classList.toggle('nav-open', willOpen);
        navToggle.setAttribute('aria-expanded', String(willOpen));
        navToggle.setAttribute('aria-label', willOpen ? 'Close navigation' : 'Open navigation');
    });

    nav?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeNavigation);
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 900) {
            closeNavigation();
        }
    });

    scrollTopButton?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const revealElements = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -50px' },
        );

        revealElements.forEach((element) => revealObserver.observe(element));
    } else {
        revealElements.forEach((element) => element.classList.add('is-visible'));
    }

    const projectFilters = document.querySelector('[data-project-filters]');
    const projectCards = document.querySelectorAll('[data-project-card]');

    projectFilters?.querySelectorAll('[data-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            const filter = button.dataset.filter ?? 'all';

            projectFilters.querySelectorAll('[data-filter]').forEach((item) => {
                item.classList.toggle('active', item === button);
            });

            projectCards.forEach((card) => {
                const categories = (card.dataset.categories ?? '').split(' ');
                const shouldShow = filter === 'all' || categories.includes(filter);
                card.classList.toggle('is-hidden', !shouldShow);
            });
        });
    });

    const gallery = document.querySelector('[data-project-gallery]');
    const galleryMainImage = gallery?.querySelector('[data-gallery-main]');

    gallery?.querySelectorAll('[data-gallery-thumb]').forEach((thumbnail) => {
        thumbnail.addEventListener('click', () => {
            const nextImage = thumbnail.dataset.image;
            if (!nextImage || !galleryMainImage) return;

            gallery.querySelectorAll('[data-gallery-thumb]').forEach((item) => {
                item.classList.toggle('active', item === thumbnail);
            });

            galleryMainImage.animate(
                [
                    { opacity: 1, transform: 'scale(1)' },
                    { opacity: 0.2, transform: 'scale(0.995)' },
                ],
                { duration: 150, easing: 'ease-out' },
            ).finished.then(() => {
                galleryMainImage.src = nextImage;
                galleryMainImage.animate(
                    [
                        { opacity: 0.2, transform: 'scale(0.995)' },
                        { opacity: 1, transform: 'scale(1)' },
                    ],
                    { duration: 220, easing: 'ease-out' },
                );
            });
        });
    });

    const contactForm = document.querySelector('[data-contact-form]');
    contactForm?.addEventListener('submit', () => {
        const submitButton = contactForm.querySelector('[data-submit-button]');
        const submitLabel = contactForm.querySelector('[data-submit-label]');

        if (submitButton instanceof HTMLButtonElement) {
            submitButton.disabled = true;
            submitButton.classList.add('is-submitting');
        }

        if (submitLabel) {
            submitLabel.textContent = 'Sending...';
        }
    });
});
