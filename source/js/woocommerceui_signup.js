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

new Interface ({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#signupForm']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#signupForm",
        data: {
            login: '',
            password: '',
            email: '',
            repeat_password: '',
            message: {
                type: false,
                text: false
            }
        },
        mounted: Event => {
        },
        methods: {

            // Event when sending the form
            submit: function (e) {

                // Overriding behavior
                e.preventDefault();

                new WPAjax('signup', {
                    login: this.login,
                    email: this.email,
                    password: this.password
                }).then(Event => {
                    if ('success' in Event.data) {
                        if (Event.data.success) {
                            location.reload();
                        } else {
                            this.toast('error', Event.data.data.message)
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
            }

        }
    }
});