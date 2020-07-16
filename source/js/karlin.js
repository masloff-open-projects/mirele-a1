karlin_color = color = {
    black: '#000000',
    gray: '#808080',
    silver: '#C0C0C0',
    white: '#FFFFFF',
    red: '#FF0000',
    fuchsia: '#FF00FF',
    yellow: '#FFFF00',
    lime: '#00FF00',
    green: '#008000',
    aqua: '#00FFFF',
    blue: '#0000FF',
    flat: {
        pomade: ['#F0697F', '#E55262', '#D34353'],
        red: ['#F67E6D', '#F2694F', '#E1533C'],
        yellow: ['#F4CC75', '#F7C659', '#EEB445'],
        green: ['#AED97D', '#9BCC6A', '#87BE54'],
        grass: ['#5ED7B6', '#48C7A8', '#34B79A'],
        ocean: ['#68CEEB', '#4DBBE2', '#38A8D3'],
        blue: ['#71ACED', '#5C96EF', '#4984D3'],
        purple: ['#AEA1E7', '#A98CED', '#9076D4'],
        pink: ['#EA94CA', '#E582B9', '#CE6CA6'],
        sand: ['#F3CDAF', '#E8C2A0', '#DCB18D'],
        gray: ['#EEEFF1', '#DFE2E7', '#C4CAD2'],
        deepOcean: ['#A3A9B5', '#616976', '#3F4650']
    }
};

karlin_animation_libs = kalib = a = {
    linear: (time) => {
        return time;
    },
    quad: (time) => {
        return Math.pow(time, 2);
    },
    circ: (time) => {
        return 1 - Math.sin(Math.acos(time));
    },
    back: (x, time) => {
        return Math.pow(time, 2) * ((x + 1) * time - x);
    },
    bounce: (time) => {
        for (let a = 0, b = 1; 1; a += b, b /= 2) {
            if (time >= (7 - 4 * a) / 11) {
                return -Math.pow((11 - 6 * a - 11 * time) / 4, 2) + Math.pow(b, 2);
            }
        }
    },
    elastic: (x, time) => {
        return Math.pow(2, 10 * (time - 1)) * Math.cos(20 * Math.PI * x / 3 * time);
    }
};
karlin_plugin = kp = ((attribute) => {
    return {
        cssTime: () => {
            try {
                seconds = attribute.match(/([0.00-9.00]+)s/)[1];
            } catch {
                seconds = 0;
            }
            try {
                minutes = attribute.match(/([0.00-9.00]+)m/)[1];
            } catch {
                minutes = 0;
            }
            try {
                hour = attribute.match(/([0.00-9.00]+)h/)[1];
            } catch {
                hour = 0;
            }
            try {
                day = attribute.match(/([0.00-9.00]+)d/)[1];
            } catch {
                day = 0;
            }
            try {
                week = attribute.match(/([0.00-9.00]+)w/)[1];
            } catch {
                week = 0;
            }
            return (Number(seconds) * 1000 + Number(minutes) * 60000 + Number(hour) * 60000 * 60 + Number(day) * 60000 * 60 * 24 + Number(week) * 60000 * 60 * 60 * 7);
        },
        randomList: () => {
            return attribute[Math.floor(Math.random() * attribute.length)];
        },
        randomObject: () => {
            return attribute[Object.keys(attribute)[Math.floor(Math.random() * Object.keys(attribute).length)]];
        },
        objectToCss: () => {
            var css = String();
            for (i in attribute) {
                css += `${i}:${typeof attribute[i] == 'number' ? `${attribute[i]}px` : attribute[i]};`;
            }
            return css;
        },
        objectToParam: () => {
            return (new URLSearchParams(attribute)).toString();
        },
        request: function () {
            function http() {
                var xmlhttp;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            var xmlHttp = http();
            xmlHttp.open('method' in attribute ? attribute.method : 'GET', 'url' in attribute ? attribute.url : window.location.href, 'async' in attribute ? attribute.async : false);
            if ('headers' in attribute) {
                for (const key in attribute.headers) {
                    if (attribute.headers.hasOwnProperty(key)) {
                        const element = attribute.headers[key];
                        xmlHttp.setRequestHeader(key, element);
                    }
                }
            }
            if ('method' in attribute) {
                if (attribute.method.toUpperCase() == "POST") {
                    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                }
            }
            xmlHttp.onreadystatechange = ('callback' in attribute) ? ('change' in attribute.callback ? attribute.callback.change : null) : null;
            xmlHttp.onload = ('callback' in attribute) ? ('ready' in attribute.callback ? attribute.callback.ready : null) : null;
            xmlHttp.send('data' in attribute ? (typeof attribute.data == 'object' ? (new URLSearchParams(attribute.data)).toString() : attribute.data) : null);
            return xmlHttp.responseText;
        }
    };
});
karlin = $k = k = ((element, sub_element = null) => {
    try {
        if (typeof element == 'string') {
            element = document.querySelector(element);
        }
        else if (typeof element == 'object') {
            element = element;
        }
        else {
            new Error('Invalid data type passed');
        }
    }
    catch {
        element = null;
    }
    ;
    try {
        if (typeof sub_element == 'string') {
            sub_element = document.querySelector(sub_element);
        }
        else if (typeof element == 'object') {
            sub_element = sub_element;
        }
        else {
            new Error('Invalid data type passed');
        }
    }
    catch {
        sub_element = null;
    }
    ;
    try {
        return {
            text: data => {
                if (data !== undefined) {
                    return element.innerText = data;
                }
                else {
                    return element.innerText;
                }
            },
            html: data => {
                if (data !== undefined) {
                    return element.innerHTML = data;
                }
                else {
                    return element.innerHTML;
                }
            },
            value: data => {
                if (data !== undefined) {
                    return element.value = data;
                }
                else {
                    return element.value;
                }
            },
            drawing: (data) => {
                const replacer = (template, object) => {
                    const keys = Object.keys(object);
                    const func = Function(...keys, "return `" + template + "`;");
                    return func(...keys.map(k => object[k]));
                };
                for (iterator of element.querySelectorAll("*")) {
                    list = (iterator.innerText).match(/\{(.*?)\}/g);
                    for (const key in list) {
                        if (list.hasOwnProperty(key)) {
                            const _ = list[key];
                            iterator.innerText = (iterator.innerText).replace(_, `$${_}`);
                        }
                    }
                    iterator.innerText = replacer(iterator.innerText, data);
                }
                return true;
            },
            css: data => {
                if (data) {
                    if (typeof data == 'object') {
                        for (const key in data) {
                            if (data.hasOwnProperty(key)) {
                                const value = data[key];
                                // value = value.replace('thisInt', parseInt(element.style[key].replace(/\D+/g,"")));
                                // value = value.replace('this', element.style[key]);
                                element.style[key] = `${typeof value == 'number' ? `${value}px` : value}`;
                            }
                        }
                        return element.style;
                    }
                    else {
                        return element.style = data;
                    }
                }
                else {
                    return element.style.cssText;
                }
            },
            attribute: (data, value) => {
                if (data && value) {
                    return element.setAttribute(data, value);
                }
                else if (data) {
                    return element.getAttribute(data);
                }
                else {
                    return element.attributes;
                }
            },
            exist: () => {
                return element != null;
            },
            on: (data, action = 'click', prefix = 'on') => {
                element[`${prefix}${action}`] = data;
            },
            create: (data, component) => {
                var object = document.createElement(component);
                for (var attribute in data) {
                    if (data.hasOwnProperty(attribute)) {
                        const value = data[attribute];
                        attribute = attribute == 'className' ? 'class' : attribute;
                        object.setAttribute(attribute, (typeof value == 'number' ? `${value}px` : value));
                    }
                }
                if (element.append(object) == null) {
                    return object;
                }
                else {
                    return new Error('Created element was not added to DOM');
                }
            },
            append: (data) => {
                return element.append(data);
            },
            remove: () => {
                return element.parentNode.removeChild(element);
            },
            focus: () => {
                return element.focus();
            },
            blur: () => {
                return element.blur();
            },
            ready: (data = null) => {
                element.onreadystatechange = function () {
                    if (element.readyState === 'complete') {
                        data();
                    }
                }
            },
            interactive: (data = null) => {
                element.onreadystatechange = function () {
                    if (element.readyState === 'interactive') {
                        data();
                    }
                }
            },
            scroll: (data, afterSendFull = true) => {
                document.addEventListener("scroll", function () {
                    if (window.scrollY >= element.offsetTop - element.offsetHeight & window.scrollY <= element.offsetTop) {
                        data((window.scrollY - (element.offsetTop - element.offsetHeight)) / (element.offsetTop - (element.offsetTop - element.offsetHeight)) * 100);
                    }
                    else if (window.scrollY - element.offsetTop <= element.offsetTop / 8) {
                        if (afterSendFull) {
                            data(100);
                        }
                    }
                });
            },
            scrollBetween: (data, afterSendFull = true) => {
                document.addEventListener("scroll", function () {
                    position = ((((window.scrollY + window.innerHeight) - (element.offsetTop - (sub_element.offsetTop - element.offsetTop))) / (element.offsetTop - (element.offsetTop - (sub_element.offsetTop - element.offsetTop)))) * 100) - 100;
                    if (position > 0 && position < 100) {
                        data(position);
                    }
                    else if (position > 100 && position < 120) {
                        if (afterSendFull) {
                            data(100);
                        }
                    }
                });
            },
            animate: (data, duration = '.3s', delay = '0s', timing_function = 'ease', callback_end) => {
                let animation = {
                    'transition': 'ease 1s',
                    'transition-duration': typeof duration == 'number' ? `${duration}ms` : duration,
                    'transition-timing-function': timing_function
                };
                animation = Object.assign(animation, data);
                if (callback_end) {
                    setTimeout(() => {
                        callback_end();
                    }, (typeof delay == 'number' ? delay : karlin_plugin(delay).cssTime()) + (typeof duration == 'number' ? duration : karlin_plugin(duration).cssTime()));
                }
                return setTimeout(() => {
                    if (typeof animation == 'object') {
                        for (const key in animation) {
                            if (animation.hasOwnProperty(key)) {
                                const value = animation[key];
                                element.style[key] = `${typeof value == 'number' ? `${value}px` : value}`;
                            }
                        }
                        return element.style;
                    }
                    else {
                        return element.style = data;
                    }
                }, typeof delay == 'number' ? delay : karlin_plugin(delay).cssTime());
            },
            animation: (data = {}) => {
                let start = performance.now();
                requestAnimationFrame(function animate(time) {
                    let timeFraction = (time - start) / data.duration;
                    if (timeFraction > 1)
                        timeFraction = 1;
                    let progress = data.timing(timeFraction);
                    data.draw((progress * 100).toFixed(2));
                    if (timeFraction < 1) {
                        requestAnimationFrame(animate);
                    }
                });
            },
            form: (data, noRedirect = true) => {
                if (data) {
                    return karlin(element).on((form) => {
                        formElement = (new FormData(form.target));
                        var formData = {};
                        for (const element of formElement.entries()) {
                            formData[element[0]] = element[1];
                        }
                        if (typeof data == 'function' || typeof data == 'object') {
                            data(formData);
                        }
                        if (noRedirect) {
                            return false;
                        }
                    }, 'submit');
                }
                else {
                    formElement = (new FormData(element));
                    var formData = {};
                    for (const element of formElement.entries()) {
                        formData[element[0]] = element[1];
                    }
                    return formData;
                }
            },
            template: (data) => {
                if (data) {
                    if (typeof data == "object") {
                        return element.append(data);
                    }
                    else {
                        if ('katlin_templates' in document) {
                            if (data in document.katlin_templates) {
                                return element.append(document.katlin_templates[data]);
                            }
                            else {
                                return new Error('Pattern not found in memory');
                            }
                        }
                        else {
                            return new Error('Pattern not found in memory');
                        }
                    }
                }
                else {
                    if ('katlin_templates' in document) {
                        var template = document.katlin_templates[element.getAttribute('k-template') ? element.getAttribute('k-template') : Math.random().toString(32).substr(2)] = element;
                    }
                    else {
                        document.katlin_templates = {};
                        var template = document.katlin_templates[element.getAttribute('k-template') ? element.getAttribute('k-template') : Math.random().toString(32).substr(2)] = element;
                    }
                    element.parentNode.removeChild(element);
                    return template;
                }
            },
            include_google_font: (data) => {
                var object = document.createElement('link');
                object.href = `https://fonts.googleapis.com/css2?family=${'name' in data ? data.name : 'Roboto'}:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap`;
                object.rel = "stylesheet";
                element.append(object);
            },
            keyup: (data = null, key=13, ctrl=false, shift=false) => {
                element.addEventListener("keyup", function(event) {
                    event.preventDefault();

                    if (event.keyCode === key && (event.ctrlKey == ctrl) && (event.shiftKey == shift)) {
                        data();
                    }

                });
            },
            notify: (data = {}) => {
                const count = document.getElementsByClassName('karlin_notify').length;
                const i = count + 1;
                if (count) {
                    heightEndNotify = document.getElementsByClassName('karlin_notify')[count - 1].offsetHeight;
                }
                else {
                    heightEndNotify = 84;
                }
                var notify = document.createElement('div');
                notify.className = "karlin_notify";
                notify.style.height = 'auto';
                notify.style.width = '400px';
                notify.style.position = 'fixed';
                notify.style.background = 'background' in data ? data.background : 'rgba(255, 255, 255, 0.8)';
                notify.style.display = "block";
                notify.style.top = `${count * (heightEndNotify + 20) + 20}px`;
                notify.style.left = 'calc(100% - 400px - (16px * 2) - 20px)';
                notify.style.padding = '16px';
                notify.style.opacity = '0.4';
                notify.style.borderRadius = '12px';
                notify.style.backdropFilter = 'blur(10px)';
                notify.style.border = '1px solid rgba(0, 0, 0, 0.2)';
                notify.style.boxShadow = '0px 0px 8px -3px #00000052';
                notify.style.transform = "translateX(100%)";
                notify.style.filter = "blur(4px)";
                notify.style.zIndex = 10 ** 9;
                let title = document.createElement('b');
                title.innerText = data.title;
                title.style.fontSize = "16px";
                title.style.color = "#323232";
                title.style.marginBottom = '4px';
                title.style.fontWeight = "bold";
                title.style.display = "block";
                title.style.fontFamily = "Roboto";
                let text = document.createElement('p');
                text.innerText = data.text;
                title.style.color = "#323232";
                text.style.fontSize = "12px";
                text.style.fontWeight = "inherit";
                text.style.fontFamily = "Roboto";
                text.style.padding = "0px";
                text.style.margin = "0px";
                let icon = document.createElement('img');
                icon.src = 'image' in data ? data.image : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAA3QAAAN0BcFOiBwAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAASbSURBVFiFxZdtTJVlGMd/1/2cl+cgHOSgCKjTlGFEFDrUGAIBQ8DICeopRXHK8syXWetbH3RuuvVFp261am2t1Rc3+yK51cS5UEcvY9ZW0idbrJjhS04BhfN29eEArgx4Dtj6f7xf/tfvvq77fp77FlXl/5RruhM3bg/laDTccOtmX0Qi5sKlS1/emI6PJJuB9aFQimcw8plCA0D/jd8THcoXw2n2pu729gf/GUAwGPTF3KnngOq56bBqmZDlvc+ZzkGu98cALsaHBxu7uroeOvVMqgRRz6xDolQ/lS0c3m5ItQFm0/BCKvuO/8FPfbFq4007BLzl1NNxBja1tC1RtMcyeE+ELObP+Xv/3b4hmt6+TTTOiFj6zOWOjl+c+BqnpKp6DPA2rJTHggNkZKfwymoPgFejcsypryOA5q27qhGa/CkQrJhgiiW01ftJ9wkITWU1ddVPBCAYDFpGOAmwpcowy060D4fh9FdxPmi/x8ORRBk9gRT2vOgdNdaTwWDQmjFA3J26W6Fo8TyhdrmMt3dcVc5cVk5ffMDZKwOJRkt4qSyNvCyDKkV9d+7unhFAY0tLhsIRgF11gjyKz683E6s2xuJ6X2S8XdJ9vLk2kSZROVJe3pgxbQAb72Egs7RAKFwkkw19JEt4rmAWVctcAJm4w4enBdD86msFCnvdLthR6/iwJOS32V9j43GBwt7SytqCpAHEip0AXBtKhbnpycXHMsyb72PrKg+Ay2XJiaQAmrftagTqMv3QVJbk6sfkt9lW6iUrTVCoK6+qa3QEEAqF3KJyHGB7jcHrnl58LIMdsNlTmTiWKnq8pKTkMbfHAG4PRQ+A5i9bIJQ/63DjTSS/TW2hm6L5FkC+Ly1wYFKA5tbWLFQPCtBWP8PgAJYBv83rNV4EQDhYVleXNSGAibqPAulVxcLSnMkBvGP/UVVszyRj/TZP51isK3KjkG4iHP1XgKaWncUq2ubzQEvV1BuvuliYZYPHFWNdaerEA0ezEKrwkOIRFG0rq1pbPNY9fh8wcAowm8oNsyfxG1NervDhGxaqOZNnAMBvE7g/zI5SN+91ho0Ip4DK0bjQ3LJzM0hFdgAaVzuvvdfN1MFhPAvBEg8LMgxARXnN2s0AVm9vrx2OSTswe/96w8K5zgDuDcG7n8c5d+UOK/K9+LxTlM1jYQ2OkO0XLvwcBVj16ccfvW8GwqYVWPT8EmFlvvPVn7+qdPUo3/REOXt5cOoJo1lYk+di5WILYFFUPK1GVesBNq5J7tjl5YIAqnEKFnucTUpLfJR2lCbGq2q9C6HSCOQvSA5g+VLhnX0WkWgWC7Mc3m1dFhihMNfCCMSh0iD0xxV6epN/IWUHcB4cIBKDuPL9bzHiCiL0G1HtBDj7tTISmcphhhoYZjiinP4uDIDG6ZSXt+ye45bINSDL54XKIiE303k5HgxNvQEDPojcH+Fab5jz16IMhRXgplsjhaKqbNi2s8il8olC8VRm/9T40yw5/RCPaWtXZ8eP4w+TUCjkvjUQXY3oCkECTlxU1XWrvy/qNGpc+dNo/OrDgbvfdnd3R2Aaj9Mnrb8A0TtykI+7cqgAAAAASUVORK5CYII=';
                icon.style.float = 'left';
                icon.style.height = '100%';
                icon.style.objectFit = 'scale-down';
                icon.style.width = '50px';
                icon.style.height = '50px';
                let div = document.createElement('div');
                div.style.paddingLeft = '60px';
                notify.append(icon);
                div.append(title);
                div.append(text);
                notify.append(div);
                element.append(notify);
                karlin(notify).on(() => {
                    karlin(notify).animate({
                        top: -120
                    }, '.6s', 0, 'cubic-bezier(0.58, 0.13, 0.24, 1.32)', () => {
                        karlin(notify).remove();
                    });
                }, 'click');
                setTimeout(() => {
                    karlin(notify).animate({
                        opacity: '1',
                        transform: 'translateX(0%)',
                        filter: 'blur(0px)'
                    }, '.3s', 0, 'cubic-bezier(0.58, 0.13, 0.24, 1.32)');
                    setTimeout(() => {
                        karlin(notify).animate({
                            opacity: '0',
                            transform: 'translateY(-100%) scale(0.8)',
                            filter: 'blur(4px)'
                        }, '.3s', 0, 'cubic-bezier(0.58, 0.13, 0.24, 1.32)', () => {
                            karlin(notify).remove();
                        });
                    }, 'timeout' in data ? data.timeout : 4000);
                }, 100);
                return i;
            },
            modal: () => {
                var modal = document.createElement('div');
                modal.className = "karlin_modal";
                modal.style.position = "fixed";
                modal.style.background = "rgba(50, 50, 50, .95)";
                modal.style.height = "100%";
                modal.style.width = "100%";
                modal.style.zIndex = 10 ** 5;
                modal.style.top = "0";
                modal.style.left = "0";
                modal.style.backdropFilter = "blur(4px)";
                let title = document.createElement('h1');
                title.innerText = 'Lorem';
                let description = document.createElement('p');
                description.innerText = 'Ipsum dolor set amin';
                modal.append(title);
                modal.append(description);
                element.append(modal);
            },
            lightboximage: (data = null) => {

                var image = document.createElement('img');

                image.style.width = '100%';
                image.style.height = '100%';
                image.style.zIndex = 10 ** 8;
                image.style.position = "fixed";
                image.className = "karlin_lightboximage";
                image.style.top = "0";
                image.style.left = "0";
                image.style.objectFit = 'contain';
                image.style.background = 'rgba(0, 0, 0, 0.5)';
                image.style.backdropFilter = 'blur(4px)';
                image.style.webkitbackdropFilter = 'blur(4px)';
                document.body.style.overflow = 'hidden';

                image.src = data;

                // karlin(image).css()

                karlin(image).on(() => {
                    karlin(image).animate({
                        opacity: String(0)
                    }, '.6s', 0, 'cubic-bezier(0.58, 0.13, 0.24, 1.32)', () => {
                        karlin(image).remove();
                        document.body.style.overflow = '';
                    });
                }, 'click');

                element.append(image);
            },
            spotlight: (data = null) => {

                var spotlight = document.createElement('div');
                spotlight.className = "karlin_spotlight";
                spotlight.style.position = 'fixed';
                spotlight.style.display = "flex";
                spotlight.style.top = '-1px';
                spotlight.style.left = 'calc(50% - 250px)';
                spotlight.style.zIndex = 10 ** 9;
                spotlight.style.background = "#212121";
                spotlight.style.height = "40px";
                spotlight.style.width = "500px";
                spotlight.style.border = "1px solid #464646";
                spotlight.style.justifyContent = "center";
                spotlight.style.placeItems = "center";

                var input = document.createElement('input');
                input.style.width = "95%";
                input.style.background = "#2B2B2B";
                input.style.border = "1px solid #464646";
                input.style.color = "white";
                input.style.padding = "4px 8px";
                spotlight.append(input);

                element.append(spotlight);

                karlin(input).focus();

                karlin(input).keyup(function() {

                    data(karlin(input).value());
                    karlin(spotlight).remove();

                    return;

                });

            }
        };
    }
    catch (error) {
        console.group('KARLIN.js');
        console.warn(error);
        console.groupEnd();
    }
});