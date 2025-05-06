<?php
    namespace Woobooking\Admin;

    class Menu
    {
        /**
         * WooBooking_Admin constructor.
         */
        public function __construct()
        {
            // Hook to add menu page in the WordPress admin
            add_action('admin_menu', [$this, 'add_admin_menu']);

            // Hook to register settings on admin init
            add_action('admin_init', [$this, 'register_settings']);
        }

        /**
         * Add admin menu page
         */
        public function add_admin_menu()
        {
            add_menu_page(
                'WooBooking Settings',    // Page title
                'Booking Settings',       // Menu title
                'manage_options',         // Capability
                'woobooking-settings',    // Menu slug
                [$this, 'settings_page'], // Callback function to render settings page
                'dashicons-calendar',     // Icon
                30                        // Position in the menu
            );
        }

        /**
         * Register plugin settings
         */
        public function register_settings()
        {
            register_setting('woobooking_settings_group', 'woobooking_time_slot_pricing');
            register_setting('woobooking_settings_group', 'woobooking_weekly_off_day');
            register_setting('woobooking_settings_group', 'woobooking_custom_off_days');
            register_setting('woobooking_settings_group', 'woobooking_default_booking_times');
            register_setting('woobooking_settings_group', 'woobooking_fixed_booking_slots');

            // Add settings sections and fields
            add_settings_section('woobooking_settings_section', 'Booking Settings', null, 'woobooking-settings');

            add_settings_field('woobooking_time_slot_pricing', 'Time Slot Pricing (JSON)', [$this, 'time_slot_pricing_field'], 'woobooking-settings', 'woobooking_settings_section');
            add_settings_field('woobooking_weekly_off_day', 'Weekly Off Day', [$this, 'weekly_off_day_field'], 'woobooking-settings', 'woobooking_settings_section');
            add_settings_field('woobooking_custom_off_days', 'Custom Off Days (comma-separated)', [$this, 'custom_off_days_field'], 'woobooking-settings', 'woobooking_settings_section');
            add_settings_field('woobooking_default_booking_times', 'Default Time Slots (comma-separated)', [$this, 'default_booking_times_field'], 'woobooking-settings', 'woobooking_settings_section');
            add_settings_field('woobooking_fixed_booking_slots', 'Fixed Slots for Specific Dates (JSON)', [$this, 'fixed_booking_slots_field'], 'woobooking-settings', 'woobooking_settings_section');
        }

        /**
         * Render settings page
         */
        public function settings_page()
        {
        ?>
        <div class="wrap">
            <h1>WooBooking Settings</h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields('woobooking_settings_group');
                            do_settings_sections('woobooking-settings');
                            submit_button();
                        ?>
            </form>
        </div>
        <?php
            }

                /**
                 * Render time slot pricing field
                 */
                public function time_slot_pricing_field()
                {
                    $value = get_option('woobooking_time_slot_pricing', '{"09:00":25,"11:00":30}');
                    echo '<textarea name="woobooking_time_slot_pricing" rows="5" style="width:100%;">' . esc_textarea($value) . '</textarea>';
                }

                /**
                 * Render weekly off day field
                 */
                public function weekly_off_day_field()
                {
                    $day = get_option('woobooking_weekly_off_day', 'Sunday');
                    echo '<select name="woobooking_weekly_off_day">';
                    foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $d) {
                        echo '<option ' . selected($day, $d, false) . '>' . $d . '</option>';
                    }
                    echo '</select>';
                }

                /**
                 * Render custom off days field
                 */
                public function custom_off_days_field()
                {
                    $value = get_option('woobooking_custom_off_days');
                    echo '<input type="text" name="woobooking_custom_off_days" style="width:100%;" value="' . esc_attr($value) . '">';
                }

                /**
                 * Render default booking times field
                 */
                public function default_booking_times_field()
                {
                    $value = get_option('woobooking_default_booking_times', '09:00,11:00');
                    echo '<input type="text" name="woobooking_default_booking_times" style="width:100%;" value="' . esc_attr($value) . '">';
                }

                /**
                 * Render fixed booking slots field
                 */
                public function fixed_booking_slots_field()
                {
                    $value = get_option('woobooking_fixed_booking_slots', '{}');
                    echo '<textarea name="woobooking_fixed_booking_slots" rows="5" style="width:100%;">' . esc_textarea($value) . '</textarea>';
                }
        }
