<?php
namespace Woobooking\Plugin;

class Dependency
{
    public static function check_woocommerce()
    {
        if (! class_exists('WooCommerce')) {
            add_action('admin_notices', [__CLASS__, 'woocommerce_missing_notice']);
            deactivate_plugins(plugin_basename(__FILE__));
        }
    }

    public static function woocommerce_missing_notice()
    {
        echo '<div class="notice notice-error"><p><strong>Please install and activate WooCommerce to use WooBooking Calendar.</strong></p></div>';
    }
}
