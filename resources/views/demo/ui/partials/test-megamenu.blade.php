<!-- Megamenu -->
<section class="space-y-4 rounded-box bg-base-200 p-6">
    <h2 class="text-lg font-medium">Megamenu</h2>
    <p class="text-sm text-base-content/70">Sur desktop, les entrées restent visibles. Sur mobile, le menu s’ouvre dans un Popover.</p>
    <x-daisy::ui.navigation.megamenu mode="wide" size="md" class="max-sm:hidden rounded-box border border-base-300 bg-base-100 p-2 shadow-sm">
        <button popovertarget="demo-megamenu-products">Produits</button>
        <div id="demo-megamenu-products" popover>
            <x-daisy::ui.navigation.menu :vertical="false">
                <li><a>Tableau de bord</a></li>
                <li><a>Automatisations</a></li>
                <li><a>Analyses</a></li>
            </x-daisy::ui.navigation.menu>
        </div>
        <button popovertarget="demo-megamenu-solutions">Solutions</button>
        <div id="demo-megamenu-solutions" popover>
            <x-daisy::ui.navigation.menu :vertical="false">
                <li><a>Équipes produit</a></li>
                <li><a>Équipes support</a></li>
                <li><a>Développeurs</a></li>
            </x-daisy::ui.navigation.menu>
        </div>
        <button popovertarget="demo-megamenu-resources">Ressources</button>
        <div id="demo-megamenu-resources" popover>
            <x-daisy::ui.navigation.menu :vertical="false">
                <li><a>Documentation</a></li>
                <li><a>Guides</a></li>
                <li><a>Communauté</a></li>
            </x-daisy::ui.navigation.menu>
        </div>
    </x-daisy::ui.navigation.megamenu>

    <button class="btn sm:hidden" popovertarget="demo-megamenu-mobile">Ouvrir le menu</button>
    <x-daisy::ui.navigation.megamenu id="demo-megamenu-mobile" mode="vertical" size="md" popover class="sm:hidden">
        <button popovertarget="demo-megamenu-mobile-products">Produits</button>
        <div id="demo-megamenu-mobile-products" popover>
            <x-daisy::ui.navigation.menu :vertical="false">
                <li><a>Tableau de bord</a></li>
                <li><a>Automatisations</a></li>
                <li><a>Analyses</a></li>
            </x-daisy::ui.navigation.menu>
        </div>
        <button popovertarget="demo-megamenu-mobile-solutions">Solutions</button>
        <div id="demo-megamenu-mobile-solutions" popover>
            <x-daisy::ui.navigation.menu :vertical="false">
                <li><a>Équipes produit</a></li>
                <li><a>Équipes support</a></li>
                <li><a>Développeurs</a></li>
            </x-daisy::ui.navigation.menu>
        </div>
    </x-daisy::ui.navigation.megamenu>
</section>
