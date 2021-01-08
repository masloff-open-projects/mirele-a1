/**
 * Welcome to the source code
 *
 * ███╗░░░███╗██╗██████╗░███████╗██╗░░░░░███████╗        ░░░░░██╗░██████╗
 * ████╗░████║██║██╔══██╗██╔════╝██║░░░░░██╔════╝        ░░░░░██║██╔════╝
 * ██╔████╔██║██║██████╔╝█████╗░░██║░░░░░█████╗░░        ░░░░░██║╚█████╗░
 * ██║╚██╔╝██║██║██╔══██╗██╔══╝░░██║░░░░░██╔══╝░░        ██╗░░██║░╚═══██╗
 * ██║░╚═╝░██║██║██║░░██║███████╗███████╗███████╗        ╚█████╔╝██████╔╝
 * ╚═╝░░░░░╚═╝╚═╝╚═╝░░╚═╝╚══════╝╚══════╝╚══════╝        ░╚════╝░╚═════╝░
 *
 * ░█████╗░██████╗░███╗░░░███╗██╗███╗░░██╗██╗░██████╗████████╗██████╗░░█████╗░████████╗░█████╗░██████╗░
 * ██╔══██╗██╔══██╗████╗░████║██║████╗░██║██║██╔════╝╚══██╔══╝██╔══██╗██╔══██╗╚══██╔══╝██╔══██╗██╔══██╗
 * ███████║██║░░██║██╔████╔██║██║██╔██╗██║██║╚█████╗░░░░██║░░░██████╔╝███████║░░░██║░░░██║░░██║██████╔╝
 * ██╔══██║██║░░██║██║╚██╔╝██║██║██║╚████║██║░╚═══██╗░░░██║░░░██╔══██╗██╔══██║░░░██║░░░██║░░██║██╔══██╗
 * ██║░░██║██████╔╝██║░╚═╝░██║██║██║░╚███║██║██████╔╝░░░██║░░░██║░░██║██║░░██║░░░██║░░░╚█████╔╝██║░░██║
 * ╚═╝░░╚═╝╚═════╝░╚═╝░░░░░╚═╝╚═╝╚═╝░░╚══╝╚═╝╚═════╝░░░░╚═╝░░░╚═╝░░╚═╝╚═╝░░╚═╝░░░╚═╝░░░░╚════╝░╚═╝░░╚═╝
 *
 *
 *
 * @package Mirele
 * @author Mirele
 * @version 1.0.0
 *
 * @see https://vuejs.org/v2/guide/
 */

"use strict";

if (Application) {

    Application.Modules.Compound = new Application.Interface({
        requires: {
            vue:    true,
            jquery: true
        },
        elements: {
            vue: ['#compound__editor__frame']
        },
        vue: {
            delimiters: Application.Config.VUE.Delimiters,
            el: '#compound__editor__frame',
            data: {
                store: {
                    components: []
                },
                document: false
            },

            mounted: function (e=null) {

                this.update();

                new Application.Postman({
                    method: 'CompoundPrivate/store',
                    body: {
                        type: 'COMPONENTS'
                    },
                }).then((e) => {
                    this.store.components = e.data;
                }).catch((e) => {
                });

            },

            methods: {

                __about: function (component) {

                    if (typeof this.store.components[component.component] !== "undefined") {
                        if (typeof this.store.components[component.component].about !== "undefined") {
                            return this.store.components[component.component].about;
                        }
                    }

                    return {
                        title: "Undefined",
                        description: "Undefined",
                        icon: false,
                    };

                },

                __getMarkup: function (event) {
                    return new Application.Postman({
                        method: 'CompoundPrivate/markup',
                        body: {
                            id: Application.Constants.WordPress.ID
                        }
                    })
                },

                update: function () {

                    return this.__getMarkup().then(event => {
                        if (event.data.document) {
                            this.document = Object.freeze(event.data.document);
                        } else {
                            this.document = false;
                        }
                    }).catch(event => {

                    });

                },

                editComponent: function ($event) {

                    const modal = Application.Modules.CompoundModal.vue;
                    const component = Application.Components.Compound.EditComponent;

                    modal.mount(component);
                    modal.open({
                        PageID: Application.Constants.WordPress.ID,
                        Area: $event.target.attributes['data-compound-area'].value,
                        Template: $event.target.attributes['data-compound-template'].value,
                        Index: $event.target.attributes['data-compound-index'].value,

                        Component: $event.target.attributes['data-compound-component'].value,
                        Document: this.document
                    });

                },

                insertTemplate: function ($event) {

                    const modal = Application.Modules.CompoundModal.vue;
                    const component = Application.Components.Compound.InsertTemplate;

                    modal.mount(component);
                    modal.open({
                        PageID: Application.Constants.WordPress.ID
                    });

                },

                appendComponent: function ($event) {

                    const modal = Application.Modules.CompoundModal.vue;
                    const component = Application.Components.Compound.AppendComponent;

                    modal.mount(component);
                    modal.open({
                        PageID: Application.Constants.WordPress.ID,
                        Area: $event.target.attributes['data-compound-area'].value,
                        Template: $event.target.attributes['data-compound-template'].value,
                        Index: $event.target.attributes['data-compound-index'].value,

                        components: this.store.components
                    });

                }

            }
        },
        ready: function () {

        }
    });

}