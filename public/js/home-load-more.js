document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('home-books-section');
    const results = document.getElementById('home-books-results');
    const button = document.getElementById('home-load-more');
    const wrapper = button?.closest('.fk-load-more-wrap');
    if (!section || !results || !button || !wrapper) return;

    let hasMore = !wrapper.hidden;

    button.addEventListener('click', async () => {
        if (button.disabled || !hasMore) return;

        button.disabled = true;
        button.setAttribute('aria-busy', 'true');

        try {
            const url = new URL(section.dataset.loadMoreUrl, window.location.origin);
            url.searchParams.set('load_more', '1');
            url.searchParams.set('offset', button.dataset.offset || '6');

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) throw new Error('Could not load more books.');

            const data = await response.json();
            if (data.results_html) results.insertAdjacentHTML('beforeend', data.results_html);

            button.dataset.offset = String(data.next_offset || Number(button.dataset.offset || 6));
            hasMore = Boolean(data.has_more);
            wrapper.hidden = !hasMore;
        } catch (error) {
            // Keep the control available so the visitor can retry.
        } finally {
            button.disabled = false;
            button.removeAttribute('aria-busy');
        }
    });
});
