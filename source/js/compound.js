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

const $page = parseInt(jQuery('meta[name="page"]').attr('content'));

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

                jQuery('[data-behavior="sortable"]').sortable({

                    tolerance: "pointer",
                    placeholder: "wp-mrl-placeholder",
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
                            page: $page,
                            order: $order
                        });

                    },
                    start: (event, ui) => {

                        jQuery('[data-role="trash"][data-namespace="editor"]').removeClass('hidden');
                        this.__renderDroppable();
                        this.__renderPlaceholder(ui);

                    },
                    stop: (event, ui) => {

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
                    page: $page
                }, event));
            },

            insertComponent: function (event) {
                const $form = Project.import('@form-createComponent').vue;
                $form.__editor = this;
                return $form.open(Object.assign({
                    page: $page,
                }, event));
            },

            __metaFieldClass__: function (event) {
                const $event = event || {};
                const $editor = $event.editor || {};
                return `wp-mrl-field col-${$editor.col || 12}`;
            },

            __updateMarkup: function (event) {
                return new Promise((resolve, reject) => {

                    // Create main request
                    const Request = new WPAjax('Compound-getMarkup', {
                        page: $page
                    });

                    Request.then(Event => {

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

                    drop: function (event, ui) {

                        const $template = jQuery(ui.helper.context).attr('data-id');
                        const $id = jQuery(ui.helper.context).attr('data-page-id');

                        const Request = new WPAjax('Compound-removeTemplate', {
                            id: $id,
                            template: $template
                        });

                        ui.draggable.remove();

                    }
                });
            },

            __renderPlaceholder: function (event) {
                return event.placeholder.height(event.item.height());
            }
        }
    },
    ready: function (Event, $) {

    }
}));