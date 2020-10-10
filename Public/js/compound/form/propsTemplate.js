Project.export('@form-propsTemplate', new Interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#modal_edit_props_template']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#modal_edit_props_template",
        data: {
            __editor: CompoundEditor.vue || Object,
            meta: {},
            fields: [],
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
                ((new AIK).postman('Compound-getTemplateProps', event)).then(Event => {

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

                        tb_show('Edit props of component', `/?TB_inline&inlineId=modal_edit_props_template&width=${CONFIG.modal.width||600}&height=${CONFIG.modal.height||700}`);
                    }

                });

            },

            submit: function (event) {

                const Request = (new AIK).postman('Compound-updateTemplateProps', Object.assign(this.event, {
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