<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/notices/notice.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.9.0
 */

# Compatibility check
defined( 'ABSPATH' ) or exit;
(isset($notices) and $notices) or exit;

# Output of notifications
foreach ($notices as $notice) {

    # Call the notification component
    \Mirele\Compound\Market::call('default_notice', [
        'notice' => $notice,
        'text' => $notice['notice'],
        'type' => 'primary',
        'attributes' => wc_get_notice_data_attr($notice)
    ]);

}
