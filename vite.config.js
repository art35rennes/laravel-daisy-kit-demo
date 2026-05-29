import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { fileURLToPath } from 'node:url';

const nodeModule = (path) => fileURLToPath(new URL(`./node_modules/${path}`, import.meta.url));

export default defineConfig({
    resolve: {
        preserveSymlinks: true,
        alias: [
            { find: /^tailwindcss$/, replacement: nodeModule('tailwindcss/index.css') },
            { find: /^daisyui$/, replacement: nodeModule('daisyui/index.js') },
            { find: /^gridstack(\/.*)?$/, replacement: `${nodeModule('gridstack')}$1` },
            { find: /^trix(\/.*)?$/, replacement: `${nodeModule('trix')}$1` },
        ],
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'vendor/art35rennes/laravel-daisy-kit',
            hotFile: 'storage/daisy-kit-vite.hot',
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    if (id.includes('codemirror') || id.includes('code-editor')) {
                        return 'code-editor';
                    }

                    if (id.includes('trix')) {
                        return 'trix';
                    }

                    if (id.includes('leaflet-routing-machine')) {
                        return 'leaflet-routing';
                    }
                    if (id.includes('leaflet.draw')) {
                        return 'leaflet-draw';
                    }
                    if (id.includes('leaflet.markercluster')) {
                        return 'leaflet-cluster';
                    }
                    if (id.includes('leaflet-measure')) {
                        return 'leaflet-measure';
                    }
                    if (id.includes('leaflet') && !id.includes('node_modules')) {
                        return 'leaflet-core';
                    }
                    if (id.includes('node_modules') && id.includes('leaflet')) {
                        return 'leaflet-vendor';
                    }

                    if (id.includes('chart.js') || id.includes('chart/')) {
                        return 'chart';
                    }

                    if (id.includes('node_modules')) {
                        if (id.includes('cally') || id.includes('calendar')) {
                            return 'calendar';
                        }

                        return 'vendor';
                    }
                },
            },
        },
        chunkSizeWarningLimit: 1000,
    },
});
