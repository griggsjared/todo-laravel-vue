import { Page } from '@inertiajs/core';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { Command } from 'commander';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createSSRApp, h } from 'vue';

const command = new Command();
command.option('-p, --port <number>', 'port number', '13714').parse();

createServer(
  (page: Page) =>
    createInertiaApp({
      progress: false,
      page,
      render: renderToString,
      resolve: (name: string) =>
        resolvePageComponent<DefineComponent>(
          `../vue/pages/${name}.vue`,
          import.meta.glob<DefineComponent>('../vue/pages/**/*.vue'),
        ),
      title: () => 'TODO App',
      setup: ({ App, props, plugin: inertia }) => {
        return createSSRApp({ render: () => h(App, props) })
          .use(inertia)
      },
    }),
  parseInt(command.opts().port),
);
