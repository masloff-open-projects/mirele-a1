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
 * @instance Login form
 */

"use strict";

new org.interface({
    requires: {
        vue: true,
        jquery: true
    },
    elements: {
        vue: ['#loginForm']
    },
    vue: {
        delimiters: ['{', '}'],
        el: "#loginForm",
        data: {
            login: '',
            password: '',
            remember: 'false',
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

                org.web.request('login', {
                    login: this.login,
                    password: this.password,
                    remember: this.remember
                }).then(e => {
                    console.log(e)
                }).catch(e => {
                    console.log(e)

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
    },
    ready: function (Event, $) {

    }
});