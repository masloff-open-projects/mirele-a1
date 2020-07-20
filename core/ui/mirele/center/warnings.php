<?php

/**
 * Page with warnings
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action('ui_mirele_center_warnings', function () {

    if (empty(get_bloginfo('description'))) {

        ?>
        <div class="notice notice-warning">
            <p><b>SEO</b> Your site does not contain a description. This will negatively affect the position of your site in search engines.</p>
        </div>
        <?php

    }

    if (wp_get_nav_menu_object(get_nav_menu_locations()['header'])->count > 8) {

        ?>
        <div class="notice notice-warning">
            <p><b>Appearance</b> In the header of the site you use <?php echo wp_get_nav_menu_object(get_nav_menu_locations()['header'])->count?> elements, which may look bad on different screen resolutions. We do not recommend using more than 8 menu items.</p>
        </div>
        <?php

    }

});