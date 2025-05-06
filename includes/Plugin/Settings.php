<?php
namespace Woobooking\Plugin;

class Settings
{

    /**
     * WooBooking_Settings constructor.
     */
    public function __construct()
    {
        // Hook to initialize the plugin settings page on admin initialization
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Register plugin settings, sections, and fields.
     */
    public function register_settings()
    {
        // Register settings group
        register_setting('woobooking_settings_group', 'woobooking_time_slot_pricing');
        register_setting('woobooking_settings_group', 'woobooking_weekly_off_day');
        register_setting('woobooking_settings_group', 'woobooking_custom_off_days');
        register_setting('woobooking_settings_group', 'woobooking_default_booking_times');
        register_setting('woobooking_settings_group', 'woobooking_fixed_booking_slots');

        // Add settings section
        add_settings_section('woobooking_settings_section', 'Booking Calendar Settings', null, 'woobooking-settings');

        // Add individual settings fields
        add_settings_field(
            'woobooking_time_slot_pricing',
            'Time Slot Pricing (JSON)',
            [$this, 'render_time_slot_pricing_field'],
            'woobooking-settings',
            'woobooking_settings_section'
        );

        add_settings_field(
            'woobooking_weekly_off_day',
            'Weekly Off Day',
            [$this, 'render_weekly_off_day_field'],
            'woobooking-settings',
            'woobooking_settings_section'
        );

        add_settings_field(
            'woobooking_custom_off_days',
            'Custom Off Days (comma-separated)',
            [$this, 'render_custom_off_days_field'],
            'woobooking-settings',
            'woobooking_settings_section'
        );

        add_settings_field(
            'woobooking_default_booking_times',
            'Default Time Slots (comma-separated)',
            [$this, 'render_default_booking_times_field'],
            'woobooking-settings',
            'woobooking_settings_section'
        );

        add_settings_field(
            'woobooking_fixed_booking_slots',
            'Fixed Slots for Specific Dates (JSON)',
            [$this, 'render_fixed_booking_slots_field'],
            'woobooking-settings',
            'woobooking_settings_section'
        );
    }

    /**
     * Render the "Time Slot Pricing" field.
     */
    public function render_time_slot_pricing_field()
    {
        $value = get_option('woobooking_time_slot_pricing', '{"09:00":25,"11:00":30}');
        echo '<textarea name="woobooking_time_slot_pricing" rows="5" style="width:100%;">' . esc_textarea($value) . '</textarea>';
        echo '<p class="description">Define time slots and their associated pricing in JSON format. Example: {"09:00":25,"11:00":30}</p>';
    }

    /**
     * Render the "Weekly Off Day" field.
     */
    public function render_weekly_off_day_field()
    {
        $day = get_option('woobooking_weekly_off_day', 'Sunday');
        echo '<select name="woobooking_weekly_off_day">';
        foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $d) {
            echo '<option ' . selected($day, $d, false) . '>' . $d . '</option>';
        }
        echo '</select>';
        echo '<p class="description">Select the weekly off day for the booking calendar.</p>';
    }

    /**
     * Render the "Custom Off Days" field.
     */
    public function render_custom_off_days_field()
    {
        $value = get_option('woobooking_custom_off_days');
        echo '<input type="text" name="woobooking_custom_off_days" style="width:100%;" value="' . esc_attr($value) . '">';
        echo '<p class="description">Comma-separated list of custom off days (e.g., "2025-12-25,2025-12-31").</p>';
    }

    /**
     * Render the "Default Booking Times" field.
     */
    public function render_default_booking_times_field()
    {
        $value = get_option('woobooking_default_booking_times', '09:00,11:00');
        echo '<input type="text" name="woobooking_default_booking_times" style="width:100%;" value="' . esc_attr($value) . '">';
        echo '<p class="description">Comma-separated list of default time slots (e.g., "09:00,11:00").</p>';
    }

    /**
     * Render the "Fixed Booking Slots" field.
     */
    public function render_fixed_booking_slots_field()
    {
        $value = get_option('woobooking_fixed_booking_slots', '{}');
        echo '<textarea name="woobooking_fixed_booking_slots" rows="5" style="width:100%;">' . esc_textarea($value) . '</textarea>';
        echo '<p class="description">Define fixed booking slots for specific dates in JSON format. Example: {"2025-12-25":["10:00","14:00"]}</p>';
    }
}
