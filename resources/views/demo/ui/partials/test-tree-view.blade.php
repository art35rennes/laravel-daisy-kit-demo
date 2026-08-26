<!-- TreeView -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">TreeView</h2>
    <p class="text-sm opacity-70">
        Contrôle de formulaire accessible avec sélection hiérarchique, recherche locale ou distante et chargement différé.
        Un nœud <code>lazy</code> appelle automatiquement l’endpoint configuré, qui doit retourner <code>{ items: [...] }</code>.
    </p>
    <div class="grid md:grid-cols-2 gap-6 items-start">
        <div class="space-y-3">
            <div class="text-sm opacity-70">Sélection simple</div>
            <x-daisy::ui.advanced.tree-view id="demoTreeSingle" name="demo_tree_single" selection="single" :persist="true" controlSize="xs" lazyUrl="/demo/api/tree-children" lazyParam="node" :search="true" :searchAuto="false" searchMin="1" searchDebounce="150" searchUrl="/demo/api/tree-search" searchParam="q" :data="[
                ['id' => 'root', 'label' => 'Racine', 'expanded' => true, 'children' => [
                    ['id' => 'a', 'label' => 'Dossier A', 'children' => [
                        ['id' => 'a1', 'label' => 'Fichier A1'],
                        ['id' => 'a2', 'label' => 'Fichier A2'],
                    ]],
                    ['id' => 'b', 'label' => 'Dossier B (lazy)', 'lazy' => true],
                    ['id' => 'c', 'label' => 'Fichier C'],
                ]],
            ]" />
            <div class="text-xs opacity-70">Événements: <code>daisy:tree-change</code>, <code>daisy:tree-load</code>, <code>daisy:tree-error</code></div>
        </div>

        <div class="space-y-3">
            <div class="text-sm opacity-70">Sélection multiple</div>
            <x-daisy::ui.advanced.tree-view id="demoTreeMulti" name="demo_tree_multi" selection="multiple" :value="['1-3-1', '2-1-1']" :persist="true" controlSize="xs" lazyUrl="/demo/api/tree-children" lazyParam="node" :search="true" :searchAuto="true" searchMin="2" searchDebounce="250" :data="[
                [
                    'id' => '1',
                    'label' => 'Projet Alpha',
                    'expanded' => true,
                    'children' => [
                        [
                            'id' => '1-1',
                            'label' => 'Kit UI',
                            'children' => [
                                ['id' => '1-1-1', 'label' => 'Roadmap.md'],
                                ['id' => '1-1-2', 'label' => 'Changelog.md (désactivé)', 'disabled' => true],
                            ],
                        ],
                        [
                            'id' => '1-2',
                            'label' => 'Site (désactivé)',
                            'disabled' => true,
                            'children' => [
                                ['id' => '1-2-1', 'label' => 'Home.vue'],
                                ['id' => '1-2-2', 'label' => 'About.vue'],
                            ],
                        ],
                        [
                            'id' => '1-3',
                            'label' => 'Sandbox (sélection partielle)',
                            'children' => [
                                ['id' => '1-3-1', 'label' => 'Draft.md'],
                                ['id' => '1-3-2', 'label' => 'Notes.md'],
                            ],
                        ],
                    ],
                ],
                [
                    'id' => '2',
                    'label' => 'Projet Beta',
                    'expanded' => true,
                    'children' => [
                        [
                            'id' => '2-1',
                            'label' => 'Documentation',
                            'children' => [
                                ['id' => '2-1-1', 'label' => 'README.md'],
                                ['id' => '2-1-2', 'label' => 'INSTALL.md'],
                            ],
                        ],
                        [
                            'id' => '2-2',
                            'label' => 'Sources',
                            'children' => [
                                ['id' => '2-2-1', 'label' => 'main.js'],
                                ['id' => '2-2-2', 'label' => 'app.vue'],
                            ],
                        ],
                        [
                            'id' => '2-3',
                            'label' => 'Dossier Lazy',
                            'lazy' => true,
                        ],
                    ],
                ],
            ]" />
        </div>
    </div>

    <div class="divider"></div>
    <div class="space-y-2">
        <div class="flex gap-2">
            <button id="btnReadSelected" type="button" class="btn btn-primary btn-sm">Lire la sélection (multi)</button>
            <button id="btnExpandB" type="button" class="btn btn-ghost btn-sm">Développer B (lazy)</button>
        </div>
        <pre id="selectedOutput" class="mockup-code w-full"><code></code></pre>
    </div>

    <div class="divider"></div>
    <div class="space-y-2">
        <div class="text-sm opacity-70">Exemple d'endpoint REST (Laravel) pour charger les enfants</div>
        <pre class="mockup-code w-full"><code class="language-php">// routes/web.php
Route::get('/demo/api/tree-children', function (\Illuminate\Http\Request $request) {
    $node = (string) $request->query('node', '');
    $data = match ($node) {
        'b' => [
            ['id' => 'b1', 'label' => 'Fichier B1'],
            // Exemple de nœud lazy imbriqué (disabled supporté)
            ['id' => 'b2', 'label' => 'Dossier B2 (lazy, disabled)', 'lazy' => true, 'disabled' => true],
            ['id' => 'b3', 'label' => 'Fichier B3'],
        ],
        'b2' => [
            ['id' => 'b2-1', 'label' => 'Fichier B2-1'],
            ['id' => 'b2-2', 'label' => 'Dossier B2-2 (avec enfants)', 'children' => [
                ['id' => 'b2-2-1', 'label' => 'Fichier B2-2-1'],
                ['id' => 'b2-2-2', 'label' => 'Fichier B2-2-2'],
            ]],
        ],
        'root' => [
            ['id' => 'r1', 'label' => 'Fichier Racine 1'],
            ['id' => 'r2', 'label' => 'Fichier Racine 2'],
        ],
        default => [
            ['id' => $node.'-1', 'label' => 'Fichier '.$node.'-1'],
            ['id' => $node.'-2', 'label' => 'Fichier '.$node.'-2'],
        ],
    };
    return response()->json(['items' => $data]);
})->name('demo.tree.children');</code></pre>
    </div>

    <script>
    (function(){
        document.addEventListener('DOMContentLoaded', () => {
            const single = document.getElementById('demoTreeSingle');
            const multi = document.getElementById('demoTreeMulti');
            const output = document.getElementById('selectedOutput')?.querySelector('code');

            function writeSelection(value) {
                if (output) {
                    output.textContent = JSON.stringify(value);
                }
            }

            if (single) {
                single.addEventListener('daisy:tree-load', ({ detail }) => writeSelection(detail));
            }

            if (multi) {
                multi.addEventListener('daisy:tree-change', ({ detail }) => writeSelection(detail));
            }

            const btnRead = document.getElementById('btnReadSelected');
            if (btnRead && multi) {
                btnRead.addEventListener('click', () => {
                    writeSelection(window.DaisyTreeView.get(multi)?.getValue() ?? []);
                });
            }

            const btnExpandB = document.getElementById('btnExpandB');
            if (btnExpandB && single) {
                btnExpandB.addEventListener('click', () => {
                    window.DaisyTreeView.get(single)?.expand('b');
                });
            }
        });
    })();
    </script>
</section>
