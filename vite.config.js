import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug'],
                passes: 2,
            },
            mangle: {
                safari10: true,
            },
        },
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios'],
                },
                assetFileNames: (assetInfo) => {
                    let extType = assetInfo.name.split('.').at(1);
                    if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
                        extType = 'img';
                    }
                    return `assets/${extType}/[name]-[hash][extname]`;
                },
                chunkFileNames: 'assets/js/[name]-[hash].js',
                entryFileNames: 'assets/js/[name]-[hash].js',
            },
        },
        cssMinify: 'lightningcss',
        cssCodeSplit: true,
        reportCompressedSize: false,
        chunkSizeWarningLimit: 500,
        assetsInlineLimit: 4096,
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    css: {
        devSourcemap: false,
    },
});
