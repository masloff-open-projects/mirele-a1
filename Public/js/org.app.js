/**
 * Application
 *
 * @type {org}
 */
const org = class {
};

org.web = class {
};
org.compound = class {
};
org.data = {};
org.references = {};
org.references.form = {};
org.references.form.insert = {};
org.references.form.get = {};
org.references.form.get.component = {};
org.references.form.get.template = {};
org.references.form.update = {};
org.references.form.update.component = {};
org.references.form.update.template = {};
org.references.form.unset = {};
org.references.form.unset.component = {};
org.references.form.unset.template = {};
org.references.form.set = {};
org.references.form.set.component = {};
org.references.form.set.template = {};
org.references.form.upgrade = {};
org.references.form.upgrade.component = {};
org.references.form.upgrade.template = {};
org.references.form.sort = {};
org.references.form.sort.component = {};
org.references.form.sort.template = {};
org.references.form.init = {};
org.references.form.init.component = {};
org.references.form.init.template = {};
org.objects = {};
org.server = MIRELE || {};

/**
 * Utility to send data to the server via AXIOS
 *
 * @param method
 * @param props
 * @param HTTP
 * @returns {*}
 */
org.web.request = function (method, props, HTTP = {}) {
    return axios({
        method: HTTP.method || 'post',
        url: MIRELE.urls.ajax,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: Qs.stringify(Object.assign(props, {
            'action': 'mirele_endpoint_v1',
            'method': method
        }))
    });
}

/**
 * Utility for creating an interface
 */
org.interface = class {

    constructor(data = {}) {
        if ('requires' in data) {
            if ('vue' in data.requires && data.requires.vue === true) {
                if (typeof Vue !== 'function') {
                    return;
                }
            }
            if ('jquery' in data.requires && data.requires.vue === true) {
                if (typeof jQuery !== 'function') {
                    return;
                }
            }

        }
        jQuery(document).ready(init => {
            if ('ready' in data) {
                this.ready = data.ready(init, jQuery);
            }
            if ('vue' in data) {
                if ('elements' in data && data.elements.vue) {
                    for (const [argument, element] of Object.entries(data.elements.vue)) {
                        if (!jQuery(element).length) {
                            return;
                        }
                    }
                }
                if ('vue' in data) {
                    this.vue = new Vue(data.vue);
                }

            }
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

/**
 * Initialization of the application
 *
 * @type {org}
 */
const app = new org;
