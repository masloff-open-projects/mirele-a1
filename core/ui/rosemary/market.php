<?php

/**
 * Block manager page render function.
 * In case of successful sales of Mirele, this page
 * will be supplemented by a marketplace
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

add_action ('rosemary_render_market', function () {

    ?>

    <div class="root">
        <div class="wrap">

            <nav class="nav-tab-wrapper woo-nav-tab-wrapper">

                <a href="<?php echo $_SERVER['REQUEST_URI'] . "&tab" ?>" class="nav-tab <?php echo $_GET['tab'] == '' ? 'nav-tab-active' : '' ?>">Manager</a>
                <a href="<?php echo $_SERVER['REQUEST_URI'] . "&tab=install" ?>" class="nav-tab <?php echo $_GET['tab'] == 'install' ? 'nav-tab-active' : '' ?>">Market</a>

            </nav>

            <?php

            if ($_GET['tab'] == 'install') {
                do_action('mirele_ui_market_install');
            } else {
                do_action('mirele_ui_market_manager');
            }

            ?>

        </div>
    </div>

    <?php

});