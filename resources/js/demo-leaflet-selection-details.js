function onReady(callback) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });

        return;
    }

    callback();
}

function selectionSummary(count) {
    return `${count} objet${count > 1 ? 's' : ''} sélectionné${count > 1 ? 's' : ''}.`;
}

function setEditorValue(editor, value) {
    if (!editor) return;

    if (window.DaisyCodeEditor?.init && !editor.__cmView) {
        window.DaisyCodeEditor.init(editor);
    }

    if (window.DaisyCodeEditor?.setValue) {
        window.DaisyCodeEditor.setValue(editor, value);

        return;
    }

    const textarea = editor.querySelector('textarea[data-sync]');

    if (textarea) {
        textarea.value = value;
    }
}

function initLeafletSelectionDemo(wrapper) {
    if (wrapper.__leafletSelectionDemoReady) return;

    const mapRoot = wrapper.querySelector('[data-module="leaflet"]');
    const modal = wrapper.querySelector('#demo-leaflet-selection-modal');
    const editor = wrapper.querySelector('#demo-leaflet-selection-json');
    const summary = wrapper.querySelector('[data-leaflet-selection-summary]');

    if (!mapRoot || !modal || !editor) return;

    wrapper.__leafletSelectionDemoReady = true;

    mapRoot.addEventListener('daisy:leaflet:selection-details', (event) => {
        const detail = event.detail || {};
        const payload = {
            count: detail.count || 0,
            featureIds: detail.featureIds || [],
            features: detail.features || [],
        };

        if (summary) {
            summary.textContent = selectionSummary(payload.count);
        }

        setEditorValue(editor, JSON.stringify(payload, null, 2));
        modal.showModal?.();
    });
}

function initAllLeafletSelectionDemos() {
    document.querySelectorAll('[data-leaflet-selection-demo]').forEach(initLeafletSelectionDemo);
}

onReady(initAllLeafletSelectionDemos);

document.addEventListener('daisy:navigation', initAllLeafletSelectionDemos);
