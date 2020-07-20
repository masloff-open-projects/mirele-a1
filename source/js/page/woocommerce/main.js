if (typeof jQuery == 'function' && jQuery.fn.jquery) {
    $(document).ready(function () {

        if (window.innerWidth > 768) {

            if (localStorage.woo_enable_sort !== false && window.mirele_woo_account_can_sort) {

                $('.account-sort').sortable({
                    axis: 'xy',
                    revert: 800,
                    placeholder: 'account-blocks-placeholder',
                    start: function(e, ui) {
                        ui.placeholder.height(ui.item.height());
                    },
                    stop: function () {

                        localStorage.woo_account_sort = $(this).children().get().map(function(el) {
                            return el.id
                        }).join("|");

                    }
                });

            }

            if (localStorage.woo_enable_sort !== false && localStorage.woo_account_sort  && window.mirele_woo_account_can_sort) {

                var templates = [];

                for (const card of localStorage.woo_account_sort.split("|")) {
                    templates.push($(`#${card}`));
                    $(`#${card}`).remove();
                }

                for (const card of templates) {
                    $('.account-sort').append(card);
                }

            }

        }

        /**
         * Function for logging out of your account using Ajax
         *
         * @version 1.0.0
         */

        for (const iterator of $("[data-action=\"woo_logout\"]")) {
            $(iterator).click(function () {
                $.ajax({
                    type: "POST",
                    url: wc_add_to_cart_params.ajax_url,
                    data: {
                        action: 'woo_logout'
                    },
                    dataType: "text",
                    success: function (response) {
                        location.reload();
                    }
                });
            });
        }


        /**
         * Function for logging of your account using Ajax
         *
         * @version 1.0.0
         */

        for (const iterator of $('[data-action="woo_login"]')) {

            $(iterator).submit(function () {

                var form = karlin(iterator).form();

                if (form.username && form.password) {
                    $.ajax({
                        url: wc_add_to_cart_params.ajax_url,
                        method: "POST",
                        timeout: 0,
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        data: {
                            "action": "woo_login",
                            "login": form.username,
                            "password": form.password
                        },
                        dataType: "json",
                        success: function (response) {

                            if (response.status == "error" ) {

                                $("#woo_login_form_warning").html(response.message);
                                $("#woo_login_form_warning").show(300);
                                $("#woo_login_form_warning").delay(6000).hide(300);

                            } else {
                                location.reload();
                            }

                        },
                        error: function () {
                            $("#woo_login_form_warning").html('Server error');
                            $("#woo_login_form_warning").show(300);
                            $("#woo_login_form_warning").delay(6000).hide(300);
                        }
                    });
                } else {
                    $("#woo_login_form_warning").html('You didn\'t fill out the login form');
                    $("#woo_login_form_warning").show(300);
                    $("#woo_login_form_warning").delay(6000).hide(300);
                }

                return false;

            });
        }


        for (const iterator of $('[data-action="woo_register"]')) {

            $(iterator).submit(function () {

                var form = karlin(iterator).form();

                if (form.email) {

                    $.ajax({
                        url: wc_add_to_cart_params.ajax_url,
                        method: "POST",
                        timeout: 0,
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        data: {
                            "action": "woo_register",
                            "email": form.email,
                            "username": form.username,
                            "password": form.password
                        },
                        dataType: "json",
                        success: function (response) {

                            console.log(response)

                            if (response.woo.errors) {

                                var errors = [];

                                for (const error_group in response.woo.errors) {
                                    errors.push(response.woo.errors[error_group].join("<br>"));
                                }

                                $("#woo_register_form_warning").html(errors.join("<br>"));
                                $("#woo_register_form_warning").show(300);
                                $("#woo_register_form_warning").delay(6000).hide(300);

                            } else {
                                location.href = response.account_url;
                            }

                        },
                        error: function () {
                            $("#woo_register_form_warning").html('Server error');
                            $("#woo_register_form_warning").show(300);
                            $("#woo_register_form_warning").delay(6000).hide(300);
                        }
                    });

                } else {
                    $("#woo_register_form_warning").html('You didn\'t fill out the register form');
                    $("#woo_register_form_warning").show(300);
                    $("#woo_register_form_warning").delay(6000).hide(300);
                }

                return false;

            });
        }


        /**
         * Function for restore password of your account using Ajax
         *
         * @version 1.0.0
         */

        for (const iterator of $('[data-action="woo_restore"]')) {

            $(iterator).submit(function () {

                var form = karlin(iterator).form();

                if (form.login && form.email) {

                    $(iterator).find('[type="submit"]').val("Loading");

                    $.ajax({
                        url: wc_add_to_cart_params.ajax_url,
                        method: "POST",
                        timeout: 0,
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        data: {
                            "action": "woo_restore",
                            "login": form.login,
                            "email": form.email
                        },
                        dataType: "json",
                        success: function (response) {

                            if (response.status == "error" ) {

                                $("#woo_restore_form_warning").html(response.message);
                                $("#woo_restore_form_warning").show(300);
                                $("#woo_restore_form_warning").delay(6000).hide(300);

                            } else if (response.email_status == false) {

                                $("#woo_restore_form_warning").html("You entered the correct data, but the email was not sent because the administrator incorrectly configured the email on the site. Please contact the website's technical support to restore your password");
                                $("#woo_restore_form_warning").show(300);
                                $("#woo_restore_form_warning").delay(12000).hide(300);

                            } else {

                                $(iterator).find('[type="submit"]').attr("disabled", true);
                                $(iterator).find('[type="submit"]').css("opacity", 0.5);
                                $(iterator).find('[type="submit"]').fadeOut(1000);

                                $("#woo_restore_form_warning").html("A link to the password recovery page was sent to your mail. Check your spam folder");
                                $("#woo_restore_form_warning").css('color', '#89c35c');
                                $("#woo_restore_form_warning").show(300);
                                $("#woo_restore_form_warning").delay(1000 * 60 * 30).hide(300);

                            }

                            $(iterator).find('[type="submit"]').val("Continue");

                        },
                        error: function () {

                            $("#woo_restore_form_warning").html('Server error');
                            $("#woo_restore_form_warning").show(300);
                            $("#woo_restore_form_warning").delay(6000).hide(300);

                            $(iterator).find('[type="submit"]').val("Continue");
                        },
                    });
                } else {
                    $("#woo_restore_form_warning").html('You didn\'t fill out the restore password form');
                    $("#woo_restore_form_warning").show(300);
                    $("#woo_restore_form_warning").delay(6000).hide(300);
                }

                return false;

            });
        }



    });
}
