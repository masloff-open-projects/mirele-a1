"use strict";

if (Application) {

    const Form = {
        Element: '#mirele__form__login'
    }

    new Application.Declare('Modules.Forms.Login');

    Application.Modules.Forms.Login = new Application.Interface({
        requires: {
            vue:    true,
            jquery: true
        },
        elements: {
            vue: [Form.Element]
        },
        vue: {

            delimiters: Application.Config.VUE.Delimiters,
            el: Form.Element,

            data: {
                message: "",
                form: {
                    login: "",
                    password: "",
                    remember: false,
                }
            },

            mounted: function (e=null) {

            },

            methods: {
                submit: function (e=null) {
                    (new Application.Postman({
                        method: 'login',
                        body: {
                            login: this.form.login,
                            password: this.form.password,
                            remember: this.form.remember
                        }
                    })).then(e => {
                        if (e.status === 401) {
                            if ('message' in e.data) {
                                this.message = e.data.message;
                                setTimeout(e => {this.message = null}, 4000);
                            }
                        } else {
                            location.reload();
                        }
                    }).catch(e => {
                        console.error(e)
                    });
                }
            }

        }
    });

}