Project.export('@form-insertTemplate', new Interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#modal_insert_template']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#modal_insert_template",
        data: {
            __editor: CompoundEditor.vue || Object,
            form: [],
        },
        mounted: Event => {},
        methods: {
            open: function (event) {
                this.event = event;
                tb_show('Insert template', `/?TB_inline&inlineId=modal_insert_template&width=${CONFIG.modal.width||600}&height=${CONFIG.modal.height||700}`);
            },

            insert: function (event) {

                const Request = (new AIK).postman('Compound-insertTemplate', Object.assign(this.event, event, {
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