<?php

/**
 * Upgrade page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action('ui_mirele_upgrade', function() {

    ?>

    <div class="wrap">
        <div class="root">

            <h3>Manage of updates</h3>

            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                <tr>
                    <th>Component</th>
                    <th>Current version</th>
                    <th>New version</th>
                </tr>
                </thead>
                <tbody>

                <?php $u = 0; foreach (MRepository::components_versions() as $package => $component): ?>

                    <?php if ($component->version > MVersion::get_version($package)): $u++; ?>

                        <tr>

                            <th> <a href="https://desk.zoho.com/portal/irtex/kb/search/class <?php echo $package ?>" target="_blank"> <?php echo $package ?> </a> </th>
                            <th> <?php echo MVersion::get_version($package) ?> </th>
                            <th> <?php echo $component->version ?> </th>

                        </tr>

                    <?php endif; ?>

                <?php endforeach; ?>

                </tbody>
            </table>

            <?php if ($u > 0): ?>

                <hr>

                <div>
                    <form action="" method="post" id="upgrade">
                        <input type="submit" value="Upgrade now" class="button" name="action">
                    </form>
                </div>

            <?php else: ?>

                <br>

                <h4>There are no updates for your system!</h4>
                <p>You are completely updated</p>

            <?php endif; ?>

        </div>
    </div>

    <?php

});