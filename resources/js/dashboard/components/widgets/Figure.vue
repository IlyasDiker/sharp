<script setup lang="ts">
    import { FigureWidgetData } from "@/types";
    import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
    import MaybeInertiaLink from "@/components/MaybeInertiaLink.vue";
    import { DashboardWidgetProps } from "@/dashboard/types";

    const props = defineProps<DashboardWidgetProps<FigureWidgetData>>();
</script>

<template>
    <Card class="relative">
        <template v-if="widget.title || value.data.evolution">
            <CardHeader class="flex flex-row items-center gap-2 pb-2">
                <CardTitle class="text-sm tracking-tight font-medium">
                    <template v-if="widget.link">
                        <MaybeInertiaLink class="hover:underline" :href="widget.link">
                            <span class="absolute inset-0"></span>
                            {{ widget.title }}
                        </MaybeInertiaLink>
                    </template>
                    <template v-else>
                        {{ widget.title }}
                    </template>
                </CardTitle>
<!--                <template v-if="value.data.evolution?.startsWith('+')">-->
<!--                    <ArrowUpRight class="ml-auto size-4 text-muted-foreground" />-->
<!--                </template>-->
<!--                <template v-else-if="value.data.evolution?.startsWith('-')">-->
<!--                    <ArrowDownRight class="ml-auto size-4 text-muted-foreground" />-->
<!--                </template>-->
            </CardHeader>
        </template>
        <CardContent>
            <div class="text-2xl font-bold">
                {{ value.data.figure }}
                <template v-if="value.data.unit">
                    {{ value.data.unit }}
                </template>
            </div>
            <template v-if="value.data.evolution">
                <p class="text-xs text-muted-foreground">
                    {{ value.data.evolution }}
                </p>
            </template>
        </CardContent>
    </Card>
</template>
