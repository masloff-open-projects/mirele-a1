/**
 * HubSpot form submission
 *
 * @version 1.0.n
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {
    $(document).ready(function () {
        if ($(`[data-action="form_hubspot"]`).length !== 0) {

            for (const iterator of $(`[data-action="form_hubspot"]`)) {

                if ($(iterator).find(`[data-action="hubspot_form_do"]`).length !== 0) {

                    const submit = $(iterator).find(`[data-action="hubspot_form_do"]`);

                    const old_text_btn = $(submit).html();

                    $(submit).click(function(e) {

                        e.preventDefault();

                        $(submit).text('Please wait');

                        $.ajax({
                            type: "POST",
                            url: wc_add_to_cart_params.ajax_url,
                            data: {
                                action: 'app_integration_hubspot_submit',
                                portal_id: $(iterator).attr('portal_id'),
                                guid: $(iterator).attr('guid'),
                                json: btoa(JSON.stringify({
                                    fields: $(iterator).serializeArray()
                                }))
                            },
                            dataType: "json",
                            success: function(response) {

                                if (response && 'inlineMessage' in response) {
                                    $(submit).text(response.inlineMessage);
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

                            }
                        });

                    });

                }
            }

        }
    });
}
