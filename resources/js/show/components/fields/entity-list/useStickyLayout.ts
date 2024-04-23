import { nextTick, onMounted, onUnmounted, Ref, ref } from "vue";
import { getNavbarHeight } from "@/utils/layout";

export function useStickyLayout(el: Ref<HTMLElement>) {
    const sticky = ref(false);
    const layout = () => {
        sticky.value = el.value && el.value.offsetHeight > (window.innerHeight - getNavbarHeight());
    }

    function updateStickyLayout() {
        layout();
    }

    onMounted(() => {
        window.addEventListener('resize', layout);
    });

    onUnmounted(() => {
        window.removeEventListener('resize', layout);
    });

    return {
        sticky,
        updateStickyLayout,
    }
}
