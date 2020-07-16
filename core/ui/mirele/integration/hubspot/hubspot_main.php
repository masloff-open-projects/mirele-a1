<?php

/**
 * HubSpot main page
 *
 * @version: 1.0.0
 * @author: Mirele
 */

add_action ('ui_mirele_integration_hubspot', function () {

    $owners = MIHubSpot::owners(get_option('mrltkn_hs', false));

    ?>

    <div class="wrap">

        <div class="wp-mrl-column-1">

            <hr class="wp-header-end">

            <div class="root wp-theme-section">
                <div class="wrap wp-header-block">
                    <h3> <?php echo $owners[0]->lastName ?> </h3>
                    <p> <?php echo $owners[0]->email ?> </p>
                    <small> <?php echo $owners[0]->isActive ? 'Active' : 'Deactivated' ?> </small>
                </div>
            </div>

            <br>

            <?php if (get_option('mrli_hs_ajax_table', false)): ?>

                <div data-mpager-part="mui_hubspot_contacts">

                </div>

                <div data-mpager-part="mui_hubspot_forms">

                </div>

                <div data-mpager-part="mui_hubspot_tickets">

                </div>

            <?php else: ?>

                <div class="root">

                    <h3>Contacts list</h3>

                    <table class="wp-list-table widefat fixed striped posts">
                        <thead>
                        <tr>
                            <th>VID</th>
                            <th>Added at</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Is Contact</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach (MIHubSpot::contacts(get_option('mrltkn_hs', false), 10)->contacts as $list): ?>
                            <tr>
                                <th><b> <?php echo $list->vid; ?> </b></th>
                                <th> <?php echo date("Y/m/d H:i:s", $list->properties->lastmodifieddate->value / 1000); ?> </th>
                                <th> <?php echo isset($list->properties->lastname->value) ? $list->properties->lastname->value : 'None'; ?> </th>
                                <th> <?php echo isset($list->properties->firstname->value) ? $list->properties->firstname->value : 'None'; ?> </th>
                                <th> <?php echo ((array)$list)['is-contact'] == 1 ? 'Yes' : 'No' ?> </th>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

                <div class="root">

                    <h3>Forms</h3>

                    <table class="wp-list-table widefat fixed striped posts">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Form Type</th>
                            <th>The form is published</th>
                            <th>Version</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach (MIHubSpot::forms(get_option('mrltkn_hs', false), 10) as $list): ?>
                            <tr>
                                <th><b> <?php echo $list->guid; ?> </b></th>
                                <th> <?php echo $list->name; ?> </th>
                                <th> <?php echo $list->formType; ?> </th>
                                <th> <?php echo $list->isPublished == 1 ? 'Yes' : 'No'; ?> </th>
                                <th> <?php echo $list->editVersion; ?> </th>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

                <div class="root">

                    <h3>Tickets</h3>

                    <table class="wp-list-table widefat fixed striped posts">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Created At</th>
                            <th>Title</th>
                            <th>Content</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach (MIHubSpot::tickets(get_option('mrltkn_hs', false))->objects as $list): ?>
                            <tr>
                                <th><b> <?php echo $list->objectId; ?> </b></th>
                                <th> <?php echo date("Y/m/d H:i:s", $list->properties->subject->timestamp / 1000); ?> </th>
                                <th> <?php echo isset($list->properties->subject->value) ? mb_strimwidth($list->properties->subject->value, 0, 128, "...") : 'None'; ?> </th>
                                <th> <?php echo isset($list->properties->content->value) ? mb_strimwidth($list->properties->content->value, 0, 128, "...") : 'None'; ?> </th>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

            <?php endif; ?>


            <hr>

            <div>
                <form action="" method="post">
                    <input type="submit" value="Log out of this account" class="button" name="action">
                </form>
            </div>

        </div>

        <div class="wp-mrl-column-2">

            <div class="wp-mrl-box">
                <div class="inner">

                    <h2>Welcome to HubSpot!</h2>

                    <p>You are in the administrative integration control panel.</p>
                    <p>Here you can configure the application and get the necessary statistics.</p>
                    <p>Integration manuals you can find in the knowledge base</p>

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
                    Thanks for choosing Mirele's HubSpot solution.
                </div>
            </div>

        </div>


    </div>

    <?php

});