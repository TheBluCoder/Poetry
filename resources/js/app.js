import Toast from 'vue-toastification';
import '../css/app.css';
import './bootstrap';

import { createInertiaApp, Head, Link, usePage } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia';
import { computed, createApp, h } from 'vue';
import 'vue-toastification/dist/index.css';
import VueClickAwayPlugin from 'vue3-click-away';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const guest = computed(() => usePage().props.auth.user === null);
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} | ${appName} `,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({
            render: () => h(App, props),
            provide: {
                guest: guest,
            },
        })
            .use(plugin)
            .use(ZiggyVue)
            .use(Toast)
            .use(pinia)
            .use(VueClickAwayPlugin)
            .component('Link', Link)
            .component('Head', Head)
            .mount(el);
    },

    progress: {
        color: '#4B5563',
    },
});
