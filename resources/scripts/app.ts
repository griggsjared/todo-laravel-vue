import '../css/app.css';

import { importPageComponent } from '@/scripts/utils/import-page-component';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { createApp, h } from 'vue';

createInertiaApp({
  resolve: (name: string) => importPageComponent(`../vue/pages/${name}.vue`, import.meta.glob('../vue/pages/**/*.vue')),
  title: () => 'TODO App',
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .use(plugin)
      .mount(el);
  },
});

InertiaProgress.init({
  delay: 100,
  color: '#3b5ed1',
  includeCSS: true,
});

import.meta.glob(['../images/**']);
