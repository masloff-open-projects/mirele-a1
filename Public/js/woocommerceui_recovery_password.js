/**
 * Welcome to the source code
 *
 * ░██╗░░░░░░░██╗░█████╗░░█████╗░░█████╗░░█████╗░███╗░░░███╗███╗░░░███╗███████╗██████╗░░█████╗░███████╗      ██╗░░░██╗██╗
 * ░██║░░██╗░░██║██╔══██╗██╔══██╗██╔══██╗██╔══██╗████╗░████║████╗░████║██╔════╝██╔══██╗██╔══██╗██╔════╝      ██║░░░██║██║
 * ░╚██╗████╗██╔╝██║░░██║██║░░██║██║░░╚═╝██║░░██║██╔████╔██║██╔████╔██║█████╗░░██████╔╝██║░░╚═╝█████╗░░      ██║░░░██║██║
 * ░░████╔═████║░██║░░██║██║░░██║██║░░██╗██║░░██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝░░██╔══██╗██║░░██╗██╔══╝░░      ██║░░░██║██║
 * ░░╚██╔╝░╚██╔╝░╚█████╔╝╚█████╔╝╚█████╔╝╚█████╔╝██║░╚═╝░██║██║░╚═╝░██║███████╗██║░░██║╚█████╔╝███████╗      ╚██████╔╝██║
 * ░░░╚═╝░░░╚═╝░░░╚════╝░░╚════╝░░╚════╝░░╚════╝░╚═╝░░░░░╚═╝╚═╝░░░░░╚═╝╚══════╝╚═╝░░╚═╝░╚════╝░╚══════╝      ░╚═════╝░╚═╝
 *
 * @package Mirele
 * @author Mirele
 * @version 1.0.0
 * @instance Signup form
 */

"use strict";

new Interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#recoveryForm']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#recoveryForm",
        data: {
            step: 1,
            login: '',
            password: '',
            repeat_password: '',
            email: '',
            key: '',
            message: {
                type: false,
                text: false
            }
        },
        mounted: function (Event) {

            // Init vars and consts
            const key = (new URLSearchParams(window.location.search.substring(1))).get('key') || false;

            // User logged on to the site with the key of variation
            if (key) {

                (new Promise((resolve, reject) => {

                    let keypair = JSON.parse(atob(key || '') || '{}');

                    if (keypair || false) {
                        this.key = keypair.key || '';
                        this.login = keypair.login || '';
                        this.email = keypair.email || '';
                        this.step = 2 || 1;
                    }

                })).then(Event => {

                }).catch(Event => {

                });

            }

        },
        methods: {

            // Event when sending the form
            submit: function (e) {

                // Overriding behavior
                e.preventDefault();

                new WPAjax('recoveryPassword', {
                    login: this.login,
                    email: this.email,
                    key: this.key ? this.key : false,
                    password: this.password ? this.password : false,
                }).then(Event => {
                    if ('success' in Event.data) {
                        if (Event.data.data.status == 'code_send') {
                            this.step = 2;
                        } else if (Event.data.data.status == 'code_correct') {
                            this.step = 3;
                        } else if (Event.data.data.status == 'password_change') {
                            this.step = 4;
                        } else {
                            this.toast('error', Event.data.data.message, 10000)
                        }
                    }
                }).catch(Event => {

                });
            },

            toast: function (type, value, delay = 1500) {
                this.message.type = type;
                this.message.text = value;

                clearTimeout(window.toast);

                window.toast = setTimeout(Evnet => {
                    this.message.type = false;
                    this.message.text = false;
                }, delay);
            },

            back: function (e) {

                // Change the form's addictive behavior
                if (this.step == 2) {
                    this.key = '';
                }

                // Take a step back.
                this.step -= 1;
            }

        }
    },
    ready: function (Event, $) {

    }
});
