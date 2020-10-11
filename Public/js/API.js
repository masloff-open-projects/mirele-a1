var $exports = {};

class __project {

    constructor() {
        this.$export = {};
        this.$declare = {};
    }

    export(name = '', object) {
        if (!(name in this.$export)) {
            this.$export[name] = object;
            return object;
        } else {
            throw `Component '${name}' has already been exported and cannot be overwritten.`;
        }
    }

    import(name = '') {
        if (name in this.$export) {
            return this.$export[name];
        } else {
            throw `Component '${name}' is not registered in the system and cannot be imported.`;
        }
    }

    declare(name = '', object) {
        if (!(name in this.$declare)) {
            this.$declare[name] = object;
            return object;
        } else {
            throw `Object '${name}' has already been declared and cannot be overwritten.`;
        }
    }

}

const Project = new __project();

class Interface {

    constructor(data = {}) {

        // Checking to see if there
        // are requests to check existing instances
        if ('requires' in data) {

            // Checking for a VUE instance
            if ('vue' in data.requires && data.requires.vue === true) {
                if (typeof Vue !== 'function') {
                    return;
                }
            }

            // Checking for a jQuery instance
            if ('jquery' in data.requires && data.requires.vue === true) {
                if (typeof jQuery !== 'function') {
                    return;
                }
            }

        }

        // Performing document availability functions
        jQuery(document).ready(init => {

            if ('ready' in data) {
                this.ready = data.ready(init, jQuery);
            }

            // Checking for instances of DOM elements
            if ('vue' in data) {

                // Checking for instances of DOM elements
                if ('elements' in data && data.elements.vue) {
                    for (const [argument, element] of Object.entries(data.elements.vue)) {
                        if (!jQuery(element).length) {
                            return;
                        }
                    }
                }

                // Creating a VUE instance
                if ('vue' in data) {
                    this.vue = new Vue(data.vue);
                }

            }

            // Matching DOM objects with page mount functions
            if ('mounted' in data) {
                for (const [element, argument] of Object.entries(data.mounted)) {
                    if (jQuery(element).length) {
                        this.mounted = argument(init, $, data.instances);
                    }
                }
            }

        });

    }
}