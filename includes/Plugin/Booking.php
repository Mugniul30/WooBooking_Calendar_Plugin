<?php
namespace Woobooking\Plugin;

class Booking
{

    /**
     * WooBooking_Booking constructor.
     */
    public function __construct()
    {
        // Hook to handle booking form submission (AJAX)
        add_action('wp_ajax_set_booking', [$this, 'set_booking']);
        add_action('wp_ajax_nopriv_set_booking', [$this, 'set_booking']);

        // Hook to display the booking details on WooCommerce order review page
        add_action('woocommerce_review_order_after_cart_contents', [$this, 'display_booking_details']);

        // Hook to add the service charge based on booking to WooCommerce cart
        add_action('woocommerce_cart_calculate_fees', [$this, 'add_service_charge']);

        // Hook to save booking details to WooCommerce order
        add_action('woocommerce_checkout_create_order', [$this, 'save_booking_details']);
    }

    /**
     * Set the booking details in the WooCommerce session.
     */
    public function set_booking()
    {
        // Security check with nonce verification
        check_ajax_referer('booking_nonce', 'nonce');

        // Sanitize and save the booking data to session
        WC()->session->set('booking', [
            'date'  => sanitize_text_field($_POST['date']),
            'time'  => sanitize_text_field($_POST['time']),
            'price' => floatval($_POST['price']),
        ]);

        // Return success response
        wp_send_json_success();
    }

    /**
     * Display booking details in WooCommerce order review page.
     */
    public function display_booking_details()
    {
        // Get the booking information from session
        $booking = WC()->session->get('booking');

        if ($booking && ! empty($booking['date']) && ! empty($booking['time'])) {
            // Format the date and time to display
            $formatted_date = date_i18n('F j, Y', strtotime($booking['date']));
            $formatted_time = date_i18n('g:i A', strtotime($booking['time']));

            echo '<tr class="order-appointment"><th>Appointment:</th><td>' . esc_html($formatted_date . ' at ' . $formatted_time) . '</td></tr>';
        }
    }

    /**
     * Add service charge based on the booking price.
     */
    public function add_service_charge($cart)
    {
        // Get the booking session details
        $booking = WC()->session->get('booking');

        if ($booking) {
            // Add the service charge to the cart
            $cart->add_fee('Service Charge', $booking['price'], true);
        }
    }

    /**
     * Save booking details to WooCommerce order meta data.
     */
    public function save_booking_details($order)
    {
        // Get the booking session details
        $booking = WC()->session->get('booking');

        if ($booking) {
            // Save the booking details to order meta data
            $order->update_meta_data('Booking Date', $booking['date']);
            $order->update_meta_data('Booking Time', $booking['time']);
            $order->update_meta_data('Service Charge', $booking['price']);

            // Clear the session data after saving it to the order
            WC()->session->__unset('booking');
        }
    }
}
