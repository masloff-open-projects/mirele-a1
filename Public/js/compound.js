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

const CONFIG = {
    modal: {
        width: 800,
        height: 600
    }
};

const CompoundEditor = Project.export('editor', new Interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#compound-editor']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#compound-editor",
        data: {
            markup: [],
            selected: [],
            tools: {
                left: [
                    {
                        title: '...',
                        icon: 'dashicons dashicons-plus',
                        href: false,
                        enabled: true,
                        click: function () {
                        }
                    },
                    {
                        title: '...',
                        icon: 'dashicons dashicons-plus',
                        href: false,
                        enabled: false,
                        click: function () {
                        }
                    },
                    {
                        title: '...',
                        icon: 'dashicons dashicons-external',
                        href: Compound.page_on_edit_url || false,
                        enabled: true,
                        click: function () {
                        }
                    },
                ],
                right: [
                    {
                        title: 'Remove selected templates',
                        icon: 'dashicons dashicons-trash',
                        href: false,
                        enabled: false,
                        click: function () {
                            return CompoundEditor.vue.transport().removeSelectedTemplates();
                        }
                    },

                    {
                        title: 'Remove selected templates',
                        icon: 'dashicons dashicons-update',
                        href: false,
                        enabled: true,
                        click: function () {
                            return CompoundEditor.vue.reloadPage();
                        }
                    }
                ]
            },
            ui: {
                notify: {
                    element: '[data-component="notify"][data-namespace="editor"][data-behavior="notify"][data-role="notify"]',
                    show: function (self, event) {
                        jQuery(this.element).removeClass('hidden');
                    },
                    hide: function (self, event) {
                        jQuery(this.element).addClass('hidden');
                    },
                    notify: function (self, event) {
                        this.show();

                        if (typeof (event || {}).html !== 'undefined') {
                            jQuery(this.element).html((event || {}).html || 'Not defined');
                        } else {
                            jQuery(this.element).text((event || {}).text || 'Not defined');
                        }

                        setTimeout(Event => {
                            this.hide();
                        }, (event || {}).timeout || 2500);
                    }
                },
                loader: {
                    element: '[data-component="spinner"][data-namespace="editor"][data-behavior="loader"][data-role="loader"]',
                    show: function (self, event) {
                        jQuery(this.element).removeClass('hidden');
                    },
                    hide: function (self, event) {
                        jQuery(this.element).addClass('hidden');
                    }
                },
                error: {
                    element: '[data-component="error"][data-namespace="editor"][data-behavior="error"][data-role="error"]',
                    show: function (self, event) {
                        jQuery(this.element).removeClass('hidden');
                    },
                    hide: function (self, event) {
                        jQuery(this.element).addClass('hidden');
                    }
                },
                layout: {
                    element: '[data-behavior="layout"][data-namespace="editor"][data-component="layout"][data-role="layout"]',
                    show: function (self, event) {
                        jQuery(this.element).removeClass('hidden');
                    },
                    hide: function (self, event) {
                        jQuery(this.element).addClass('hidden');
                    },
                    setSortable: function (boolean = true) {
                        if (boolean == true) {
                            jQuery(this.element).sortable("option", "disabled", !true);
                        } else if (boolean == false) {
                            jQuery(this.element).sortable("option", "disabled", !false);
                        }
                    },
                    blur: function (self, event) {
                        jQuery(this.element).blur();
                        jQuery(this.element).animate({
                            opacity: 0.3
                        });
                    },
                    focus: function (self, event) {
                        jQuery(this.element).focus();
                        jQuery(this.element).animate({
                            opacity: 1
                        });
                    },
                    getSelected: function (self, event) {

                        const $element = '[data-component="field-body"][data-selected]';

                        return jQuery($element).map((i, element) => {
                            return jQuery(element).attr('data-id') || 0;
                        }) || [];

                    },
                    mount: function (self, event) {

                        const context = this;

                        jQuery(this.element).selectable({
                            filter: '[data-component="field-body"]',
                            cancel: '[data-component="template-control"],[data-component="field-component"]',
                            selected: function (event, ui) {
                                jQuery(ui.selected).attr('data-selected', true);
                                self.selected = context.getSelected();
                            },
                            selecting: function (event, ui) {
                                jQuery(ui.selected).attr('data-selected', true);
                                self.selected = context.getSelected();
                            },
                            unselected: function (event, ui) {
                                jQuery(ui.unselected).removeAttr('data-selected');
                                self.selected = context.getSelected();
                            },
                            unselecting: function (event, ui) {
                                jQuery(ui.unselected).removeAttr('data-selected');
                                self.selected = context.getSelected();
                            },
                        });

                        jQuery(this.element).sortable({

                            axis: "xy",
                            containment: "document",
                            disabled: true,
                            // tolerance: "pointer",
                            placeholder: "__compound_box_placeholder",
                            connectWith: jQuery('[data-behavior="droppable"][data-namespace="editor"]'),
                            helper: 'clone',
                            opacity: 0.5,
                            cursor: "move",
                            forcePlaceholderSize: true,
                            revert: 80,
                            delay: 0,

                            update: function (event, ui) {
                                CompoundEditor.vue.updateOrder();
                            },
                            start: (event, ui) => {
                                ui.placeholder.height(ui.item.height());
                                self.ui.trash.show();
                                self.ui.trash.mount();
                            },
                            stop: (event, ui) => {
                                self.ui.layout.setSortable(false);
                                self.ui.trash.hide();
                            }
                        });

                    },
                    reset: function (self, event) {
                        CompoundEditor.vue.selected = [];
                        jQuery(this.element).selectable("refresh");
                    }
                },
                body: {
                    element: '[data-behavior="body"][data-namespace="editor"][data-component="body"][data-role="body"]',
                    show: function (self, event) {
                        jQuery(this.element).removeClass('hidden');
                    },
                    hide: function (self, event) {
                        jQuery(this.element).addClass('hidden');
                    }
                },
                trash: {
                    element: '[data-behavior="trash"][data-role="trash"][data-component="trash"][data-namespace="editor"]',
                    show: function (self, event) {
                        jQuery(this.element).removeClass('hidden');
                    },
                    hide: function (self, event) {
                        jQuery(this.element).addClass('hidden');
                    },
                    mount: function (self, event) {
                        return jQuery(this.element).droppable({
                            accept: jQuery('[data-component="field"][data-namespace="editor"]'),
                            activeClass: 'wp-mrl-trash-active',
                            hoverClass: '__compound_box_action_unset_hover',

                            drop: (event, ui) => {
                                const $template = jQuery(ui.helper.context).attr('data-id') || false;
                                ui.draggable.remove();
                                CompoundEditor.vue.removeTemplate({template: $template}).then(Event => {
                                    // FIXME
                                });
                            }
                        });
                    }
                }
            }
        },
        mounted: function (Event) {

            this.updateMarkup().then(Data => {

                this.ui.loader.hide(this);
                this.ui.body.show(this);
                this.ui.layout.mount(this);

            }).catch(Data => {

                this.ui.loader.hide(this);
                this.ui.error.show(this);

            });

        },
        methods: {

            updateMarkup: function (event) {
                return new Promise((resolve, reject) => {

                    // Create main request
                    ((new AIK).postman('Compound-getMarkup', {
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

            editTemplate: function (event) {
                const $form = Project.import('@form-propsTemplate').vue;
                $form.__editor = this;
                return $form.open(Object.assign({
                    page: Compound.page_on_edit || 0
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
                return (new AIK).postman('Compound-removeTemplate', {
                    page: Compound.page_on_edit || 0,
                    template: event.template
                });
            },

            reloadPage: function () {
                this.ui.layout.blur()
                this.updateMarkup().then(Event => {
                    this.ui.layout.focus();
                    CompoundEditor.vue.ui.notify.notify(false, {
                        html: '<span class="dashicons dashicons-saved"></span> Changes have been successfully saved'
                    });
                }).catch(Event => {
                    this.ui.layout.focus();
                });
            },

            updateOrder: function () {
                var $order = [];

                for (const [index, element] of Object.entries(jQuery('[data-component="field"][data-namespace="editor"]'))) {
                    const $id = jQuery(element).attr('data-id');
                    if ($id) {
                        $order.push($id);
                    }
                }

                const Request = (new AIK).postman('Compound-sortOrder', {
                    page: Compound.page_on_edit || 0,
                    order: $order
                });
            },

            transport: function () {
                const self = CompoundEditor.vue;
                return {
                    removeSelectedTemplates: function () {
                        if (self.selected.length > 0) {
                            self.removeTemplate({template: self.selected}).then(Event => {
                                self.ui.layout.reset();
                                self.reloadPage();
                            });
                        }
                    },
                    removeTemplate: function (event) {
                        if (event.template) {
                            const Request = (new AIK).postman('Compound-removeTemplate', {
                                page: Compound.page_on_edit || 0,
                                template: event.template
                            });

                            Request.then(Event => {
                                self.reloadPage();
                            }).catch(Event => {
                                // FIXME
                            });
                        }
                    },
                    cloneTemplate: function (event) {
                        if (event.template) {
                            const Request = (new AIK).postman('Compound-cloneTemplate', {
                                page: Compound.page_on_edit || 0,
                                template: event.template
                            });

                            Request.then(Event => {
                                self.reloadPage();
                            }).catch(Event => {
                                // FIXME
                            });
                        }
                    },
                };
            },


            __menuActionEditTemplate: function (event) {

            },

            __metaFieldClass__: function (event) {
                const $event = event || {};
                const $editor = $event.editor || {};
                return `__compound_field col-${$editor.col || 12}`;
            },

        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },
        watch: {
            selected: function (event) {
                if (event.length > 0) {
                    this.tools.right[0].enabled = true;
                } else {
                    this.tools.right[0].enabled = false;
                }
            }
        }
    },
    ready: function (Event, $) {

        // Hotkey registration
        document.addEventListener('keydown', Event => {

            const key = Event.key || '';
            const self = CompoundEditor.vue || {};

            if (key === "Delete") {
                self.transport().removeSelectedTemplates();
            }
        });
        
        // Meta info
        const CompoundMeta = Project.export('page-meta', new Interface({
            requires: {
                vue: true,
                jquery: true
            },
            elements: {
                vue: ['#compound-meta']
            },
            vue: {
                delimiters: ['{', '}'],
                el: "#compound-meta",
                data: {
                    updated: true,
                    meta: []
                },
                mounted: function (Event) {

                    const self = this;

                    (new AIK).postman('Compound-getPage', {
                        page: Compound.page_on_edit || 0
                    }).then(Event => {
                        self.meta = Event.data.data;
                    });

                },
                methods: {

                    submit: function () {

                        this.__show_loader();

                        var $props = {};

                        jQuery(jQuery('#compound-meta').serializeArray()).each(function(index, obj){
                            $props[obj.name] = obj.value;
                        });

                        (new AIK).postman('Compound-updatePage', {
                            props: $props,
                            page: Compound.page_on_edit || 0
                        }).then(Event => {
                            console.log(Event.data.data);
                            this.__hide_loader();
                        })


                    },
                    
                    __is_updated: function () {
                        return this.updated;
                    },

                    __show_loader: function () {
                        return this.updated = false;
                    },

                    __hide_loader: function () {
                        return this.updated = true;
                    }

                },
                filters: {},
                watch: {}
            }
        }));

    }
}));