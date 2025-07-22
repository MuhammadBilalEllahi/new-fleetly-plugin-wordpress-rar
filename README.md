# New Fleetly WordPress Plugin

A modern WordPress plugin to display instant quote forms, booking details, and manage cab service bookings with a seamless user experience.

## Features

- **Instant Quote Widget**: Allow users to get instant cab quotes.
- **Quotations Widget**: Display and manage user quotations.
- **Booking Details Widget**: Show detailed booking information.
- **Payment Details Widget**: Secure payment interface for bookings.
- **Success Widget**: Confirmation and success messages for completed actions.
- **User Authentication**: Login, registration, and user bookings widgets.
- **Admin Panel Integration**: Settings, file editor, and help pages in the WordPress admin menu.
- **Customizable**: Easily assign widgets to pages and configure API settings.
- **Modern UI**: Responsive, dark-themed frontend and admin styles.

## Installation

1. **Download or Clone the Plugin**
   - Download this repository as a ZIP file, or clone it into your WordPress plugins directory:
     ```
     git clone <repo-url> wp-content/plugins/new-fleetly-plugin-wordpress-rar
     ```

2. **Upload to WordPress**
   - If you downloaded as a ZIP, upload it via the WordPress Admin:  
     `Plugins > Add New > Upload Plugin`.

3. **Activate the Plugin**
   - Go to `Plugins` in your WordPress admin and activate **New Fleetly WordPress Plugin**.

4. **Configure the Plugin**
   - A new menu item **Fleetly** will appear in your WordPress admin sidebar.
   - Go to `Fleetly > Settings` to:
     - Assign widgets to pages (Instant Quote, Quotations, Booking Details, etc.).
     - Enter your API URL prefix, API key, Tenant Owner ID, and Terms & Conditions link.

## Usage

### Adding Widgets to Pages

Each widget can be added to a page using its shortcode. Assign pages for each widget in the plugin settings, or manually add the following shortcodes to your pages:

- **Instant Quote Widget**: `[nfpl_instant_quote_widget]`
- **Quotations Widget**: `[nfpl_quotations_widget]`
- **Booking Details Widget**: `[nfpl_booking_details_widget]`
- **Payment Details Widget**: `[nfpl_payment_details_widget]`
- **Success Widget**: `[nfpl_success_widget]`
- **Login Widget**: `[nfpl_login_widget]`
- **Register Widget**: `[nfpl_register_widget]`
- **User Booking Widget**: `[nfpl_user_booking_widget]`

### Admin Tools

- **File Editor**: Edit plugin files directly from the WordPress admin (`Fleetly > File Editor`).
- **Help**: Access documentation and troubleshooting tips (`Fleetly > Help`).

## Directory Structure

- `/admin/` – Admin pages and settings.
- `/assets/` – CSS and JS for frontend and admin.
- `/widgets/` – Widget PHP files for shortcodes and user interface.

## Troubleshooting

- **Function Name Conflicts**: If you have multiple versions of Fleetly plugins, ensure all function names are unique to avoid fatal errors.
- **Debugging**: To enable debug logs, add the following to your `wp-config.php`:
  ```php
  define('WP_DEBUG', true);
  define('WP_DEBUG_LOG', true);
  define('WP_DEBUG_DISPLAY', false);
  ```
  Check `wp-content/debug.log` for error details.
- **Fatal Error: Function Name Conflict**  
  If you see a fatal error about a function name (e.g., `enqueue_custom_plugin_assets()`), rename the function in one of the plugins or deactivate the conflicting plugin.
- **API Issues**  
  Ensure your API URL prefix, API key, and Tenant Owner ID are correctly set in the plugin settings.

## For Beginner Developers

- You can edit the plugin files in VSCode and see changes in real-time on your local WordPress site.
- Always use unique function names if you have multiple versions of this plugin active.

## Contributing

Pull requests and suggestions are welcome! Please ensure your code is well-documented and tested.

## License

[MIT](LICENSE) or as specified by the project owner. 