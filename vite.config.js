import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/assets/admin/css/app.js',
                'resources/assets/admin/css/app-rtl.js',
                'resources/assets/admin/css/data-tables.js',

                'resources/assets/admin/js/app-script.js',
                'resources/assets/admin/js/data-tables.js',
            ],
            refresh: true,
        }),
    ],
});
