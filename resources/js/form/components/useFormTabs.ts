import { ref, watch } from "vue";
import { slugify } from "@/utils";
import { router } from "@inertiajs/vue3";
import { FormData } from "@/types";

export function useFormTabs(props: { form: FormData }) {
    const selectedTabSlug = ref('');

    selectedTabSlug.value = props.form.layout.tabs
            .map(tab => slugify(tab.title))
            .find(tabSlug => new URLSearchParams(location.search).get('tab') == tabSlug)
        ?? slugify(props.form.layout.tabs?.[0]?.title ?? '');

    if(props.form.layout.tabbed && props.form.layout.tabs.length > 1) {
        watch(selectedTabSlug, () => {
            const url = location.origin + location.pathname + `?tab=${selectedTabSlug.value}`;
            // @ts-ignore
            router.page.url = url;
            // @ts-ignore
            history.replaceState(router.page, null, url);
            // todo inertia v2 router.page doesn't exist so we will have to hack with popstate event
            // window.dispatchEvent(new PopStateEvent('popstate'));
        }, { immediate: true });
    }

    return {
        selectedTabSlug,
    }
}
