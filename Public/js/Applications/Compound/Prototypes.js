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

if (Application) {

    Application.Modules.CompoundPrototypes = {

        default: Vue.component('compound-prototype-default', {
            data: function () {
                return {
                    value: ''
                }
            },
            watch: {
                value: function ($value) {
                    this.$parent.attributes[this.name] = $value;
                }
            },
            props: {
                name: 'default',
                value: 'default'
            },
            template: ` 
                <div class="grid-container gap-12">
                    <div class="col-6">
                        <h4 class="margin-0 paffing-0">{{name}}</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur consequuntur culpa cumque debitis deserunt, dolor dolorem error et hic impedit labore mollitia odit omnis reiciendis repellendus saepe ullam velit voluptatem.</p>                
                    </div>
                    <div class="col-6">
                        <input :value="value" v-model="value" type="text" class="width-100">                    
                    </div>
                </div>
            `
        }),

        id: Vue.component('compound-prototype-default', {
            data: function () {
                return {}
            },
            watch: {
                value: function ($value) {
                    this.$parent.attributes[this.name] = $value;
                }
            },
            props: {
                name: 'default',
                value: 'default'
            },
            template: ` 
                <div class="grid-container gap-12">
                    <div class="col-6">
                        <h4 class="margin-0 paffing-0">ID</h4>                
                    </div>
                    <div class="col-6">
                        <input :value="value" type="text" readonly class="width-100">                   
                    </div>
                </div>
            `
        }),

    };

}