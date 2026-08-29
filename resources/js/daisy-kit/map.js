import '@daisy-kit/map.css';
import { getInstance, mountAll } from '@daisy-kit/map.js';

mountAll();

document.querySelectorAll('[data-doc-map-action]').forEach((button) => {
    button.addEventListener('click', () => {
        const root = button.closest('[data-daisy-kit-module="map"]');
        const map = getInstance(root);

        if (!map) return;

        if (button.dataset.docMapAction === 'view') {
            map.setView([48.1181, -1.6769], 14);
            root.dataset.docsMapFacade = 'view-updated';
        }

        if (button.dataset.docMapAction === 'invalidate') {
            map.invalidateSize();
            root.dataset.docsMapFacade = 'layout-updated';
        }
    });
});
