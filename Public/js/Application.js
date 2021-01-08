const Application = {
    Config: {
        VUE: {
            Delimiters: ['{', '}']
        }
    },
    Constants: {
        Service:     window.x33707 || {},
        WordPress:   window.x27511 || {},
        Woocommerce: window.x70460 || {},
    },
    Temporary: {},
    Variables: {},
    Components: {
        Compound: {}
    },
    Modules: {},
    Declare: class {
        constructor(path) {
            lodash.set(Application, path, {});
        }
    },
    Interface: class {
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
    },
    Request: class {
        constructor(data = {}) {
            if ('url' in data) {
                this.url = data.url;
            }
            if ('method' in data) {
                this.method = data.method;
            }
            if ('headers' in data) {
                this.headers = data.headers;
            }
            if ('body' in data) {
                this.body = data.body;
            }
            if ('Postman' in data) {
                this.Postman = data.Postman;
            }
        }

        run () {
            return axios({
                method: this.method || 'post',
                url: this.url || Application.Constants.Service.AXIOS.URL,
                headers: this.headers || {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },

                data: Qs.stringify(this.body || Object.assign({
                    'action': 'mirele_endpoint_v1',
                    'method': this.Postman.Method || ''
                }))
            });
        }
    },
    Postman: class {
        constructor(data = {}) {
            return axios({
                validateStatus: () => true,
                method: (data.HTTP || {}).method || 'post',
                url: (data.HTTP || {}).url || Application.Constants.Service.AXIOS.URL,
                headers: (data.HTTP || {}).headers || {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                data: Qs.stringify(Object.assign(data.body || {}, {
                    'action': 'mirele_endpoint_v1',
                    'method': data.method
                }))
            });
        }
    },
    Midway: class {

    }
}