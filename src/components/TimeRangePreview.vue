<template>
    <div class="k-openinghours-field-preview">
        {{ preview }}
    </div>
</template>

<script setup>
import { computed } from 'kirbyuse'

const props = defineProps({
    value: Object,
    column: Object,
    field: Object
})

const preview = computed(() => {
    if (!props.value.start || !props.value.end) {
        return '-'
    }

    const startSplitted = props.value.start.split(':')
    const endSplitted = props.value.end.split(':')

    return `${startSplitted[0]}:${startSplitted[1]} - ${endSplitted[0]}:${endSplitted[1]}`
})

</script>

<style scoped>
    .k-openinghours-field-preview {
        padding: 0 var(--table-cell-padding);
    }
</style>