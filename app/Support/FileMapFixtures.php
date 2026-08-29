<?php

namespace App\Support;

final class FileMapFixtures
{
    /**
     * @return list<array{id: string, title: string, summary: string, state: string}>
     */
    public static function scenarios(string $module): array
    {
        return match ($module) {
            'forms' => [
                ['id' => 'contributor-profile', 'title' => 'Contributor profile', 'summary' => 'A multi-step profile that computes a review summary.', 'state' => 'success'],
                ['id' => 'preference-variant', 'title' => 'Preference variant', 'summary' => 'An optional preference branch with a small field set.', 'state' => 'variant'],
                ['id' => 'invalid-submission', 'title' => 'Invalid submission', 'summary' => 'A visible validation response for incomplete input.', 'state' => 'error'],
            ],
            'table' => [
                ['id' => 'contributor-directory', 'title' => 'Contributor directory', 'summary' => 'A paged directory of active contributors.', 'state' => 'success'],
                ['id' => 'filtered-server-result', 'title' => 'Filtered server result', 'summary' => 'A typed filter applied to a deterministic endpoint.', 'state' => 'variant'],
                ['id' => 'unavailable-source', 'title' => 'Unavailable source', 'summary' => 'An accessible error when the data source cannot respond.', 'state' => 'error'],
            ],
            'tree' => [
                ['id' => 'workspace-navigation', 'title' => 'Workspace navigation', 'summary' => 'A keyboard-navigable project hierarchy.', 'state' => 'success'],
                ['id' => 'lazy-media-branch', 'title' => 'Lazy media branch', 'summary' => 'A branch whose deterministic child data loads on demand.', 'state' => 'loading'],
                ['id' => 'search-result', 'title' => 'Search result', 'summary' => 'A local or remote search result with no-match handling.', 'state' => 'variant'],
            ],
            'blueprint' => [
                ['id' => 'editorial-workflow', 'title' => 'Editorial workflow', 'summary' => 'A five-node publication flow.', 'state' => 'success'],
                ['id' => 'inspector-selection', 'title' => 'Inspector selection', 'summary' => 'A selected node with contextual inspection.', 'state' => 'variant'],
                ['id' => 'read-only-review', 'title' => 'Read-only review', 'summary' => 'A review mode that prevents authoring actions.', 'state' => 'variant'],
            ],
            'file-preview' => [
                ['id' => 'text-report', 'title' => 'Text report', 'summary' => 'A local text document in the sandboxed frame.', 'state' => 'success'],
                ['id' => 'document-gallery', 'title' => 'Document gallery', 'summary' => 'A compact gallery for supported local document types.', 'state' => 'variant'],
                ['id' => 'rejected-file', 'title' => 'Rejected file', 'summary' => 'A MIME, size or authorization rejection.', 'state' => 'error'],
            ],
            'map' => [
                ['id' => 'marker-clustering', 'title' => 'Markers, popups and clustering', 'summary' => 'Nearby operations sites grouped as the view changes.', 'state' => 'success'],
                ['id' => 'osm-and-business-layers', 'title' => 'OSM styles and business layers', 'summary' => 'Operational layers delivered through GeoJSON, XYZ and WMS.', 'state' => 'variant'],
                ['id' => 'drawing-and-export', 'title' => 'Drawing, measurement and form export', 'summary' => 'Editable typed geometry synchronized with a form value.', 'state' => 'variant'],
                ['id' => 'facade-and-persistence', 'title' => 'Persistence, errors and external controls', 'summary' => 'Integrator controls and a retryable local error using the documented Map facade.', 'state' => 'error'],
            ],
        };
    }

    /**
     * @return array{schema: array{fields: list<array{name: string, label: string, type: string, options?: list<array{value: string, label: string}>}>, submitLabel: string}, value: array{name: string, email: string, updates: string}}
     */
    public static function forms(): array
    {
        return [
            'schema' => [
                'fields' => [
                    ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                    ['name' => 'updates', 'label' => 'Updates', 'type' => 'select', 'options' => [['value' => 'weekly', 'label' => 'Weekly'], ['value' => 'monthly', 'label' => 'Monthly']]],
                ],
                'submitLabel' => 'Save profile',
            ],
            'value' => ['name' => 'Ada Lovelace', 'email' => 'ada@example.test', 'updates' => 'weekly'],
        ];
    }

    /**
     * @return array{
     *     schema: array{submit: array{label: string, mode: string}, fields: list<array{id: string, type: string, label: string, fields: list<array<string, mixed>>}>},
     *     value: array{name: string, email: string, role: string, newsletter: bool},
     *     submission: array{endpoint: string, method: string}
     * }
     */
    public static function formsParity(): array
    {
        return [
            'schema' => [
                'submit' => ['label' => 'Save contributor profile', 'mode' => 'event'],
                'fields' => [
                    [
                        'id' => 'identity',
                        'type' => 'wizardStep',
                        'label' => 'Identity',
                        'fields' => [
                            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => ['required', 'min:3']],
                            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'rules' => ['required', 'email']],
                        ],
                    ],
                    [
                        'id' => 'preferences',
                        'type' => 'wizardStep',
                        'label' => 'Preferences',
                        'fields' => [
                            ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'options' => [['value' => 'maintainer', 'label' => 'Maintainer'], ['value' => 'reviewer', 'label' => 'Reviewer']]],
                            ['name' => 'newsletter', 'label' => 'Newsletter', 'type' => 'checkbox'],
                        ],
                    ],
                    [
                        'id' => 'review',
                        'type' => 'wizardStep',
                        'label' => 'Review',
                        'fields' => [
                            ['name' => 'summary', 'label' => 'Summary', 'type' => 'text', 'computed' => ['type' => 'jsonata', 'expression' => '"Contributor: " & name']],
                        ],
                    ],
                ],
            ],
            'value' => ['name' => 'Ada Lovelace', 'email' => 'ada@example.test', 'role' => 'maintainer', 'newsletter' => true],
            'submission' => ['endpoint' => '/fixtures/forms', 'method' => 'POST'],
        ];
    }

    /**
     * @return array{columns: list<array{id: string, label: string}>, rows: list<array{id: string, name: string, role: string, status: string, location: string, updatedAt: string}>}
     */
    public static function table(): array
    {
        return [
            'columns' => [
                ['id' => 'name', 'label' => 'Contributor'],
                ['id' => 'role', 'label' => 'Role'],
                ['id' => 'status', 'label' => 'Status'],
            ],
            'rows' => [
                ['id' => 'ada', 'name' => 'Ada Lovelace', 'role' => 'Maintainer', 'status' => 'active', 'location' => 'London', 'updatedAt' => '2026-08-01'],
                ['id' => 'grace', 'name' => 'Grace Hopper', 'role' => 'Reviewer', 'status' => 'active', 'location' => 'Arlington', 'updatedAt' => '2026-08-02'],
                ['id' => 'alan', 'name' => 'Alan Turing', 'role' => 'Contributor', 'status' => 'invited', 'location' => 'Manchester', 'updatedAt' => '2026-08-03'],
                ['id' => 'radia', 'name' => 'Radia Perlman', 'role' => 'Maintainer', 'status' => 'active', 'location' => 'Portsmouth', 'updatedAt' => '2026-08-04'],
                ['id' => 'margaret', 'name' => 'Margaret Hamilton', 'role' => 'Reviewer', 'status' => 'paused', 'location' => 'Cambridge', 'updatedAt' => '2026-08-05'],
                ['id' => 'donald', 'name' => 'Donald Knuth', 'role' => 'Contributor', 'status' => 'active', 'location' => 'Stanford', 'updatedAt' => '2026-08-06'],
            ],
        ];
    }

    /**
     * @param  array{filter?: string, columnFilters?: array{role?: string, status?: string}, sort?: string, direction?: string, page?: int, pageSize?: int}  $filters
     * @return array{rows: list<array{id: string, name: string, role: string, status: string, location: string, updatedAt: string}>, total: int}
     */
    public static function tablePage(array $filters): array
    {
        $query = mb_strtolower($filters['filter'] ?? '');
        $role = $filters['columnFilters']['role'] ?? null;
        $status = $filters['columnFilters']['status'] ?? null;
        $sort = $filters['sort'] ?? 'name';
        $direction = $filters['direction'] ?? 'asc';
        $page = (int) ($filters['page'] ?? 1);
        $perPage = (int) ($filters['pageSize'] ?? 5);

        $rows = array_values(array_filter(self::table()['rows'], static function (array $row) use ($query, $role, $status): bool {
            $matchesQuery = $query === '' || str_contains(mb_strtolower(implode(' ', $row)), $query);
            $matchesRole = $role === null || $row['role'] === $role;
            $matchesStatus = $status === null || $row['status'] === $status;

            return $matchesQuery && $matchesRole && $matchesStatus;
        }));

        usort($rows, static function (array $left, array $right) use ($sort, $direction): int {
            $result = strnatcasecmp($left[$sort], $right[$sort]);

            return $direction === 'desc' ? -$result : $result;
        });

        $total = count($rows);

        return [
            'rows' => array_values(array_slice($rows, ($page - 1) * $perPage, $perPage)),
            'total' => $total,
        ];
    }

    /**
     * @return array{
     *     items: list<array{id: string, label: string, expanded: bool, children: list<array{id: string, label: string, selected?: bool, indeterminate?: bool, source?: string}>}>,
     *     lazy: array{media: string},
     *     searchEndpoint: string
     * }
     */
    public static function treeParity(): array
    {
        return [
            'items' => [[
                'id' => 'workspace',
                'label' => 'Documentation workspace',
                'expanded' => true,
                'children' => [
                    ['id' => 'forms', 'label' => 'Forms', 'selected' => true],
                    ['id' => 'guide', 'label' => 'Developer guide'],
                    ['id' => 'table', 'label' => 'Table'],
                    ['id' => 'tree', 'label' => 'Tree', 'indeterminate' => true],
                    ['id' => 'media', 'label' => 'Media', 'source' => '/fixtures/tree?parent=media'],
                ],
            ]],
            'lazy' => ['media' => '/fixtures/tree?parent=media'],
            'searchEndpoint' => '/fixtures/tree',
        ];
    }

    /**
     * @return list<array{id: string, label: string}>
     */
    public static function mediaTreeItems(): array
    {
        return [
            ['id' => 'office-plan', 'label' => 'office-plan.png'],
            ['id' => 'editorial-brief', 'label' => 'editorial-brief.docx'],
        ];
    }

    /**
     * @return list<array{id: string, label: string, expanded: bool, children: list<array{id: string, label: string, selected?: bool, indeterminate?: bool, source?: string}>}>
     */
    public static function searchTreeItems(string $query): array
    {
        $query = mb_strtolower($query);

        $workspace = self::treeParity()['items'][0];
        $searchableItems = [
            ['id' => $workspace['id'], 'label' => $workspace['label']],
            ...array_map(
                static fn (array $item): array => ['id' => $item['id'], 'label' => $item['label']],
                $workspace['children'],
            ),
            ...self::mediaTreeItems(),
        ];

        return array_values(array_filter(
            $searchableItems,
            static fn (array $item): bool => str_contains(mb_strtolower($item['label']), $query),
        ));
    }

    /**
     * @return array{nodes: list<array{id: string, label: string}>, edges: list<array{source: string, target: string}>}
     */
    public static function blueprint(): array
    {
        return [
            'nodes' => [
                ['id' => 'draft', 'label' => 'Draft'],
                ['id' => 'editorial-review', 'label' => 'Editorial review'],
                ['id' => 'legal-review', 'label' => 'Legal review'],
                ['id' => 'scheduled', 'label' => 'Scheduled'],
                ['id' => 'published', 'label' => 'Published'],
            ],
            'edges' => [
                ['source' => 'draft', 'target' => 'editorial-review'],
                ['source' => 'editorial-review', 'target' => 'legal-review'],
                ['source' => 'editorial-review', 'target' => 'scheduled'],
                ['source' => 'legal-review', 'target' => 'scheduled'],
                ['source' => 'scheduled', 'target' => 'published'],
            ],
        ];
    }

    /**
     * @return array{files: list<array{name: string, type: string, url: string, state: string}>}
     */
    public static function filePreviews(): array
    {
        return [
            'files' => [
                ['name' => 'quarterly-report.txt', 'type' => 'text/plain', 'url' => '/fixtures/file-preview/quarterly-report.txt', 'state' => 'ready'],
                ['name' => 'office-plan.svg', 'type' => 'image/svg+xml', 'url' => '/fixtures/file-preview/office-plan.svg', 'state' => 'ready'],
                ['name' => 'preview.wav', 'type' => 'audio/wav', 'url' => '/fixtures/file-preview/preview.wav', 'state' => 'ready'],
                ['name' => 'preview-walkthrough.mp4', 'type' => 'video/mp4', 'url' => '/fixtures/file-preview/preview-walkthrough.mp4', 'state' => 'ready'],
                ['name' => 'release-notes.pdf', 'type' => 'application/pdf', 'url' => '/fixtures/file-preview/release-notes.pdf', 'state' => 'ready'],
                ['name' => 'editorial-brief.docx', 'type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'url' => '/fixtures/file-preview/editorial-brief.docx', 'state' => 'ready'],
                ['name' => 'unsupported.exe', 'type' => 'application/octet-stream', 'url' => '/fixtures/unsupported.exe', 'state' => 'error'],
            ],
        ];
    }

    /**
     * @return array{name: string, latitude: string, longitude: string, description: string, geojson: array{type: string, features: list<array{type: string, geometry: array{type: string, coordinates: list<list<float>>}, properties: array<string, string>}>}}
     */
    public static function map(): array
    {
        return [
            'name' => 'Rennes office',
            'latitude' => '48.1173',
            'longitude' => '-1.6778',
            'description' => 'A fixed coordinate fixture for documentation and browser tests.',
            'geojson' => [
                'type' => 'FeatureCollection',
                'features' => [[
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'LineString',
                        'coordinates' => [[-1.681, 48.115], [-1.6778, 48.1173], [-1.674, 48.119]],
                    ],
                    'properties' => ['name' => 'Office route'],
                ]],
            ],
        ];
    }

    /**
     * @return array{
     *     markers: list<array{id: string, label: string, position: array{float, float}, popup: string|array{renderer: string, content: string}}>,
     *     basemaps: list<array{id: string, label: string, provider: string, selected?: bool}>,
     *     layers: list<array<string, mixed>>,
     *     editableGeojson: array<string, mixed>,
     *     objectTypes: list<array{id: string, label: string, geometry: string}>,
     *     drawLayers: list<array{id: string, label: string, visible: bool}>
     * }
     */
    public static function mapParity(): array
    {
        return [
            'markers' => [
                ['id' => 'rennes', 'label' => 'Rennes office', 'position' => [48.1173, -1.6778], 'popup' => 'Rennes office'],
                ['id' => 'depot', 'label' => 'Central depot', 'position' => [48.1181, -1.6769], 'popup' => 'Central depot'],
                ['id' => 'lab', 'label' => 'Materials lab', 'position' => [48.1167, -1.6786], 'popup' => ['renderer' => 'trusted-html', 'content' => '<strong>Materials lab</strong><br>Open 08:00–18:00']],
                ['id' => 'workshop', 'label' => 'Workshop', 'position' => [48.1178, -1.6791], 'popup' => 'Workshop'],
                ['id' => 'dispatch', 'label' => 'Dispatch center', 'position' => [48.1169, -1.6762], 'popup' => 'Dispatch center'],
                ['id' => 'storage', 'label' => 'Storage', 'position' => [48.1185, -1.6781], 'popup' => 'Storage'],
                ['id' => 'training', 'label' => 'Training room', 'position' => [48.1164, -1.6771], 'popup' => 'Training room'],
                ['id' => 'support', 'label' => 'Support desk', 'position' => [48.1175, -1.6758], 'popup' => 'Support desk'],
            ],
            'basemaps' => [
                ['id' => 'standard', 'label' => 'OSM standard', 'provider' => 'osm.standard', 'selected' => true],
                ['id' => 'light', 'label' => 'OSM light', 'provider' => 'osm.light'],
                ['id' => 'dark', 'label' => 'OSM dark', 'provider' => 'osm.dark'],
                ['id' => 'voyager', 'label' => 'OSM voyager', 'provider' => 'osm.voyager'],
            ],
            'layers' => [
                ['id' => 'districts', 'label' => 'Service districts', 'type' => 'geojson', 'url' => '/fixtures/map/districts.geojson', 'style' => ['color' => '#2563eb', 'weight' => 2]],
                ['id' => 'works', 'label' => 'Scheduled road works', 'type' => 'xyz', 'url' => '/fixtures/map/tiles/works/{z}/{x}/{y}.svg', 'visible' => false],
                ['id' => 'zoning', 'label' => 'Planning constraints', 'type' => 'wms', 'url' => '/fixtures/map/wms', 'options' => ['layers' => 'demo:zoning', 'format' => 'image/png', 'transparent' => true], 'visible' => false],
            ],
            'editableGeojson' => [
                'type' => 'FeatureCollection',
                'features' => [
                    ['type' => 'Feature', 'id' => 'hydrant-north', 'properties' => ['name' => 'North hydrant', 'drawLayer' => 'water', 'objectType' => 'hydrant'], 'geometry' => ['type' => 'Point', 'coordinates' => [-1.684, 48.124]]],
                    ['type' => 'Feature', 'id' => 'hydrant-south', 'properties' => ['name' => 'South hydrant', 'drawLayer' => 'water', 'objectType' => 'hydrant'], 'geometry' => ['type' => 'Point', 'coordinates' => [-1.671, 48.109]]],
                    ['type' => 'Feature', 'id' => 'cabinet-west', 'properties' => ['name' => 'West cabinet', 'drawLayer' => 'electricity', 'objectType' => 'cabinet'], 'geometry' => ['type' => 'Point', 'coordinates' => [-1.691, 48.116]]],
                    ['type' => 'Feature', 'id' => 'cabinet-east', 'properties' => ['name' => 'East cabinet', 'drawLayer' => 'electricity', 'objectType' => 'cabinet'], 'geometry' => ['type' => 'Point', 'coordinates' => [-1.662, 48.118]]],
                ],
            ],
            'objectTypes' => [
                ['id' => 'hydrant', 'label' => 'Hydrant', 'geometry' => 'point'],
                ['id' => 'cabinet', 'label' => 'Electrical cabinet', 'geometry' => 'point'],
                ['id' => 'pipe', 'label' => 'Pipe', 'geometry' => 'line'],
                ['id' => 'zone', 'label' => 'Intervention zone', 'geometry' => 'polygon'],
            ],
            'drawLayers' => [
                ['id' => 'water', 'label' => 'Water network', 'visible' => true],
                ['id' => 'electricity', 'label' => 'Electricity network', 'visible' => false],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function mapDistricts(): array
    {
        return [
            'type' => 'FeatureCollection',
            'features' => [[
                'type' => 'Feature',
                'id' => 'district-center',
                'properties' => ['name' => 'Central district', 'popup' => 'Central district'],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [-1.72, 48.09],
                        [-1.61, 48.09],
                        [-1.61, 48.16],
                        [-1.72, 48.16],
                        [-1.72, 48.09],
                    ]],
                ],
            ]],
        ];
    }

    public static function mapTile(int $z, int $x, int $y): string
    {
        return <<<SVG
            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256">
                <path d="M-24 196 L82 90 L126 134 L232 28 L280 76 L174 182 L130 138 L24 244 Z" fill="#f97316" fill-opacity=".28" stroke="#ea580c" stroke-width="3" stroke-dasharray="10 8"/>
                <circle cx="82" cy="90" r="10" fill="#f97316" fill-opacity=".8"/>
                <circle cx="174" cy="182" r="10" fill="#f97316" fill-opacity=".8"/>
                <text x="12" y="244" fill="#9a3412" font-family="ui-monospace, monospace" font-size="10">Works {$z}/{$x}/{$y}</text>
            </svg>
            SVG;
    }

    public static function transparentMapTile(): string
    {
        return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=', true)
            ?: throw new \LogicException('The deterministic map tile is invalid.');
    }
}
