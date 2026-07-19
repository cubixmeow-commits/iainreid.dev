(() => {
    'use strict';

    const header = document.querySelector('.site-header');
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('#site-nav');
    const revealItems = document.querySelectorAll('[data-reveal]');
    const desktopQuery = window.matchMedia('(min-width: 901px)');

    const updateHeader = () => {
        if (!header) return;
        header.classList.toggle('is-scrolled', window.scrollY > 24);
    };

    const setNavOpen = (open) => {
        if (!header || !toggle) return;
        header.classList.toggle('is-nav-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    };

    const closeNav = () => setNavOpen(false);

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    if (toggle && nav && header) {
        toggle.addEventListener('click', () => {
            setNavOpen(!header.classList.contains('is-nav-open'));
        });

        nav.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeNav);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeNav();
        });

        document.addEventListener('click', (event) => {
            if (!header.classList.contains('is-nav-open')) return;
            if (header.contains(event.target)) return;
            closeNav();
        });

        const handleDesktopChange = (event) => {
            if (event.matches) closeNav();
        };

        if (typeof desktopQuery.addEventListener === 'function') {
            desktopQuery.addEventListener('change', handleDesktopChange);
        } else if (typeof desktopQuery.addListener === 'function') {
            desktopQuery.addListener(handleDesktopChange);
        }
    }

    if (!('IntersectionObserver' in window)) {
        revealItems.forEach((item) => item.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries, activeObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            activeObserver.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.12,
    });

    revealItems.forEach((item) => observer.observe(item));
})();
