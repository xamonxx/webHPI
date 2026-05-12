(() => {
    const onReady = (callback) => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, { once: true });
        } else {
            callback();
        }
    };

    onReady(() => {
        const revealItems = document.querySelectorAll('[data-aos]');
        if (revealItems.length > 0) {
            if (!('IntersectionObserver' in window)) {
                revealItems.forEach((item) => item.classList.add('aos-animate'));
            } else {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;

                        entry.target.classList.add('aos-animate');
                        observer.unobserve(entry.target);
                    });
                }, {
                    rootMargin: '0px 0px -48px 0px',
                    threshold: 0.08
                });

                revealItems.forEach((item) => observer.observe(item));
            }
        }

        document.querySelectorAll('a[href^="#"], a[href*="/#"]').forEach((anchor) => {
            anchor.addEventListener('click', (event) => {
                const href = anchor.getAttribute('href');
                if (!href || href === '#') return;

                const url = new URL(href, window.location.origin);
                const samePath = url.pathname.replace(/\/index\.php$/, '/') === window.location.pathname.replace(/\/index\.php$/, '/');
                if (!samePath || !url.hash) return;

                const target = document.getElementById(url.hash.slice(1));
                if (!target) return;

                event.preventDefault();
                window.scrollTo({
                    top: target.getBoundingClientRect().top + window.scrollY - 80,
                    behavior: 'smooth'
                });
            }, { passive: false });
        });

        const counters = document.querySelectorAll('.counter');
        if (counters.length > 0 && 'IntersectionObserver' in window) {
            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-target'), 10) || 0;
                const suffix = counter.getAttribute('data-suffix') || '';
                const duration = 1200;
                const start = performance.now();

                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    counter.textContent = Math.floor(target * progress) + suffix;

                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    }
                };

                requestAnimationFrame(tick);
            };

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;

                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                });
            }, { threshold: 0.5 });

            counters.forEach((counter) => counterObserver.observe(counter));
        }

        const backToTop = document.getElementById('back-to-top');
        if (backToTop) {
            let ticking = false;
            const updateBackToTop = () => {
                const visible = window.scrollY > 500;
                backToTop.classList.toggle('opacity-0', !visible);
                backToTop.classList.toggle('invisible', !visible);
                ticking = false;
            };

            window.addEventListener('scroll', () => {
                if (ticking) return;

                ticking = true;
                requestAnimationFrame(updateBackToTop);
            }, { passive: true });
        }
    });
})();
