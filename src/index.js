import OpeningHours from './fields/OpeningHours.vue'
import OpeningHoursPreview from './components/OpeningHoursPreview.vue'

panel.plugin("zephir/openinghours", {
    fields: {
        'openinghours': OpeningHours,
    },
    components: {
        'k-openinghours-field-preview': OpeningHoursPreview,
    }
});
