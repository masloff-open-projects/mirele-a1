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
 * @instance Product Page
 */

"use strict";

new app.interface({
    requires: {
        vue: true,
        jquery: true
    },
    ready: function () {
    },
    instances: {
        vue: {
            carousel: {
                delimiters: ['{', '}'],
                el: "#carousel",
                data: {
                    carousel: [
                        {
                            img: 'https://www.reserved.com/media/SHARED/stronywizerunkowe/reserved/home/content/img/sliders/mobile/baner-mobile-back-to-business-on-500x800px-190820_IMG.jpg',
                            title: 'Back in business',
                            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur dignissimos dolore est et impedit iure magni natus, non quia tempore vitae voluptas? A delectus exercitationem illo itaque nemo quo sequi!'
                        },
                        {
                            img: 'https://www.reserved.com/media/SHARED/stronywizerunkowe/reserved/home/content/img/bricks/re-kobieta-kafel-minisite-737x737px09_EN.jpg',
                            title: 'Back in business',
                            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur dignissimos dolore est et impedit iure magni natus, non quia tempore vitae voluptas? A delectus exercitationem illo itaque nemo quo sequi!'

                        },
                        {
                            img: 'https://www.reserved.com/media/SHARED/stronywizerunkowe/reserved/home/content/img/sliders/mobile/baner-mobile-lookbook-ladies-500x800px-260820.jpg',
                            title: 'lorem',
                            description: 'lorem'
                        },
                    ]
                }
            }
        }
    },
    mounted: {
        '#carousel': function (init, $, instances) {
            new Vue(instances.vue.carousel);
        }
    }
});