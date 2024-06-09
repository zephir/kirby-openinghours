<template>
    <div class="k-openinghours-field-preview">
        <div v-if="value.default">
            <strong>Standard Öffnungszeiten</strong>
        </div>
        <div v-if="preview.label">
            <strong>{{ preview.label }}</strong>
        </div>
        <div v-if="preview.daterange">
            <strong v-if="preview.daterange">{{ preview.daterange }}</strong>
        </div>
        <div>
            <table v-if="preview?.weekdays?.length">
                <tr v-for="weekday in preview.weekdays" :key="weekday.day">
                    <td>{{ weekday.day }}</td>
                    <td>{{ weekday.time }}</td>
                </tr>
            </table>
            <div v-else>
                Keine Öffnungszeiten konfiguriert
            </div>
        </div>
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
    if (props.value.default) {
        return Object.keys(weekdayLabels)
    }

    let activeWeekdays = []

    const startDate = dayjs(props.value.daterange.start)
    const endDate = dayjs(props.value.daterange.end)
    let loopDate = startDate

    while (loopDate.isBefore(endDate) || loopDate.isSame(endDate)) {
        activeWeekdays.push(loopDate.format('dd').toLowerCase())
        loopDate = loopDate.add(1, 'day')

        if (activeWeekdays.length >= 7) {
            break
        }
    }

    return [...new Set(activeWeekdays)]
})

const preview = computed(() => {
    const weekdays = []

    for (const [key, value] of Object.entries(props.value.weekdays)) {
        if (value && activeWeekdays.value.includes(key)) {
            weekdays.push({
                day: weekdayLabels[key],
                time: value.closed ? 'Geschlossen' : getTimeString(value)
            })
        }
    }

    if (props.value.default) {
        return {
            weekdays
        }
    }

    const start = props.value.daterange.start ? dayjs(props.value.daterange.start) : false
    const end = props.value.daterange.end ? dayjs(props.value.daterange.end) : false

    const daterange = (start && end) ? `${start.format('DD.MM.YYYY')} - ${end.format('DD.MM.YYYY')}` : false

    return {
        label: props.value.label,
        daterange,
        weekdays
    }
})

const getTimeString = (value) => {
    const entries = []

    if (value.timeblock1) {
        const t1s = value.timeblock1.start
        const t1e = value.timeblock1.end

        if (t1s && t1e) {
            entries.push(`${t1s?.substr(0, t1s.lastIndexOf(":"))} - ${t1e.substr(0, t1e.lastIndexOf(":"))}`)
        } else if (t1s || t1e) {
            entries.push('Zeitraum 1: Falsche Eingabe')
        }
    }
    if (value.timeblock2) {
        const t2s = value.timeblock2.start
        const t2e = value.timeblock2.end

        if (t2s && t2e) {
            entries.push(`${t2s?.substr(0, t2s.lastIndexOf(":"))} - ${t2e.substr(0, t2e.lastIndexOf(":"))}`)
        } else if (t2s || t2e) {
            entries.push('Zeitraum 2: Falsche Eingabe')
        }
    }

    return entries.join(', ')
}

</script>

<style scoped>
    .k-openinghours-field-preview {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding: 5px var(--table-cell-padding);
    }

    td:first-of-type {
        width: 100px;
        padding-left: 0;
    }
</style>