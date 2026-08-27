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
                ['id' => 'office-workspace', 'title' => 'Office workspace', 'summary' => 'A deterministic office map with a primary location.', 'state' => 'success'],
                ['id' => 'layers-and-markers', 'title' => 'Layers and markers', 'summary' => 'A common layer and marker configuration.', 'state' => 'variant'],
                ['id' => 'draw-and-measure', 'title' => 'Draw and measure', 'summary' => 'An editable geometry with a visible measurement.', 'state' => 'variant'],
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

        return array_values(array_filter(
            self::treeParity()['items'],
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
     * @return array{files: list<array{name: string, type: string, src: string, state: string}>}
     */
    public static function filePreviews(): array
    {
        return [
            'files' => [
                ['name' => 'quarterly-report.txt', 'type' => 'text/plain', 'src' => '/fixtures/quarterly-report.txt', 'state' => 'ready'],
                ['name' => 'office-plan.svg', 'type' => 'image/svg+xml', 'src' => '/fixtures/office-plan.svg', 'state' => 'ready'],
                ['name' => 'release-notes.pdf', 'type' => 'application/pdf', 'src' => '/fixtures/release-notes.pdf', 'state' => 'ready'],
                ['name' => 'editorial-brief.docx', 'type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'src' => '/fixtures/editorial-brief.docx', 'state' => 'ready'],
                ['name' => 'unsupported.exe', 'type' => 'application/octet-stream', 'src' => '/fixtures/unsupported.exe', 'state' => 'error'],
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
}
