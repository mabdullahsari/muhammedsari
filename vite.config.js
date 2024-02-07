import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/site.scss', 'resources/js/site.js'],
            refresh: true,
        }),
    ],
});
