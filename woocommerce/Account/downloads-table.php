<?php
/**
 * Downlaods table for account page
 * 
 * @package: Mirele
 * @author: iRTEX
 * @version: 1.0.0 
 */

defined('ABSPATH') || exit;

function woocommerce_account_mirele_table_downloads_render () {

    $woo = woo();
    $downloads = WC()->customer->get_downloadable_products();

    ?>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Product</th>
                <th>File</th>
                <th>Remaining</th>
                <th>Access Expires</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ( $downloads as $download ) {

                do_action( 'woocommerce_available_download_start', $download );

                ?> 
                <tr>
                    <td> <?php echo $download['product_name'] ?> </td>
                    <td> <?php echo $download['download_name'] ? $download['download_name'] : 'Unknown' ?> </td>
                    <td> <?php echo is_numeric($download['downloads_remaining']) ? apply_filters( 'woocommerce_available_download_count', $download['downloads_remaining']) : 'Not limit' ?> </td>
                    <td> <?php echo $download['access_expires'] ? date("d.m.y", strtotime($download['access_expires'])) : 'Not limit' ?> </td>
                    <td> 
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle el_2729771096" type="button" id="woo-dropdown-manager-order" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Download Management
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu woo-dropdown-menu" aria-labelledby="woo-dropdown-manager-order">
                                <li>
                                    <a href="<?php echo $download['download_url'] ?>">Download</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php

                do_action( 'woocommerce_available_download_end', $download );
            }
			?>
        </tbody>
    </table>
    <?php
}