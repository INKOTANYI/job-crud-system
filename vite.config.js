import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig(async () => {
    const laravel = (await import('laravel-vite-plugin')).default;
    return {
        plugins: [
            laravel({
                input: ['resources/sass/app.scss', 'resources/js/app.js'],
                refresh: true,
            }),
            vue(),
        ],
        server: {
            port: 5175,
        },
    };
});
