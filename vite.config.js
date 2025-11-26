import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

// const host =
//     process.env.GITHUB_CODESPACES === 'true'
//         ? `https://${process.env.CODESPACE_NAME}-5173.app.github.dev`
//         : '127.0.0.1';

const host = '127.0.0.1';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: 'localhost',
        port: 5173,
        hmr: {
            host: 'localhost',
            port: 5173,
            protocol: 'http',
        },
    },
});
