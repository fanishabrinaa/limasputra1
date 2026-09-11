function initScrollAnimation() {
    const elements = document.querySelectorAll('.lp-scroll');

    if (!elements.length) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('lp-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15
        }
    );

    elements.forEach((element) => {
        observer.observe(element);
    });
}

document.addEventListener('DOMContentLoaded', initScrollAnimation);
document.addEventListener('livewire:navigated', initScrollAnimation);