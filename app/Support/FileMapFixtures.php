<?php

namespace App\Support;

final class FileMapFixtures
{
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
     * @return array{schema: array{title: string, steps: list<array{id: string, label: string}>, fields: list<array<string, mixed>>}, value: array<string, mixed>, submission: array{endpoint: string, method: string}}
     */
    public static function formsParity(): array
    {
        return [
            'schema' => [
                'title' => 'Contributor profile',
                'steps' => [
                    ['id' => 'identity', 'label' => 'Identity'],
                    ['id' => 'preferences', 'label' => 'Preferences'],
                    ['id' => 'review', 'label' => 'Review'],
                ],
                'fields' => [
                    ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'step' => 'identity', 'rules' => ['required', 'min:3']],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'step' => 'identity', 'rules' => ['required', 'email']],
                    ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'step' => 'preferences', 'options' => [['value' => 'maintainer', 'label' => 'Maintainer'], ['value' => 'reviewer', 'label' => 'Reviewer']]],
                    ['name' => 'newsletter', 'label' => 'Newsletter', 'type' => 'checkbox', 'step' => 'preferences'],
                    ['name' => 'summary', 'label' => 'Summary', 'type' => 'computed', 'step' => 'review', 'expression' => '"Contributor: " & $name'],
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
     * @param  array{q?: string, role?: string, status?: string, sort?: string, direction?: string, page?: int, per_page?: int}  $filters
     * @return array{data: list<array{id: string, name: string, role: string, status: string, location: string, updatedAt: string}>, meta: array{total: int, current_page: int, per_page: int, last_page: int}}
     */
    public static function tablePage(array $filters): array
    {
        $query = mb_strtolower($filters['q'] ?? '');
        $role = $filters['role'] ?? null;
        $status = $filters['status'] ?? null;
        $sort = $filters['sort'] ?? 'name';
        $direction = $filters['direction'] ?? 'asc';
        $page = (int) ($filters['page'] ?? 1);
        $perPage = (int) ($filters['per_page'] ?? 5);

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
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min($page, $lastPage);

        return [
            'data' => array_values(array_slice($rows, ($page - 1) * $perPage, $perPage)),
            'meta' => ['total' => $total, 'current_page' => $page, 'per_page' => $perPage, 'last_page' => $lastPage],
        ];
    }

    /**
     * @return list<array{id: string, label: string, expanded?: bool, children?: list<array{id: string, label: string}>}>
     */
    public static function tree(): array
    {
        return [[
            'id' => 'documentation',
            'label' => 'Documentation',
            'expanded' => true,
            'children' => [
                ['id' => 'readme', 'label' => 'README.md'],
                ['id' => 'installation', 'label' => 'installation.md'],
            ],
        ]];
    }

    /**
     * @return array{items: list<array<string, mixed>>, lazy: array<string, string>, searchEndpoint: string}
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
                    ['id' => 'media', 'label' => 'Media', 'lazy' => true],
                ],
            ]],
            'lazy' => ['media' => '/fixtures/tree?parent=media'],
            'searchEndpoint' => '/fixtures/tree?q={query}',
        ];
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
     * @return array{name: string, type: string, size: string, updatedAt: string, src: string}
     */
    public static function filePreview(): array
    {
        return [
            'name' => 'quarterly-report.txt',
            'type' => 'text',
            'size' => '164 B',
            'updatedAt' => '2026-01-15',
            'src' => '/fixtures/quarterly-report.txt',
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
                ['name' => 'office-plan.png', 'type' => 'image/png', 'src' => '/fixtures/office-plan.png', 'state' => 'ready'],
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
