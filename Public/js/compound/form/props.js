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

                this.fields = [];
                this.meta = {};
                this.event = event;

                // Create request
                ((new AIK).postman('Compound-getProps', event)).then(Event => {

                    if (Event.data.success === true) {
                        if (typeof Event.data.data.props == 'object' && Object.keys(Event.data.data.props).length > 0) {

                            for (const [name, value] of Object.entries(Event.data.data.props)) {

                                this.fields.push({
                                    name: name,
                                    value: value
                                });

                                this.props[name] = value;

                            }

                        }

                        if (typeof Event.data.data.meta == 'object') {
                            this.meta = Event.data.data.meta;
                        }

                        tb_show('Edit props of component', `/?TB_inline&inlineId=modal_edit_props&width=${CONFIG.modal.width || 600}&height=${CONFIG.modal.height || 700}`);

                    }

                });

            },

            submit: function (event) {

                const Request = (new AIK).postman('Compound-updateProps', Object.assign(this.event, {
                    type: this.type
                }, {
                    props: this.props || []
                }));

                Request.then(Event => {
                    this.__editor.updateMarkup().then(Event => {
                        tb_remove();
                    });
                });

            },

        }
    },
    ready: function (Event, $) {

    }
}));