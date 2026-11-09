/*! instant.page v5.2.0 - Universal Speculative Preloader (Safari + Chrome + Firefox) */
(function() {
    'use strict';
    let mouseoverTimer;
    let lastTouchTimestamp;
    const prefetched = new Set();

    const prefetch = (url) => {
        if (!url || prefetched.has(url)) return;
        prefetched.add(url);

        // Standard link rel=prefetch
        try {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = url;
            link.as = 'document';
            document.head.appendChild(link);
        } catch (e) {}

        // Universal WebKit/Safari & Firefox HTTP cache pre-warm
        if (window.fetch) {
            try {
                fetch(url, { priority: 'low', credentials: 'include', mode: 'no-cors' }).catch(() => {});
            } catch (e) {}
        }
    };

    const isEligible = (a) => {
        if (!a || !a.href) return false;
        if (a.origin !== location.origin) return false;
        if (a.protocol !== 'http:' && a.protocol !== 'https:') return false;
        if (a.hash && (a.pathname + a.search === location.pathname + location.search)) return false;
        if (a.pathname === location.pathname && a.search === location.search) return false;
        if (a.href.indexOf('/wp-admin') !== -1 || a.href.indexOf('/wp-login') !== -1 || a.href.indexOf('action=') !== -1) return false;
        if (a.hasAttribute('download') || (a.getAttribute('rel') && a.getAttribute('rel').indexOf('nofollow') !== -1)) return false;
        if (a.getAttribute('target') === '_blank') return false;
        return true;
    };

    // Mobile: prefetch instantly on touchstart
    document.addEventListener('touchstart', (e) => {
        lastTouchTimestamp = performance.now();
        const a = e.target.closest('a');
        if (isEligible(a)) {
            prefetch(a.href);
        }
    }, { capture: true, passive: true });

    // Desktop: prefetch after 50ms hover
    document.addEventListener('mouseover', (e) => {
        if (performance.now() - lastTouchTimestamp < 1100) return;
        const a = e.target.closest('a');
        if (!isEligible(a)) return;
        mouseoverTimer = setTimeout(() => {
            prefetch(a.href);
        }, 50);
    }, { capture: true, passive: true });

    document.addEventListener('mouseout', (e) => {
        clearTimeout(mouseoverTimer);
    }, { capture: true, passive: true });
})();

