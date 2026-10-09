document.addEventListener('DOMContentLoaded', () => {
    const lightbox = document.getElementById('book-cover-lightbox');
    const lightboxImage = lightbox?.querySelector('[data-book-lightbox-image]');
    const closeButton = lightbox?.querySelector('[data-close-book-lightbox]');
    if (!lightbox || !lightboxImage || !closeButton) return;

    let previousFocus = null;
    let previousOverflow = '';

    function closeLightbox() {
        if (lightbox.hidden) return;
        lightbox.hidden = true;
        lightboxImage.removeAttribute('src');
        document.body.style.overflow = previousOverflow;
        if (previousFocus?.isConnected) previousFocus.focus();
    }

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('.js-book-cover-open');
        if (!trigger) return;

        const sourceImage = trigger.querySelector('img');
        const source = sourceImage?.currentSrc || sourceImage?.src;
        if (!source || (sourceImage.complete && sourceImage.naturalWidth === 0)) return;

        event.preventDefault();
        event.stopPropagation();
        previousFocus = trigger;
        previousOverflow = document.body.style.overflow;
        lightboxImage.src = source;
        lightboxImage.alt = sourceImage.alt || 'غلاف الكتاب';
        lightbox.hidden = false;
        document.body.style.overflow = 'hidden';
        closeButton.focus();
    });

    closeButton.addEventListener('click', closeLightbox);

    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !lightbox.hidden) closeLightbox();
    });
});
