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
                        from1: {
                            label: 'Von',
                            name: 'from1',
                            type: 'time',
                            saveable: true,
                            when: {
                                closed: false
                            }
                        },
                        to1: {
                            label: 'Bis',
                            name: 'to1',
                            type: 'time',
                            saveable: true,
                            when: {
                                closed: false
                            }
                        },
                        from2: {
                            label: 'Von',
                            name: 'from2',
                            type: 'time',
                            saveable: true,
                            when: {
                                closed: false
                            }
                        },
                        to2: {
                            label: 'Bis',
                            name: 'to2',
                            type: 'time',
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
    if (!startDate.value || !endDate.value) {
        return
    }

    let loopDate = startDate.value
    let activeWeekdays = []

    while (loopDate.isBefore(endDate.value) || loopDate.isSame(endDate.value)) {
        activeWeekdays.push(loopDate.format('dd').toLowerCase())
        loopDate = loopDate.add(1, 'day')
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
    startDate.value = dayjs(daterange.start)
    endDate.value = dayjs(daterange.end)

    evaluateWeekdays()
}

watch(() => props.daterange, (newValue) => {
    onDaterangeChange(newValue)
}, { deep: true })

onDaterangeChange(props.daterange)

</script>