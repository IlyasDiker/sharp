
import { createApp, h, nextTick } from 'vue';

// import Notifications from 'vue-notification';

import SharpCommands from '@sharp/commands';
import SharpDashboard from '@sharp/dashboard';
import SharpEntityList from '@sharp/entity-list/src';
import SharpFilters from '@sharp/filters';
import SharpForm from '@sharp/form';
import SharpShow from '@sharp/show/src';
import SharpUI from '@sharp/ui';
import SharpSearch from '@sharp/search';

import ActionView from './components/ActionView.vue';
import LeftNav from './components/LeftNav.vue';

import { store as getStore } from './store/store';
// import { router as getRouter } from "./router";
import { createInertiaApp, router } from "@inertiajs/vue3";
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ignoredElements } from "@/utils/vue";


// const router = getRouter();
const store = getStore();


if(document.querySelector('[data-page]')) {
    createInertiaApp({
        resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            const app = createApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue, Ziggy)
                .use(store);

            app.config.compilerOptions.isCustomElement = tag => ignoredElements.includes(tag);

            app.use(SharpCommands, { store });
            app.use(SharpDashboard, { store });
            app.use(SharpEntityList, { store });
            app.use(SharpFilters, { store });
            app.use(SharpForm, { store });
            app.use(SharpShow, { store });
            app.use(SharpUI, { store });
            app.use(SharpSearch, { store });

            app.mount(el);

            nextTick(() => {
                window.dispatchEvent(new CustomEvent('sharp:mounted'));
            });
        },
    });

    // force reload on previous navigation to invalidate outdated data / state
    window.addEventListener('popstate', () => {
        document.addEventListener('inertia:navigate', () => {
            router.reload({ replace: true });
        }, { once: true });
    });
}




