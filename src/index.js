import OpeningHours from './fields/OpeningHours.vue'
import DateRange from './fields/DateRange.vue'
import TimeRange from './fields/TimeRange.vue'

import OpeningHoursPreview from './components/OpeningHoursPreview.vue'
import TimeRangePreview from './components/TimeRangePreview.vue'

panel.plugin("zephir/openinghours", {
    fields: {
        'daterange': DateRange,
        'times': TimeRange,
        'openinghours': OpeningHours,
    },
    components: {
        'k-openinghours-field-preview': OpeningHoursPreview,
        'k-times-field-preview': TimeRangePreview,
    }
});
