function clone(value) {
    return JSON.parse(JSON.stringify(value));
}

function fieldValue(field) {
    if (field.dataset.blueprintField === 'channels') {
        return field.value.split(',').map(value => value.trim()).filter(Boolean);
    }

    if (field.type === 'checkbox') {
        return field.checked;
    }

    if (field.type === 'number') {
        return Number(field.value);
    }

    return field.value;
}

function setFieldValue(field, value) {
    if (field.dataset.blueprintField === 'channels') {
        field.value = Array.isArray(value) ? value.join(', ') : '';

        return;
    }

    if (field.type === 'checkbox') {
        field.checked = Boolean(value);

        return;
    }

    field.value = value ?? '';
}

document.querySelectorAll('[data-demo-blueprint-inspector]').forEach(root => {
    const blueprint = root.closest('[data-blueprint]');
    const fields = [...root.querySelectorAll('[data-blueprint-field]')];
    let session = null;
    let draft = null;

    blueprint.addEventListener('daisy:blueprint:inspector-open', event => {
        session = event.detail;
        draft = clone(session.value);

        fields.forEach(field => {
            const key = field.dataset.blueprintField;
            setFieldValue(field, key === 'category' ? draft.category : draft.data[key]);
        });
    });

    fields.forEach(field => {
        field.addEventListener('input', () => {
            if (!session || !draft) {
                return;
            }

            const key = field.dataset.blueprintField;

            if (key === 'category') {
                draft.category = fieldValue(field);
            } else {
                draft.data[key] = fieldValue(field);
            }

            session.setDraft(draft);
        });

        field.addEventListener('change', () => field.dispatchEvent(new Event('input')));
    });

    root.querySelector('[data-blueprint-action="save"]')?.addEventListener('click', () => {
        session?.commit(draft);
    });

    root.querySelector('[data-blueprint-action="cancel"]')?.addEventListener('click', () => {
        session?.cancel('integrator');
    });

    ['daisy:blueprint:inspector-commit', 'daisy:blueprint:inspector-cancel'].forEach(event => {
        blueprint.addEventListener(event, () => {
            session = null;
            draft = null;
        });
    });
});
