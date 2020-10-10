Project.export('@form-createComponent', new Interface({
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
            __editor: CompoundEditor.vue || Object,
            form: [],
        },
        mounted: Event => {
        },
        methods: {
            open: function (event) {
                this.event = event;
                tb_show('Insert component', `/?TB_inline&inlineId=modal_insert_component&width=${CONFIG.modal.width||600}&height=${CONFIG.modal.height||700}`);
            },

            create: function (event) {

                const Request = (new AIK).postman('Compound-insertComponent', Object.assign(this.event, event, {
                    page: Compound.page_on_edit || 0
                }));

                Request.then(Event => {
                    this.__editor.updateMarkup().then(Event => {
                        tb_remove();
                    });
                });

                return false;

            },

            submit: function (event) {

            }
        }
    }
}));