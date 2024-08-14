import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import inertiaLayout from './resources/scripts/utils/inertia-layout';

export default ({ mode }) => {
  return defineConfig({
    plugins: [
      process.env?.VITE_SERVER_HTTPS == 'true' ? basicSsl() : {},
      inertiaLayout(),
      vue({
        template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
          useVueStyleLoader: true,
        },
      }),
      laravel({
        input: 'resources/scripts/app.ts',
        ssr: 'resources/scripts/ssr.ts',
        refresh: true,
      }),
    ],
    ssr: {
      noExternal: ['@inertiajs/server'],
    },
    resolve: {
      alias: {
        '@': '/resources',
        '@scripts': '/resources/scripts',
        '@components': '/resources/vue/components',
        '@pages': '/resources/pages/pages',
        '@layouts': '/resources/pages/layouts',
      },
    },
  });
};
