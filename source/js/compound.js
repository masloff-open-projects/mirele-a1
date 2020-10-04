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

new Interface ({
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

            this.__updateMarkup();

            // jQuery(".jquery-selectable-compound").selectable();

            jQuery(".jquery-sortable-compound").sortable({
                tolerance: "pointer",
                placeholder: "wp-mrl-placeholder",
                connectWith: '#compound-editor-trash-area',
                helper: 'clone',
                // revert: true,
                opacity: 0.5,
                cursor: "move",

                update: function(event, ui) {
                    //Run this code whenever an item is dragged and dropped out of this list
                    var order = jQuery(this).sortable('serialize');
                },
                start: function(event, ui) {
                    // jQuery("#compound-editor-trash-area").slideDown('fast');
                },
                stop: function(event, ui) {

                    const $page = jQuery("#compound-editor-body").attr('data-page-id');
                    var $order = [];
                    for (const [index, element] of Object.entries(jQuery("#compound-editor-body > div"))) {
                        const $id = jQuery(element).attr('data-id');
                        if ($id) {
                            $order.push($id);
                        }
                    }

                    const Request = new WPAjax('Compound-sort', {
                        page: $page,
                        order: $order
                    });

                    // jQuery("#compound-editor-trash-area").slideUp('fast');
                }
            });
            // jQuery("#compound-editor-body").disableSelection();

            jQuery("#compound-editor-trash-area").droppable({
                accept: '#compound-editor-body > div',
                activeClass: 'wp-mrl-trash-active',
                hoverClass: 'wp-mrl-trash-hover',
                drop: function(event, ui) {

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
        methods: {

            editProps: function (event) {
                const $form = Project.import('@form-props').vue;
                return $form.open(Object.assign({
                    page: parseInt(jQuery('#compound-editor-body').attr('data-page-id'))
                }, event));
            },

            insertComponent: function (event) {
                const $form = Project.import('@form-createComponent').vue;
                return $form.open(Object.assign({
                    page: parseInt(jQuery('#compound-editor-body').attr('data-page-id'))
                }, event));
            },

            __metaFieldClass: function (event) {
                const $event = event||{};
                const $editor = $event.editor||{};
                return `wp-mrl-field col-${$editor.col||12}`;
            },

            __updateMarkup: function (event) {

                this.markup = [];

                // Create main request
                const Request = new WPAjax('Compound-getMarkup', {
                    page: parseInt(jQuery('#compound-editor-body').attr('data-page-id'))
                });

                Request.then(Event => {
                    for (const [id, template] of Object.entries(Event.data.data)) {
                        this.markup.push({
                            name: template.props.name || 'default',
                            id: id,
                            fields: template.fields,
                            props: template.props
                        });
                    }
                });


            }

        }
    },
    ready: function (Event, $) {

    }
});