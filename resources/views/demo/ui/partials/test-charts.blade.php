<section class="space-y-6 rounded-box bg-base-200 p-6">
    <div class="space-y-2">
        <h2 class="text-lg font-medium">Charts (ECharts)</h2>
        <p class="max-w-3xl text-sm text-base-content/70">
            Les nouveaux composants <code>x-daisy::charts.*</code> exposent des presets ECharts prêts à l'emploi.
            La démo couvre les vues dashboard, répartition, comparaison et micro-indicateurs.
        </p>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.4fr_0.9fr]">
        <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
            <x-daisy::charts.line
                title="Trafic d'acquisition"
                subtitle="Sessions hebdomadaires par canal"
                :categories="['S1', 'S2', 'S3', 'S4', 'S5', 'S6']"
                :series="[
                    ['name' => 'SEO', 'data' => [1240, 1380, 1510, 1660, 1740, 1895]],
                    ['name' => 'Paid', 'data' => [840, 920, 890, 980, 1015, 1090]],
                ]"
                :toolbar="true"
                :options="[
                    'yAxis' => [
                        'axisLabel' => ['formatter' => '{value}'],
                    ],
                ]"
                height="360px"
            />
        </div>

        <div class="grid gap-6">
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
                <x-daisy::charts.donut
                    title="Mix de revenus"
                    subtitle="Répartition du MRR"
                    :series="[
                        ['name' => 'MRR', 'data' => [
                            ['value' => 42, 'name' => 'Abonnements'],
                            ['value' => 18, 'name' => 'Services'],
                            ['value' => 11, 'name' => 'Partenariats'],
                        ]],
                    ]"
                    :toolbar="true"
                    value-format="currency"
                    height="260px"
                />
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.24em] text-base-content/50">Pipeline</p>
                    <p class="mt-2 text-2xl font-semibold">€84k</p>
                    <x-daisy::charts.sparkline
                        :series="[
                            ['name' => 'Pipeline', 'data' => [18, 24, 21, 29, 34, 37, 44]],
                        ]"
                        value-format="currency"
                        height="88px"
                    />
                </div>

                <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.24em] text-base-content/50">Churn</p>
                    <p class="mt-2 text-2xl font-semibold">2.4%</p>
                    <x-daisy::charts.sparkline
                        :series="[
                            ['name' => 'Churn', 'data' => [3.8, 3.1, 3.4, 2.9, 2.7, 2.5, 2.4]],
                        ]"
                        value-format="percent"
                        :palette="['error']"
                        height="88px"
                    />
                </div>

                <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.24em] text-base-content/50">NPS</p>
                    <p class="mt-2 text-2xl font-semibold">58</p>
                    <x-daisy::charts.sparkline
                        :series="[
                            ['name' => 'NPS', 'data' => [41, 44, 47, 49, 53, 55, 58]],
                        ]"
                        :palette="['success']"
                        height="88px"
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
            <x-daisy::charts.bar
                title="Nouveaux comptes"
                subtitle="Comparaison mensuelle"
                :categories="['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin']"
                :series="[
                    ['name' => 'Self-serve', 'data' => [48, 55, 63, 60, 74, 82]],
                    ['name' => 'Sales-led', 'data' => [18, 22, 25, 29, 31, 35]],
                ]"
                value-format="number"
                height="320px"
            />
        </div>

        <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
            <x-daisy::charts.stacked-bar
                title="Charge support"
                subtitle="Tickets ouverts par équipe"
                :categories="['Lun', 'Mar', 'Mer', 'Jeu', 'Ven']"
                :series="[
                    ['name' => 'Support', 'data' => [12, 15, 11, 16, 13]],
                    ['name' => 'Produit', 'data' => [5, 7, 9, 6, 8]],
                    ['name' => 'Infra', 'data' => [3, 4, 2, 5, 4]],
                ]"
                height="320px"
            />
        </div>

        <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
            <x-daisy::charts.area
                title="Consommation API"
                subtitle="Millions de requêtes"
                :categories="['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin']"
                :series="[
                    ['name' => 'API v1', 'data' => [1.2, 1.5, 1.7, 1.9, 2.2, 2.6]],
                ]"
                height="320px"
            />
        </div>

        <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
            <x-daisy::charts.stacked-area
                title="Capacité équipe"
                subtitle="Heures allouées par flux"
                :categories="['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4']"
                :series="[
                    ['name' => 'Build', 'data' => [48, 52, 54, 56]],
                    ['name' => 'Run', 'data' => [26, 24, 22, 20]],
                    ['name' => 'Enablement', 'data' => [10, 12, 14, 13]],
                ]"
                height="320px"
            />
        </div>
    </div>

    <div class="rounded-box border border-dashed border-base-content/15 bg-base-100/70 p-4">
        <x-daisy::charts.pie
            title="Répartition des alertes"
            subtitle="Classification des incidents sur 30 jours"
            :series="[
                ['name' => 'Incidents', 'data' => [
                    ['value' => 18, 'name' => 'Performance'],
                    ['value' => 12, 'name' => 'Données'],
                    ['value' => 9, 'name' => 'Disponibilité'],
                    ['value' => 5, 'name' => 'Sécurité'],
                ]],
            ]"
            height="360px"
        />
    </div>
</section>
