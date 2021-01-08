// this.$parent.props

Application.Components.Compound.AppendComponent = Vue.component('modal-edit-component', {
    data: function () {
        return {
            component: null,
            attributes: {},
            editor: Application.Modules.Compound.vue
        }
    },
    mounted: function () {

    },
    methods: {
        insert: function ($event) {
            new Application.Postman({
                method: 'CompoundPrivate/component',
                body: {
                    PageID: this.$parent.props.PageID,
                    Area: this.$parent.props.Area,
                    Template: this.$parent.props.Template,
                    Index: this.$parent.props.Index,

                    component: event.target.attributes['data-compound-name'].value,
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
                <div class="__compound_modal_item col-4 padding-x-4 padding-y-2 cursor-pointer" v-for="(component, componentName) in this.$parent.props.components" :data-compound-name="componentName" @click="insert">
                    {{component.about.title}}
                </div>
            </div>
        </div> 
    `
});