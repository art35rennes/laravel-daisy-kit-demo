@php
    use App\Helpers\DocsHelper;

    $category = 'forms';
    $name = 'viewer';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'submit', 'label' => 'Modes de soumission'],
        ['id' => 'values-errors', 'label' => 'Valeurs et erreurs Laravel'],
        ['id' => 'jsonata', 'label' => 'JSONata et champs calculés'],
        ['id' => 'events', 'label' => 'Événements navigateur'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $demoSchema = [
        'version' => '1.0',
        'id' => 'docs-contact',
        'meta' => [
            'title' => 'Formulaire exemple',
            'description' => 'Rendu serveur à partir d’un schéma JSON ; interactions gérées par form-viewer.',
        ],
        'fields' => [
            ['id' => 'email', 'type' => 'email', 'name' => 'email', 'label' => 'Email', 'rules' => ['required', 'email']],
            ['id' => 'notes', 'type' => 'textarea', 'name' => 'notes', 'label' => 'Message', 'rules' => ['nullable', 'max:500']],
            [
                'id' => 'computed_demo',
                'type' => 'number',
                'name' => 'computed_demo',
                'label' => 'Valeur calculée (JSONata)',
                'computed' => [
                    'type' => 'jsonata',
                    'expression' => '1 + 1',
                    'dependsOn' => [],
                    'mode' => 'readonly',
                ],
            ],
        ],
        'submit' => ['mode' => 'none', 'label' => 'Envoyer'],
    ];

    $schemaWithSubmitEvent = [
        'version' => '1.0',
        'id' => 'docs-event-submit',
        'meta' => ['title' => 'Soumission événement'],
        'fields' => [
            ['id' => 'topic', 'type' => 'text', 'name' => 'topic', 'label' => 'Sujet', 'rules' => ['required', 'max:80']],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Émettre daisy-form:submit'],
    ];

    $docsPrefix = trim((string) config('daisy-kit.docs.prefix', 'docs'), '/');
@endphp

<x-daisy::docs.page
    title="Form viewer"
    category="forms"
    name="viewer"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Form viewer"
            subtitle="Coque formulaire rendue côté serveur à partir du schéma Daisy Form Kit : hydration JS sur data-module form-viewer, valeurs initiales, erreurs Laravel via FormErrorBagMapper, validation progressive et modes de soumission alignés sur le runtime navigateur."
            jsModule="form-viewer"
        />
        <div class="not-prose mt-6 space-y-3">
            <div class="alert alert-info alert-soft">
                <div class="space-y-2 text-sm">
                    <p class="font-medium">Place dans le flux Form Kit</p>
                    <ul class="list-inside list-disc space-y-1 opacity-90">
                        <li><strong>Viewer</strong> : rendu utilisateur et interactions (JSONata, visibilité, règles).</li>
                        <li><strong>Builder</strong> : authoring du même schéma JSON.</li>
                        <li><strong>Serveur</strong> : `FormSchemaValidator`, `LaravelRuleMapper`, `FormSubmissionEvaluator`, `FormErrorBagMapper` dans `Art35rennes\DaisyKit\FormKit\*`.</li>
                    </ul>
                </div>
            </div>
            <p class="text-sm text-base-content/75">
                Démo combinée :
                <a href="{{ route('templates.forms.form-kit') }}" class="link link-primary">page interactive Form Kit</a>
                · Doc template :
                <a href="{{ url('/'.$docsPrefix.'/templates/form/form-kit') }}" class="link link-primary">Form Kit (démo)</a>
                ·
                <a href="{{ url('/'.$docsPrefix.'/forms/builder') }}" class="link link-primary">Form builder</a>
            </p>
        </div>
    </x-slot:intro>

    <x-daisy::docs.sections.example name="viewer">
        <x-slot:preview>
            <div class="max-w-xl rounded-box border border-base-300 bg-base-100 p-4">
                <x-daisy::forms.viewer
                    :schema="$demoSchema"
                    :value="['email' => 'demo@example.com']"
                    submitMode="none"
                    action="#"
                    method="POST"
                />
            </div>
            <p class="mt-2 text-sm text-base-content/70">
                <code class="kbd kbd-sm">submitMode="none"</code> masque le bouton et évite tout finalize côté JS — pratique pour la doc ou les aperçus en lecture presque seule.
            </p>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::forms.viewer
    :schema="$schema"
    :value="['email' => 'jane@example.com']"
    :errors="$errors"
    submitMode="event"
    action="{{ route('contact.store') }}"
    method="POST"
    validate-on="submit"
/>
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$baseCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="submit" title="Modes de soumission" class="mt-10">
        <div class="not-prose space-y-4 text-sm leading-relaxed">
            <p class="text-base-content/80">
                Le mode effectif est <code class="kbd kbd-xs">submitMode</code> Blade si fourni, sinon <code class="kbd kbd-xs">$schema['submit']['mode']</code>, avec repli sur <code class="kbd kbd-xs">event</code>
                (<code class="kbd kbd-xs">resources/js/form-kit/runtime.js</code>).
            </p>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Mode</th>
                            <th>Comportement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code class="kbd kbd-xs">none</code></td>
                            <td>Pas de finalisation : soumission HTML stoppée si l’utilisateur envoie quand même ; champons visibles sans bouton lorsque le schéma a <code class="kbd kbd-xs">submit.mode = none</code>.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">event</code></td>
                            <td>Validation client puis <code class="kbd kbd-xs">daisy-form:submit</code> avec <code class="kbd kbd-xs">detail.values</code> et <code class="kbd kbd-xs">detail.schema</code> (SPA, logging, preview).</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">html</code></td>
                            <td>Après validation, <code class="kbd kbd-xs">HTMLFormElement.submit()</code> classique — garde cookies CSRF Laravel.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">fetch</code></td>
                            <td>POST asynchrone paramétré par le runtime (action / method) puis toujours émission de <code class="kbd kbd-xs">daisy-form:submit</code> après la requête réseau.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-warning alert-soft text-sm">
                Les attributs <code class="kbd kbd-xs">action</code> et <code class="kbd kbd-xs">method</code> du composant alimentent le <code class="kbd kbd-xs">&lt;form&gt;</code> ; pour <code class="kbd kbd-xs">GET</code>, le composant n’injecte pas <code class="kbd kbd-xs">@csrf</code>.
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="values-errors" title="Valeurs et erreurs Laravel" class="mt-10">
        <div class="not-prose space-y-4 text-sm leading-relaxed">
            <ul class="list-inside list-disc space-y-2 text-base-content/80">
                <li><code class="kbd kbd-xs">:value</code> — tableau (ou JSON) des valeurs initiales, clés = <code class="kbd kbd-xs">name</code> des champs (ou <code class="kbd kbd-xs">id</code> en secours).</li>
                <li>
                    <code class="kbd kbd-xs">:errors</code> — soit un <code class="kbd kbd-xs">MessageBag</code> Laravel (mappé via <code class="kbd kbd-xs">FormErrorBagMapper</code>), soit un tableau
                    <code class="kbd kbd-xs">[ clé => string|string[] ]</code> déjà compatible avec le viewer.
                </li>
                <li>Les trois blocs JSON embarqués (<code class="kbd kbd-xs">data-form-schema</code>, <code class="kbd kbd-xs">data-form-value</code>, <code class="kbd kbd-xs">data-form-errors-payload</code>) servent au module <code class="kbd kbd-xs">form-viewer</code>.</li>
                <li><code class="kbd kbd-xs">validate-on</code> (défaut <code class="kbd kbd-xs">submit</code>) pilote réellement le runtime : <code class="kbd kbd-xs">input</code> valide à chaque saisie, <code class="kbd kbd-xs">change</code> valide au changement, <code class="kbd kbd-xs">submit</code> valide seulement avant finalisation.</li>
                <li><code class="kbd kbd-xs">readonly</code> empêche l’édition côté Blade (champs rendus en lecture seule).</li>
            </ul>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="jsonata" title="JSONata et champs calculés" class="mt-10">
        <div class="not-prose space-y-4 text-sm leading-relaxed">
            <p class="text-base-content/80">
                Les expressions du schéma sont évaluées dans le navigateur (<code class="kbd kbd-xs">jsonata-engine.js</code>) avec un contexte contenant <code class="kbd kbd-xs">values</code>, <code class="kbd kbd-xs">field</code>, <code class="kbd kbd-xs">visible</code> et <code class="kbd kbd-xs">meta</code>.
                Les champs cachés par <code class="kbd kbd-xs">visibleWhen</code> ne bloquent pas la soumission.
            </p>
            <ul class="list-inside list-disc space-y-2 text-base-content/80">
                <li><code class="kbd kbd-xs">computed.mode = readonly</code> — la valeur calculée remplace régulièrement l’entrée utilisateur après chaque rafraîchissement.</li>
                <li><code class="kbd kbd-xs">computed.mode = suggested</code> — remplit tant que l’utilisateur n’a pas saisi de valeur.</li>
                <li>Une erreur JSONata ajoute un message dans le sac d’erreurs du champ concerné.</li>
            </ul>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="events" title="Événements navigateur" class="mt-10">
        <div class="not-prose space-y-3 text-sm">
            <p class="text-base-content/80">
                Le viewer attache le runtime sur le nœud <code class="kbd kbd-xs">data-module="form-viewer"</code>. Les événements bulles suivants sont émis sur le <code class="kbd kbd-xs">&lt;form&gt;</code> :
            </p>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Événement</th>
                            <th>Détail (<code class="kbd kbd-xs">event.detail</code>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code class="kbd kbd-xs">daisy-form:ready</code></td>
                            <td><code class="kbd kbd-xs">runtime</code>, <code class="kbd kbd-xs">schema</code>, <code class="kbd kbd-xs">values</code> après premier <code class="kbd kbd-xs">refresh</code>.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">daisy-form:change</code></td>
                            <td><code class="kbd kbd-xs">values</code>, <code class="kbd kbd-xs">visible</code> à chaque interaction ou recalcul.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">daisy-form:invalid</code></td>
                            <td><code class="kbd kbd-xs">errors</code> lorsque la validation échoue avant soumission.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">daisy-form:submit</code></td>
                            <td><code class="kbd kbd-xs">values</code> sérialisés (champs visibles), <code class="kbd kbd-xs">schema</code> canonique — mode <code class="kbd kbd-xs">event</code> ou après <code class="kbd kbd-xs">fetch</code>.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">daisy-form:step-change</code></td>
                            <td><code class="kbd kbd-xs">currentStep</code> après navigation dans un schéma multi-étapes.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">daisy-form:destroy</code></td>
                            <td><code class="kbd kbd-xs">schema</code>, <code class="kbd kbd-xs">values</code> lorsque le runtime est détaché.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <pre class="rounded-box bg-base-200 p-4 text-xs leading-relaxed"><code>document.querySelector('form[data-module="form-viewer"]')
  ?.addEventListener('daisy-form:submit', (event) => {
    console.table(event.detail.values);
  });</code></pre>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <p class="font-semibold">API runtime</p>
                <p class="mt-2 text-base-content/80">
                    Le module enregistre chaque viewer dans <code class="kbd kbd-xs">window.DaisyFormViewer</code> avec l’identifiant
                    <code class="kbd kbd-xs">data-form-id</code> / <code class="kbd kbd-xs">id</code> / <code class="kbd kbd-xs">schema.id</code>. L’intégrateur peut récupérer le runtime sans maintenir un état concurrent.
                </p>
                <div class="mockup-code mt-3">
<pre data-prefix=""><code>document.getElementById('quote-viewer').addEventListener('daisy-form:ready', async (event) => {
    const runtime = event.detail.runtime;
    const registry = window.DaisyFormViewer;

    runtime.on('daisy-form:change', (changeEvent) => {
        console.log(changeEvent.detail.values);
    });

    await runtime.setValue('quantity', 3);
    await runtime.validate();
    await runtime.submit();

    console.log(runtime.serialize(), registry.get(runtime.id), registry.all());
});</code></pre>
                </div>
                <ul class="mt-3 list-inside list-disc space-y-1 text-base-content/80">
                    <li>Valeurs : <code class="kbd kbd-xs">getValues()</code>, <code class="kbd kbd-xs">getValue()</code>, <code class="kbd kbd-xs">setValue()</code>, <code class="kbd kbd-xs">setValues()</code>, <code class="kbd kbd-xs">reset()</code>, <code class="kbd kbd-xs">serialize()</code>.</li>
                    <li>Validation : <code class="kbd kbd-xs">validate()</code>, <code class="kbd kbd-xs">isValid()</code>, <code class="kbd kbd-xs">getErrors()</code>, <code class="kbd kbd-xs">setErrors()</code>, <code class="kbd kbd-xs">clearErrors()</code>, <code class="kbd kbd-xs">getValidateOn()</code>.</li>
                    <li>Structure : <code class="kbd kbd-xs">getSchema()</code>, <code class="kbd kbd-xs">getField()</code>, <code class="kbd kbd-xs">getInput()</code>, <code class="kbd kbd-xs">getVisibleFields()</code>, <code class="kbd kbd-xs">isReadonly()</code>.</li>
                    <li>Soumission : <code class="kbd kbd-xs">getSubmitMode()</code>, <code class="kbd kbd-xs">submit()</code>.</li>
                    <li>Navigation : <code class="kbd kbd-xs">getStep()</code>, <code class="kbd kbd-xs">setStep()</code>, <code class="kbd kbd-xs">nextStep()</code>, <code class="kbd kbd-xs">previousStep()</code>.</li>
                    <li>Cycle de vie : <code class="kbd kbd-xs">refresh()</code>, <code class="kbd kbd-xs">destroy()</code>, <code class="kbd kbd-xs">on()</code>, <code class="kbd kbd-xs">off()</code>.</li>
                    <li>Registry global : <code class="kbd kbd-xs">window.DaisyFormViewer.get()</code>, <code class="kbd kbd-xs">getByElement()</code>, <code class="kbd kbd-xs">all()</code>, <code class="kbd kbd-xs">unregister()</code>.</li>
                </ul>
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.variants name="viewer-variants">
        <x-slot:preview>
            <div class="max-w-xl rounded-box border border-base-300 bg-base-100 p-4">
                <x-daisy::forms.viewer
                    :schema="$schemaWithSubmitEvent"
                    :value="['topic' => 'Release notes']"
                    submitMode="event"
                    action="#"
                    method="POST"
                />
                <p class="mt-3 text-xs text-base-content/65">
                    Bouton présent ; au clic, le runtime intercepte le POST natif et émet <code class="kbd kbd-xs">daisy-form:submit</code> une fois les règles satisfaites.
                </p>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
{{-- Mode événement + bouton de soumission --}}
<x-daisy::forms.viewer
    :schema="[
        'version' => '1.0',
        'id' => 'ticket',
        'meta' => ['title' => 'Ticket'],
        'fields' => [
            ['id' => 'title', 'type' => 'text', 'name' => 'title', 'label' => 'Titre', 'rules' => ['required']],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Créer'],
    ]"
    submitMode="event"
/>
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$variantsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="240px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
