class DOMComposite {

    constructor(document=false) {

        if (document) {
            this.document = document;
        }

        this.templates = {};

    }

    register (attr='template', callback=false) {

        if (typeof (this.templates) != 'object') {
            this.templates = {};
        }

        if (!(attr in this.templates)) {
            if (typeof  callback === 'function') {
                this.templates[String(attr)] = callback;
                return true;
            }
        }

        return false;

    }

    execute () {

        if (typeof (this.templates) === 'object') {
            for (const element in this.templates) {
                try {
                    for (const _ of $(`[data-${element}]`)) {
                        try {
                            this.templates[element](_);
                        } catch (e) {
                            console.group('DOMComposite Error');
                            console.warn(e);
                            console.groupEnd();
                        }
                    }
                } catch (e) {
                    console.groupCollapsed('DOMComposite Error');
                    console.warn(e);
                    console.groupEnd();
                }
            }

            return true;
        }

        return false;

    }

}

$(document).ready(function () {
    window.domc = new DOMComposite(document);
    domc.register('template', function (e=null) {});
    domc.execute();
});