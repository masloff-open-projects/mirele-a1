Project.export('@form-props', new Interface ({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#modal_edit_props']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#modal_edit_props",
        data: {
            fields: [],
            component: [],
            props: [],
            type: 'update'
        },
        mounted: Event => {},
        methods: {
            open: function (event) {

                this.event = event;

                // Load modal
                const $modal = jQuery('#modal_edit_props');

                // Create request
                const Request = new WPAjax('Compound-getProps', event);

                this.fields = [];

                Request.then(Event => {
                    if (Event.data.success == true) {
                        for (const [name, value] of Object.entries(Event.data.data)) {
                            this.fields.push({
                                name: name,
                                value: value
                            });

                            this.props[name] = value;
                        }
                    }
                });

                tb_show('Edit props of component', '/?TB_inline&inlineId=modal_edit_props&width=700&height=500');

            },

            submit: function (event) {
                const Request = new WPAjax('Compound-updateProps', Object.assign(this.event, {
                    type: this.type
                }, {
                    props: this.props
                }));
            }
        }
    },
    ready: function (Event, $) {

    }
}));