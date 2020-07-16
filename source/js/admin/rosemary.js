/**
 * java engine for rosemary engine
 */

var $ = jQuery;

$(document).ready(function () {

    /**
     * Page refresh function without refreshing it
     * in understanding the appeal to location.reload
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    function async_update() {
        $("html").animate({
            opacity: 0,
        });

        $.ajax({
            type: "GET",
            url: location.href,
            dataType: "html",
            success: function (response) {
                $("html").css("opacity", "0");
                $("body").html(response);
                $("html").animate({
                    opacity: 1,
                });
            },
        });
    }

    /**
     * String function to convert the first letter
     * to the title page.
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    function ucFirst(str) {
        if (!str) return str;

        return str[0].toUpperCase() + str.slice(1);
    }

    /**
     * Function for sorting blocks
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    function rosemary_sort_blocks() {
        var index = {};

        for (iterator of $("[data-action='table_for_block']")) {
            index[$(iterator).attr("block")] = Object.keys(index).length;
        }

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "editor_save_index",
                page: new URLSearchParams(location.search).get("page_id"),
                blocks: btoa(JSON.stringify(index)),
            },
            dataType: "text",
            success: function (response) {
                console.log(response);
            },
        });
    }

    function mirele_auth_bridge (action='', function_=null, args={}) {

        return $.prompt('To complete this action, you need to enter the password for your Mirele account. Thus, Mirele secured customers from unauthorized actions by other persons.', function (e = null) {

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
     * Function for install blocks
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    function rosemary_install (url = null, callback_success=false, callback_cancel=false, callback_on=false) {

        if (callback_on) {
            callback_on();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "text",
            success: function (response) {
                try {
                    hashCode = function (s) {
                        return s.split("").reduce(function (a, b) {
                            a = (a << 5) - a + b.charCodeAt(0);
                            return a & a;
                        }, 0);
                    };

                    function trim(str) {
                        return str.replace(/^\s+/, "").replace(/\s+$/, "");
                    }

                    var meta = {
                        version: response.match("Version:(.*);")[1],
                        author: response.match("Author:(.*);")[1],
                        type: response.match("Type:(.*);")[1],
                        template: response.match("Rosemary Template:(.*);")[1],
                    };

                    $.dialog({
                        title: "Confirm Installation",
                        content: `You are going to install the block <b>${
                            meta.template
                        }</b> from the author of <b>${
                            meta.author ? meta.author : "unknown"
                        }</b>. are you sure you want to do this? <hr><small>Template name: ${
                            meta.template
                        }<br>Author: ${meta.author}<br>Version: ${meta.version}<br>
                    <hr>
                    Type: ${meta.type}
                    
                    ${meta.type == 'Kit' ? '<p><small>Please note that you are downloading a set of blocks and not a single block.</small></p>' : ''}
                    
                    </small>`,
                        buttons: [{ type: "cancel" }, { type: "confirm" }],
                        onConfirm: function () {

                            mirele_auth_bridge ('market_install', function (response=null) {

                                if ('message' in response) {

                                    $.dialog({
                                        title: "Response",
                                        content:  response.message,
                                        buttons: [{ type: "confirm" }],
                                        escCall: "",
                                        enterCall: "",
                                        onConfirm: function () {},
                                    }).open();

                                    if (callback_success) {
                                        callback_success();
                                    }

                                } else {

                                    $.dialog({
                                        title: "Error",
                                        content: `The block was not installed. It is possible that Mirele does not have write permissions in the template directory (rosemary_templates is the default) and it is possible that the block is already installed`,
                                        buttons: [{ type: "confirm" }],
                                        escCall: "",
                                        enterCall: "",
                                        onConfirm: function () {},
                                    }).open();

                                }

                            }, {
                                'url': url
                            });

                        },
                        onCancel: function () {
                            if (callback_cancel) {
                                callback_cancel();
                            }
                        }
                    }).open();
                } catch (e) {
                    $.dialog({
                        title: "Error parsing the package",
                        content: `The block you are trying to install is not correct, or it is damaged`,
                        buttons: [{ type: "confirm" }],
                    }).open();
                }
            },
            error: function () {
                $.dialog({
                    title: "The repository does not respond",
                    content: `The repository from which you want to install the block is unavailable. check your Internet connection`,
                    buttons: [{ type: "confirm" }],
                }).open();
            },
        });
    }

    /**
     * Reinitialization of forms. Each form on the page will be hung
     * AJAX hook that will submit the form in the background, which
     * will avoid page updates when sending content
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    if (
        new URLSearchParams(location.search).get("page_id") &&
        new URLSearchParams(location.search).get("page")
    ) {
        if ("success_icon_for_notify" in sessionStorage) {
            // Pass
        } else {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "wp_path",
                },
                dataType: "json",
                success: function (response) {
                    var notify_icon_success = response.icon_success;
                    sessionStorage.success_icon_for_notify = response.icon_success;
                    sessionStorage.rosemary_path = JSON.stringify(response);
                },
            });
        }

        for (const iterator of $('form[data-action="edit_block"]')) {
            karlin(iterator).form((event) => {
                $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: event,
                    dataType: "text",
                    success: function (response) {
                        karlin("body").notify({
                            title: "Done",
                            text:
                                "Block settings saved successfully. You can see the changes on the site.",
                            image: sessionStorage.success_icon_for_notify,
                        });
                    },
                    error: function (response) {
                        karlin("body").notify({
                            title: "Error",
                            text: "Error saving",
                            image:
                                "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxjaXJjbGUgc3R5bGU9ImZpbGw6I0Q3NUE0QTsiIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIvPjxwb2x5bGluZSBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojRkZGRkZGO3N0cm9rZS13aWR0aDoyO3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjEwOyIgcG9pbnRzPSIxNiwzNCAyNSwyNSAzNCwxNiAiLz48cG9seWxpbmUgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6I0ZGRkZGRjtzdHJva2Utd2lkdGg6MjtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDoxMDsiIHBvaW50cz0iMTYsMTYgMjUsMjUgMzQsMzQgIi8+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+",
                        });
                    },
                });

                return false;
            });
        }

        /**
         * Block Drag Functions
         *
         * @version: 1.0.0
         * @package: Mirele and Rosemary
         */

        $(".root-blocks").sortable({
            cursor: "move",
            placeholder: "rosemary-blocks-placeholder",
            distance: 24,
            animation: 500,

            start: function (event, ui) {
                ui.placeholder.height(ui.item.height());
            },

            stop: function (event, ui) {
                rosemary_sort_blocks();
            },
        });

        rosemary_sort_blocks();

    }

    /**
     * Search for components that are responsible for opening
     * modal window with a choice of media file, which will be indicated in
     * field for entering component value
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="media"]')) {
        $(iterator).click(function () {
            karlin(`[name="${karlin(iterator).attribute("for_name")}"]`).value("");

            wp.media.editor.open();
            wp.media.editor.send.attachment = function (props, attachment) {
                value = karlin(
                    `[name="${karlin(iterator).attribute("for_name")}"]`
                ).value();
                karlin(`[name="${karlin(iterator).attribute("for_name")}"]`).value(
                    `${value}|${attachment.id}`
                );
            };

            return false;
        });
    }

    /**
     * Search for components that are responsible for opening
     * modal window with a type pretty text
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="pretty_text"]')) {
        $(iterator).click(function () {

            $('#pretty_text_modal').remove();

            var pretty_text = karlin(`[name="${karlin(iterator).attribute("for_name")}"]`).value().replace(new RegExp('<br>', 'g'), "\n");

            $.dialog({
                title: "Edit content",
                content: `<textarea id='pretty_text_modal'>${pretty_text}</textarea>`,
                buttons: [{ type: "cancel" }, { type: "confirm" }],
                width: 640,
                onConfirm: function () {

                    var html_text = $('#pretty_text_modal').val().replace(new RegExp("\n", 'g'), "<br>");

                    karlin(`[name="${karlin(iterator).attribute("for_name")}"]`).value(html_text);

                },
            }).open();

            return false;
        });
    }

    /**
     * Search for all components that are referenced
     * on the block creation form. For each such component
     * hangs on click
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="create_block_other"]')) {
        $(iterator).click(function () {
            $.prompt("Enter block ID", function (event) {
                $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: {
                        action: "editor_add_block",
                        page: new URLSearchParams(location.search).get("page_id"),
                        block: event,
                    },
                    dataType: "html",
                    success: function (response) {
                        location.reload();
                        console.log(response);
                    },
                });
            });
        });
    }

    /**
     * Search for all components that are responsible for
     * block removal. A click hook is hung on these components.
     * to send a request to delete a block
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="remove_block"]')) {
        $(iterator).click(function (event) {
            $.dialog({
                title: "Remove?",
                content: "Are you sure you want to remove this block from this page?",
                buttons: [{ type: "cancel" }, { type: "confirm" }],
                onConfirm: function () {
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "editor_remove_block",
                            page: new URLSearchParams(location.search).get("page_id"),
                            block: $(event.target).attr("block"),
                        },
                        dataType: "text",
                        success: function (response) {
                            $(`table[block="${$(event.target).attr("block")}"]`).css({
                                display: "block",
                                overflow: "hidden",
                            });

                            $(`table[block="${$(event.target).attr("block")}"]`).animate(
                                {
                                    height: "0px",
                                },
                                1000,
                                function () {
                                    $(`table[block="${$(event.target).attr("block")}"]`).remove();
                                }
                            );
                        },
                    });
                },
            }).open();
        });
    }

    /**
     * Search for all components that are responsible for
     * page removal. A click hook is hung on these components.
     * to send a request to delete a page
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="remove_page"]')) {
        $(iterator).click(function (event) {
            $.dialog({
                title: "Remove?",
                content: "Are you sure you want to remove this page?",
                buttons: [{ type: "cancel" }, { type: "confirm" }],
                onConfirm: function () {
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "editor_remove_page",
                            page: $(event.target).attr("page"),
                        },
                        dataType: "json",
                        success: function (response) {
                            location.reload();
                            console.log(response);
                        },
                    });
                },
            }).open();
        });
    }

    /**
     * Search for all components that are responsible for
     * page create. A click hook is hung on these components.
     * to send a request to create a page
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="create_page"]')) {
        $(iterator).click(function (event) {
            $.prompt("Enter a name for the new page. <br>Use lowercase letters, underscores, numbers, and hyphens.<br><br><b>Examples</b>: main, about_our_company, faq-1-2", function (eval) {
                location.search = `?page=rosemary_render_editor&page_id=${eval}`;
            }, 'Create new page');
        });
    }

    /**
     * Search for all components that are responsible for
     * WP page create. A click hook is hung on these components.
     * to send a request to create a WP page
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="create_wordpress_page"]')) {
        $(iterator).click(function (event) {
            $.dialog({
                title: "Create Page?",
                content:
                    "You are currently trying to create a WordPress page based on a Mirele page. This means that all the blocks you create on this Mirele page will be displayed on the WordPress page.",
                buttons: [{ type: "cancel" }, { type: "confirm" }],
                onConfirm: function () {
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "editor_create_wp_page",
                            page: $(event.target).attr("page"),
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.url) {
                                window.open(response.url);

                                $.dialog({
                                    title: "Page created",
                                    content: `Done! Now you can use this page as your homepage. URL: <a href="javascript:;">${response.url}</a>`,
                                }).open();
                            }
                        },
                    });
                },
            }).open();
        });
    }

    /**
     * Search for all components that are responsible for
     * create new block. A click hook is hung on these components.
     * to send a request to create a new block in this page
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="create_block"]')) {
        $(iterator).click(function (event) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "editor_get_available_blocks",
                },
                dataType: "json",
                success: function (response) {

                    var blocks = response.body.blocks_meta;

                    if (Object.keys(blocks).length > 0) {

                        try {

                            for (i of $(".root-blocks>table")) {
                                try {
                                    delete blocks[$(i).attr("block")];
                                } catch (e) {}
                            }


                            var used_blocks = JSON.parse(localStorage.getItem("used_blocks"));

                            if (!used_blocks) {
                                used_blocks = {};
                            }

                            var sortable = [];
                            for (var index in used_blocks) {
                                sortable.push([index, used_blocks[index]]);
                            }

                            sortable.sort(function (a, b) {
                                return a[1] - b[1];
                            });

                            sortable;

                            for (const iterator of sortable) {
                                if (typeof blocks[iterator[0]] == "object") {
                                    data = blocks[iterator[0]];
                                    delete blocks[iterator[0]];
                                    blocks[iterator[0]] = data;
                                }
                            }

                            for (const iterator of Object.keys(blocks).reverse()) {
                                data = blocks[iterator];
                                delete blocks[iterator];
                                blocks[iterator] = data;
                            }

                        } catch (e) {
                            localStorage.setItem("used_blocks", "{}");
                        }

                        var html = $("<div>", {});
                        var container = $("<div>", {
                            class: "fast-select-block-container",
                        }).appendTo(html);

                        var search = $("<input>", {
                            type: "text",
                            placeholder: "Search block",
                            id: "box_search_input",
                            autofocus: true,
                            css: {
                                width: "-webkit-fill-available",
                                margin: "12px 4px",
                                position: "sticky",
                                top: "4px",
                                background: "white",
                                zIndex: 10 ** 2,
                            },
                        }).appendTo(container);

                        $(search).focus();

                        setTimeout(() => {
                            $("input#box_search_input").focus();

                            $("input#box_search_input").on("input", function (event) {
                                $(".block_element").hide();

                                var input = $(this).val();

                                for (const iterator of $(".block_element")) {
                                    if (
                                        $(iterator)
                                            .text()
                                            .toLowerCase()
                                            .indexOf(input.toLowerCase()) >= 0
                                    ) {
                                        $(iterator).show();
                                    }
                                }
                            });
                        }, 1000);

                        if (Object.keys(blocks).length > 0) {
                            for (const iterator in blocks) {
                                var element = $("<div>", {
                                    css: {
                                        marginBottom: "8px",
                                        border: "1px solid #eee",
                                        padding: "8px 16px",
                                        background: "#f7f7f7",
                                        borderRadius: "6px",
                                    },
                                    class: "block_element",
                                    'data-image-hint': 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png'
                                }).appendTo(container);

                                var header = $("<p>").appendTo(element);

                                $("<span>", {
                                    text: blocks[iterator].title
                                        ? ucFirst(blocks[iterator].title)
                                        : iterator,
                                    css: {
                                        fontWeight: "bold",
                                        fontSize: "14px",
                                    },
                                }).appendTo(header);

                                $("<span>", {
                                    text: blocks[iterator].author,
                                    css: {
                                        marginLeft: "6px",
                                        color: "#72777c",
                                    },
                                }).appendTo(header);

                                $("<span>", {
                                    text: " ",
                                    css: {
                                        marginLeft: "6px",
                                        backgroundColor: blocks[iterator].unique_color,
                                        height: "4px",
                                        width: "4px",
                                        display: "inline-block",
                                        borderRadius: "50%",
                                        bottom: "2px",
                                        position: "relative",
                                    },
                                }).appendTo(header);

                                $("<p>", {
                                    text: blocks[iterator].description
                                        ? ucFirst(blocks[iterator].description)
                                        : "No description",
                                }).appendTo(element);
                                $("<a>", {
                                    href: "javascript:;",
                                    text: "add",
                                    'data-action': "create_block",
                                    block: iterator,
                                }).appendTo(element);
                            }
                        } else {
                            $("<p>", {
                                text:
                                    "No templates available. All of them are on the current page.",
                            }).appendTo(container);
                        }

                        $.dialog({
                            content: $(html).html(),
                            title: `Collection of Available Blocks (${
                                Object.keys(blocks).length
                            })`,
                            width: 900,
                            height: 600,
                        }).open();

                        $('div.block_element > a[data-action="create_block"]').click(function () {
                            var used_blocks = JSON.parse(localStorage.getItem("used_blocks"));

                            if (!used_blocks) {
                                used_blocks = {};
                            }

                            used_blocks[$(this).attr("block")] =
                                Number(
                                    isNaN(parseInt(used_blocks[$(this).attr("block")]))
                                        ? 0
                                        : used_blocks[$(this).attr("block")]
                                ) + 1;

                            localStorage.setItem("used_blocks", JSON.stringify(used_blocks));

                            $.ajax({
                                type: "POST",
                                url: ajaxurl,
                                data: {
                                    action: "editor_add_block",
                                    page: new URLSearchParams(location.search).get("page_id"),
                                    block:
                                        $(this).attr("block") +
                                        "@" +
                                        ($(`.root-blocks>table[block-name="${$(this).attr("block")}"]`)
                                                .length +
                                            1),
                                },
                                dataType: "text",
                                success: function (response) {
                                    if (response != "") {
                                        location.reload();
                                    } else {
                                        alert("Block not created");
                                    }
                                },
                            });
                        });

                    } else {

                        $.dialog({
                            content: "<center><br><br><br><h2>Your collection is empty</h2><p>Your block collection is completely empty!<br>Go to the block store to download yourself a couple of new items!</p></center>",
                            title: `Collection of Available Blocks`,
                            width: 900,
                            height: 600,
                        }).open();

                    }
                },
                error: function () {

                    $.dialog({
                        content: "<center><br><br><br><h2>Hmm.. Error 500</h2><p>\n" +
                            "The error could have occurred for several reasons.<br>The most common is an error in the block code.<br>Go to the widget panel and find the \"Mirele Security\" widget there and if viruses<br>are detected on your site, try using the standard Mirele antivirus functionality,<br>or contact your system administrator</p></center>",
                        title: `Collection of Available Blocks`,
                        width: 900,
                        height: 600,
                    }).open();

                }
            });
        });
    }

    /**
     * Search for all components that are responsible for
     * export blocks. A click hook is hung on these components.
     * to send a request to export blocks
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="export_blocks"]')) {
        $(iterator).click(function (event) {
            function download(filename, text) {
                var element = document.createElement("a");
                element.setAttribute(
                    "href",
                    "data:text/plain;charset=utf-8," + encodeURIComponent(text)
                );
                element.setAttribute("download", filename);

                element.style.display = "none";
                document.body.appendChild(element);

                element.click();

                document.body.removeChild(element);
            }

            $.dialog({
                title: "Export blocks?",
                content: "Are you sure you want to export blocks?",
                buttons: [{ type: "cancel" }, { type: "confirm" }],
                onConfirm: function () {
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "editor_export_blocks",
                            page: new URLSearchParams(location.search).get("page_id"),
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.body) {
                                download(
                                    "Mirele Blocks.json",
                                    JSON.stringify(response.body, null, 2)
                                );
                            }
                        },
                    });
                },
            }).open();
        });
    }

    /**
     * Search for all components that are responsible for
     * import blocks. A click hook is hung on these components.
     * to send a request to import blocks
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="import_blocks"]')) {
        $(iterator).click(function (event) {
            var input = document.createElement("input");
            input.type = "file";
            input.click();
            input.onchange = (e) => {
                var file = e.target.files[0];

                var reader = new FileReader();
                reader.readAsText(file, "UTF-8");

                reader.onload = (readerEvent) => {
                    var content = readerEvent.target.result;

                    try {
                        var data = JSON.parse(content);

                        $.dialog({
                            title: "Import blocks?",
                            content: `Are you sure you want to import <b> ${
                                Object.keys(data).length
                            } </b> blocks to this page? Blocks for import: ${Object.keys(
                                data
                            ).join(", ")}`,
                            buttons: [{ type: "cancel" }, { type: "confirm" }],
                            onConfirm: function () {
                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    data: {
                                        action: "editor_import_blocks",
                                        page: new URLSearchParams(location.search).get("page_id"),
                                        blocks: btoa(JSON.stringify(data)),
                                    },
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.status == "imported") {
                                            location.reload();
                                        } else if (response.status == "no-imported") {
                                            setTimeout(() => {
                                                $.dialog({
                                                    title: "Warning",
                                                    content: `The import of the blocks was completed, but the verification failed. You may already have an identical set of blocks`,
                                                    buttons: [{ type: "confirm" }],
                                                }).open();
                                            }, 1000);
                                        } else {
                                            setTimeout(() => {
                                                $.dialog({
                                                    title: "Error",
                                                    content: `An unknown error occurred while importing blocks. Please try again later. If the error persists, try changing the export file`,
                                                    buttons: [{ type: "confirm" }],
                                                }).open();
                                            }, 1000);
                                        }
                                    },
                                });
                            },
                        }).open();
                    } catch (error) {
                        $.dialog({
                            title: "Error",
                            content:
                                "Sorry, this file is damaged or you made a mistake with the file. This file does not contain block information.",
                            buttons: [{ type: "confirm" }],
                        }).open();
                    }
                };
            };
        });
    }

    /**
     * Search for all components that are responsible for
     * edit options. A click hook is hung on these components.
     * to send a request to edit options
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="edit_element_options"]')) {
        $(iterator).click(function (event) {

            $('.mgDialog').remove();
            $('[data-action="edit_options"]').remove();

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "editor_options_element",
                    id: $(event.target).attr("element_id"),
                    page: new URLSearchParams(location.search).get("page_id"),
                },
                dataType: "json",
                success: function (response) {
                    if (
                        response.html == false ||
                        Object.keys(response.html).length == 0
                    ) {
                        $.dialog({
                            title: "Item does not contain options.",
                            content: "This item has no options that can be edited.",
                            buttons: [{ type: "confirm" }],
                        }).open();
                    } else {

                        var content = $("<div>");
                        var form = $("<form>", {
                            method: "POST",
                            'data-action': "edit_options",
                        }).appendTo(content);

                        $(form).append(response.html);

                        $.dialog({
                            title: "Options editor",
                            content: $(content).html(),
                            buttons: [{ type: "confirm" }],
                            width: 600,
                            enterCall: "",
                            onConfirm: function () {

                                try {

                                    $.ajax({
                                        type: "POST",
                                        url: ajaxurl,
                                        data: {
                                            action: "editor_save_options",
                                            id: $(event.target).attr("element_id"),
                                            page: new URLSearchParams(location.search).get("page_id"),
                                            options: btoa(
                                                JSON.stringify(karlin('[data-action="edit_options"]').form())
                                            ),
                                        },
                                        dataType: "json",
                                        success: function (response) {},
                                        error:  function (response) {
                                            console.log('[Error save options]', response);
                                        }
                                    });

                                    karlin('[data-action="edit_options"]').remove();

                                } catch (e) {
                                    $.dialog({
                                        title: "Error",
                                        content: (e.message),
                                        buttons: [{ type: "confirm" }]
                                    }).open();
                                }
                            },
                        }).open();

                        try {
                            $('.select-color').wpColorPicker();
                        } catch (e) { }
                    }
                },
            });


        });
    }

    for (const iterator of $('[data-action="edit_block_options"]')) {
        $(iterator).click(function (event) {

            $('.mgDialog').remove();
            $('[data-action="edit_options"]').remove();

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "editor_options_block",
                    id: $(event.target).attr("block"),
                    page: new URLSearchParams(location.search).get("page_id"),
                },
                dataType: "json",
                success: function (response) {
                    if (
                        response.html == false ||
                        Object.keys(response.html).length == 0
                    ) {
                        $.dialog({
                            title: "Block does not contain options.",
                            content: "This block has no options that can be edited.",
                            buttons: [{ type: "confirm" }],
                        }).open();
                    } else {

                        var content = $("<div>");
                        var form = $("<form>", {
                            method: "POST",
                            'data-action': "edit_options",
                        }).appendTo(content);

                        $(form).append(response.html);

                        $.dialog({
                            title: "Options editor",
                            content: $(content).html(),
                            buttons: [{ type: "confirm" }],
                            width: 600,
                            enterCall: "",
                            onConfirm: function () {

                                try {

                                    $.ajax({
                                        type: "POST",
                                        url: ajaxurl,
                                        data: {
                                            action: "editor_save_options_block",
                                            id: $(event.target).attr("block"),
                                            page: new URLSearchParams(location.search).get("page_id"),
                                            options: btoa(
                                                JSON.stringify(karlin('[data-action="edit_options"]').form())
                                            ),
                                        },
                                        dataType: "json",
                                        success: function (response) {},
                                        error:  function (response) {
                                            console.log('[Error save options]', response);
                                        }
                                    });

                                    karlin('[data-action="edit_options"]').remove();

                                } catch (e) {
                                    $.dialog({
                                        title: "Error",
                                        content: (e.message),
                                        buttons: [{ type: "confirm" }]
                                    }).open();
                                }
                            },
                        }).open();

                        try {
                            $('.select-color').wpColorPicker();
                        } catch (e) { }
                    }
                },
            });


        });
    }



    /**
     * Search for all components that are responsible for
     * get block info. After clicking on the block card, a modal window will open
     * with the necessary information about the block
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="get_block_meta_info"]')) {
        $(iterator).click(function (event) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "editor_get_block_info",
                    id: $(iterator).attr("block_index"),
                },
                dataType: "json",
                success: function (response) {
                    var html = $("<div>");
                    var screenshot =
                        "screenshot" in response.body
                            ? $("<img>", {
                                src: response.body.screenshot,
                                css: {
                                    width: "100%",
                                    height: "400px",
                                    objectFit: "cover",
                                    border: "1px solid #ddd",
                                },
                            }).appendTo(html)
                            : false;
                    var title = $("<h3>", { text: response.body.title }).appendTo(html);
                    var description = $("<p>", {
                        text: response.body.description,
                    }).appendTo(html);
                    var author = $("<small>", {
                        text: `Author: ${response.body.author}`,
                        css: { display: "block" },
                    }).appendTo(html);
                    var used = $("<small>", {
                        text: `Used by you: ${
                            typeof localStorage.used_blocks != "undefined"
                                ? typeof JSON.parse(localStorage.used_blocks)[
                                    $(iterator).attr("block_index")
                                    ] != "undefined"
                                ? JSON.parse(localStorage.used_blocks)[
                                    $(iterator).attr("block_index")
                                    ]
                                : 0
                                : 0
                        }`,
                        css: { display: "block" },
                    }).appendTo(html);
                    var uid = $("<small>", {
                        text: `UID: ${response.body.uid}`,
                        css: { display: "block" },
                    }).appendTo(html);

                    $.dialog({
                        title: "Block Information",
                        content: $(html).html(),
                        buttons: [{ type: "confirm" }],
                        width: 800,
                        height: 800,
                    }).open();
                },
            });
        });
    }

    /**
     * Search for all the blocks that should cause
     * context menu with the ability to add a block to your page
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="setup_block_on_page"]')) {
        $(iterator).click(function (event) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "editor_get_pages",
                },
                dataType: "json",
                success: function (response) {
                    $('[name="page"]').remove();

                    var html = $("<div>");
                    var title = $("<h3>", {
                        text: "Select the page to which the block will be added.",
                    }).appendTo(html);
                    for (const key in response) {
                        if (response.hasOwnProperty(key)) {
                            const element = response[key];
                            var div = $("<div>", {
                                text: element,
                                css: { marginBottom: "4px" },
                            }).appendTo(html);
                            var radio = $("<input>", {
                                type: "radio",
                                text: element,
                                value: element,
                                name: "page",
                            }).prependTo(div);
                        }
                    }

                    $.dialog({
                        title: "Block Information",
                        content: $(html).html(),
                        buttons: [{ type: "confirm" }],
                        onConfirm: function (event) {
                            if ($('[name="page"]:checked').val()) {
                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    data: {
                                        action: "editor_add_block",
                                        page: $('[name="page"]:checked').val(),
                                        block: $(iterator).attr("block_index") + "@1",
                                    },
                                    dataType: "html",
                                    success: function (response) {
                                        karlin("body").notify({
                                            title: "Block added successfully",
                                            text: `Block '${$(iterator).attr(
                                                "block_index"
                                            )}' successfully added to page '${$(
                                                '[name="page"]:checked'
                                            ).val()}'`,
                                        });
                                    },
                                });
                            }
                        },
                    }).open();
                },
            });
        });
    }

    /**
     * Function for editing HTML code
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="html_edit"]')) {
        $(iterator).click(function (event) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "wp_path",
                },
                dataType: "json",
                success: function (response) {
                    var editor;

                    setTimeout(() => {
                        $("#ajax_loading_html_form").remove();

                        ClassicEditor.create(document.querySelector("#htmleditor"), {
                            initialData: $(
                                `input[name="${$(iterator).attr("for_name")}"]`
                            ).val(),
                        }).then((newEditor) => {
                            editor = newEditor;
                        });
                    }, 1000);

                    $("#htmleditor").remove();

                    $.dialog({
                        title: "HTML editor",
                        content: `<img src="${response.loader}" class="ajax_loader" id="ajax_loading_html_form" style="height: 600px"><div id="htmleditor"></div>`,
                        width: 800,
                        buttons: [{ type: "confirm" }],
                        escCall: "",
                        enterCall: "",
                        onConfirm: function () {
                            $(`input[name="${$(iterator).attr("for_name")}"]`).val(
                                editor.getData()
                            );
                            console.log(editor.getData());
                        },
                    }).open();
                },
            });
        });
    }

    /**
     * Function for editing PHP code in developer page
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $("#developer_editor")) {
        $(document).ready(function () {
            if (!localStorage.getItem("developer_start_message")) {
                $.dialog({
                    title: "Welcome. But be careful",
                    content: `<h3>Dear developer</h3> <p>This small IDE is in beta testing. You can create your own new blocks in it, you can edit them, you can delete them. Hot keys are also available to you (CTRL + 1, CTRL + 2, CTRL + 3), at the bottom of the editor you can see a line of information. Soon you will be able to write plugins for the Mirele IDE (presumably in version Mirele 1.2).</p><p>If you think that the AJAX functions of the development mode are unsafe, disable them. Change the define line in functions.php ('ROSEMARY_DEVELOPER_MODE', true); on define ('ROSEMARY_DEVELOPER_MODE', false); </p>`,
                    buttons: [{ type: "confirm" }],
                    escCall: "",
                    enterCall: "",
                    onConfirm: function () {
                        localStorage.developer_start_message = true;
                    },
                }).open();
            }
        });

        function get_php_template(id = "") {
            return `<?php

/**
 * Rosemary Template: ${id};
 */

rosemary_register('${id.toLowerCase().split(" ").join("_")}', function() {
?>

<?php echo rre('', [
    'value' => '',
    'type' => 'text'
], []); ?>

<?php
}, array(
    'title' => '${id}',
    'description' => '',
    'author' => ''
));`;
        }

        function get_php_rra() {
            return ` <?php echo rre('', ['value' => '', 'type' => 'text'], []); ?> `;
        }

        function get_php_options() {
            return ` $options_ = rosemary_get_options(); `;
        }

        function developer_save() {
            $("#developer_status_label").text("Save file");

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "developer_write_file",
                    file: new URLSearchParams(location.search).get("file"),
                    content: btoa(editor.getValue()),
                },
                dataType: "json",
                success: function (response) {
                    if (response.status == false) {
                        $("#developer_status_label").text("Write error");
                    } else {
                        $("#developer_status_label").text("");
                    }
                },
                error: function () {
                    $.dialog({
                        title: "Error receiving file",
                        content: `Your server is not responding, or you have disabled developer methods`,
                        buttons: [{ type: "confirm" }],
                        escCall: "",
                        enterCall: "",
                        onConfirm: function () {},
                    }).open();
                },
            });
        }

        window.editor = CodeMirror(iterator, {
            value: "<?php",
            lineNumbers: true,
            startOpen: true,
            styleActiveLine: true,
            matchBrackets: true,
            autoCloseTags: true,
            mode: "application/x-httpd-php",
            theme: "monokai",
            lineWiseCopyCut: true,
            lineWrapping: true,
            undoDepth: 200,
            tabMode: "shift",
            enterMode: "keep",
            tabSize: 4,
            htmlMode: true,
            extraKeys: {
                F11: function (cm) {
                    cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                },
                Esc: function (cm) {
                    if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                },
                "Ctrl-S": function (cm) {
                    developer_save();

                    event.preventDefault();
                    return false;
                },
                "Ctrl-1": function (cm) {
                    cm.setValue(get_php_template());
                },
                "Ctrl-2": function (cm) {
                    var doc = cm.getDoc();
                    var cursor = doc.getCursor();
                    doc.replaceRange(get_php_rra(), cursor);
                },
                "Ctrl-3": function (cm) {
                    var doc = cm.getDoc();
                    var cursor = doc.getCursor();
                    doc.replaceRange(get_php_options(), cursor);
                },
                "Ctrl-Space": "autocomplete",
                "Alt-F": "findPersistent",
            },
        });

        if (
            new URLSearchParams(location.search).get("file") &&
            new URLSearchParams(location.search).get("page")
        ) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "developer_get_file",
                    file: new URLSearchParams(location.search).get("file"),
                },
                dataType: "json",
                success: function (response) {
                    if (response.content_base64) {
                        if ("editor" in window) {
                            editor.setValue(
                                atob(response.content_base64).split("    ").join("\t")
                            );
                        }
                    } else {
                        editor.setValue(
                            get_php_template(new URLSearchParams(location.search).get("file"))
                        );
                    }
                },
                error: function () {
                    $.dialog({
                        title: "Error receiving file",
                        content: `Your server is not responding, or you have disabled developer methods`,
                        buttons: [{ type: "confirm" }],
                        escCall: "",
                        enterCall: "",
                        onConfirm: function () {},
                    }).open();
                },
            });
        }

        $("#wpcontent").css({
            marginLeft: "140px",
        });

        editor.on("change", function () {
            const code = editor.getValue();

            const execute_time_rre = 0.00001001358;
            const execute_time_rr = 0.00000500679;

            const calculate_time_rre = execute_time_rre * code.split("rre").length;
            const calculate_time_rosemary_register_element =
                execute_time_rre * code.split("rosemary_register_element").length;
            const calculate_time_rosemary_register =
                execute_time_rr * code.split("rosemary_register").length;

            const time =
                calculate_time_rre +
                calculate_time_rosemary_register_element +
                calculate_time_rosemary_register;

            $("#developer_execute_time_rf").text(time);
        });

        jQuery(document).keydown(function (event) {
            if ((event.ctrlKey || event.metaKey) && event.which == 83) {
                event.preventDefault();
                return false;
            }
        });
    }

    /**
     * Function to insert a template into
     * code editing area
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="develop_paste_template"]')) {
        $(iterator).click(function () {
            if ("editor" in window) {
                editor.setValue(get_php_template());
            }
        });
    }

    /**
     * Function to save data
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="develop_save"]')) {
        $(iterator).click(function () {
            if ("editor" in window) {
                developer_save();
            }
        });
    }

    /**
     * Function from open the editor to full screen
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="develop_full_screen"]')) {
        $(iterator).click(function () {
            if ("editor" in window) {
                if ($(".developer-body").css("position") == "fixed") {
                    $(".developer-body").css({
                        display: "",
                        position: "",
                        top: "",
                        left: "",
                        zIndex: 0,
                        height: "",
                        width: "",
                    });

                    $(".developer-code-menu").show();

                    $(".developer-code-editor").css({
                        width: "",
                    });
                } else {
                    $(".developer-body").css({
                        display: "block",
                        position: "fixed",
                        top: "0px",
                        left: "0px",
                        zIndex: 10 ** 8,
                        height: "100vh",
                        width: "100vw",
                    });

                    $(".developer-code-menu").hide();

                    $(".developer-code-editor").animate({
                        width: "100%",
                    });
                }
            }
        });
    }

    /**
     * Function for creating
     * new block based on received
     * from user information
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="develop_create_block"]')) {
        $(iterator).click(function () {
            $.prompt("Enter you new block name", function (event) {
                location.href = location.href + "&file=" + event;
            });
        });
    }

    /**
     * Function for getting feedback from the console
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="develop_ticket"]')) {
        $(iterator).click(function () {
            $.dialog({
                title: "FeedBack",
                content: `<script src="https://desk.zoho.com/portal/api/feedbackwidget/493135000000233734?orgId=713883891&displayType=iframe"></script> <iframe id="zsfeedbackFrame" width="890" height="570" name="zsfeedbackFrame" scrolling="no" allowtransparency="false" frameborder="0" border="0" src="https://desk.zoho.com/support/fbw?formType=AdvancedWebForm&fbwId=730563f199aeadd3c5cbbf1f346e50319b00078ee9385e28&xnQsjsdp=3UBg8*SZNKqAwNkNXxZfuw$$&mode=showNewWidget&displayType=iframe"></iframe>`,
                // buttons: [
                //     { type: 'confirm' }
                // ],
                width: 610,
                height: 610,
                escCall: "",
                enterCall: "",
                onConfirm: function () {
                    localStorage.developer_start_message = true;
                },
            }).open();
        });
    }

    /**
     * Registration of functions for editing
     * lists
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */

    for (const iterator of $('[data-action="list"]')) {
        $(iterator).click(function (event) {
            var items = $(`input[name="${$(iterator).attr("for_name")}"]`)
                .val()
                .split("|");
            var html = $("<div>");
            var div = $("<div>", {
                id: "box-inputs-list",
            }).appendTo(html);

            for (const iterator of items) {
                $("<input>", {
                    type: "text",
                    value: iterator,
                    placeholder: iterator,
                    maxlength: 64,
                    autofocus: true,
                    css: {
                        width: "-webkit-fill-available",
                        margin: "12px 4px",
                        background: "white",
                    },
                }).appendTo(div);
            }

            $.dialog({
                title: "List editor",
                content: $(html).html(),
                width: 800,
                buttons: [{ type: "confirm" }],
                escCall: "",
                enterCall: "",
                onConfirm: function () {
                    for (const iterator of $("#box-inputs-list > input")) {
                        $("#box-inputs-list > input").val();
                    }

                    $(`input[name="${$(iterator).attr("for_name")}"]`).val(
                        editor.getData()
                    );
                    console.log(editor.getData());
                },
            }).open();
        });
    }

    /**
     * Function for registering a collapse and expand event
     * table blocks.
     *
     * @version: 1.0.0
     * @package: Mirele and Rosemary
     */


    $('[data-action="table_for_block"] > thead').dblclick(function () {
        sessionStorage.setItem(
            `rosemary_visible_page:${new URLSearchParams(location.search).get(
                "page_id"
            )}_${$($(this).parent()).attr("block")}`,
            $($($($(this).parent()).children("tbody")).toggle()).is(":visible")
        );
    });

    $(document.body).on("form-ajax-load", function(e=null) {
        for (const iterator of $('[data-action="rosemary_install_market"]')) {
            $(iterator).click(function () {

                window.iterator = $(iterator);

                rosemary_install ($(iterator).attr('data-url'), function (e) {
                    $($(window.iterator).parent()).html('<button type="button" class="button button-disabled" disabled="disabled">Installed</button>');
                }, function () {
                    $($(window.iterator).parent()).html('<a class="install-now button updating-message">Installing...</a>');
                }, function () {
                    $($(window.iterator).parent()).html('<a class="install-now button updating-message">Installing...</a>');
                });


            });
        }
    });

    (function () {
        for (const iterator of $('[data-action="table_for_block"]')) {
            if (
                sessionStorage.getItem(
                    `rosemary_visible_page:${new URLSearchParams(location.search).get(
                        "page_id"
                    )}_${$(iterator).attr("block")}`
                ) == "false"
            ) {
                $($(iterator).children("tbody")).hide();
            }
        }
    })();
});