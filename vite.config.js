import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
        },
 
       ),
       
    
    ],
    
    server: {
    proxy: {
    '/api': {
      target: 'https://app-ventas-al-credito-production.up.railway.app/',
      changeOrigin: true,
      secure: false,
    },
    cors:false
    }  
});
