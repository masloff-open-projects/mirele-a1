$ = jQuery;

function kristen_save () {

    var gallery_grid = {}; 

    for (const iterator of $("div[column] > img")) {
        try {
            gallery_grid[$($(iterator).closest("div")[0]).attr('column')].push($(iterator).attr('src'));
        } catch (e) {
            gallery_grid[$($(iterator).closest("div")[0]).attr('column')] = [];
            gallery_grid[$($(iterator).closest("div")[0]).attr('column')].push($(iterator).attr('src'));
        }
    }

    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: 'kristen_setup',
            grid: btoa(JSON.stringify(gallery_grid))
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
        },
    });

}

function kristen_get () {

    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: 'kristen_get'
        },
        dataType: "json",
        success: function (response) {

            for (const id in Object.keys(response.gallery)) {

                grid_id = Object.keys(response.gallery)[id];

                for (const src in response.gallery[grid_id]) {

                    $('<img>', {src: response.gallery[grid_id][src], action: "can_remove", "data-toggle": "tooltip", "data-placement": "bottom", "title": "Double tap to delete photo"}).appendTo(`div[column="${grid_id}"]`);

                }

            }

            setTimeout(() => {
                for (const iterator of $('[action="can_remove"]')) {
                    $(iterator).dblclick(function (event) {

                        $.dialog({
                            title: 'Remove?',
                            content: 'Are you sure you want to delete the photo from this section?',
                            buttons: [
                                { type: 'cancel' },
                                { type: 'confirm' }
                            ],
                            onConfirm: function () {

                                karlin(iterator).animate({
                                    transform: 'scale(10)',
                                    opacity: '0',
                                    height: '0'
                                }, '.3s', 0, 'ease', function() {

                                    $(iterator).remove();
                                    kristen_save();

                                });
                            }
                        }).open();

                    });
                }
            }, 2000);

        },
    });

}


$(function () {

    $('.column').sortable({
        cursor: "move",
        placeholder: "",
        distance: 48,

        stop: function () {
            kristen_save();
        }

    });

    for (const iterator of $('[action="photo"]')) {
        $(iterator).click(function () {

            wp.media.editor.open();
            wp.media.editor.send.attachment = function (props, attachment) {

                $('<img>', {src: attachment.url, action: "can_remove", "data-toggle": "tooltip", "data-placement": "bottom", "title": "Double tap to delete photo"}).appendTo(`[column="${($($(iterator).closest("div[column]")[0]).attr('column'))}"]`);
                kristen_save();

            };

            return false;
        });
    }

    kristen_get();

}); 
