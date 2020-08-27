<?php

add_action ('mirele_ui_market_manager_repository_manager', function ($e=null) {

    ?>

    <div class="wrap">

        <div class="root">

            <h3>Manage you gits</h3>
            <p>
                You can add your own Git repositories to search them. Please note that only public repositories are supported. <br>
                It is also worth paying attention to the fact that you will not receive component updates from these repositories, <br>
                you will not receive news, system updates for security purposes
            </p>

            <br>

            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                <tr>
                    <th>Parameter</th>
                    <th width="80px">Action</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <th> <?php echo ROSEMARY_GIT; ?> </th>
                    <th>

                    </th>
                </tr>

                <?php foreach (get_option('rosemary_gits', []) as $git): ?>

                    <tr>
                        <th> <?php echo $git; ?> </th>
                        <th>

                            <form method="post">
                                <button type="submit" class="button-primary" name="action" value="remove:<?php echo $git; ?>"> Remove </button>
                            </form>

                        </th>
                    </tr>

                <?php endforeach; ?>

                </tbody>

                <tfoot>
                <tr>
                    <th colspan="2" style="text-align: right;">
                        <div>
                            <form method="post" style="margin: 0px">
                                <input type="text" name="git" placeholder="URL to git (https://github.com/irtex-web/mirele.git)" style="width: 40%">
                                <input type="submit" class="button-primary" value="Add Now">
                            </form>
                        </div>
                    </th>
                </tr>
                </tfoot>

            </table>

        </div>
    </div>

    <?php

});
