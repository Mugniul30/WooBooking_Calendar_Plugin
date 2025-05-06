<?php
/*
 * Plugin Name:       WooBooking Calendar
 * Plugin URI:        https://wetechpro.com/
 * Description:       A flexible booking calendar with time slot management for WooCommerce.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mugniul Afif
 * Author URI:        https: //github.com/Mugniul30
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
if (! defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The Main Plugin Class
 */
final class WooBooking_Calendar_Plugin
{
    /**
     * Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Class Constructor
     */
    private function __construct()
    {
        $this->define_constants();

        // Register the activation hook and initialize the plugin.
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance
     *
     * @return \WooBooking_Calendar_Plugin
     */
    public static function init()
    {
        static $instance = false;
        if (! $instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * Define plugin constants
     */
    private function define_constants()
    {
        define('WOOBOOKING_VERSION', self::VERSION);
        define('WOOBOOKING_FILE', __FILE__);
        define('WOOBOOKING_PATH', __DIR__);
        define('WOOBOOKING_URL', plugins_url('', WOOBOOKING_FILE));
        define('WOOBOOKING_ASSETS', WOOBOOKING_URL . '/assets');
    }

    /**
     * Run activation tasks
     */
    public function activate()
    {
        // Check if this plugin has been installed previously
        $installed = get_option('woobooking_version');

        if (! $installed) {
            update_option('woobooking_installed', time());
        }

        // Store the plugin version in the options table
        update_option('woobooking_version', WOOBOOKING_VERSION);
    }

    /**
     * Initialize the plugin functionality
     */
    public function init_plugin()
    {
        // Initialize the plugin functionality
        new Woobooking\Admin\Menu();
        new Woobooking\Frontend\Shortcodes();
        new Woobooking\Frontend\Assets();
        new Woobooking\Plugin\Settings();
        new Woobooking\Plugin\Booking();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \WooBooking_Calendar_Plugin
 */
function woobooking_calendar_plugin()
{
    return WooBooking_Calendar_Plugin::init();
}

// Initialize the plugin
woobooking_calendar_plugin();
