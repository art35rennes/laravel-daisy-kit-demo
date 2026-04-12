@php
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    /** @var list<array{id: string, title: string}> */
    $demoUiSections = [
        ['id' => 'demo-actions', 'title' => 'Components · Actions'],
        ['id' => 'demo-data-media', 'title' => 'Components · Data & media'],
        ['id' => 'demo-navigation', 'title' => 'Components · Navigation'],
        ['id' => 'demo-feedback', 'title' => 'Components · Feedback'],
        ['id' => 'demo-forms', 'title' => 'Components · Forms & inputs'],
        ['id' => 'demo-layout', 'title' => 'Components · Layout'],
        ['id' => 'demo-mockups', 'title' => 'Components · Mockups'],
        ['id' => 'demo-inventory', 'title' => 'Package inventory · Manifest cache'],
        ['id' => 'demo-extensions', 'title' => 'Extensions · External libraries'],
        ['id' => 'demo-js-kit', 'title' => 'JavaScript · Daisy Kit modules'],
    ];
@endphp
<x-daisy::layout.app title="DaisyUI Kit - Demo" :container="false">
    {{-- Navbar avec navigation Docs/Démo/Template --}}
    <x-daisy::ui.navigation.navbar bg="base-100" :shadow="true" fixed="false" class="border-b">
        <x-slot:start>
            <h1 class="text-lg font-semibold">DaisyUI Kit</h1>
        </x-slot:start>
        <x-slot:center>
            <div class="join">
                @if (Route::has('daisy.docs.index'))
                    <a href="{{ route('daisy.docs.index') }}" class="btn btn-sm join-item btn-ghost">Docs</a>
                @else
                    <a href="/{{ $prefix }}" class="btn btn-sm join-item btn-ghost">Docs</a>
                @endif
                <a href="{{ route('demo') }}" class="btn btn-sm join-item btn-ghost btn-active">Démo</a>
                @if (Route::has('daisy.docs.templates'))
                    <a href="{{ route('daisy.docs.templates') }}" class="btn btn-sm join-item btn-ghost">Template</a>
                @else
                    <a href="/{{ $prefix }}/templates" class="btn btn-sm join-item btn-ghost">Template</a>
                @endif
            </div>
        </x-slot:center>
        <x-slot:end>
            <x-daisy::ui.advanced.theme-controller 
                variant="dropdown" 
                :themes="['light', 'dark', 'cupcake', 'bumblebee', 'emerald', 'corporate', 'synthwave', 'retro', 'cyberpunk', 'valentine', 'halloween', 'garden', 'forest', 'aqua', 'lofi', 'pastel', 'fantasy', 'wireframe', 'black', 'luxury', 'dracula', 'cmyk', 'autumn', 'business', 'acid', 'lemonade', 'night', 'coffee', 'winter']"
                label="Theme"
                size="sm"
            />
        </x-slot:end>
    </x-daisy::ui.navigation.navbar>

    <div class="container mx-auto px-4 sm:px-6 py-4 sm:py-6">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold">DaisyUI Kit - Demo</h1>
        </div>
        <nav aria-label="Page sections" class="mb-8 rounded-box bg-base-200/80 p-3 card-border">
            <div class="text-xs font-semibold uppercase tracking-wide text-base-content/60 mb-2">Sommaire</div>
            <div class="-mx-1 overflow-x-auto pb-1">
                <ul class="menu menu-horizontal flex-nowrap gap-1 bg-transparent px-1 py-0 min-w-max">
                    @foreach ($demoUiSections as $demoSection)
                        <li>
                            <a href="#{{ $demoSection['id'] }}" class="rounded-btn whitespace-nowrap text-sm">{{ $demoSection['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    
    <!-- Sélecteur de thème flottant -->
    <div id="themePicker" class="fixed top-4 right-4 z-50 hidden md:block">
        <div id="themePickerBox" class="bg-base-100 rounded-box shadow p-3 card-border w-56 sm:w-64 max-w-[calc(100vw-2rem)]">
            <label class="form-control w-full">
                <div class="label"><span class="label-text text-xs">Thème DaisyUI</span></div>
                <select id="themeSelect" class="select select-bordered select-sm w-full">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="cupcake">Cupcake</option>
                    <option value="bumblebee">Bumblebee</option>
                    <option value="emerald">Emerald</option>
                    <option value="corporate">Corporate</option>
                    <option value="synthwave">Synthwave</option>
                    <option value="retro">Retro</option>
                    <option value="cyberpunk">Cyberpunk</option>
                    <option value="valentine">Valentine</option>
                    <option value="halloween">Halloween</option>
                    <option value="garden">Garden</option>
                    <option value="forest">Forest</option>
                    <option value="aqua">Aqua</option>
                    <option value="lofi">Lofi</option>
                    <option value="pastel">Pastel</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="wireframe">Wireframe</option>
                    <option value="black">Black</option>
                    <option value="luxury">Luxury</option>
                    <option value="dracula">Dracula</option>
                    <option value="cmyk">CMYK</option>
                    <option value="autumn">Autumn</option>
                    <option value="business">Business</option>
                    <option value="acid">Acid</option>
                    <option value="lemonade">Lemonade</option>
                    <option value="night">Night</option>
                    <option value="coffee">Coffee</option>
                    <option value="winter">Winter</option>
                </select>
            </label>
        </div>
    </div>
    <script>
        (function() {
            const THEME_KEY = 'daisy-theme';
            const htmlEl = document.documentElement;
            const themeSelect = document.getElementById('themeSelect');
            const themePicker = document.getElementById('themePicker');
            const themePickerBox = document.getElementById('themePickerBox');
            const controllers = () => Array.from(document.querySelectorAll('.theme-controller'));

            function applyTheme(theme) {
                if (!theme) return;
                htmlEl.setAttribute('data-theme', theme);
                try { localStorage.setItem(THEME_KEY, theme); } catch (_) {}
                controllers().forEach((el) => {
                    if (el.type === 'radio') {
                        el.checked = (el.value === theme);
                    } else if (el.tagName === 'SELECT') {
                        el.value = theme;
                    }
                });
            }

            function readSavedTheme() {
                try { return localStorage.getItem(THEME_KEY); } catch (_) { return null; }
            }

            function init() {
                const saved = readSavedTheme();
                const current = saved || htmlEl.getAttribute('data-theme') || 'light';
                applyTheme(current);
                if (themeSelect) themeSelect.value = current;
                adjustThemePicker();
            }

            if (themeSelect) {
                themeSelect.addEventListener('change', (e) => applyTheme(e.target.value));
            }
            document.addEventListener('change', (e) => {
                const t = e.target;
                if (t && t.classList && t.classList.contains('theme-controller')) {
                    applyTheme(t.value);
                    if (themeSelect) themeSelect.value = t.value;
                }
            });

            function adjustThemePicker(){
                if (!themePickerBox) return;
                const vw = window.innerWidth;
                // Max width: viewport - 2rem
                const maxW = Math.max(240, vw - 32);
                themePickerBox.style.maxWidth = maxW + 'px';
                // Décaler si dépasse à droite malgré right-4
                const r = themePickerBox.getBoundingClientRect();
                const shift = Math.max(0, r.right - vw + 8);
                themePicker.style.transform = shift ? `translateX(-${shift}px)` : '';
            }

            window.addEventListener('resize', adjustThemePicker);

            document.addEventListener('DOMContentLoaded', init);
        })();
    </script>

    <x-daisy::ui.navigation.section-nav
        title="Sommaire"
        targetSelector="div.space-y-10 > section"
        headingSelector="h2"
        buttonColor="primary"
        searchPlaceholder="Filtrer les sections…"
        emptyLabel="Aucune section correspondante"
    />
    <script>
        (function(){
            function normalizeText(t){ return (t || '').toLowerCase().normalize('NFD').replace(/\p{Diacritic}/gu,''); }
            function slugify(text){ return (text || '').toLowerCase().trim().replace(/[^\w\s-]/g,'').replace(/\s+/g,'-'); }
            /** @returns {string} */
            function shortSectionLabel(fullTitle) {
                const m = (fullTitle || '').match(/·\s*(.+)$/);
                return m ? m[1].trim() : (fullTitle || '').trim();
            }
            /**
             * Adds stable ids and permalink links to each demo block (partial) inside a main section.
             *
             * @returns {void}
             */
            function augmentDemoBlockAnchors() {
                const mainSections = document.querySelectorAll('div.space-y-10 > section[id]');
                mainSections.forEach((main) => {
                    const prefix = main.id;
                    const innerSections = main.querySelectorAll(':scope > div.space-y-6 > section');
                    innerSections.forEach((inner, idx) => {
                        const h2 = inner.querySelector(':scope > h2');
                        if (!h2 || h2.querySelector('a[href^="#"]')) {
                            return;
                        }
                        const raw = h2.textContent.trim();
                        let slug = slugify(raw);
                        if (!slug) {
                            slug = 'block-' + idx;
                        }
                        let id = inner.id ? inner.id : (prefix + '-' + slug);
                        let n = 2;
                        while (document.getElementById(id)) {
                            id = prefix + '-' + slug + '-' + n;
                            n += 1;
                        }
                        inner.id = id;
                        inner.classList.add('scroll-mt-6');
                        const a = document.createElement('a');
                        a.href = '#' + id;
                        a.className = 'link link-hover';
                        while (h2.firstChild) {
                            a.appendChild(h2.firstChild);
                        }
                        h2.appendChild(a);
                    });
                });
            }
            function collectSections(){
                const wrap = document.querySelector('div.space-y-10');
                if (!wrap) {
                    return [];
                }
                const sections = Array.from(wrap.querySelectorAll(':scope > section'));
                const seen = new Set();
                const data = [];
                for (const sec of sections) {
                    const h2 = sec.querySelector(':scope > h2');
                    if (!h2) {
                        continue;
                    }
                    const titleLink = h2.querySelector('a');
                    const label = (titleLink ? titleLink.textContent : h2.textContent).trim();
                    let id = sec.id || slugify(label);
                    let base = id, i = 2;
                    while (seen.has(id)) { id = base + '-' + (i++); }
                    seen.add(id);
                    if (!sec.id) sec.id = id;
                    data.push({ id, label, labelKey: normalizeText(label), level: 1 });
                    const innerSections = sec.querySelectorAll(':scope > div.space-y-6 > section');
                    innerSections.forEach((inner) => {
                        const ih2 = inner.querySelector(':scope > h2');
                        if (!ih2) {
                            return;
                        }
                        const innerId = inner.id;
                        if (!innerId) {
                            return;
                        }
                        const iLink = ih2.querySelector('a');
                        const innerTitle = (iLink ? iLink.textContent : ih2.textContent).trim();
                        const displayLabel = shortSectionLabel(label) + ' · ' + innerTitle;
                        data.push({ id: innerId, label: displayLabel, labelKey: normalizeText(displayLabel), level: 2 });
                    });
                }
                return data;
            }
            document.addEventListener('DOMContentLoaded', () => {
                augmentDemoBlockAnchors();
                const wrap = document.querySelector('div.space-y-10');
                if (wrap) {
                    const mo = new MutationObserver(() => {
                        const navRoots = document.querySelectorAll('[data-section-nav]');
                        navRoots.forEach((navRoot) => {
                            navRoot.dataset.sectionNavReady = '';
                        });
                    });
                    mo.observe(wrap, { childList: true, subtree: true });
                }
                const hash = window.location.hash.slice(1);
                if (hash) {
                    const el = document.getElementById(hash);
                    if (el) {
                        setTimeout(() => el.scrollIntoView({ block: 'start', behavior: 'smooth' }), 100);
                    }
                }
            });
        })();
    </script>

    <div class="space-y-10">
        @php ($s = $demoUiSections[0]) @endphp
        <!-- Components / Actions -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-buttons')
                @include('daisy-dev::demo.ui.partials.test-dropdown')
                @include('daisy-dev::demo.ui.partials.test-modal')
                @include('daisy-dev::demo.ui.partials.test-swap')
                @include('daisy-dev::demo.ui.partials.test-theme-controller')
                @include('daisy-dev::demo.ui.partials.test-login-buttons')
            </div>
        </section>

        @php ($s = $demoUiSections[1]) @endphp
        <!-- Components / Data & media -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-accordion')
                @include('daisy-dev::demo.ui.partials.test-avatars')
                @include('daisy-dev::demo.ui.partials.test-badges')
                @include('daisy-dev::demo.ui.partials.test-card')
                @include('daisy-dev::demo.ui.partials.test-carousel')
                @include('daisy-dev::demo.ui.partials.test-chat')
                @include('daisy-dev::demo.ui.partials.test-collapse')
                @include('daisy-dev::demo.ui.partials.test-countdown')
                @include('daisy-dev::demo.ui.partials.test-diff')
                @include('daisy-dev::demo.ui.partials.test-icons')
                @include('daisy-dev::demo.ui.partials.test-kbd')
                @include('daisy-dev::demo.ui.partials.test-list')
                @include('daisy-dev::demo.ui.partials.test-stat')
                @include('daisy-dev::demo.ui.partials.test-status')
                @include('daisy-dev::demo.ui.partials.test-table')
                @include('daisy-dev::demo.ui.partials.test-timeline')
                @include('daisy-dev::demo.ui.partials.test-lightbox')
                @include('daisy-dev::demo.ui.partials.test-media-gallery')
                @include('daisy-dev::demo.ui.partials.test-hover-gallery')
                {{-- @include('daisy-dev::demo.ui.partials.test-embeds') --}}
            </div>
        </section>

        @php ($s = $demoUiSections[2]) @endphp
        <!-- Components / Navigation -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-breadcrumbs')
                @include('daisy-dev::demo.ui.partials.test-dock')
                @include('daisy-dev::demo.ui.partials.test-fab')
                @include('daisy-dev::demo.ui.partials.test-links')
                @include('daisy-dev::demo.ui.partials.test-menu')
                @include('daisy-dev::demo.ui.partials.test-navbar')
                @include('daisy-dev::demo.ui.partials.test-pagination')
                @include('daisy-dev::demo.ui.partials.test-steps')
                @include('daisy-dev::demo.ui.partials.test-stepper')
                @include('daisy-dev::demo.ui.partials.test-tabs')
                @include('daisy-dev::demo.ui.partials.test-scrollspy')
                @include('daisy-dev::demo.ui.partials.test-tree-view')
            </div>
        </section>

        @php ($s = $demoUiSections[3]) @endphp
        <!-- Components / Feedback -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-callout')
                @include('daisy-dev::demo.ui.partials.test-alert')
                @include('daisy-dev::demo.ui.partials.test-loading')
                @include('daisy-dev::demo.ui.partials.test-progress')
                @include('daisy-dev::demo.ui.partials.test-radial-progress')
                @include('daisy-dev::demo.ui.partials.test-skeleton')
                @include('daisy-dev::demo.ui.partials.test-tooltip')
                @include('daisy-dev::demo.ui.partials.test-popover')
                @include('daisy-dev::demo.ui.partials.test-popconfirm')
                @include('daisy-dev::demo.ui.partials.test-scroll-status')
                @include('daisy-dev::demo.ui.partials.test-notifications')
                @include('daisy-dev::demo.ui.partials.test-onboarding')
            </div>
        </section>

        @php ($s = $demoUiSections[4]) @endphp
        <!-- Components / Forms & inputs -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-checkbox')
                @include('daisy-dev::demo.ui.partials.test-fieldset')
                @include('daisy-dev::demo.ui.partials.test-file-input')
                @include('daisy-dev::demo.ui.partials.test-filter')
                @include('daisy-dev::demo.ui.partials.test-label')
                @include('daisy-dev::demo.ui.partials.test-radio')
                @include('daisy-dev::demo.ui.partials.test-range')
                @include('daisy-dev::demo.ui.partials.test-rating')
                @include('daisy-dev::demo.ui.partials.test-selects')
                @include('daisy-dev::demo.ui.partials.test-inputs')
                @include('daisy-dev::demo.ui.partials.test-token-input')
                @include('daisy-dev::demo.ui.partials.test-textareas')
                @include('daisy-dev::demo.ui.partials.test-toggle')
                @include('daisy-dev::demo.ui.partials.test-validator')
                @include('daisy-dev::demo.ui.partials.test-color-picker')
                @include('daisy-dev::demo.ui.partials.test-input-mask')
                @include('daisy-dev::demo.ui.partials.test-transfer')
                @include('daisy-dev::demo.ui.partials.test-sign')
            </div>
        </section>

        @php ($s = $demoUiSections[5]) @endphp
        <!-- Components / Layout -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-divider')
                @include('daisy-dev::demo.ui.partials.test-drawer')
                @include('daisy-dev::demo.ui.partials.test-footer')
                @include('daisy-dev::demo.ui.partials.test-hero')
                @include('daisy-dev::demo.ui.partials.test-indicator')
                @include('daisy-dev::demo.ui.partials.test-copyable')
                @include('daisy-dev::demo.ui.partials.test-join')
                @include('daisy-dev::demo.ui.partials.test-mask')
                @include('daisy-dev::demo.ui.partials.test-stack')
                @include('daisy-dev::demo.ui.partials.test-grid-layout')
                @include('daisy-dev::demo.ui.partials.test-layouts')
                @include('daisy-dev::demo.ui.partials.test-daisyui5-motion')
            </div>
        </section>

        @php ($s = $demoUiSections[6]) @endphp
        <!-- Components / Mockups -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-mockup-browser')
                @include('daisy-dev::demo.ui.partials.test-mockup-code')
                @include('daisy-dev::demo.ui.partials.test-mockup-phone')
                @include('daisy-dev::demo.ui.partials.test-mockup-window')
            </div>
        </section>

        @php ($s = $demoUiSections[7]) @endphp
        <!-- Package inventory (manifest cache) -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            @php
                $components = [];
                try {
                    $components = \App\Helpers\ComponentScanner::readCached()['components'] ?? [];
                } catch (\Throwable $e) {
                    $components = [];
                }
                $byCategory = [];
                foreach ($components as $c) {
                    $cat = $c['category'] ?? 'other';
                    $byCategory[$cat][] = $c;
                }
                ksort($byCategory);
            @endphp
            @if(empty($components))
                <div role="alert" class="alert alert-warning">
                    <span>Inventaire non disponible. Lancez <code class="kbd kbd-sm">php artisan inventory:cache:rebuild --components</code>.</span>
                </div>
            @endif
            <div class="space-y-6">
                @foreach($byCategory as $cat => $items)
                    <div class="space-y-2">
                        <div class="font-medium opacity-70">{{ ucfirst(str_replace('-', ' ', $cat)) }}</div>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($items as $it)
                                <div class="card bg-base-100 card-border">
                                    <div class="card-body p-4">
                                        <div class="card-title text-base">{{ $it['name'] ?? '' }}</div>
                                        <div class="text-xs opacity-70 break-all">{{ $it['view'] ?? '' }}</div>
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach(($it['tags'] ?? []) as $tag)
                                                <span class="badge badge-ghost badge-sm">{{ $tag }}</span>
                                            @endforeach
                                            @if(!empty($it['jsModule']))
                                                <span class="badge badge-info badge-sm">js: {{ $it['jsModule'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        @php ($s = $demoUiSections[8]) @endphp
        <!-- External libraries (Leaflet, charts, etc.) -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-charts')
                @include('daisy-dev::demo.ui.partials.test-leaflet')
                @include('daisy-dev::demo.ui.partials.test-calendar')
                {{-- @include('daisy-dev::demo.ui.partials.test-calendar-full') --}}
                @include('daisy-dev::demo.ui.partials.test-wysiwyg')
                @include('daisy-dev::demo.ui.partials.test-code-editor')
            </div>
        </section>


        @php ($s = $demoUiSections[9]) @endphp
        <!-- Daisy Kit JS modules -->
        <section id="{{ $s['id'] }}" class="scroll-mt-8">
            <h2 class="text-xl font-semibold">
                <a href="#{{ $s['id'] }}" class="link link-hover">{{ $s['title'] }}</a>
            </h2>
            <div class="space-y-6">
                @include('daisy-dev::demo.ui.partials.test-js-modules')
            </div>
        </section>
    </div>

    <script>
    // Marquer toutes les images de la démo en lazy pour éviter que l'onglet reste en "chargement"
    (function(){
      document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('img:not([loading])').forEach((img) => {
          img.setAttribute('loading', 'lazy');
          img.setAttribute('decoding', 'async');
        });
      });
    })();
    </script>
</x-daisy::layout.app>

