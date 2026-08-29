import '@daisy-kit/file-preview.css';
import { getInstance, mountAll } from '@daisy-kit/file-preview.js';

mountAll();

document.querySelectorAll('[data-file-preview-open-external]').forEach((button) => {
    button.addEventListener('click', () => {
        const instance = button.dataset.filePreviewOpenExternal;
        const root = document.querySelector(`[data-file-preview-instance="${CSS.escape(instance)}"]`);

        if (root) getInstance(root)?.open(button);
    });
});
