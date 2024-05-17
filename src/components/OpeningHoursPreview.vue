<template>
    <div class="k-openinghours-field-preview">
        <strong v-if="preview.label">{{ preview.label }}: </strong>
        <span v-if="preview.daterange">{{ preview.daterange }}</span>
        <span v-if="preview?.weekdays?.length">: {{ preview.weekdays.join(', ') }}</span>
        <span v-else>: Keine Wochentage konfiguriert</span>
    </div>
</template>

<script setup>
import { computed } from 'kirbyuse'
import dayjs from 'dayjs'

const props = defineProps({
    value: Object,
    column: Object,
    field: Object
})

const weekdayLabels = {
    'mo': 'Montag',
    'tu': 'Dienstag',
    'we': 'Mittwoch',
    'th': 'Donnerstag',
    'fr': 'Freitag',
    'sa': 'Samstag',
    'su': 'Sonntag'
}

const activeWeekdays = computed(() => {
    let activeWeekdays = []

    console.log(props.value)

    const startDate = dayjs(props.value.daterange.start)
    const endDate = dayjs(props.value.daterange.end)
    let loopDate = startDate

    while (loopDate.isBefore(endDate) || loopDate.isSame(endDate)) {
        activeWeekdays.push(loopDate.format('dd').toLowerCase())
        loopDate = loopDate.add(1, 'day')
    }

    return [...new Set(activeWeekdays)]
})

const preview = computed(() => {
    const start = dayjs(props.value.daterange.start)
    const end = dayjs(props.value.daterange.end)

    const daterange = `${start.format('DD.MM.YYYY')} - ${end.format('DD.MM.YYYY')}`

    const weekdays = []
    for (const [key, value] of Object.entries(props.value.weekdays)) {
        if (value && activeWeekdays.value.includes(key)) {
            weekdays.push(`${weekdayLabels[key]}` + (value.closed ? ' (geschlossen)' : ''))
        }
    }

    return {
        label: props.value.label,
        daterange: daterange,
        weekdays: weekdays
    }
})

</script>

<style scoped>
    .k-openinghours-field-preview {
        padding: 0 var(--table-cell-padding);
    }
</style>