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

jQuery(document).ready(init => {

    let $ = jQuery;

    // Check if Vue include
    if (typeof Vue !== 'function') {
        throw 'VueJS not include';
    }

    // Check if jQuery include
    if (typeof $ !== 'function') {
        throw 'jQuery not include';
    }

    // VUE Components
    new Vue({
        delimiters: ['{', '}'],
        el: '#mireleThemeSettings',
        data: {
            active: false,

            // Tabs on page (Render)
            tabs: [
                {name: 'Basic settings', namespace: 'basic', id: 'basic'},
            ],

            // Setting on page (Render)
            settings: [],

            // All settings
            options: false,

            // Changes
            changes: []
        },
        mounted: function () {

            // Try get all namespaces
            new WPAjax('namespaces', {}).then(event => {

                if (event.data) {

                    // Clear tabs content
                    this.tabs = [];

                    for (const [index, name] of Object.entries(event.data)) {
                        this.tabs.push({
                            name: name,
                            namespace: name,
                            id: name
                        });
                    }

                }

            });

            // Try get all options
            new WPAjax('options', {
                namespace: 'all'
            }).then(event => {
                this.options = (typeof event.data === typeof [] ? event.data : false)
            });

        },
        methods: {

            // Select active tab
            selectTab: function (namespace = '*', name = 'default') {
                this.active = name || '*' || 'basic';

                // If options is not exist then get options for current tab
                if (this.options === false || typeof this.options[this.active] === 'undefined') {
                    new WPAjax('options', {
                        namespace: this.active
                    }).then(event => {
                        this.options = this.options === false ? {} : this.options;
                        this.options[this.active] = event.data;
                        this.settings = this.options[this.active];
                    });
                }

                // If options is found then get it from local memory
                else {

                    // Option page exists?
                    if (namespace in this.options) {
                        if (typeof this.options === "object") {
                            if (this.active in this.options && this.options[this.active]) {
                                this.settings = this.options[this.active].map(function (option) {
                                    return Object(option);
                                });

                                this.changes = this.settings.map(function (option) {
                                    return option.name || 0;
                                });
                            }

                            // Show message about error
                            else {
                                this.settings = false;
                            }
                        }

                        // Show message about error
                        else {
                            this.settings = false;
                        }
                    }

                    // Show message about error
                    else {
                        this.settings = false;
                    }

                }

            },

            // Save
            save: function (option, value) {

                // Try save settings
                new WPAjax('saveOption', {
                    namespace: option.namespace || '*' || 'basic',
                    name: option.name || 'default',
                    value: value
                }).then();

            },

            // Wait key up
            saveWaitKeyUp: function (option, value) {
                if (this.timer) {
                    clearTimeout(this.timer);
                    this.timer = null;
                }
                this.timer = setTimeout(() => {
                    this.save(option, value);
                }, 800);
            }

        }
    });

});
