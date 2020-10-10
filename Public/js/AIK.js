var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var AIK = /** @class */ (function () {
    function AIK() {
        this.axios = null;
        this.project = null;
        if (typeof window['axios'] == 'function') {
            this.axios = window['axios'];
        }
        if (typeof window['MIRELE'] == 'object') {
            this.project = window['MIRELE'];
        }
    }
    AIK.prototype.postman = function (method, data, axios) {
        if (axios === void 0) { axios = { method: 'POST' }; }
        if (typeof method != "undefined" && typeof data != "undefined") {
            if (typeof method == 'string') {
                if (typeof data == 'object') {
                    var body = __assign(__assign({}, data), { 'action': 'mirele_endpoint_v1', 'method': method });
                    var form = new FormData;
                    for (var key in body) {
                        var value = body[key];
                        if (typeof value === "object") {
                            for (var _ in value) {
                                var __ = value[_];
                                form.append(key + "[" + _ + "]", __);
                            }
                        }
                        else {
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
                                    return this.axios["delete"](this.project.urls.ajax, form);
                                case "GET":
                                    return this.axios.get(this.project.urls.ajax, form);
                                default:
                                    throw 'You have incorrectly specified the method of working with axios, the available methods: POST/PUT/DELETE/GET';
                            }
                        }
                    }
                }
                else {
                    throw "Attribute 'data' may not be of any type other than a object.";
                }
            }
            else {
                throw "Attribute 'method' may not be of any type other than a string.";
            }
        }
        else {
            throw 'Pass on all attributes of the function';
        }
    };
    return AIK;
}());
//# sourceMappingURL=AIK.js.map