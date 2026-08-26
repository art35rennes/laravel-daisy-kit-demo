const themeSelect = document.querySelector('[data-theme-select]');

themeSelect?.addEventListener('change', (event) => {
    document.documentElement.dataset.theme = event.target.value;
});

const searchInputs = document.querySelectorAll('[data-doc-search]');
const navigationItems = document.querySelectorAll('[data-doc-item]');
const emptyState = document.querySelector('[data-doc-empty]');

searchInputs.forEach((input) => {
    input.addEventListener('input', (event) => {
        const query = event.target.value.trim().toLowerCase();
        let matches = 0;

        navigationItems.forEach((item) => {
            const visible = item.textContent.toLowerCase().includes(query);
            item.classList.toggle('hidden', !visible);

            if (visible) {
                matches += 1;
            }
        });

        emptyState?.classList.toggle('hidden', matches !== 0);
    });
});
