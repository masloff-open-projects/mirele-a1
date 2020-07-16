<?php
add_action ('mirele_ui_market_template_package', function ($package=null) {

    ?>
    <div class="plugin-card">
        <div class="plugin-card-top">
            <div class="name column-name">
                <h3>
                    <span class="thickbox">
                    <?php echo !empty($package->title) ? $package->title : 'Unknown' ?>
                    <img src="<?php echo !empty($package->picture) ? $package->picture : 'Unknown' ?>" class="plugin-icon icon-for-search-block-repo" loading="lazy">
                    </span>
                </h3>
            </div>
            <div class="action-links">
                <ul class="plugin-action-buttons">
                    <li>
                        <?php if (!$package->installed): ?>
                            <a class="install-now button aria-button-if-js" href="javascript:;" role="button" data-action="rosemary_install_market" data-url="<?php echo $package->source ?>">Install</a>
                        <?php else: ?>
                            <button type="button" class="button button-disabled" disabled="disabled">Active</button>
                        <?php endif; ?>
                    </li>

                    <li>
<!--                        <a href="#" class="open-plugin-details-modal">More Details</a>-->
                    </li>

                </ul>
            </div>
            <div class="desc column-description">
                <p><?php echo $package->description ?></p>
                <p class="authors">
                    <cite>By
                        <span>
                            <a href="<?php echo $_SERVER['REQUEST_URI'] . "&tab=install&tab_&s=" . $package->author; ?>"><?php echo $package->author ?></a>
                        </span>
                    </cite>
                </p>
            </div>
        </div>
        <div class="plugin-card-bottom">
            <div class="column-updated">
                <strong>Version</strong>
                <?php echo $package->version ?>
            </div>
        </div>
    </div>
    <?php
});