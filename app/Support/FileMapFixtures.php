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
     * @return array{columns: list<array{id: string, label: string}>, rows: list<array{name: string, role: string, status: string}>}
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
                ['name' => 'Ada Lovelace', 'role' => 'Maintainer', 'status' => 'Active'],
                ['name' => 'Grace Hopper', 'role' => 'Reviewer', 'status' => 'Active'],
                ['name' => 'Alan Turing', 'role' => 'Contributor', 'status' => 'Invited'],
            ],
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
     * @return array{nodes: list<array{id: string, label: string}>, edges: list<array{source: string, target: string}>}
     */
    public static function blueprint(): array
    {
        return [
            'nodes' => [
                ['id' => 'draft', 'label' => 'Draft'],
                ['id' => 'review', 'label' => 'Review'],
                ['id' => 'published', 'label' => 'Published'],
            ],
            'edges' => [
                ['source' => 'draft', 'target' => 'review'],
                ['source' => 'review', 'target' => 'published'],
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
     * @return array{name: string, latitude: string, longitude: string, description: string, geojson: array{type: string, geometry: array{type: string, coordinates: list<list<float>>}, properties: array<never, never>}}
     */
    public static function map(): array
    {
        return [
            'name' => 'Rennes office',
            'latitude' => '48.1173',
            'longitude' => '-1.6778',
            'description' => 'A fixed coordinate fixture for documentation and browser tests.',
            'geojson' => [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'LineString',
                    'coordinates' => [[-1.681, 48.115], [-1.6778, 48.1173], [-1.674, 48.119]],
                ],
                'properties' => [],
            ],
        ];
    }
}
