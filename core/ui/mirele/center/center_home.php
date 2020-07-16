<?php

/**
 * Home page
 *
 * @version: 1.0.0
 * @author: Mirele
 */


add_action('ui_mirele_center_home_page', function () {

    require ABSPATH . WPINC . '/version.php';

    ?>

    <div class="wrap wp-wrap-tabs">

        <?php

        /**
         * Getting meta information from the repository to
         * check for updates, find out news, etc.
         *
         * @version 1.0.0
         */

        $version = new MRepository;

        if (isset($version->version()->version)) {

            if ($version->version()->version != MIRELE_VERSION) {
                ?>
                <div class="notice notice-success">
                    <p>New version of Mirele -
                        <b><?php echo $version->version()->version; ?></b>! <?php echo $version->version()->description; ?>
                        <a href="javascript:" data-action="re-specify_update_email">I want to re-specify email to
                            receive updates</a></p>
                </div>
                <?php
            }

        }

        ?>

        <div class="wp-mrl-column-1">

            <hr class="wp-header-end">

            <?php echo do_action('ui_mirele_center_warnings');?>

            <div class="postbox">
                <div class="root">
                    <div class="wp-header-block">

                        <table height="20px">
                            <tr>
                                <td>
                                    <img src="<?php echo get_avatar_url(wp_get_current_user()->user_email)?>" class="wp-user-avatar">
                                </td>
                                <td>
                                    <div class="wp-header-block">
                                        <h3> <?php echo wp_get_current_user()->display_name?> </h3>
                                        <p> <?php echo wp_get_current_user()->user_email?> </p>
                                        <small> ... </small>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

            <div class="root">

                <div class="card-center-box">
                    <div>
                        <h1>01 items</h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, corporis dolore id iste itaque, officiis provident quaerat quasi quis quod repudiandae sequi soluta vel? Aliquam consequatur ea quae repellendus tenetur?</p>
                </div>

                <div class="card-center-box">
                    <div>
                        <h1>01 items</h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, corporis dolore id iste itaque, officiis provident quaerat quasi quis quod repudiandae sequi soluta vel? Aliquam consequatur ea quae repellendus tenetur?</p>
                </div>

                <div class="card-center-box">
                    <div>
                        <h1>01 items</h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, corporis dolore id iste itaque, officiis provident quaerat quasi quis quod repudiandae sequi soluta vel? Aliquam consequatur ea quae repellendus tenetur?</p>
                </div>

                <div class="card-center-box">
                    <div>
                        <h1>01 items</h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, corporis dolore id iste itaque, officiis provident quaerat quasi quis quod repudiandae sequi soluta vel? Aliquam consequatur ea quae repellendus tenetur?</p>
                </div>


            </div>

            <div class="root">

                <table class="wp-list-table widefat fixed striped posts">
                    <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <th> Mirele version</th>
                        <th> <?php echo MIRELE_VERSION ?> </th>
                    </tr>

                    <tr>
                        <th> Rosemary version</th>
                        <th> <?php echo ROSEMARY_VERSION ?> </th>
                    </tr>

                    <tr>
                        <th> You are a Rosemary developer</th>
                        <th> <?php echo ROSEMARY_DEVELOPER_MODE ? 'Yes' : 'No' ?> </th>
                    </tr>

                    <tr>
                        <th> WordPress version</th>
                        <th> <?php echo $wp_version ?> </th>
                    </tr>

                    <tr>
                        <th> PHP version</th>
                        <th> <?php echo phpversion() ?> </th>
                    </tr>

                    <tr>
                        <th> Linked to the repository</th>
                        <th> <?php echo ROSEMARY_GIT; ?> </th>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>

        <div class="wp-mrl-column-2">

            <div class="wp-mrl-box">
                <div class="inner">

                    <h2>Welcome!</h2>
                    <p>All template settings are located in this center</p>
                    <p>On this tab you can read the latest news from the author.</p>

                    <h3>Resources</h3>
                    <ul>
                        <li>
                            <a href="https://irtex-web.github.io" target="_blank">
                                <i aria-hidden="true" class="dashicons dashicons-external"></i> Documentation
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="footer">
                    Thank you for your creativity with Mirele!
                </div>
            </div>

        </div>

    </div>

    <?php

});
