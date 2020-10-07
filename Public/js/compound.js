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

const CompoundEditor = Project.export('editor', new Interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#compound-editor-body']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#compound-editor-body",
        data: {
            markup: []
        },
        mounted: function (Event) {

            this.__updateMarkup().then(Data => {

                jQuery('[data-component="body"][data-namespace="editor"]').removeClass('hidden');
                jQuery('[data-component="spinner"][data-namespace="editor"]').addClass('hidden');

                // Hotkey registration
                const self = this;
                document.addEventListener('keydown', function (event) {
                    const key = event.key;
                    if (key === "Delete") {
                        const $templates = jQuery('[data-component="field-body"][data-selected]').map((i, el) => {
                            return jQuery(el).attr('data-id');
                        });

                        if ($templates.length > 0) {
                            self.removeTemplate({
                                template: $templates
                            }).then(Event => {
                                self.reloadPage();
                                $('[data-component="field-body"][data-selected]').selectable( "refresh" );
                            }).catch(Event => {

                            });
                        }
                    }
                });

                jQuery('[data-behavior="editor-template"][data-namespace="editor"][data-component="editor-body"]').selectable({
                    filter: '[data-component="field-body"]',
                    cancel: '[data-component="template-control"],[data-component="field-component"]',
                    selected: function( event, ui ) {
                        jQuery(ui.selected).attr('data-selected', true)
                    },
                    selecting: function( event, ui ) {
                        jQuery(ui.selected).attr('data-selected', true)
                    },
                    unselected: function( event, ui ) {
                        jQuery(ui.unselected).removeAttr('data-selected')
                    },
                    unselecting: function( event, ui ) {
                        jQuery(ui.unselected).removeAttr('data-selected')
                    },
                });

                jQuery('[data-behavior="editor-template"]').sortable({

                    axis: "y",
                    containment: "document",
                    disabled: true,
                    tolerance: "pointer",
                    placeholder: "__compound_box_placeholder",
                    connectWith: jQuery('[data-behavior="droppable"][data-namespace="editor"]'),
                    helper: 'clone',
                    opacity: 0.5,
                    cursor: "move",
                    forcePlaceholderSize: true,
                    revert: 80,

                    update: function (event, ui) {

                        var $order = [];

                        for (const [index, element] of Object.entries(jQuery('[data-component="field"][data-namespace="editor"]'))) {
                            const $id = jQuery(element).attr('data-id');
                            if ($id) {
                                $order.push($id);
                            }
                        }

                        const Request = new WPAjax('Compound-sort', {
                            page: Compound.page_on_edit || 0,
                            order: $order
                        });

                    },
                    start: (event, ui) => {

                        jQuery('[data-role="trash"][data-namespace="editor"]').removeClass('hidden');

                        this.__renderDroppable();
                        this.__renderPlaceholder(ui);

                    },
                    stop: (event, ui) => {

                        jQuery('[data-behavior="editor-template"][data-namespace="editor"][data-component="editor-body"]').sortable("option", "disabled", true);
                        jQuery('[data-role="trash"][data-namespace="editor"]').addClass('hidden');

                    }
                });

            }).catch(Data => {

                jQuery('[data-component="error"][data-namespace="editor"]').removeClass('hidden');
                jQuery('[data-component="spinner"][data-namespace="editor"]').addClass('hidden');

            });


        },
        methods: {

            editProps: function (event) {
                const $form = Project.import('@form-props').vue;
                $form.__editor = this;
                return $form.open(Object.assign({
                    page: Compound.page_on_edit || 0
                }, event));
            },

            insertComponent: function (event) {
                const $form = Project.import('@form-createComponent').vue;
                $form.__editor = this;
                return $form.open(Object.assign({
                    page: Compound.page_on_edit || 0,
                }, event));
            },

            insertTemplate: function (event) {
                const $form = Project.import('@form-insertTemplate').vue;
                $form.__editor = this;
                return $form.open(Object.assign({
                    page: Compound.page_on_edit || 0,
                }, event));
            },

            removeTemplate: function (event) {
                return new WPAjax('Compound-removeTemplate', {
                    page: Compound.page_on_edit || 0,
                    template: event.template
                });
            },

            reloadPage: function () {

                jQuery('[data-namespace="editor"][data-component="editor-body"]').animate({
                    opacity: 0.3
                });

                this.__updateMarkup().then(Event => {

                    jQuery('[data-namespace="editor"][data-component="editor-body"]').animate({
                        opacity: 1
                    });

                }).catch(Event => {

                    jQuery('[data-namespace="editor"][data-component="editor-body"]').animate({
                        opacity: 1
                    });

                });
            },

            __moveEnabled: function (event) {
                jQuery('[data-behavior="editor-template"][data-namespace="editor"][data-component="editor-body"]').sortable("option", "disabled", false);
            },

            __menuActionRemoveTemplate: function (event) {
                const Request = new WPAjax('Compound-removeTemplate', {
                    page: Compound.page_on_edit || 0,
                    template: event.template
                });

                Request.then(Event => {
                    this.__updateMarkup();
                }).catch(Event => {

                });
            },

            __menuActionEditTemplate: function (event) {
                // const Request = new WPAjax('Compound-removeTemplate', {
                //     page: Compound.page_on_edit || 0,
                //     template: event.template
                // });
                //
                // Request.then(Event => {
                //     this.__updateMarkup();
                // }).catch(Event => {
                //
                // });
            },

            __metaFieldClass__: function (event) {
                const $event = event || {};
                const $editor = $event.editor || {};
                return `__compound_field col-${$editor.col || 12}`;
            },

            __updateMarkup: function (event) {
                return new Promise((resolve, reject) => {

                    // Create main request
                    (new WPAjax('Compound-getMarkup', {
                        page: Compound.page_on_edit || 0
                    })).then(Event => {

                        var $buffer = [];

                        for (const [id, template] of Object.entries(Event.data.data)) {
                            $buffer.push({
                                name: template.props.name || 'default',
                                id: id,
                                fields: template.fields,
                                props: template.props
                            });
                        }

                        this.markup = $buffer;

                        // Resolve
                        resolve(Event.data.data);

                    }).catch(Event => {

                        // Reject
                        reject(Event);

                    });
                });
            },

            __renderDroppable: function (event) {
                return jQuery('[data-behavior="droppable"]').droppable({
                    accept: jQuery('[data-component="field"][data-namespace="editor"]'),
                    activeClass: 'wp-mrl-trash-active',
                    hoverClass: 'wp-mrl-trash-hover',

                    drop: (event, ui) => {
                        const $template = jQuery(ui.helper.context).attr('data-id');
                        this.removeTemplate({template: $template});
                        ui.draggable.remove();
                    }
                });
            },

            __renderPlaceholder: function (event) {
                return event.placeholder.height(event.item.height());
            }
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        }
    },
    ready: function (Event, $) {

    }
}));