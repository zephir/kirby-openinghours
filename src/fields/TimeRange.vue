<template>
    <k-field
        class="k-timerange-field"
        v-bind="props"
        :label="label"
        :required="required"
        :disabled="disabled"
    >
        <k-grid variant="fields">
            <k-column width="6/12">
                <k-time-field
                    label="Von"
                    :value="value?.start"
                    @input="val => emitChange(val, 'start')"
                    type="date"
                    name="from"
                    :time="false"
                    default="now"
                    :required="required"
                />
            </k-column>
            <k-column width="6/12">
                <k-time-field
                    label="Bis"
                    :value="value?.end"
                    @input="val => emitChange(val, 'end')"
                    type="date"
                    name="end"
                    :time="false"
                    default="now"
                    :required="required"
                />
            </k-column>
        </k-grid>
    </k-field>

</template>

<script setup>
import { nextTick, ref } from 'kirbyuse';
import dayjs from 'dayjs'

const props  = defineProps({
    label: {
        type: String,
        required: true,
    },
    value: {
        type: Object,
    },
    required: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    },
})

const emit = defineEmits(["input"])

const validateRange = ({ start, end }, changedValue) => {
    if (!start || !end) {
        return { start, end }
    }

    const startTimes = start.split(':')
    const endTimes = end.split(':')

    let startDate = dayjs('01.01.2000')
    let endDate = dayjs('01.01.2000')

    startDate = startDate.hour(startTimes[0])
    startDate = startDate.minute(startTimes[1])
    endDate = endDate.hour(endTimes[0])
    endDate = endDate.minute(endTimes[1])

    if (changedValue === 'start' && endDate.isBefore(startDate)) {
        endDate = startDate
    } else if (changedValue === 'end' && startDate.isAfter(endDate)) {
        startDate = endDate
    }

    return {
        start: startDate.format('HH:mm:ss'),
        end: endDate.format('HH:mm:ss'),
    }
}

const emitChange = (value, name) => {
    let updatedValue

    if (name) {
        updatedValue = {
            ...props.value,
            [name]: value
        }
    } else {
        updatedValue = value
    }

    if (updatedValue.start && !updatedValue.end) {
        updatedValue.end = updatedValue.start
    }

    updatedValue = validateRange(updatedValue, name)

    emit('input', updatedValue)
}

nextTick(() => {
    if (props.value?.start && props.value?.end) {
        emitChange(props.value)
    }
})
</script>