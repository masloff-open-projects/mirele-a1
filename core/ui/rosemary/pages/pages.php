<?php

add_action('rosemary_render_editor_pages', function () {

    global $rm;

    $args['meta_key'] = '_wp_page_template';
    $args['meta_value'] = ROSEMARY_CANVAS;
    $pages = get_pages($args);

    do_action('rosemary_render_pages_list_start');

    ?>

    <div class="wrap">

        <h1 class="wp-heading-inline">Pages</h1>
        <a href="javascript:;" class="page-title-action" data-action="create_page">Add New</a>

        <hr class="wp-header-end">

        <div class="root">

            <div class="wp-mrl-column-1">

                <?php if (count($rm->markup()) > 0): ?>

                    <table class="wp-list-table widefat fixed striped posts">
                        <thead>
                            <tr>
                                <th>Page ID</th>
                                <th>Name</th>
                                <th>Blocks count</th>
                                <th>Used as</th>
                                <th>Shortcode</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($rm->markup() as $page => $body): ?>
                            <tr>
                                <th>
                                    <b> <?php echo ucfirst($page); ?> </b>
                                    <p class="row-actions">

                                        <span class="view">
                                            <a href="<?php echo admin_url(sprintf('admin.php?page=rosemary_render_editor&page_id=%s', $body['page']['id'])) ?>">Edit page</a>
                                        </span>

                                        <span class="view">
                                            | <a href="javascript:;" data-action="create_wordpress_page" page="<?php echo $body['page']['id']; ?>">Create WordPress Page</a>
                                        </span>

                                        <span class="trash">
                                            | <a href="javascript:;" data-action="remove_page" page="<?php echo $body['page']['id']; ?>">Remove page</a>
                                        </span>

                                    </p>
                                </th>
                                <th> <?php echo $body['page']['id']; ?> </th>
                                <th> <?php echo count($body) - 1; ?> </th>
                                <th> <?php foreach ($pages as $key => $value): ?>
                                        <?php if ((strpos($value->post_content, "[rosemary page=\"" . $body['page']['id'] . "\"]") !== false) || (strpos($value->post_content, "[rosemary page='" . $body['page']['id'] . "']") !== false)): ?>
                                            <span>
                                            <?php echo $value->post_title; ?>
                                                <?php if (get_option('page_on_front') == $value->ID): ?>
                                                    (<b>Home page</b>)
                                                <?php endif;?>
                                        </span>
                                        <?php endif; ?>
                                    <?php endforeach; ?> </th>
                                <th> <?php echo sprintf('<code> [rosemary page="%s"] </code>', $body['page']['id']); ?> </th>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                <?php else: ?>

                    <div class="wp-mrl-box">
                        <h2 class="wp-mrl-header">
                            <span>Welcome</span>
                        </h2>

                        <div class="inner">

                            <div class="inner-center-box-margin">
                                <div class="inner-center-box">
                                    <h1>Welcome to Rosemary Block Editor!</h1>
                                    <p>New page editor, new features in template customization. Let's get acquainted!</p>

                                    <img src="<?php echo MIRELE_SOURCE_DIR . '/img/forms/lerning.jpg'; ?>" class="welcome-image">

                                    <div class="align-left card-welcome-box">

                                        <h1 class="title">First start</h1>
                                        <p class="description-box">Congratulations, you have successfully installed Mirele and have already begun to familiarize yourself with the interface! Your steps to success. You are now in the Rosemary Block Editing Page. With it, you will create almost all landing pages on your site.</p>

                                    </div>

                                    <div class="align-left card-welcome-box">

                                        <h1 class="title">First page</h1>
                                        <p class="description-box">To create your first Rosemary page, you can click <a href="javascript:;" data-action="create_page">on me</a>, or find the control panel at the top and find the "Add New" button</p>

                                    </div>

                                    <div class="align-left card-welcome-box">

                                        <h1 class="title">First block</h1>
                                        <p class="description-box">Each page consists of several blocks. Their number is unlimited, you can create 100 blocks and not worry about the speed of the site. Each block is a ready-made element for your page, which you can change as you wish. To create a block, create a page, switch to its editing mode, find the "Create block" button on the toolbar and click on it. A "block collection" will open for you. In the collection, select the block you need and click on the button to add a block to the page. For more information on the block collection, see the
                                            <a href="https://irtex-web.github.io">documentation</a> .</p>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

            <div class="wp-mrl-column-2">

                <div class="wp-mrl-box">
                    <h2 class="wp-mrl-header">
                        <span>Rosemary pages</span>
                    </h2>

                    <div class="inner">

                        <h2>Create new Rosemary page!</h2>
                        <p>Create Mirele Pages, Convert Them to WordPress pages and use them as regular page of your site.</p>
                        <p>Maybe it sounded scary, but working with Rosemary's pages is very easy.</p>

                        <h3>Actions</h3>
                        <ul>
                            <li>
                                <a href="javascript:;" data-action="create_page">
                                    <i class="dashicons dashicons-admin-customizer"></i> Create new page
                                </a>
                            </li>
                        </ul>

                        <h3>Resources</h3>
                        <ul>
                            <li>
                                <a href="https://irtex-web.github.io" target="_blank">
                                    <i aria-hidden="true" class="dashicons dashicons-external"></i> Documentation
                                </a>
                            </li>
                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php

    do_action('rosemary_render_pages_list_end');

});