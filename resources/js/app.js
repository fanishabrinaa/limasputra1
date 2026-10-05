// Satu observer permanen untuk seluruh halaman - dibuat sekali, tidak pernah di-disconnect/dibuat ulang.
const scrollObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('lp-visible');
                scrollObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.15 }
);

function observeScrollElements(root = document) {
    // Mengamati elemen animasi agar tampil saat masuk ke area layar.
    root.querySelectorAll(
        '.lp-scroll:not(.lp-visible), .lp-reveal:not(.lp-visible), .lp-scroll-left:not(.lp-visible), .lp-scroll-right:not(.lp-visible), .lp-scroll-zoom:not(.lp-visible), .lp-scroll-rotate:not(.lp-visible)'
    ).forEach((el) => {
        scrollObserver.observe(el);
    });
}

// MutationObserver untuk mendeteksi elemen baru atau class yang diubah Livewire.
const domWatcher = new MutationObserver(() => {
    observeScrollElements();
});

let domWatcherStarted = false;

function initScrollAnimation() {
    // Memasang pengamat halaman agar elemen baru dari Livewire ikut dianimasikan.
    observeScrollElements();

    if (!domWatcherStarted) {
        domWatcher.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class']
        });

        domWatcherStarted = true;
    }
}

function initMobileMenu() {
    // Mengatur buka-tutup menu navigasi pada layar kecil.
    const toggle = document.querySelector('[data-mobile-menu-toggle]');
    const menu = document.querySelector('#mobile-menu');
    const close = document.querySelector('[data-mobile-menu-close]');

    if (!toggle || !menu || toggle.dataset.mobileMenuReady === 'true') {
        return;
    }

    const setMenuState = (isOpen) => {
        menu.classList.toggle('hidden', !isOpen);
        toggle.setAttribute('aria-expanded', String(isOpen));
        document.body.classList.toggle('overflow-hidden', isOpen);
    };

    toggle.addEventListener('click', () => {
        const isOpen = !menu.classList.contains('hidden');
        setMenuState(!isOpen);
    });

    close?.addEventListener('click', () => {
        setMenuState(false);
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            setMenuState(false);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setMenuState(false);
        }
    });

    toggle.dataset.mobileMenuReady = 'true';
}


// ==========================================
// CURSOR FOLLOWING GLOW - HERO
// ==========================================

let heroGlowReady = false;

function initHeroGlow() {
    if (heroGlowReady) return;

    document.addEventListener('mousemove', (e) => {
        document.querySelectorAll('.lp-hero-glow').forEach((heroSection) => {
            const rect = heroSection.getBoundingClientRect();

            // Cek apakah cursor sedang berada di dalam hero
            if (
                e.clientX >= rect.left &&
                e.clientX <= rect.right &&
                e.clientY >= rect.top &&
                e.clientY <= rect.bottom
            ) {
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                heroSection.style.setProperty('--cursor-x', `${x}px`);
                heroSection.style.setProperty('--cursor-y', `${y}px`);
            }
        });
    });

    heroGlowReady = true;
}


document.addEventListener('DOMContentLoaded', initScrollAnimation);
document.addEventListener('DOMContentLoaded', initMobileMenu);
document.addEventListener('DOMContentLoaded', initHeroGlow);

document.addEventListener('livewire:navigated', initScrollAnimation);
document.addEventListener('livewire:navigated', initMobileMenu);
document.addEventListener('livewire:navigated', initHeroGlow);