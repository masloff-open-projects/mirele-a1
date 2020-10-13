/**
 * Application
 *
 * @type {org}
 */
const org = class {
    constructor() {
        this.data = {};
        this.references = {};
        this.references.form = {};
        this.references.form.insert = {};
        this.references.form.get = {};
        this.references.form.get.component = {};
        this.references.form.get.template = {};
        this.references.form.update = {};
        this.references.form.update.component = {};
        this.references.form.update.template = {};
        this.references.form.unset = {};
        this.references.form.unset.component = {};
        this.references.form.unset.template = {};
        this.references.form.set = {};
        this.references.form.set.component = {};
        this.references.form.set.template = {};
        this.references.form.upgrade = {};
        this.references.form.upgrade.component= {};
        this.references.form.upgrade.template= {};
        this.references.form.sort = {};
        this.references.form.sort.component = {};
        this.references.form.sort.template = {};
        this.references.form.init = {};
        this.references.form.init.component = {};
        this.references.form.init.template = {};
        this.objects = {};
        this.server = MIRELE || {};
    }
};

/**
 * Utility to send data to the server via AXIOS
 *
 * @param method
 * @param props
 * @param HTTP
 * @returns {*}
 */
org.prototype.request = function (method, props, HTTP={}) {
    return axios({
        method: HTTP.method || 'post',
        url: MIRELE.urls.ajax,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        data : Qs.stringify(Object.assign(props, {
            'action': 'mirele_endpoint_v1',
            'method': method
        }))
    });
}

/**
 * Utility for creating an interface
 *
 * @type {org.interface}
 */
org.prototype.interface = class {

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