import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [laravel({
    input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/general.js', 'resources/js/diary.js', 'resources/js/accounts.js'],
    refresh: true,
  })],
  build: {
    manifest: true,
    outDir: 'public/build',
    rollupOptions: {
      input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/general.js', 'resources/js/diary.js', 'resources/js/accounts.js'],
    },
  }
});


