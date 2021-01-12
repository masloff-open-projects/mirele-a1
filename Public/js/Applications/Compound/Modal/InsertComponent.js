Application.Components.Compound.InsertComponent = Vue.component('modal-edit-component', {
    data: function () {
        return {
            component: null,
            attributes: {},
            editor: Application.Modules.Compound.vue,
            spinner: false
        }
    },
    methods: {
        insert: function ($event) {
            this.spinner = true;
            new Application.Postman({
                method: 'CompoundPrivate/component',
                body: {
                    PageID: this.$parent.props.PageID,
                    path: this.$parent.props.path,
                    component: $event.target.attributes['data-compound-name'].value,
                    type: 'INSERT'
                },
            }).finally((e) => {
                this.$parent.close();
                this.editor.update();
                this.spinner = false;
            })
        }
    },
    template: `
         <div class="__compound_modal_body">
             <div class="__compound_spinner" v-if="spinner === true">
                <span class="spinner is-active"></span>
            </div>
         
             <div class="__compound_modal_frame" v-else>
                <div class="__compound_modal_items grid-container gap-12">
                    <div class="__compound_modal_item col-4 padding-x-4 padding-y-2 cursor-pointer" v-for="(component, componentName) in this.$parent.props.components" :data-compound-name="componentName" @click="insert">
                        {{component.about.title}}
                    </div>
                </div>
             </div>
         </div>
    `
});