import { fileURLToPath, URL } from 'node:url';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import stylexPlugin from 'vite-plugin-stylex';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            refresh: true,
        }),
        react(),
        stylexPlugin(),
    ],
    resolve: {
        alias: {
            // must be a real filesystem path: vite-plugin-stylex joins it
            // directly when resolving @/... stylex imports at build time
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
        },
    },
    // server: {
    //     host: '0.0.0.0',
    //     port: 5173,
    //     hmr: {
    //         host: 'localhost',
    //     },
    // },
});
