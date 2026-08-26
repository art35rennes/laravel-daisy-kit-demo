<?php

namespace App\Support;

final class FileMapFixtures
{
    /**
     * @return array{name: string, type: string, size: string, updatedAt: string}
     */
    public static function filePreview(): array
    {
        return [
            'name' => 'quarterly-report.pdf',
            'type' => 'application/pdf',
            'size' => '1.8 MB',
            'updatedAt' => '2026-01-15',
        ];
    }

    /**
     * @return array{name: string, latitude: string, longitude: string, description: string}
     */
    public static function map(): array
    {
        return [
            'name' => 'Rennes office',
            'latitude' => '48.1173',
            'longitude' => '-1.6778',
            'description' => 'A fixed coordinate fixture for documentation and browser tests.',
        ];
    }
}
