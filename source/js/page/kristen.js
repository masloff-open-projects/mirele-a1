
/**
 * A bit of lyrics. I think the gallery should be in the form of a plugin,
 * but since integrating all JS scripts into Mirele is easier,
 * now you can observe many fragments scattered throughout the script
 * from gallery plugin
 *
 * @param { DOM Element } element
 * @param { {left, center, right} } grid
 *
 * @version 1.0.0
 */

if (typeof jQuery == 'function' && jQuery.fn.jquery) {

    function kristen_gallery(element, grid) {

        try {

            grid.prop;

            if (!!document.querySelector(element)) {

                // Left position gallery
                if (grid.hasOwnProperty('left')) {
                    let div = document.createElement('div');
                    div.className = "col-xs-12 col-sm-12 col-md-4 col-lg-4";

                    grid.left.forEach(element => {
                        let image = document.createElement('img');
                        image.src = element;
                        image.alt = "";
                        image.className = "gallery-picture";
                        image.setAttribute('can_open_full_size', true);

                        image.onload = function () {
                            div.append(image);
                        }

                        image.onclick = function () {
                            karlin('body').lightboximage(element);
                        }

                    });

                    document.querySelector(element).append(div);
                }

                // Center position gallery
                if (grid.hasOwnProperty('center')) {
                    let div = document.createElement('div');
                    div.className = "col-xs-12 col-sm-6 col-md-4 col-lg-4";

                    grid.center.forEach(element => {
                        let image = document.createElement('img');
                        image.src = element;
                        image.alt = "";
                        image.className = "gallery-picture";

                        image.onload = function () {
                            div.append(image);
                        }

                        image.onclick = function () {
                            karlin('body').lightboximage(element);
                        }

                    });

                    document.querySelector(element).append(div);
                }

                // Right position gallery
                if (grid.hasOwnProperty('right')) {
                    let div = document.createElement('div');
                    div.className = "col-xs-12 col-sm-6 col-md-4 col-lg-4";

                    grid.right.forEach(element => {
                        let image = document.createElement('img');
                        image.src = element;
                        image.alt = "";
                        image.className = "gallery-picture";

                        image.onload = function () {
                            div.append(image);
                        }

                        image.onclick = function () {
                            karlin('body').lightboximage(element);
                        }

                    });

                    document.querySelector(element).append(div);
                }

            }

        } catch (error) {
            console.error(`gallery var grid is not object (${error})`);
        }

    }

    /**
     * Gallery render feature on request
     *
     * @version 1.0.0
     */

    function kristen_gallery_render(element = "#content-gallery") {
        $.ajax({
            type: "POST",
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: 'kristen_get'
            },
            dataType: "json",
            success: function (response) {
                kristen_gallery(element, {
                    left: response.gallery[1],
                    center: response.gallery[2],
                    right: response.gallery[3]
                });
            }
        });
    }

    $(document).ready(function () {

        /**
         * Gallery render attempt
         *
         * @version 1.0.0
         */

        if ($(`#content-gallery`).length !== 0) {
            kristen_gallery_render();
        }

    })

}