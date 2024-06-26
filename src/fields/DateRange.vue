<template>
    <k-field
        class="k-daterange-field"
        v-bind="props"
        :label="label"
        :required="required"
        :disabled="disabled"
    >
        <k-grid variant="fields">
            <k-column width="6/12">
                <k-date-field
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
                <k-date-field
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
    required: Boolean,
    disabled: Boolean,
})

const emit = defineEmits(["input"])

const validate = ({ start, end }, changedValue) => {
    let startDate = dayjs(start)
    let endDate = dayjs(end)

    if (changedValue === 'start' && endDate.isBefore(startDate)) {
        endDate = startDate
    } else if (changedValue === 'end' && startDate.isAfter(endDate)) {
        startDate = endDate
    }

    startDate = startDate.hour(0).minute(0).second(0)
    endDate = endDate.hour(23).minute(59).second(59)

    return {
        start: startDate.format(),
        end: endDate.format()
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

    updatedValue = validate(updatedValue, name)

    emit('input', updatedValue)
}

nextTick(() => {
    if (props.value?.start && props.value?.end) {
        emitChange(props.value)
    }
})
</script>