/**
 * فَلَك — بحث AJAX لصفحات الموقع (الكتب / المؤلفون / المترجمون)
 * يعمل البحث فقط عند الضغط على زر البحث (أو Enter) وليس أثناء الكتابة،
 * ويحدّث النتائج والترقيم دون إعادة تحميل الصفحة بالكامل.
 */
(function () {
    'use strict';

    // كل مفتاح هنا يقابل form[data-ajax-search="key"] وعناصر النتائج المرتبطة به
    const sections = ['books', 'authors', 'translators'];

    function getEls(key) {
        return {
            form:      document.getElementById(`${key}-search-form`),
            section:   document.getElementById(`${key}-results-section`),
            grid:      document.getElementById(`${key}-results-grid`),
            pagination:document.getElementById(`${key}-pagination`),
            info:      document.getElementById(`${key}-search-info`),
        };
    }

    async function fetchResults(key, url) {
        const els = getEls(key);
        if (!els.section) return;

        els.section.classList.add('is-loading');
        els.section.style.opacity = '0.6';

        try {
            const res = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (!res.ok) {
                const errorMessage = document.createElement('div');
                errorMessage.className = 'fk-empty';
                errorMessage.textContent = els.section.dataset.errorMessage || '';
                if (els.grid) els.grid.replaceChildren(errorMessage);
                return;
            }
            const data = await res.json();

            if (els.grid) els.grid.innerHTML = data.results_html ?? '';
            if (els.pagination) els.pagination.innerHTML = data.pagination_html ?? '';
            if (els.info) els.info.innerHTML = data.info_html ?? '';

            // تحديث رابط المتصفح ليكون قابلاً للمشاركة دون إعادة تحميل الصفحة
            history.pushState({ ajaxSearch: key }, '', url);

            // تمرير سلس لأعلى قسم النتائج
            els.section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (err) {
            if (els.grid) {
                const errorMessage = document.createElement('div');
                errorMessage.className = 'fk-empty';
                errorMessage.textContent = els.section.dataset.unexpectedMessage || '';
                els.grid.replaceChildren(errorMessage);
            }
        } finally {
            els.section.classList.remove('is-loading');
            els.section.style.opacity = '';
        }
    }

    function buildUrl(baseUrl, params) {
        const url = new URL(baseUrl, window.location.origin);
        url.search = '';
        for (const [k, v] of params.entries()) {
            if (v !== '' && v !== null && v !== undefined) url.searchParams.set(k, v);
        }
        return url.toString();
    }

    sections.forEach((key) => {
        const els = getEls(key);
        if (!els.form || !els.section) return;

        const baseUrl = els.section.dataset.resultsUrl || els.form.action;

        // إرسال البحث فقط عند الضغط على زر البحث (submit) — ليس مع كل حرف يُكتب
        els.form.addEventListener('submit', (e) => {
            e.preventDefault();
            const params = new URLSearchParams(new FormData(els.form));
            fetchResults(key, buildUrl(baseUrl, params));
        });

        // اعتراض روابط الترقيم (pagination) لتحميلها عبر AJAX أيضاً
        if (els.pagination) {
            els.pagination.addEventListener('click', (e) => {
                const link = e.target.closest('a[href]');
                if (!link) return;
                e.preventDefault();
                fetchResults(key, link.href);
            });
        }

        // اعتراض رابط "إلغاء البحث" داخل شريط النتائج (يُستبدل ديناميكياً)
        if (els.info) {
            els.info.addEventListener('click', (e) => {
                const link = e.target.closest('[data-search-clear]');
                if (!link) return;
                e.preventDefault();
                els.form.querySelector('input[name="search"]').value = '';
                fetchResults(key, link.href);
            });
        }
    });

    // دعم زر الرجوع/التقدم في المتصفح لإعادة تحميل الصفحة كاملة (أبسط وأضمن)
    window.addEventListener('popstate', () => {
        window.location.reload();
    });
})();
