import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/css/app.css',
                'resources/css/donativos.css',
                'resources/css/inicio.css',
                'resources/css/login.css',
                'resources/css/nosotros.css',
                'resources/css/noticias.css',
                
                // JS
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/script.js',
                'resources/js/scripts.js',
            ],
            refresh: true,
        }),
    ],
});
