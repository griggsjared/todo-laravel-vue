import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createSSRApp, h } from 'vue';

import.meta.glob(['../images/**']);

import '../css/app.css';

createInertiaApp({
  resolve: (name: string) =>
    resolvePageComponent<DefineComponent>(`../vue/pages/${name}.vue`, import.meta.glob<DefineComponent>('../vue/pages/**/*.vue')),
  title: () => 'TODO App',
  setup({ el, App, props, plugin: inertia }) {
    createSSRApp({ render: () => h(App, props) })
      .use(inertia)
      .mount(el);
  },
  progress: {
    delay: 100,
    color: '#3b5ed1',
    includeCSS: true,
  },
});
