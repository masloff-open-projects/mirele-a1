<?php

/**
 * Backup page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_backup_main', function () {

    ?>

    <div class="wrap">
        <div class="root">

            <h3>Manage your backups</h3>

            <p>Mirele makes a copy of the entire template every <u><?php echo secondsToTime(MBackup::getFrequency()); ?></u>. </p>
            <p>Back-up system skips files whose size exceeds <u><?php echo formatSizeUnits(MBackup::getMaxSize()); ?></u>. </p>

            <?php if (MBackup::getPassword() != false): ?>
                <p>There is no password on your archives</p>
            <?php else: ?>
                <p>The backup password may contain the following password: <b><?php echo MBackup::getPassword(); ?></b>. </p>
            <?php endif; ?>

            <hr>

            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Size</th>
                    <th>Filename</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach (MBackup::all() as $file): ?>

                    <?php if (strpos($file, '.zip') !== false): $info = MBackup::info($file); ?>

                        <tr>

                            <th> <?php echo str_replace('.zip', '', $file); ?> </th>
                            <th> <?php echo time_elapsed_string(date('Y-m-d H:i:s', $info->stat['ctime'])); ?> </th>
                            <th> <?php echo formatSizeUnits($info->stat['size']); ?> </th>
                            <th> <?php echo $file; ?> </th>

                            <th>
                                <form action="" method="post">
                                    <input type="hidden" name="passwd" value="<?php echo MBackup::getPassword(); ?>">
                                    <button type="submit" class="button" value="<?php echo $file; ?>" name="expand"> Expand backup </button>
                                </form>
                            </th>

                        </tr>

                    <?php endif; ?>

                <?php endforeach; ?>

                </tbody>
            </table>

            <hr>

            <div>
                <form action="" method="post" id="backup_now">
                    <input type="submit" value="Create Backup now" class="button" name="action">
                </form>
            </div>

        </div>
    </div>

    <?php

});