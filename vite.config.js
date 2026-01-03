import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //'resources/css/app.css', 'resources/js/app.js'
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin.css',  // <-- add this
                'resources/js/admin.js',    // <-- add this
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',   // 🔥 REQUIRED
        port: 5174,
        strictPort: true,
        hmr: {
            host: 'localhost', // avoid IPv6
        },
    },
});
