<template>
    <div class="k-openinghours-field">
        <k-toggle-field
            label="Standard Öffnungszeiten"
            :value="value.default"
            @input="val => emitChange('default', val)"
        />
        <k-text-field
            label="Bezeichnung"
            :value="value.label"
            @input="val => emitChange('label', val)"
            v-if="!value.default"
        />
        <DateRange
            label="Zeitraum"
            :value="value.daterange"
            @input="val => emitChange('daterange', val)"
            v-if="!value.default"
        />
        <Weekdays
            label="Wochentage"
            :value="value.weekdays"
            :daterange="value.daterange"
            :isDefault="value.default"
            @input="val => emitChange('weekdays', val)"
        />
    </div>
</template>

<script setup>
import DateRange from './DateRange.vue'
import Weekdays from './Weekdays.vue'

const props = defineProps({
    value: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(["input"])

const emitChange = (key, val) => {
    emit('input', {
        ...props.value,
        [key]: val
    })
}

</script>

<style lang="scss" scoped>
.k-openinghours-field {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
</style>