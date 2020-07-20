<?php

add_action('rosemary_render_editor_blocks', function ($id) {

    global $rm;

    // Registration of components for markup from in the editor
    initialize_templates(true);
    rosemary_page($id, 'depressed');

    do_action('rosemary_render_editor_page_start');

    ?>

        <div class="wrap">

            <div class="root">

                <h1 class="wp-heading-inline">Blocks</h1>

                <a href="javascript:;" class="page-title-action" data-action="create_block">Create block</a>
                <a href="javascript:;" class="page-title-action" data-action="export_blocks">Export</a>
                <a href="javascript:;" class="page-title-action" data-action="import_blocks">Import</a>

                <hr class="wp-header-end">

                <div class="wp-mrl-column-1">
                    <div class="root-blocks">

                        <?php if (count($rm->get_page($id) ) > 0): ?>

                            <?php foreach ($rm->get_page($id) as $page => $body): ?>
                                <table class="wp-list-table widefat fixed striped posts table-block wp-rosemary-table" data-action="table_for_block" block="<?php echo $body['block']['id']; ?>" block-name="<?php echo explode("@", $body['block']['id'])[0]; ?>">
                                    <form method="POST" data-action="edit_block">
                                        <thead>

                                        <tr>
                                            <th width="160px"> <b> <?php echo str_ireplace('_', ' ', ucfirst(explode("@", $body['block']['id'])[0])) ?> </b>

                                                <?php if(!empty($body['block']['options'])): ?>

                                                    -
                                                    <a href="javascript:;" data-action="edit_block_options" block="<?php echo $body['block']['id']; ?>">
                                                        edit
                                                    </a>

                                                <?php endif; ?>

                                            </th>
                                            <th>Value</th>
                                            <th width="140px">Action</th>
                                            <th width="140px">Visible</th>
                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php foreach ($body['elements'] as $element): ?>

                                            <tr>

                                                <th class="id-element-rosemary-block">

                                                    <?php $id = explode(':', $element->element_id); echo '<i>' . str_ireplace('_', ' ', ucfirst($id[2])) . '</i>'; ?>

                                                    <p class="row-actions">

                                                                <span class="view">
                                                                    <?php if (!empty(@get_object_vars(@json_decode($element->element_options)))): ?>
                                                                        <a href="javascript:;" data-action="edit_element_options" page="<?php echo $body['page']['id']; ?>" element_id="<?php echo $element->element_id; ?>">Edit options</a>
                                                                    <?php endif; ?>
                                                                </span>

                                                    </p>

                                                </th>

                                                <th class="blocks-input">

                                                    <?php if ( strtolower($element->element_type) == 'src' ): ?>

                                                        <input type="text" name="<?php echo $element->element_id; ?>/value"  value="<?php echo $element->element_value; ?>" readonly class="wp-rosemary-any-input">

                                                    <?php elseif ( strtolower($element->element_type) == 'int' ): ?>

                                                        <input type="number" name="<?php echo $element->element_id; ?>/value"  value="<?php echo $element->element_value; ?>" class="wp-rosemary-any-input">

                                                    <?php else: ?>

                                                        <input type="text" name="<?php echo $element->element_id; ?>/value"  value="<?php echo $element->element_value; ?>" class="wp-rosemary-any-input">

                                                    <?php endif; ?>

                                                </th>

                                                <th class="wp-rosemary-table-actions">

                                                    <?php if ( strtolower($element->element_type) == 'src' ): ?>

                                                        <a class="button button-primary" href="javascript:;" data-action="media" for_name="<?php echo $element->element_id; ?>/value">Select Media</a>

                                                    <?php else: ?>

                                                        <a href="javascript:;" class="button-primary" data-action="html_edit" for_name="<?php echo $element->element_id; ?>/value">HTML</a>
                                                        <a href="javascript:;" class="button-primary" data-action="pretty_text" for_name="<?php echo $element->element_id; ?>/value">Pretty</a>

                                                    <?php endif; ?>

                                                </th>

                                                <th>
                                                    <label>
                                                        <input type="checkbox" value="1" name="<?php echo $element->element_id; ?>/visible" <?php echo $element->element_visible ? 'checked' : ''; ?> > Show element
                                                    </label>
                                                </th>

                                            </tr>

                                        <?php endforeach; ?>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="4">
                                                <div class="table-block-manage">
                                                    <div>
                                                        <input type="hidden" value="editor_save_block" name="action">
                                                        <a class="button-secondary" href="javascript:;" data-action="remove_block" block="<?php echo $body['block']['id']; ?>">Remove block</a>
                                                        <input type="submit" value="Save block" class="button button-primary" style="float: right;">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </form>
                                </table>
                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="wrap">
                                <div class="root menu-center">

                                    <img src="<?php echo PATH_CREATE_BLOCK_IMG; ?>" alt="" width="256px">
                                    <h3>Create a block to start editing the page</h3>
                                    <p></p>

                                </div>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="add_block_button" data-action="create_block">
                        Create new block
                    </div>

                </div>

                <div class="wp-mrl-column-2">

                    <div class="wp-mrl-box">
                        <h2 class="wp-mrl-header">
                            <span>Rosemary page</span>
                        </h2>

                        <div class="inner">

                            <h2>Blocks. More blocks</h2>
                            <p>This page has all the magic of editing Rosemary pages.</p>
                            <p>You can change feature options, block options, change block positions, change the contents of elements, etc.</p>

                            <h3>Actions</h3>
                            <ul>
                                <li>
                                    <a href="javascript:;" data-action="import_blocks">
                                        <i class="dashicons dashicons-admin-customizer"></i> Import
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="export_blocks">
                                        <i class="dashicons dashicons-sticky"></i> Export
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo get_admin_url( null, 'edit-tags.php?taxonomy=category', 'https' );?>">
                                        <i class="dashicons dashicons-archive"></i> Market
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

    do_action('rosemary_render_editor_page_end');

});