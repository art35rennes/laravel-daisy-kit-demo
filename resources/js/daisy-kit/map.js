import '@daisy-kit/map.css';
import { getInstance, mountAll } from '@daisy-kit/map.js';

mountAll();

const controlledMap = document.querySelector('#controlled-map');

controlledMap?.addEventListener('daisy-kit:map:action', (event) => {
    if (event.detail.id !== 'focus-depot') return;

    getInstance(controlledMap)?.setView([48.1181, -1.6769], 14);
    controlledMap.dataset.docsMapFacade = 'view-updated';
});

document.querySelectorAll('[data-doc-map-action]').forEach((button) => {
    button.addEventListener('click', () => {
        const root = button.closest('[data-daisy-kit-module="map"]');
        const map = getInstance(root);

        if (!map) return;

        if (button.dataset.docMapAction === 'invalidate') {
            map.invalidateSize();
            root.dataset.docsMapFacade = 'layout-updated';
        }
    });
});
