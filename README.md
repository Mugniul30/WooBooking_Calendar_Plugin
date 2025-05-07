<h1>WooBooking Calendar Plugin</h1>
    <p>WooBooking Calendar is a powerful and flexible booking solution designed for WooCommerce. It enables you to easily add a booking calendar to your WooCommerce store, manage time slots, and offer customizable pricing for services or events. Whether you’re running a service-based business or hosting events, WooBooking Calendar streamlines the process of booking appointments online.</p>

<h2>Key Features</h2>
    <ul>
        <li><strong>Customizable Booking Calendar:</strong> Display an interactive calendar that allows customers to select their desired date and time slot.</li>
        <li><strong>Flexible Time Slot Management:</strong> Set predefined or custom time slots for specific days and events.</li>
        <li><strong>Dynamic Pricing:</strong> Assign different prices to time slots based on availability or specific time periods.</li>
        <li><strong>WooCommerce Integration:</strong> Integrates directly with WooCommerce, allowing customers to book appointments while checking out.</li>
        <li><strong>Availability Management:</strong> Disable specific days or time slots, and set weekly or custom off days to control your availability.</li>
        <li><strong>Easy Admin Interface:</strong> Intuitive settings page to manage booking options, time slots, off days, and pricing.</li>
    </ul>

<h2>Installation Requirements</h2>
    <ul>
        <li><strong>WordPress Version:</strong> 5.2 or higher</li>
        <li><strong>PHP Version:</strong> 7.2 or higher</li>
        <li><strong>WooCommerce:</strong> Required for the plugin to function correctly.</li>
    </ul>

<h2>Installation Steps</h2>
<h3>Upload the Plugin</h3>
    <ul>
        <li>Download the .zip file of the WooBooking Calendar plugin.</li>
        <li>Navigate to your WordPress admin dashboard, go to Plugins &gt; Add New.</li>
        <li>Click Upload Plugin, select the .zip file, and click Install Now.</li>
        <li>After installation, click Activate to enable the plugin.</li>
    </ul>

<h3>Activate WooCommerce</h3>
    <p>Make sure that WooCommerce is installed and activated. If it’s not installed, the plugin will notify you and deactivate itself automatically.</p>

<h2>Configuration</h2>
    <p>After the plugin is activated, you can configure the booking settings by following these steps:</p>
    
<h3>Access Settings</h3>
    <p>Go to WooBooking Settings in the WordPress admin menu.</p>

<h3>Set Time Slot Pricing</h3>
    <p>Configure time slots and their associated prices. For example:</p>
    <pre>
    { "09:00": 25, "11:00": 30 }
    </pre>

<h3>Define Weekly Off Day</h3>
    <p>Set the day of the week (e.g., Sunday) as the weekly off day where no bookings can be made.</p>

<h3>Add Custom Off Days</h3>
    <p>Define specific off days (e.g., public holidays) by entering the dates in comma-separated format (e.g., 2025-05-01,2025-12-25).</p>

<h3>Configure Default Time Slots</h3>
    <p>Set default available times for booking (e.g., 09:00,11:00).</p>

<h3>Assign Fixed Slots for Specific Dates</h3>
    <p>Set specific available time slots for certain dates using JSON format. For example:</p>
    <pre>
    { "2025-06-01": ["10:00", "12:00"] }
    </pre>

<h3>Save Settings</h3>
    <p>After configuring your settings, click Save Changes to apply the new settings.</p>

<h2>Usage</h2>
    <p>Once your settings are configured, the booking calendar will be available for use on your site. Here’s how to use it:</p>

<h3>Add the Calendar to a Page</h3>
    <p>Use the <code>[booking_calendar]</code> shortcode to display the booking calendar on any page or post.</p>
    <pre>
    [booking_calendar]
    </pre>

<h3>Booking Process</h3>
    <ul>
        <li>Customers can select an available date and time from the calendar.</li>
        <li>Available time slots will be marked in green (🟢), and booked slots will be marked in red (🔴).</li>
        <li>After selecting a time slot, customers can proceed to checkout with the booking details added to the WooCommerce cart.</li>
    </ul>

<h3>Booking Information on Checkout</h3>
    <ul>
        <li>The selected date, time, and price will appear on the WooCommerce checkout page, along with other cart items.</li>
        <li>The booking details will be saved as part of the WooCommerce order metadata.</li>
    </ul>

<h2>Admin Features</h2>
    <ul>
        <li><strong>Booking Details in Orders:</strong> View the selected date, time, and price in WooCommerce orders in the admin dashboard.</li>
        <li><strong>Off Day Management:</strong> Easily set off days (weekly or custom) where no bookings will be allowed.</li>
        <li><strong>Easy Configuration:</strong> Adjust booking settings (time slots, pricing, availability) directly from the plugin settings page.</li>
        <li><strong>Dynamic Calendar:</strong> The front-end calendar will automatically update to reflect booked dates and times.</li>
    </ul>

<h2>WooCommerce Dependency</h2>
    <p>This plugin requires WooCommerce to function correctly. If WooCommerce is not installed or activated, the plugin will:</p>
    <ul>
        <li>Display an admin notice indicating that WooCommerce is required.</li>
        <li>Deactivate itself to prevent issues.</li>
    </ul>

<h2>Troubleshooting</h2>
    <h3>WooCommerce Missing Error</h3>
    <p>If you see the error message "WooCommerce is not installed," ensure that WooCommerce is installed and activated. The plugin will deactivate itself if WooCommerce is missing.</p>

<h3>Booking Availability Not Updating</h3>
    <p>If the booking availability is not showing correctly, try clearing your browser cache or any caching plugin you may be using.</p>

<h2>Frequently Asked Questions (FAQs)</h2>
    <h3>Q: Can I change the time slots for specific dates?</h3>
    <p>Yes! You can configure fixed time slots for specific dates through the plugin’s settings, using a simple JSON format.</p>

<h3>Q: How do I manage the off days for my business?</h3>
    <p>You can set a weekly off day (like Sunday) and add custom off days (such as public holidays) directly in the plugin settings.</p>

<h3>Q: How do I set up pricing for time slots?</h3>
    <p>The plugin allows you to define prices for different time slots using a JSON format in the settings. For example:</p>
    <pre>
    { "09:00": 25, "11:00": 30 }
    </pre>

<h2>Contributing</h2>
    <p>We welcome contributions to WooBooking Calendar Plugin! If you would like to improve the plugin or fix bugs, please follow these steps:</p>
    <ul>
        <li>Fork the repository.</li>
        <li>Create a new branch for your feature or bugfix.</li>
        <li>Submit a pull request with a clear description of the changes.</li>
    </ul>

<h2>License</h2>
    <p>This plugin is licensed under the GPL v2 or later license. You are free to use, modify, and distribute the plugin, but please attribute the original author.</p>

<h2>Developer Information</h2>
    <ul>
        <li><strong>Author:</strong> Mugniul Afif</li>
        <li><strong>Email:</strong> mugniulafif@clientsync.tech</li>
        <li><strong>GitHub:</strong> <a href="https://github.com/Mugniul30" target="_blank">github.com/Mugniul30</a></li>
        <li><strong>Website:</strong> <a href="https://clientsync.tech" target="_blank">clientsync.tech</a></li>
    </ul>

<h2>Changelog</h2>
    <ul>
        <li><strong>1.0.0:</strong> Initial release of the WooBooking Calendar Plugin.</li>
        <li>Integrated WooCommerce booking system with customizable time slots and pricing.</li>
        <li>Added the ability to disable specific dates and time slots.</li>
        <li>WooCommerce dependency check implemented.</li>
    </ul>

<h2>Conclusion</h2>
    <p>This README.md file is professionally structured and provides clear instructions for users and developers. It covers installation, configuration, troubleshooting, and contributions in a clean and organized manner.</p>


    