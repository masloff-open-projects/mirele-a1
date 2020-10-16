if (typeof window.Compound != "undefined") {
    org.references.form.get.component.props = new org.interface({
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
                __editor: org.compound.editor.vue || Object,
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
                    (org.web.request('Compound/getProps', event)).then(Event => {

                        if (Event.status == 200) {
                            if (typeof Event.data.props == 'object' && Object.keys(Event.data.props).length > 0) {

                                for (const [name, value] of Object.entries(Event.data.props)) {

                                    this.fields.push({
                                        name: name,
                                        value: value
                                    });

                                    this.props[name] = value;

                                }

                            }

                            if (typeof Event.data.meta == 'object') {
                                this.meta = Event.data.meta;
                            }

                            tb_show('Edit props of component', `/?TB_inline&inlineId=modal_edit_props&width=${CONFIG.modal.width || 600}&height=${CONFIG.modal.height || 700}`);

                        } else {

                            this.__editor.vue.ui.notify.notify(this, {
                                text: 'Request to server failed',
                                type: 'danger'
                            });

                        }

                    });

                },

                submit: function (event) {

                    const Request = org.web.request('Compound/updateProps', Object.assign(this.event, {
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
    })
}