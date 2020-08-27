/**
 * WorPress admin features
 * This code is also responsible for recording actions
 * for integration applications
 *
 * @version 1.0.0
 * @author Mirele
 * @package Mirele
 */

var $ = jQuery;

$(function () {

    function mirele_auth_bridge (action='', function_=null, args={}) {

        $.prompt('To complete this action, you need to enter the password for your Mirele account. Thus, Mirele secured customers from unauthorized actions by other persons.', function (e = null) {

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: Object.assign({
                    action: action,
                    password: e
                }, args),
                dataType: "json",
                success: function (response) {

                    setTimeout(e => {

                        if ('mirele_auth' in response && response.mirele_auth == 'error_password') {

                            $.dialog({
                                title: "Auth error",
                                content: "You have not logged in. Try again, but check the password before doing so. Make sure you enter the password for your Mirele account and not for WordPress",
                                buttons: [{type: "confirm"}],
                                escCall: "",
                                enterCall: "",
                                onConfirm: function () {
                                },
                            }).open();

                        } else if ('mirele_auth' in response && response.mirele_auth == 'no_registred') {

                            $.prompt('You will need to use the Mirele password to complete some actions. Password will protect your version of the product from unauthorized installation of external components, updates, etc. Your password is encrypted in WordPress memory and cannot be sent anywhere. Support Mirele cannot ask for this password. Please enter your password and remember it', function (e = null) {

                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    data: {
                                        action: "mirele_account_register",
                                        password: e
                                    },
                                    dataType: "json",
                                    success: function (response) {

                                        if (response.auth == true || response.auth == 'true') {
                                            $.toast('You have successfully set a password for your Mirele account');
                                        }

                                    }
                                });

                            }, 'Let\'s register a password');

                        } else {

                            function_(response);

                        }

                    }, 100);

                },
            });

        }, 'ID confirmation');

    }

    /**
     * Mirele modal forms
     * Collecting emails to send free updates
     *
     * @version 1.0.0
     * @author Mirele
     */

    class MForms {
        /**
         * Collecting emails to send free updates
         *
         * @version 1.0.0
         * @author Mirele
         */

        email_for_updates() {
            $.dialog({
                title: "Enter your email",
                content: `<iframe frameborder="0" style="height:500px;width:99%;border:none;" src='https://forms.zohopublic.com/masloff/form/ApplicationforMireleThemeUpdates/formperma/hcCSpohyiqEZOTnRNkWdwV4TT6mUfi134WJxH3rfOz0'></iframe>`,
                height: 620,
                width: 680,
                onConfirm: function () {
                },
            }).open();
        }

        /**
         * Collecting information about the relevance of packages
         *
         * @version 1.0.0
         * @author Mirele
         */

        relevance() {
            $.dialog({
                title: "Evaluate the product in 2 minutes",
                content: `<iframe frameborder="0" style="height:500px;width:99%;border:none;" src='https://forms.zohopublic.com/masloff/form/Interrogation/formperma/D1l-jtOc-cc7nEsKIJQPfp4dhISBs4rpwIRaFj0k0wc'></iframe>`,
                height: 620,
                width: 680,
                onConfirm: function () {
                },
            }).open();
        }
    }

    /**
     * Authorization script for MailChimp
     *
     * @author Mirele
     * @version 1.0.0
     */

    $("#app_mailchimp_auth").submit(function (e) {
        if (!$("#app_mailchimp_auth").attr("login")) {
            e.preventDefault();
        }

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "app_integration_mailchimp_auth",
                token: $("#app_mailchimp_auth").serializeArray()[4].value,
            },
            dataType: "json",
            success: function (response) {
                if (response && "first_name" in response) {
                    console.log(response);

                    $.dialog({
                        title: "Confirm Login",
                        content: `Hello, ${response.last_name} ${response.first_name}! Please confirm that you are logged in to the correct account.`,
                        buttons: [{type: "confirm"}],
                        onConfirm: function () {
                            $("#app_mailchimp_auth").attr("login", true);
                            $("#app_mailchimp_auth").submit();
                        },
                    }).open();
                } else {
                    $.dialog({
                        title: "Error",
                        content:
                            "You have not logged in to the MailChimp server. It is possible that you inserted the wrong token, check that your token was in the format ********************************** - **** and try again",
                        buttons: [{type: "confirm"}],
                        onConfirm: function () {
                        },
                    }).open();
                }
            },
        });
    });

    /**
     * Authorization script for HubSpot
     *
     * @author Mirele
     * @version 1.0.0
     */

    $("#app_hubspot_auth").submit(function (e) {
        if (!$("#app_hubspot_auth").attr("login")) {
            e.preventDefault();
        }

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "app_integration_hubspot_auth",
                token: $("#app_hubspot_auth").serializeArray()[4].value,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);

                if (response && "portalId" in response) {
                    $.dialog({
                        title: "Confirm Login",
                        content: `Hello! Please confirm authorization in HubSpot CMS. This is your portalID ${response.portalId}?`,
                        buttons: [{type: "confirm"}],
                        onConfirm: function () {
                            $("#app_hubspot_auth").attr("login", true);
                            $("#app_hubspot_auth").submit();
                        },
                    }).open();
                } else {
                    $.dialog({
                        title: "Error",
                        content:
                            "An error occurred while logging in. Verify that you are specifying <b> HupiKey </b>",
                        buttons: [{type: "confirm"}],
                        onConfirm: function () {
                        },
                    }).open();
                }
            },
        });
    });

    /**
     * Check if the client is subscribed to updates.
     * If not, you need to sign
     *
     * @author Mirele
     * @version 1.0.0
     */

    if (!localStorage.client_send_email) {
        $.dialog({
            title: "5 minutes of your time",
            content:
                "In order for you to receive free system updates, we need to know your Email (no spam). Please give permission to receive an email address from you.",
            buttons: [{type: "confirm"}, {type: "cancel"}],
            onConfirm: function () {
                localStorage.client_send_email = true;

                new MForms().email_for_updates();
            },
            onCancel: function () {
                localStorage.client_send_email = 100;
            },
        }).open();
    }

    /**
     * Survey of the relevance of packages.
     * As in Linux APT, but only static
     *
     * @author Mirele
     * @version 1.0.0
     */

    if (!localStorage.client_surveyed) {
        localStorage.client_surveyed = new Date().getTime();
    } else if (
        new Date().getTime() / 1000 -
        parseInt(localStorage.client_surveyed) / 1000 >
        60 * 60 * 24 * 2
    ) {
        $.dialog({
            title: "5 minutes of your time",
            content:
                "You have been using the product for quite a long time, could you please rate it?",
            buttons: [{type: "confirm"}, {type: "cancel"}],
            onConfirm: function () {
                localStorage.client_surveyed =
                    new Date().getTime() / 1000 + 10 ** (10 * 100);
                new MForms().relevance();
            },
            onCancel: function () {
                localStorage.client_surveyed =
                    new Date().getTime() / 1000 + 60 * 60 * 24 * 14;
                new MForms().relevance();
            },
        }).open();
    }

    /**
     * Email Override Event
     *
     * @author Mirele
     * @version 1.0.0
     */

    $(document).ready(function () {
        for (const argument of $('[data-action="re-specify_update_email"]')) {
            $(argument).click(function () {
                new MForms().email_for_updates();
            });
        }
    });


    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {
            if ($('[data-open-tab]').length !== 0) {

                $(`[data-tab]`).hide();
                if ($(`[data-tab="welcome"]`).length !== 0) {
                    $(`[data-tab="welcome"]`).show();
                } else {
                    if ($(`[data-tab="main"]`).length !== 0) {
                        $(`[data-tab="main"]`).show();
                    }
                }

                for (const tab of $('[data-open-tab]')) {

                    $(tab).click(function () {

                        $('[data-open-tab]').removeClass('active');

                        $(`[data-tab]`).hide();
                        $(`[data-tab="${$(this).attr('data-open-tab')}"]`).show();

                        $(tab).addClass('active');

                    });

                }
            }
        });
    }

    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {
            if ($('[data-open-sidebar]').length !== 0) {

                $(`[data-sidebar]`).hide();
                if ($(`[data-sidebar="main"]`).length !== 0) {
                    $(`[data-sidebar="main"]`).show();
                }

                for (const side of $('[data-open-sidebar]')) {
                    $(side).click(function () {
                        $(`[data-sidebar]`).hide();
                        $(`[data-sidebar="${$(this).attr('data-open-sidebar')}"]`).show();
                    });
                }
            }
        });
    }

    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {
            if ($('[data-insert-element]').length !== 0) {

                for (const e of $('[data-insert-element]')) {
                    $(e).hover(function () {

                        $(e).attr('data-hint', 'Wait 2 seconds');

                        window.hover_timeout = setTimeout(function () {
                            $(`${$(e).attr('data-insert-element')}`).val($(`${$(e).attr('data-insert-element')}`).val() + " " + $(e).attr('data-content'));
                            $(e).attr('data-hint', 'Append!');
                        }, 1300);
                    }, function () {
                        clearTimeout(window.hover_timeout);
                        delete window.hover_timeout;
                    });
                }
            }
        });
    }

    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {
            if ($('[data-ul-open-submenu]').length !== 0) {

                $(`[data-ul-submenu]`).hide();

                for (const tab of $('[data-ul-open-submenu]')) {
                    $(tab).click(function () {
                        $(`[data-ul-submenu="${$(this).attr('data-ul-open-submenu')}"]`).toggle();
                    });
                }
            }
        });
    }

    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {
            if ($('[data-form-ajax]').length !== 0) {
                for (const form of $('[data-form-ajax]')) {
                    $(form).submit(function (e) {
                        e.preventDefault();
                        $.ajax({
                            type: $(form).attr('method'),
                            url: $(form).attr('action'),
                            data: $(form).serialize(),
                            success: function (data) {
                                karlin(document.body).notify({
                                    'title': 'Success',
                                    'text': 'All changes are saved and entered into force.'
                                });
                            }
                        });
                    });
                }
            }
        });
    }

    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {

            if ($('[data-form-ajax-settings]').length !== 0) {

                $(document.body).trigger('form-ajax-load');

                for (const form of $('[data-form-ajax-settings]')) {

                    $(form).submit(function (e) {
                        e.preventDefault();

                        if ($(form).attr('data-form-ajax-preloader') && $(form).attr('data-form-ajax-render')) {
                            $($(form).attr('data-form-ajax-preloader')).show();
                            $($(form).attr('data-form-ajax-render')).hide();
                        }

                        $.ajax({
                            type: "POST",
                            url: '',
                            data: karlin(form).form(),
                            success: function (data) {
                                if ($(form).attr('data-form-ajax-render')) {
                                    $($(form).attr('data-form-ajax-render')).html(data);
                                    $($(form).attr('data-form-ajax-preloader')).hide();
                                    $($(form).attr('data-form-ajax-render')).show();
                                } else {
                                    karlin(document.body).notify({
                                        'title': 'Success',
                                        'text': 'All changes are saved and entered into force.'
                                    });
                                }

                                $(document.body).trigger('form-ajax-load');

                            }
                        });

                    });
                }
            }
        });
    }

    if (typeof jQuery == 'function' && jQuery.fn.jquery) {
        $(document).ready(function () {
            if ($('[data-mpager-part]').length !== 0) {
                for (const part of $('[data-mpager-part]')) {

                    $.ajax({
                        type: "POST",
                        url: '',
                        async: false,
                        data: {
                            'mrl_action': 'mui_' + $(part).attr('data-mpager-part')
                        },
                        success: function (data) {
                            $(part).html(data);
                        }
                    });

                }
            }
        });
    }
});
