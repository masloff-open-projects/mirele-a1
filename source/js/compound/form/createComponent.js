Project.export('@form-createComponent', new Interface ({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#modal_insert_component']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#modal_insert_component",
        data: {

        },
        mounted: Event => {},
        methods: {
            open: function (event) {

                this.event = event;

                // Load modal
                const $modal = jQuery('#modal_insert_component');

                tb_show('Insert component', '/?TB_inline&inlineId=modal_insert_component&width=600&height=700');

            },

            submit: function (event) {
                alert(4);
            }
        }
    },
    ready: function (Event, $) {

    }
}));