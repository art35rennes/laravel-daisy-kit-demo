@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getTemplateNavigationItems($prefix);
@endphp

<x-daisy::layout.docs title="Form Kit (démo)" :sidebarItems="$navItems" :currentRoute="request()->path()">
    <x-slot:navbar>
        <x-daisy::ui.overlay.dropdown label="Templates" buttonClass="btn btn-sm btn-ghost" end>
            <li><a href="/{{ $prefix }}">Docs</a></li>
            <li><a href="{{ route('demo') }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates" class="menu-active">Templates</a></li>
        </x-daisy::ui.overlay.dropdown>
    </x-slot:navbar>

    <section id="intro">
        <h1>Form Kit (démo applicative)</h1>
        <p class="text-base-content/70">
            Ce flux n’est pas un template publié sous <code>daisy::templates.*</code> : il vit dans la démo sous
            <code>resources/views/demo/templates/forms/form-kit-builder.blade.php</code> et
            <code>resources/views/demo/templates/forms/form-kit-viewers.blade.php</code>, qui composent les composants package
            <code>x-daisy::forms.viewer</code> et <code>x-daisy::forms.builder</code>.
        </p>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('templates.forms.form-kit-builder') }}" class="btn btn-primary btn-sm">Ouvrir le template builder</a>
            <a href="{{ route('templates.forms.form-kit-viewers') }}" class="btn btn-primary btn-sm">Ouvrir le template viewers</a>
            <a href="/{{ $prefix }}/forms/viewer" class="btn btn-ghost btn-sm">Doc Form viewer</a>
            <a href="/{{ $prefix }}/forms/builder" class="btn btn-ghost btn-sm">Doc Form builder</a>
        </div>
    </section>

    <section id="routes" class="mt-10">
        <h2>Routes</h2>
        <div class="mockup-code mt-4">
            <pre data-prefix=""><code>{{ route('templates.forms.form-kit') }}</code></pre>
            <pre data-prefix=""><code>{{ route('templates.forms.form-kit-builder') }}</code></pre>
            <pre data-prefix=""><code>{{ route('templates.forms.form-kit-viewers') }}</code></pre>
        </div>
        <p class="mt-4 text-sm text-base-content/70">
            Noms Laravel : <code class="kbd kbd-sm">templates.forms.form-kit</code>,
            <code class="kbd kbd-sm">templates.forms.form-kit-builder</code> et
            <code class="kbd kbd-sm">templates.forms.form-kit-viewers</code> — définis dans
            <code>routes/web.php</code> du projet démo.
        </p>
    </section>

    <section id="composition" class="mt-10">
        <h2>Composition recommandée</h2>
        <ul class="list-inside list-disc space-y-2 text-sm text-base-content/80">
            <li>Servez un schéma stable depuis votre contrôleur ou une entrée CMS ; passez-le au viewer pour la saisie et au builder pour l’édition.</li>
            <li>Réutilisez les classes <code class="kbd kbd-xs">Art35rennes\DaisyKit\FormKit\*</code> pour valider schéma et payload côté PHP.</li>
            <li>Utilisez la preview intégrée du builder pour authorer, puis les viewers autonomes pour les parcours édition et lecture seule.</li>
            <li>Écoutez <code class="kbd kbd-xs">daisy-form:submit</code> côté viewer et postez le textarea caché <code class="kbd kbd-xs">name="schema"</code> côté builder pour persister le JSON canonique.</li>
            <li>Stockez les réglages de composants dans <code class="kbd kbd-xs">attrs.*</code> et <code class="kbd kbd-xs">ui.*</code> : le viewer les transmet aux composants du package, par exemple <code class="kbd kbd-xs">x-daisy::ui.inputs.sign</code>.</li>
        </ul>
    </section>

    <section id="architecture" class="mt-10">
        <h2>Architecture d’intégration</h2>
        <div class="mt-4 grid gap-4 lg:grid-cols-3">
            <article class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Builder</h3>
                <p class="mt-2 text-sm text-base-content/70">
                    <code class="kbd kbd-xs">x-daisy::forms.builder</code> monte un composant Livewire. Il édite le
                    schéma canonique, affiche les diagnostics, rend la vraie preview viewer et expose un JSON exportable.
                    Le JavaScript ne pilote que les gestes transitoires comme le drag.
                </p>
            </article>
            <article class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Viewer</h3>
                <p class="mt-2 text-sm text-base-content/70">
                    <code class="kbd kbd-xs">x-daisy::forms.viewer</code> reçoit <code class="kbd kbd-xs">schema</code>
                    et <code class="kbd kbd-xs">value</code>. Le Blade rend les composants du package, puis le runtime JS
                    applique visibilité, computed, validation client, steps et événements d’intégration.
                </p>
            </article>
            <article class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Host Laravel</h3>
                <p class="mt-2 text-sm text-base-content/70">
                    L’application conserve la persistance, les autorisations, la soumission finale et l’évaluation JSONata
                    serveur. Elle peut stocker le JSON du builder, le relire plus tard et brancher ses traitements sur les
                    événements ou l’API du viewer.
                </p>
            </article>
        </div>
        <div class="mockup-code mt-4">
<pre data-prefix="1"><code>$schema = $formDefinition-&gt;schema;</code></pre>
<pre data-prefix="2"><code>&lt;x-daisy::forms.builder name="schema" :schema="$schema" /&gt;</code></pre>
<pre data-prefix="3"><code>&lt;x-daisy::forms.viewer id="quote-viewer" :schema="$schema" :value="$draft" validate-on="change" /&gt;</code></pre>
<pre data-prefix="4"><code>window.DaisyFormViewer.get('quote-viewer').on('daisy-form:submit', handler);</code></pre>
        </div>
    </section>

    <section id="viewer-api" class="mt-10">
        <h2>API JavaScript du viewer</h2>
        <p class="mt-2 text-sm text-base-content/70">
            Chaque viewer expose un runtime identifié par <code class="kbd kbd-xs">data-form-id</code> dans
            <code class="kbd kbd-xs">window.DaisyFormViewer</code>. Cette API sert à l’intégration host : écouter les événements,
            manipuler les valeurs, déclencher validation ou soumission, sans remplacer le rendu Blade du package.
        </p>
        <div class="mockup-code mt-4">
<pre data-prefix=""><code>const runtime = window.DaisyFormViewer.get('quote-viewer');

runtime.on('daisy-form:submit', (event) => {
    console.log(event.detail.values);
});

await runtime.setValue('quantity', 3);
await runtime.validate();</code></pre>
        </div>
        <ul class="mt-4 list-inside list-disc space-y-2 text-sm text-base-content/80">
            <li>Valeurs : <code class="kbd kbd-xs">getValues()</code>, <code class="kbd kbd-xs">getValue()</code>, <code class="kbd kbd-xs">setValue()</code>, <code class="kbd kbd-xs">setValues()</code>, <code class="kbd kbd-xs">reset()</code>, <code class="kbd kbd-xs">serialize()</code>.</li>
            <li>Validation : <code class="kbd kbd-xs">validate()</code>, <code class="kbd kbd-xs">isValid()</code>, <code class="kbd kbd-xs">getErrors()</code>, <code class="kbd kbd-xs">setErrors()</code>, <code class="kbd kbd-xs">clearErrors()</code>, <code class="kbd kbd-xs">getValidateOn()</code>.</li>
            <li>Structure : <code class="kbd kbd-xs">getSchema()</code>, <code class="kbd kbd-xs">getField()</code>, <code class="kbd kbd-xs">getInput()</code>, <code class="kbd kbd-xs">getVisibleFields()</code>.</li>
            <li>Soumission et lecture seule : <code class="kbd kbd-xs">getSubmitMode()</code>, <code class="kbd kbd-xs">submit()</code>, <code class="kbd kbd-xs">data-readonly="true"</code>, <code class="kbd kbd-xs">isReadonly()</code>.</li>
            <li>Navigation : <code class="kbd kbd-xs">getStep()</code>, <code class="kbd kbd-xs">setStep()</code>, <code class="kbd kbd-xs">nextStep()</code>, <code class="kbd kbd-xs">previousStep()</code>.</li>
            <li>Cycle de vie : <code class="kbd kbd-xs">daisy-form:ready</code>, <code class="kbd kbd-xs">daisy-form:change</code>, <code class="kbd kbd-xs">daisy-form:invalid</code>, <code class="kbd kbd-xs">daisy-form:submit</code>, <code class="kbd kbd-xs">daisy-form:step-change</code>, <code class="kbd kbd-xs">daisy-form:destroy</code>.</li>
        </ul>
    </section>

    <section id="snippet" class="mt-10">
        <h2>Extrait Blade (référence)</h2>
        <div class="mockup-code mt-4">
<pre data-prefix=""><code>&lt;x-daisy::layout.navbar-layout title="Form Kit"&gt;
    &lt;!-- form-kit-builder.blade.php --&gt;
    &lt;x-daisy::forms.builder name="schema_live" :schema="$schema" :value="$data" :preview="true" :jsonEditor="true" /&gt;
&lt;/x-daisy::layout.navbar-layout&gt;

&lt;x-daisy::layout.navbar-layout title="Form Kit - Viewers"&gt;
    &lt;!-- form-kit-viewers.blade.php --&gt;
    &lt;x-daisy::forms.viewer :schema="$schema" :value="$data" validate-on="change" /&gt;
    &lt;x-daisy::forms.viewer :schema="$schema" :value="$data" :readonly="true" submit-mode="none" /&gt;
&lt;/x-daisy::layout.navbar-layout&gt;</code></pre>
        </div>
        <p class="mt-4 text-sm text-base-content/70">
            Copiez la vue démo pour adapter titres, schémas et actions ; évitez de dupliquer la logique métier dans le package.
        </p>
    </section>
</x-daisy::layout.docs>
