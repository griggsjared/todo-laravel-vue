import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { importPageComponent } from '@/scripts/utils/import-page-component'

createInertiaApp({
	resolve: (name : string)  => importPageComponent(name, import.meta.glob('../vue/pages/**/*.vue')),
  title: () => 'TODO App',
	setup({ el, app, props, plugin }) {
		createApp({ render: () => h(app, props) })
			.use(plugin)
			.mount(el)
	},
})

InertiaProgress.init({
  delay: 100,
  color: '#3b5ed1',
  includeCSS: true
})

import.meta.glob([
  '../images/**',
]);
