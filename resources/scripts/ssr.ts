import { importPageComponent } from '@/scripts/utils/import-page-component';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import createServer from '@inertiajs/server';
import { renderToString } from '@vue/server-renderer';
import { createSSRApp, h } from 'vue';

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    resolve: (name: string) =>
      importPageComponent(`../vue/pages/${name}.vue`, import.meta.glob('../vue/pages/**/*.vue')),
    title: () => 'TODO App',
    setup: ({ app, props, plugin: inertia }) => {
      return createSSRApp({ render: () => h(app, props) }).use(inertia);
    },
  })
);
