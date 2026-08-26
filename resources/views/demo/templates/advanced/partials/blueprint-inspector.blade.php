<div class="grid gap-4" data-demo-blueprint-inspector>
    <label class="form-control gap-1">
        <span class="label-text">Responsable</span>
        <input type="text" class="input input-bordered" data-blueprint-field="owner">
    </label>

    <label class="form-control gap-1">
        <span class="label-text">Délai cible (heures)</span>
        <input type="number" min="1" max="168" class="input input-bordered" data-blueprint-field="sla_hours">
    </label>

    <label class="form-control gap-1">
        <span class="label-text">Priorité</span>
        <select class="select select-bordered" data-blueprint-field="priority">
            <option value="normal">Normale</option>
            <option value="high">Haute</option>
            <option value="critical">Critique</option>
        </select>
    </label>

    <label class="label cursor-pointer justify-start gap-3">
        <input type="checkbox" class="checkbox" data-blueprint-field="requires_review">
        <span class="label-text">Relecture obligatoire</span>
    </label>

    <label class="form-control gap-1">
        <span class="label-text">Canaux (séparés par des virgules)</span>
        <input type="text" class="input input-bordered" data-blueprint-field="channels">
    </label>

    <label class="form-control gap-1">
        <span class="label-text">Règle d’éligibilité</span>
        <textarea class="textarea textarea-bordered" rows="3" data-blueprint-field="eligibility_rule"></textarea>
    </label>

    <label class="form-control gap-1">
        <span class="label-text">Recommandation</span>
        <textarea class="textarea textarea-bordered" rows="3" data-blueprint-field="recommendation"></textarea>
    </label>

    <label class="form-control gap-1">
        <span class="label-text">Catégorie</span>
        <select name="category" class="select select-bordered" data-blueprint-field="category">
            @foreach ($nodeCategories as $category)
                <option value="{{ $category['value'] }}">{{ $category['label'] }}</option>
            @endforeach
        </select>
    </label>

    <div class="flex justify-end gap-2">
        <button type="button" class="btn" data-blueprint-action="cancel">Annuler</button>
        <button type="button" class="btn btn-primary" data-blueprint-action="save">Enregistrer</button>
    </div>
</div>
