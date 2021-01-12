Application.Components.Compound.EditComponent = Vue.component('modal-edit-component', {
    data: function () {
        return {
            component: null,
            attributes: {},
            editor: Application.Modules.Compound.vue,
            tabs: {
                props: {
                    title: 'Props'
                },
                design: {
                    title: 'Design'
                },
                manage: {
                    title: 'Manage'
                }
            },
            activeTab: 'props',
            availableUpdate: true
        }
    },
    components: Application.Modules.CompoundPrototypes || {},
    methods: {
        update: function (event) {

            this.availableUpdate = false;

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
                
            }).catch((e) => {

            }).finally((e) => {

                this.availableUpdate = true;

                this.$parent.close();
                this.editor.update();

            });
        },
        
        prototype: function (name) {
            return Application.Modules.CompoundPrototypes[name] || Application.Modules.CompoundPrototypes['default'] || false;
        }
    },
    template: `
        <div>
            <div class="__compound_modal_tabs_body">
                <a href="#" :class="['__compound_modal_tabs_tab', index == activeTab ? 'current' : '']" v-for="(tab, index) in tabs" v-text="tab.title" @click.prevent="activeTab = index"></a>
            </div>
    
            <div class="__compound_modal_body">
               
                <div class="margin-buttom-4" v-for="(attr, name) in this.$parent.props.Document[this.$parent.props.Index][this.$parent.props.Template][this.$parent.props.Area][this.$parent.props.Component].attributes">
                    <component v-bind:is="prototype(name)" :name="name" :value="attr"></component>     
                </div>
                  
            </div>
            
            <div class="__compound_modal_footer">
                <a :class="['button', 'button-primary', 'right', availableUpdate === false ? 'disabled' : '']" @click="update">Update</a>
            </div>
                      
        </div> 
    `
});