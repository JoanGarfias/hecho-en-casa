import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/inicio/menu.css', 'resources/css/inicio/pie.css', 'resources/css/inicio/cuerpo.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
