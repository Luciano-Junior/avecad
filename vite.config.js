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
        host: '0.0.0.0',  // Permite que o Vite seja acessado pelo Docker
        port: 5173,       // Garante que a porta seja usada
        strictPort: true,
        hmr: {
            host: 'localhost',  // Se estiver rodando na máquina
            protocol: 'ws',
        },
        watch: {
            usePolling: true, // Necessário para Docker em alguns casos
        },
    },
});