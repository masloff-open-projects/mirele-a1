Project.export('@form-props', new Interface({
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
            __editor: CompoundEditor.vue || Object,
            meta: {},
            fields: [],
            component: [],
            props: [],
            type: 'update'
        },
        mounted: Event => {
        },
        methods: {
            open: function (event) {

                this.event = event;

                // Load modal
                const $modal = jQuery('#modal_edit_props');

                // Create request
                const Request = new WPAjax('Compound-getProps', event);

                this.fields = [];
                this.meta = {};

                Request.then(Event => {
                    if (Event.data.success === true) {
                        if (typeof Event.data.data.props == 'object') {

                            for (const [name, value] of Object.entries(Event.data.data.props)) {

                                this.fields.push({
                                    name: name,
                                    value: value
                                });

                                this.props[name] = value;

                            }

                            jQuery('[data-component="spinner"][data-namespace="modal-props"]').addClass('hidden');
                            jQuery('[data-component="body"][data-namespace="modal-props"]').removeClass('hidden');
                        }

                        if (typeof Event.data.data.meta == 'object') {
                            this.meta = Event.data.data.meta;
                        }
                    }
                });

                tb_show('Edit props of component', '/?TB_inline&inlineId=modal_edit_props&width=600&height=700');

            },

            submit: function (event) {

                const Request = new WPAjax('Compound-updateProps', Object.assign(this.event, {
                    type: this.type
                }, {
                    props: this.props
                }));

                Request.then(Event => {
                    this.__editor.__updateMarkup().then(Event => {
                        tb_remove();
                    });
                });

            }
        }
    },
    ready: function (Event, $) {

    }
}));