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
        data: {},
        mounted: Event => {
            jQuery("#compound-editor-body").sortable({
                placeholder: "wp-mrl-placeholder",
                connectWith: '#compound-editor-trash-area',
                helper: 'clone',
                // revert: true,
                opacity: 0.5,
                update: function(event, ui) {
                    //Run this code whenever an item is dragged and dropped out of this list
                    var order = jQuery(this).sortable('serialize');
                },
                start: function(evt, ui) {
                    // jQuery("#compound-editor-trash-area").slideDown('fast');
                },
                stop: function(evt, ui) {
                    // jQuery("#compound-editor-trash-area").slideUp('fast');
                }
            });
            // jQuery("#compound-editor-body").disableSelection();

            jQuery("#compound-editor-trash-area").droppable({
                accept: '#compound-editor-body > div',
                activeClass: 'wp-mrl-trash-active',
                hoverClass: 'wp-mrl-trash-hover',
                drop: function(event, ui) {
                    const template = jQuery(ui.helper.context).attr('data-id');
                    const id = jQuery(ui.helper.context).attr('data-page-id');

                    const Request = new WPAjax('Compound-removeTemplate', {
                        id: id,
                        template: template
                    });

                    ui.draggable.remove();

                }
            });

        },
        methods: {
            
            editProps: function (event) {
                const $form = Project.import('@form-props').vue;
                return $form.open(event);
            }

        }
    },
    ready: function (Event, $) {

    }
});