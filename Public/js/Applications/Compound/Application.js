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
                    components: [],
                    templates: []
                },
                document: false,
                style: false,
                selected: [],
                bufferCopyPaste: [],
                thereCriticalError: false
            },

            mounted: function (e=null) {

                jQuery('.__compound_hide_before_mounted').removeClass('__compound_hide_before_mounted');

                const self = this;
                
                this.update().then(event => {

                    jQuery(".__compound_editor_document").selectable({
                        filter: '.__compound_editor_container',
                        // cancel: '[data-component="template-control"],[data-component="field-component"]',
                        // selected: function (event, ui) {
                        //     this.selected = context.getSelected();
                        // },
                        // selecting: function (event, ui) {
                        //     this.selected = context.getSelected();
                        // },
                        // unselected: function (event, ui) {
                        //     this.selected = context.getSelected();
                        // },
                        // unselecting: function (event, ui) {
                        //     this.selected = context.getSelected();
                        // },
                        stop: function () {
                            self.selected = [];
                            jQuery(".ui-selected", this ).each(function() {
                                self.selected.push(jQuery(this).attr('data-compound-path'));
                            });
                        }
                    });

                    jQuery("#compound_layout").sortable({

                        axis: "xy",
                        containment: "document",
                        disabled: true,
                        tolerance: "pointer",
                        placeholder: "__compound_placeholder",
                        // connectWith: jQuery('[data-behavior="droppable"][data-namespace="editor"]'),
                        helper: 'clone',
                        opacity: 0.5,
                        cursor: "move",
                        forcePlaceholderSize: true,
                        revert: 20,
                        delay: 0,

                        start: (event, ui) => {
                            ui.placeholder.height(ui.item.height());
                        },
                        stop: (event, ui) => {
                            jQuery("#compound_layout").sortable("option", "disabled", true);
                        },
                        update: (event, ui) => {

                            var order = [];

                            jQuery("#compound_layout").find('.__compound_editor_index').each(function () {
                                order.push(jQuery(this).attr('data-compound-path'));
                            });

                            self.updateOrder(order);

                        }
                    });

                    jQuery(document).keydown(function(e){
                        if (self.selected != [] && self.selected != null && self.selected) {
                            if(e.ctrlKey && e.keyCode == 86){
                                e.preventDefault();
                                self.dublicate(self.bufferCopyPaste);
                            } else if (e.ctrlKey && e.keyCode == 67) {
                                e.preventDefault();
                                self.bufferCopyPaste = self.selected;
                            } else if (e.ctrlKey && e.keyCode == 46) {
                                e.preventDefault();
                                self.remove(self.selected);
                            }
                        }

                        if (e.ctrlKey && e.keyCode == 82) {
                            e.preventDefault();
                            self.update();
                        }
                    })

                }).catch(event => {

                });

                new Application.Postman({
                    method: 'CompoundPrivate/store',
                    body: {
                        type: 'COMPONENTS'
                    },
                }).then((e) => {
                    this.store.components = e.data;
                }).catch((e) => {

                });

                new Application.Postman({
                    method: 'CompoundPrivate/store',
                    body: {
                        type: 'TEMPLATES'
                    },
                }).then((e) => {
                    this.store.templates = e.data;
                }).catch((e) => {
                });

            },

            methods: {

                __editor: function (template, area) {
                    try {
                        return this.store.templates[template]['editor'][area];
                    } catch (e) {
                        return {};
                    }
                },

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

                error: function (code) {

                    this.thereCriticalError = ({
                        901: {
                            title: 'Template code is broken',
                            description: 'Your template code is corrupted. Most likely because you made a mistake when manually editing the document.' +
                                "<br>Please revert the document to an earlier version or recreate the page",
                        }
                    })[code];

                },

                update: function () {

                    const self = this;

                    jQuery('.__compound_editor_area').addClass('__compound_almost_inaccessible');

                    return this.__getMarkup().then(event => {

                        if (event.status == 500) {
                            this.error(901);
                        }

                        if (event.data.document) {

                            jQuery('.ui-selected').removeClass('ui-selected');

                            this.document = Object.freeze(event.data.document);
                            this.style = Object.freeze(event.data.style);

                            return true;

                        } else {
                            return this.document = false;
                        }

                    }).catch(event => {
                        
                    }).finally(event => {

                        jQuery('.__compound_editor_area').removeClass('__compound_almost_inaccessible');

                    });

                },

                editComponent: function ($event) {

                    const modal = Application.Modules.CompoundModal.vue;
                    const component = Application.Components.Compound.EditComponent;

                    console.log($event.target.attributes)

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
                        PageID: Application.Constants.WordPress.ID,

                        templates: this.store.templates
                    });

                },

                insertComponent: function ($event) {

                    const modal = Application.Modules.CompoundModal.vue;
                    const component = Application.Components.Compound.InsertComponent;

                    modal.mount(component);
                    modal.open({
                        PageID: Application.Constants.WordPress.ID,
                        path: $event.target.attributes['data-compound-path'].value,
                        components: this.store.components
                    });

                },

                dublicate: function (templates) {

                    new Application.Postman({
                        method: 'CompoundPrivate/template',
                        body: {
                            PageID: Application.Constants.WordPress.ID,
                            type: 'DUBLICATE',
                            DUBLICATE: templates || this.selected
                        },
                    }).then((e) => {
                        this.update();
                    }).catch((e) => {
                        this.update();
                    });

                },

                remove: function (templates) {

                    new Application.Postman({
                        method: 'CompoundPrivate/template',
                        body: {
                            PageID: Application.Constants.WordPress.ID,
                            type: 'DELETE',
                            DELETE: templates || this.selected
                        },
                    }).then((e) => {
                        this.update();
                    }).catch((e) => {
                        this.update();
                    });

                },

                updateOrder: function (order) {

                    new Application.Postman({
                        method: 'CompoundPrivate/template',
                        body: {
                            PageID: Application.Constants.WordPress.ID,
                            type: 'ORDER',
                            ORDER: order || []
                        },
                    }).finally((e) => {
                        this.update();
                    })

                },

                _mouseoverTemplateTools: function ($event) {

                    const container = jQuery($event.target).closest('.__compound_editor_template').find('[data-selected]');

                    container.attr('data-selected', 'true');
                    jQuery("#compound_layout").sortable("option", "disabled", false);


                },

                _mouseleaveTemplateTools: function ($event) {

                    const container = jQuery($event.target).closest('.__compound_editor_template').find('[data-selected]');

                    container.attr('data-selected', 'false');
                    jQuery("#compound_layout").sortable("option", "disabled", true);

                },

            }
        },
        ready: function () {

        }
    });

}