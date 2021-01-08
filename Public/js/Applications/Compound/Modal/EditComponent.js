// this.$parent.props

Application.Components.Compound.EditComponent = Vue.component('modal-edit-component', {
    data: function () {
        return {
            component: null,
            attributes: {},
            editor: Application.Modules.Compound.vue
        }
    },
    methods: {
        update: function (event) {
            new Application.Postman({
                method: 'CompoundPrivate/component',
                body: {
                    PageID: this.$parent.props.PageID,
                    Area: this.$parent.props.Area,
                    Template: this.$parent.props.Template,
                    Component: this.$parent.props.Component,
                    Index: this.$parent.props.Index,
                    type: 'UPDATE',
                    UPDATE: this.attributes
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
        <div>
        
            <div class="grid-container margin-buttom-4" v-for="(attr, name) in this.$parent.props.Document[this.$parent.props.Index][this.$parent.props.Template][this.$parent.props.Area][this.$parent.props.Component].attributes">
                <div class="col-6">
                    <h4 class="width-100 margin-0 display-block">{{name}}</h4>
                    <p class="margin-0 display-block"/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi, consequuntur debitis dicta obcaecati sunt tempore temporibus! Assumenda esse ex illum minima, praesentium quae quis quos rem sint tenetur voluptatem.</p>
                </div>
                
                <div class="col-6">
                    <input type="text" :data-model="attributes[name] = attr" v-model="attributes[name]" :id="name" :name="name">
                </div>
            </div>
            
            <button class="button button-primary button-large" @click="update">Update</button>
            
            <a class="deletion" href="#">Move to Trash</a>
            
        </div> 
    `
});