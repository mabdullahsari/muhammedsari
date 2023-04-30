import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['app/UI/Http/Site/Style/site.css'],
            refresh: true,
            valetTls: 'muhammedsari.test',
        }),
    ],
});
