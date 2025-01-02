import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
            // Redirige todas las solicitudes a "/api" a tu servidor XAMPP
            '/build': 'http://localhost/Laravel/hecho-en-casa/hecho-en-casa-GH/public', // Si los archivos están en el directorio build de XAMPP
        },
    },
});
