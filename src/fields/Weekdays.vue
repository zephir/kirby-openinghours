<template>

    <div>
        <div v-for="weekday in weekdays" :key="weekday.id">
            <div v-if="weekday.isActive">
                <k-object-field
                    :label="weekday.name"
                    :fields="{
                        closed: {
                            label: 'Geschlossen',
                            name: 'closed',
                            type: 'toggle',
                            default: false,
                            saveable: true,
                            text: ['nein', 'ja']
                        },
                        timeblock1: {
                            label: 'Zeitraum 1',
                            name: 'timeblock1',
                            type: 'times',
                            saveable: true,
                            when: {
                                closed: false
                            }
                        },
                        timeblock2: {
                            label: 'Zeitraum 2',
                            name: 'timeblock2',
                            type: 'times',
                            saveable: true,
                            when: {
                                closed: false
                            }
                        }
                    }"
                    :value="value[weekday.id] ? value[weekday.id] : null"
                    @input="val => emitChange(weekday.id, val)"
                />
                <div style="height: 20px"></div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref, watch } from 'kirbyuse';
import dayjs from 'dayjs'

const props  = defineProps({
    label: {
        type: String,
        required: true,
    },
    value: Object,
    isDefault: Boolean,
    required: Boolean,
    disabled: Boolean,
    daterange: Object
})

const emit = defineEmits(["input"])

const weekdays = ref([
    { id: 'mo', name: 'Montag', isActive: false },
    { id: 'tu', name: 'Dienstag', isActive: false },
    { id: 'we', name: 'Mittwoch', isActive: false },
    { id: 'th', name: 'Donnerstag', isActive: false },
    { id: 'fr', name: 'Freitag', isActive: false },
    { id: 'sa', name: 'Samstag', isActive: false },
    { id: 'su', name: 'Sonntag', isActive: false }
])
const startDate = ref(null)
const endDate = ref(null)

const evaluateWeekdays = () => {
    if (props.isDefault) {
        weekdays.value.forEach(weekday => {
            weekday.isActive = true
        })

        return
    }

    if (!startDate.value || !endDate.value) {
        return
    }

    let loopDate = startDate.value
    let activeWeekdays = []

    while (loopDate.isBefore(endDate.value) || loopDate.isSame(endDate.value)) {
        activeWeekdays.push(loopDate.format('dd').toLowerCase())
        loopDate = loopDate.add(1, 'day')

        if (activeWeekdays.length >= 7) {
            break
        }
    }

    activeWeekdays = [...new Set(activeWeekdays)]

    weekdays.value.forEach(weekday => {
        weekday.isActive = activeWeekdays.includes(weekday.id.toString())
    })
}

const emitChange = (day, value) => {
    const updatedValue = {
        ...props.value,
        [day]: value
    }

    emit('input', updatedValue)
}

const onDaterangeChange = (daterange) => {
    if (daterange) {
        startDate.value = dayjs(daterange.start)
        endDate.value = dayjs(daterange.end)
    }

    evaluateWeekdays()
}

watch(() => props.daterange, (newValue) => {
    onDaterangeChange(newValue)
}, { deep: true })

watch(() => props.isDefault, (newValue) => {
    evaluateWeekdays()
})

onDaterangeChange(props.daterange)

</script>