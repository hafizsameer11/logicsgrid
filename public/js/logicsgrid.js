(function () {
    'use strict';

    const progressBar = document.querySelector('.fixed.top-0.left-0.right-0.h-\\[3px\\]') ||
        document.querySelector('[style*="transform-origin:0% 50%"]');

    function updateScrollProgress() {
        if (!progressBar) return;
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? scrollTop / docHeight : 0;
        progressBar.style.transform = `scaleX(${Math.min(progress, 1)})`;
    }

    function initMarquee() {
        document.querySelectorAll('.marquee-track').forEach((track) => {
            if (track.dataset.cloned) return;
            track.dataset.cloned = 'true';
            track.innerHTML += track.innerHTML;
        });
    }

    function initMobileMenu() {
        const toggle = document.querySelector('[aria-label="Toggle menu"]');
        if (!toggle) return;

        let panel = document.getElementById('mobile-menu-panel');
        if (!panel) {
            panel = document.createElement('div');
            panel.id = 'mobile-menu-panel';
            panel.className = 'mobile-menu-panel lg:hidden fixed inset-x-4 top-24 z-30 rounded-3xl border bg-white p-6 shadow-xl';
            panel.style.borderColor = 'rgba(0,0,0,0.12)';
            panel.innerHTML = `
                <nav class="flex flex-col gap-4 text-[13px] tracking-[0.18em] uppercase">
                    <a href="/" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Home</a>
                    <a href="/software-development" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Software Development</a>
                    <a href="/startup-growth" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Startup Growth</a>
                    <a href="/ai-solutions" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">AI Solutions</a>
                    <a href="/venture-building" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Venture Building</a>
                    <a href="/business-digitization" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Business Digitization</a>
                    <a href="/portfolio" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Portfolio</a>
                    <a href="/about" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">About</a>
                    <a href="/team" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Team</a>
                    <a href="/industries" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Industries</a>
                    <a href="/why-logicsgrid" class="py-2 border-b" style="border-color:rgba(0,0,0,0.08)">Why LogicsGrid</a>
                    <a href="/contact" class="py-2">Contact</a>
                </nav>
                <a href="/strategy-session" class="mt-6 inline-flex w-full justify-center rounded-full px-6 py-3 text-[13px] text-black tracking-wide" style="background:#4ECDC4">Book A Strategy Session</a>
            `;
            document.body.appendChild(panel);
        }

        const lines = toggle.querySelectorAll('span');
        if (lines[0]) lines[0].setAttribute('data-menu-line-1', '');
        if (lines[1]) lines[1].setAttribute('data-menu-line-2', '');

        toggle.addEventListener('click', () => {
            document.body.classList.toggle('mobile-nav-open');
        });

        panel.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => document.body.classList.remove('mobile-nav-open'));
        });
    }

    function initNavDropdowns() {
        document.querySelectorAll('header nav .relative').forEach((wrap) => {
            const btn = wrap.querySelector('button[aria-haspopup]');
            if (!btn) return;

            const label = btn.textContent.trim().split('\n')[0];
            const links = {
                Services: [
                    ['Software Development', '/software-development'],
                    ['Startup Growth', '/startup-growth'],
                    ['AI Solutions', '/ai-solutions'],
                    ['Venture Building', '/venture-building'],
                    ['Business Digitization', '/business-digitization'],
                ],
                Company: [
                    ['About', '/about'],
                    ['Team', '/team'],
                    ['Industries', '/industries'],
                    ['Why LogicsGrid', '/why-logicsgrid'],
                ],
                Work: [
                    ['Portfolio', '/portfolio'],
                    ['Kokolet Luxury', '/portfolio/kokolet-luxury'],
                    ['BillsPro', '/portfolio/billspro-fintech'],
                    ['Colala Mall', '/portfolio/colala-mall'],
                ],
            }[label];

            if (!links) return;

            let menu = wrap.querySelector('.logicsgrid-dropdown');
            if (!menu) {
                menu = document.createElement('div');
                menu.className = 'logicsgrid-dropdown absolute left-0 top-full pt-3 opacity-0 pointer-events-none translate-y-1 transition-all duration-200';
                menu.innerHTML = `<div class="min-w-[220px] rounded-2xl border bg-white p-2 shadow-xl" style="border-color:rgba(0,0,0,0.1)">${links.map(([t, u]) => `<a href="${u}" class="block rounded-xl px-4 py-2.5 text-[12px] tracking-wide hover:bg-[#fafafa]">${t}</a>`).join('')}</div>`;
                wrap.appendChild(menu);
            }

            wrap.addEventListener('mouseenter', () => {
                menu.style.opacity = '1';
                menu.style.pointerEvents = 'auto';
                menu.style.transform = 'translateY(0)';
                btn.setAttribute('aria-expanded', 'true');
            });
            wrap.addEventListener('mouseleave', () => {
                menu.style.opacity = '0';
                menu.style.pointerEvents = 'none';
                menu.style.transform = 'translateY(4px)';
                btn.setAttribute('aria-expanded', 'false');
            });
        });
    }

    function initIndustriesTabs() {
        const buttons = Array.from(document.querySelectorAll('button')).filter((b) => /^\d{2}\s/.test(b.textContent.trim()));
        if (buttons.length < 3) return;

        const panels = [];
        buttons.forEach((btn, i) => {
            let panel = btn.closest('section')?.querySelectorAll('[data-industry-panel]')[i];
            if (!panel) {
                const section = btn.closest('section');
                if (!section) return;
                const detailBlocks = section.querySelectorAll('h3');
                panel = detailBlocks[i]?.closest('div[class*="col-span"]') || detailBlocks[i]?.parentElement;
            }
            if (panel) {
                panel.dataset.industryPanel = String(i);
                panels.push(panel);
                panel.style.display = i === 0 ? '' : 'none';
            }
            btn.addEventListener('click', () => {
                buttons.forEach((b, j) => {
                    b.style.background = j === i ? '#000' : '';
                    b.style.color = j === i ? '#4ECDC4' : '';
                });
                panels.forEach((p, j) => {
                    if (p) p.style.display = j === i ? '' : 'none';
                });
            });
        });
    }

    function initReveal() {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        document.querySelectorAll('section, article, figure').forEach((el) => {
            if (el.closest('header') || el.closest('footer')) return;
            el.classList.add('logicsgrid-reveal');
            if (!prefersReduced) {
                el.classList.add('logicsgrid-reveal--animate');
            }
        });

        if (prefersReduced) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.04, rootMargin: '0px 0px -20px 0px' }
        );

        document.querySelectorAll('.logicsgrid-reveal--animate').forEach((el) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                el.classList.add('is-visible');
            } else {
                observer.observe(el);
            }
        });
    }

    function initScreenGalleries() {
        document.querySelectorAll('section').forEach((section) => {
            const heading = section.querySelector('h2');
            if (!heading || !/screen|crafted|gallery|surfaces/i.test(heading.textContent)) return;

            const row = section.querySelector('.flex.gap-4, .flex.gap-5, .flex.gap-6, [class*="overflow-x"]');
            if (!row) return;

            row.classList.add('overflow-x-auto', 'scroll-smooth', 'pb-4');
            row.style.scrollSnapType = 'x mandatory';
            row.querySelectorAll('img').forEach((img) => {
                img.style.scrollSnapAlign = 'start';
                img.style.flexShrink = '0';
            });
        });
    }

    function initCtaLinks() {
        document.querySelectorAll('button').forEach((btn) => {
            const text = btn.textContent.trim();
            if (/Book A Strategy Session|Book a strategy/i.test(text)) {
                btn.addEventListener('click', () => { window.location.href = '/strategy-session'; });
            } else if (/Talk To Us|Email The Team|Work With Us/i.test(text)) {
                btn.addEventListener('click', () => { window.location.href = '/contact'; });
            }
        });
    }

    function initForms() {
        document.querySelectorAll('form').forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = form.querySelector('input[type="email"]');
                if (email?.value) {
                    alert('Thanks — we\'ll be in touch at ' + email.value);
                    email.value = '';
                }
            });
        });
    }

    window.addEventListener('scroll', updateScrollProgress, { passive: true });
    window.addEventListener('resize', updateScrollProgress);

    document.addEventListener('DOMContentLoaded', () => {
        initMarquee();
        initMobileMenu();
        initNavDropdowns();
        initIndustriesTabs();
        initReveal();
        initScreenGalleries();
        initCtaLinks();
        initForms();
        updateScrollProgress();
    });
})();
