/**
 * MailChimp Newsletter Subscription
 * Actions by clicking the bear on the "Subscribe" button
 *
 * @version 1.0.n
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {
    $(document).ready(function() {
        if ($(`[data-action="subscribe_to_news_mailchimp_form"]`).length !== 0) {

            for (const iterator of $(`[data-action="subscribe_to_news_mailchimp_form"]`)) {

                if ($(iterator).find(`[data-action="subscribe_to_news_mailchimp_do"]`).length !== 0) {

                    const submit = $(iterator).find(`[data-action="subscribe_to_news_mailchimp_do"]`);

                    const old_text_btn =  $(submit).html();

                    $(submit).click(function(e) {

                        e.preventDefault();

                        $(submit).text('Please wait');

                        $.ajax({
                            type: "POST",
                            url: wc_add_to_cart_params.ajax_url,
                            data: {
                                action: 'app_integration_mailchimp_subscribe',
                                email: $(iterator).find(`[name="email"]`).val(),
                                fname: $(iterator).find(`[name="fname"]`).val(),
                                lname: $(iterator).find(`[name="lname"]`).val(),
                                phone: $(iterator).find(`[name="phone"]`).val(),
                                list: $(iterator).attr('list_id')
                            },
                            dataType: "json",
                            success: function(response) {

                                if (response && 'status' in response && response.status == 'subscribed') {
                                    $(submit).text('Thank you for your feedback!');
                                } else {
                                    $(submit).text('Your application has not been sent. Please try again later.');
                                }

                                $(submit)
                                    .css({
                                        transition: '0.1s',
                                        fontSize: '+=1'
                                    })
                                    .delay(800)
                                    .queue(function (next) {

                                        $(submit).delay(400).css({
                                            transition: '0.1s',
                                            fontSize: '-=1'
                                        });

                                        next();
                                    });

                                $(submit)
                                    .delay(8000)
                                    .queue(function(next) {

                                        $(submit).html(old_text_btn);

                                    });

                            },
                            error: function() {
                                $(submit).text('Your application has not been sent. Please try again later.');

                                $(submit)
                                    .delay(8000)
                                    .queue(function(next) {

                                        $(submit).html(old_text_btn);

                                    });
                            }
                        });

                    });

                }
            }

        }
    });
}
