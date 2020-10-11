interface __return {
    type: string,
    message: string,
    code: number,
    timestamp: number
}

class AIK {
    private axios = null;
    private project = null;

    constructor() {
        if (typeof window['axios'] == 'function') {
            this.axios = window['axios'];
        }
        if (typeof window['MIRELE'] == 'object') {
            this.project = window['MIRELE'];
        }
    }

    public postman(method: string, data: object, axios = {method: 'POST'}) {
        if (typeof method != "undefined" && typeof data != "undefined") {
            if (typeof method == 'string') {
                if (typeof data == 'object') {

                    const body = {
                        ...data,
                        'action': 'mirele_endpoint_v1',
                        'method': method
                    };

                    const form = new FormData;

                    for (const key in body) {
                        const value = body[key];
                        if (typeof value === "object") {
                            for (const _ in value) {
                                const __ = value[_];
                                form.append(`${key}[${_}]`, __);
                            }
                        } else {
                            form.append(key, value || false);
                        }
                    }

                    if (this.axios != null) {
                        if (typeof axios.method != 'undefined') {
                            switch (axios.method) {
                                case "POST":
                                    return this.axios.post(this.project.urls.ajax, form);
                                case "PUT":
                                    return this.axios.put(this.project.urls.ajax, form);
                                case "DELETE":
                                    return this.axios.delete(this.project.urls.ajax, form);
                                case "GET":
                                    return this.axios.get(this.project.urls.ajax, form);
                                default:
                                    throw 'You have incorrectly specified the method of working with axios, the available methods: POST/PUT/DELETE/GET';
                            }
                        }
                    }

                } else {
                    throw `Attribute 'data' may not be of any type other than a object.`;
                }
            } else {
                throw `Attribute 'method' may not be of any type other than a string.`;
            }
        } else {
            throw 'Pass on all attributes of the function';
        }
    }

}
