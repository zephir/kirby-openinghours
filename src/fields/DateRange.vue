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
                    :invalid="!!dateError"
                    :help="dateError"
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
                    :invalid="!!dateError"
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

const dateError = ref(null)

const validateRange = ({ start, end }) => {
    const startDate = dayjs(start)
    const endDate = dayjs(end)

    if (startDate.isAfter(endDate)) {
        dateError.value = 'Start date must be before end date'
        return false
    }

    dateError.value = null

    return true
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

    const isValid = validateRange(updatedValue)

    if (!isValid) {
        return
    }

    console.log({ updatedValue })

    emit('input', updatedValue)
}

nextTick(() => {
    if (props.value?.start && props.value?.end) {
        emitChange(props.value)
    }
})
</script>