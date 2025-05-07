<?php
    namespace Woobooking\Frontend;

    class Shortcodes
    {
        /**
         * Register the booking calendar shortcode
         */
        public function woobooking_register_shortcodes()
        {
            add_shortcode('booking_calendar', [$this, 'woobooking_booking_calendar_shortcode']);
        }

        /**
         * Callback function for the [booking_calendar] shortcode
         */
        public function woobooking_booking_calendar_shortcode()
        {
            wp_enqueue_script('woobooking-script');
            wp_enqueue_style('woobooking-style');
            wp_enqueue_script('flatpickr');
            wp_enqueue_style('flatpickr');

            // Get necessary settings from the options table
            $off_day         = get_option('weekly_off_day', 'Sunday');
            $custom_off_days = explode(',', get_option('custom_off_days', ''));
            $default_times   = explode(',', get_option('default_booking_times', '09:00,11:00'));
            $fixed_slots     = json_decode(get_option('fixed_booking_slots', '{}'), true);
            $pricing         = json_decode(get_option('time_slot_pricing', '{}'), true);

            // Fetch booked dates and times
            $booked_dates = [];
            $booked_times = [];

            $args = [
                'post_type'      => 'shop_order',
                'post_status'    => ['wc-completed', 'wc-processing'],
                'posts_per_page' => -1,
            ];
            $orders = get_posts($args);
            foreach ($orders as $order_post) {
                $order_id = $order_post->ID;
                $date     = get_post_meta($order_id, '_booking_date', true);
                $time     = get_post_meta($order_id, '_booking_time', true);
                if ($date) {
                    $booked_dates[] = $date;
                }

                if ($time && $date) {
                    $booked_times[$date][] = $time;
                }
            }

        ob_start(); ?>
        <div class="canvas">
        <div class="availability">
        <span style="color:#333; font-weight: 500; font-size: 14px;">
                🔴 <strong>Booked</strong>&nbsp;&nbsp;🟢 <strong>Available</strong>
            </span></div>
            <div id="calendar"></div>
        </div>
        <div id="slots"></div>

        <?php
            // Use wp_localize_script to pass PHP data to JS
                    wp_enqueue_script('woobooking-calendar-script', plugin_dir_url(__FILE__) . 'assets/script.js', ['jquery'], null, true);

                    // Localize PHP variables to JavaScript
                    wp_localize_script('woobooking-calendar-script', 'woobookingData', [
                        'customOffDays' => $custom_off_days,
                        'offDay'        => $off_day,
                        'bookedDates'   => $booked_dates,
                        'defaultTimes'  => $default_times,
                        'fixedSlots'    => $fixed_slots,
                        'pricing'       => $pricing,
                        'ajaxUrl'       => admin_url('admin-ajax.php'),
                        'nonce'         => wp_create_nonce('booking_nonce'),
                    ]);

                    return ob_get_clean();
                }

                /**
                 * Initialize shortcodes
                 */
                public function woobooking_init_shortcodes()
                {
                    $this->woobooking_register_shortcodes();
                }
            }

            // Initialize the shortcodes when the plugin is loaded
            add_action('init', function () {
                $shortcodes = new Shortcodes();
                $shortcodes->woobooking_init_shortcodes();
        });
