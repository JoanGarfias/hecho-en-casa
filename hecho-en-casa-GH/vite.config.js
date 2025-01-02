import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/inicio/menu.css', // Agrega estos archivos
                'resources/css/inicio/pie.css',
                'resources/css/inicio/cuerpo.css',
            ],
            refresh: true,
        }),
    ],
});
