import { resolve } from 'node:path';
import { fileURLToPath } from 'node:url';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

const projectRoot = fileURLToPath(new URL('.', import.meta.url));

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/daisy-kit/table.js',
                'resources/js/daisy-kit/tree.js',
                'resources/js/daisy-kit/blueprint.js',
                'resources/js/daisy-kit/file-preview.js',
                'resources/js/daisy-kit/map.js',
                'resources/js/daisy-kit/copyable.js',
                'resources/js/daisy-kit/combobox.js',
                'resources/js/daisy-kit/signature.js',
                'resources/js/daisy-kit/truncate.js',
                'resources/js/daisy-kit/scrollspy.js',
                'resources/js/daisy-kit/transfer-list.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@daisy-kit': resolve(projectRoot, 'vendor/art35rennes/laravel-daisy-kit/dist'),
        },
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
