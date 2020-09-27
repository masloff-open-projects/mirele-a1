class WPAjax {
    constructor (method='/', data={}) {

        // Create request body
        const body = Object.assign({
            'action': 'mirele_endpoint_v1',
            'method': method
        }, data);

        // Create form
        let form = new FormData;

        for (const [key, value] of Object.entries(body)) {
            if (typeof value === "object") {
                for (const [_, __] of Object.entries(value)) {
                    form.append(`${key}[${_}]`, __);
                }
            } else {
                form.append(key, value || false);
            }
        }

        return axios.post(MIRELE.urls.ajax, form);
    }
}

class Interface {

    constructor(data={}) {

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
                data.ready(init, jQuery);
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
                    new Vue(data.vue);
                }

            }

            // Matching DOM objects with page mount functions
            if ('mounted' in data) {
                for (const [element, argument] of Object.entries(data.mounted)) {
                    if (jQuery(element).length) {
                        argument(init, $, data.instances);
                    }
                }
            }

        });

    }
}