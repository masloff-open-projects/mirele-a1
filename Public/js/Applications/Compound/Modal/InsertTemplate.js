// this.$parent.props

Application.Components.Compound.InsertTemplate = Vue.component('modal-edit-component', {
    data: function () {
        return {
            component: null,
            attributes: {},
            editor: Application.Modules.Compound.vue,
            market: {}
        }
    },
    mounted: function () {
        
        this.store();
        
    },
    methods: {
        store: function (event) {
            new Application.Postman({
                method: 'CompoundPrivate/store',
                body: {
                    type: 'TEMPLATES'
                },
            }).then((e) => {
                this.market = e.data;
            }).catch((e) => {
            });
        },

        insert: function ($event) {
            new Application.Postman({
                method: 'CompoundPrivate/template',
                body: {
                    PageID: this.$parent.props.PageID,
                    template: event.target.attributes['data-compound-name'].value,
                    type: 'INSERT'
                },
            }).then((e) => {
                this.$parent.close();
                this.editor.update();
            }).catch((e) => {
                this.$parent.close();
                this.editor.update();
            });
        }
    },
    template: `
        <div class="__compound_modal_frame">
            <div class="__compound_modal_items grid-container gap-12">
                <div class="__compound_modal_item col-4 padding-x-4 padding-y-2 cursor-pointer" v-for="(item, name) in market" :data-compound-name="name" @click="insert">
                    <h4 class="margin-0 padding-0">{{item.about.title || 'Untitles'}}</h4>
                    {{item.about.description || 'Undefeated'}}
                </div>
            </div>
        </div> 
    `
});