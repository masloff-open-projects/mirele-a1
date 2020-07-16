<?php

add_action ('mirele_ui_market_manager', function ($e=null) {

    ?>

    <div class="wrap">

        <div class="root">

            <?php

                initialize_templates(true);
                
                $speed = microtime(true);

            ?>

            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Color</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach (rosemary_get_available_blocks()->blocks_meta as $index => $block): ?>
                    <tr>
                        <th>
                            <b> <?php echo $block->title; ?> </b>
                            <p class="row-actions">

                                <span class="view">
                                    <a href="javascript:;" data-action="setup_block_on_page" block_index="<?php echo $index; ?>">Add to Page</a>
                                </span>

                                <span class="view">
                                    | <a href="javascript:;" data-action="get_block_meta_info" block_index="<?php echo $index; ?>">Details</a>
                                </span>

                            </p>
                        </th>
                        <th> <?php echo $block->description; ?> </th>
                        <th> <?php echo $block->author; ?> </th>
                        <th>
                            <div style="color: <?php echo $block->unique_color; ?>; background-color: <?php echo $block->unique_color; ?>">COLOR</div>
                        </th>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

            <div>
                <hr>
                <p>
                    <?php echo count(rosemary_get_available_blocks()->blocks_meta); ?> results in <b><?php echo number_format(microtime(true) - $speed, 6); ?></b> seconds
                </p>
            </div>

        </div>

    </div>

    <?php

});