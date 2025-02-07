<?php

/*
Plugin Name: New Fleetly Worpress Plugin
Description: A plugin to display instant quote form and booking details for Cab services.
Version: 1.0.0
Author: Cogentro
*/

//## NFP means new fleetly plugin 


// if(!defined('ABSPATH')){
//     exit;
// }



add_action('wp_footer', function () {
    ob_start();
    echo '<div class="nfp-toast-container" id="nfp-toastContainer"></div>';
    ob_end_flush();
});

add_action('admin_footer', function () {
    ob_start();
    echo '<div class="nfp-toast-container" id="nfp-toastContainer"></div>';
    ob_end_flush();
});


if (!defined('NFP_PLUGIN_DIR_PATH')) {
    define('NFP_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}
if (!defined('NFP_PLUGIN_DIR_URL')) {
    define('NFP_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

// ### BELOW HOOCK IS USED TO ADD SCRIPTS AND STYLES TO THE BOTH "FRONTEND AND ADMIN PANEL"
function enqueue_custom_plugin_assets_FOR_BOTH()
{
    wp_enqueue_style('nfp_toastify_self_styles', NFP_PLUGIN_DIR_URL . 'assets/css/nfp_toastify.css', array(), '1.0.0');
    wp_enqueue_script('nfp_toastify_self_scripts', NFP_PLUGIN_DIR_URL . 'assets/js/nfp_toastify.js', array(), '1.0.0', true);


    wp_enqueue_script('nfp_auth_self_scripts', NFP_PLUGIN_DIR_URL . 'assets/js/nfpl_auth.js', array(), '1.0.0', false);

}
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_BOTH');
add_action('admin_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_BOTH');

// ### BELOW HOOCK IS USED TO ADD SCRIPTS AND STYLES TO THE "ADMIN PANEL"
function enqueue_custom_plugin_assets_FOR_ADMIN()
{
    wp_enqueue_style('nfp_FOR_ADMIN_plugin_editor_style', NFP_PLUGIN_DIR_URL . 'assets/css/admin/nfp_plugin_editor.css', array(), '1.0.0');
    wp_enqueue_script('nfp_FOR_ADMIN_plugin_editor_script', NFP_PLUGIN_DIR_URL . 'assets/js/admin/nfp_plugin_editor.js', array(), '1.0.0', true);

    wp_enqueue_style('nfp_FOR_ADMIN_shortcode_copier_styles', NFP_PLUGIN_DIR_URL . 'assets/css/admin/nfp_shortcode_copier.css', array(), '1.0.0');
    wp_enqueue_script('nfp_FOR_ADMIN_shortcode_copier_scripts', NFP_PLUGIN_DIR_URL . 'assets/js/admin/nfp_shortcode_copier.js', array(), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_ADMIN');

// ### BELOW HOOCK IS USED TO ADD SCRIPTS AND STYLES TO THE "FRONTEND"
function enqueue_custom_plugin_assets_FOR_FRONTEND()
{
    wp_enqueue_style('nfp_main_root_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfp_styles.css', array(), '1.0.1');
    wp_enqueue_script('nfp_main_root_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfp_scripts.js', array(), '1.0.0', true);


} 
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_FRONTEND');




function nfpl_display_instant_quote_widget()
{
    ob_start();

    include(NFP_PLUGIN_DIR_PATH . 'widgets/nfpl_instant-quote-widget.php');

    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}

function nfpl_display_quotations_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/nfpl_quotations-widget.php');
    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}

function nfpl_display_booking_deatils_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/nfpl_booking-details-widget.php');
    $content = ob_get_clean(); // store buffered output content.
    return $content; // Return the content.
}

function nfpl_display_payment_details_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/nfpl_payment-details-widget.php');
    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}

function nfpl_display_success_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/nfpl_success-widget.php');
    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}

function nfpl_display_login_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/auth/nfpl_login_widget.php');
    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}

function nfpl_display_register_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/auth/nfpl_register_widget.php');
    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}

function nfpl_display_user_booking_widget()
{
    ob_start();
    include(NFP_PLUGIN_DIR_PATH . 'widgets/auth/nfpl_user_bookings.php');
    $content = ob_get_clean(); // store buffered output content.

    return $content; // Return the content.
}


if (!defined('INSTANT_QUOTE_WIDGET')) {
    define('INSTANT_QUOTE_WIDGET', 'nfpl_instant_quote_widget');
}
if (!defined('QUOTATIONS_WIDGET')) {
    define('QUOTATIONS_WIDGET', 'nfpl_quotations_widget');
}
if (!defined('BOOKING_DETAILS_WIDGET')) {
    define('BOOKING_DETAILS_WIDGET', 'nfpl_booking_details_widget');
}
if (!defined('PAYMENT_DETAILS_WIDGET')) {
    define('PAYMENT_DETAILS_WIDGET', 'nfpl_payment_details_widget');
}
if (!defined('SUCCESS_WIDGET')) {
    define('SUCCESS_WIDGET', 'nfpl_success_widget');
}

if (!defined('LOGIN_WIDGET')) {
    define('LOGIN_WIDGET', 'nfpl_login_widget');
}

if (!defined('REGISTER_WIDGET')) {
    define('REGISTER_WIDGET', 'nfpl_register_widget');
}

if (!defined('USER_BOOKING_WIDGET')) {
    define('USER_BOOKING_WIDGET', 'nfpl_user_booking_widget');
}





// p1 means page-1. To be displayed on first page
add_shortcode(INSTANT_QUOTE_WIDGET, 'nfpl_display_instant_quote_widget');
add_shortcode(QUOTATIONS_WIDGET, 'nfpl_display_quotations_widget');
add_shortcode(BOOKING_DETAILS_WIDGET, 'nfpl_display_booking_deatils_widget');
add_shortcode(PAYMENT_DETAILS_WIDGET, 'nfpl_display_payment_details_widget');
add_shortcode(SUCCESS_WIDGET, 'nfpl_display_success_widget');

add_shortcode(LOGIN_WIDGET, 'nfpl_display_login_widget');
add_shortcode(REGISTER_WIDGET, 'nfpl_display_register_widget');
add_shortcode(USER_BOOKING_WIDGET, 'nfpl_display_user_booking_widget');


if (!defined('NFP_MAIN_QOUTE_PAGE_SLUG')) {
    define('NFP_MAIN_QOUTE_PAGE_SLUG', 'nfp_quotation_page');
}

function fleetly_main_plugin_menu()
{
 
    add_menu_page(
        'Fleetly Cabs',//page title
        'Fleetly', //menu title
        'manage_options', //capability
        NFP_MAIN_QOUTE_PAGE_SLUG,  //slug
        'fleetly_main_plugin_html',  //function // right this below
        'dashicons-admin-tools',  //icon
        5 // position in sidebar
    );

    // Add the submenu for the plugin file editor
    add_submenu_page(
        NFP_MAIN_QOUTE_PAGE_SLUG, // Parent menu slug
        'Plugin File Editor', // Page title
        'File Editor', // Menu title
        'manage_options', // Capability
        'fleetly-plugin-file-editor', // Submenu slug
        'fleetly_plugin_file_editor' // Function to render the file editor page
    );

    add_submenu_page(
        NFP_MAIN_QOUTE_PAGE_SLUG, // Parent menu slug
        'Fleetly Settings', // Page title
        'Settings', // Menu title
        'manage_options', // Capability
        'fleetly-settings-page', // Submenu slug
        null // Function to render the file editor page
    );

    add_submenu_page(
        NFP_MAIN_QOUTE_PAGE_SLUG, // Parent menu slug
        'Fleetly Help', // Page title
        'Help', // Menu title
        'manage_options', // Capability
        'help-document-page', // Submenu slug
        null // Function to render the file editor page
    );

}

function fleetly_main_plugin_html()
{
    /** 
     * below form is used to save the data in the database
     */
    ?>
    <div>
        <h1>Fleetly Plugin Settings</h1>
        <p>Here you can attach a plugin widget to your webpage.
            <br />
            Select a page (or create new page) from the dropdown list to attach the widget to the page. and click on the
            save button.
        </p>
        <form method="post" action="options.php">
            <?php
            settings_fields('nfp_quotation_settings_group');
            do_settings_sections(NFP_MAIN_QOUTE_PAGE_SLUG);
            submit_button();

            ?>

        </form>
    </div>
    <?php
}


/**
 * in add_action first parameter is the hook that is used to run the function
 * second parameter is the function that is to be run
 * add_action is a built in function in wordpress that is used to run a function when a hook is called
 * admin_menu is a built in hook in wordpress that is used to run a function when the admin menu is loaded
 */
add_action('admin_menu', 'fleetly_main_plugin_menu');


/**
 * Register the settings for the plugin.
 */
function nfpl_function_quotation_plugin_settings_init()
{
    register_setting(
        'nfp_quotation_settings_group',
        'nfp_quotation_settings_group_options',
        'nfpl_function_sanitize_quotation_plugin_settings'
    );

    // Add settings section
    add_settings_section(
        'nfp_quotation_settings_section',
        'Page and API Settings Section',
        'nfpl_function_quotation_plugin_settings_section_callback',
        NFP_MAIN_QOUTE_PAGE_SLUG
    );


    $fields = array(
        array('id' => INSTANT_QUOTE_WIDGET, 'label' => 'Instant Quote Widget'),
        array('id' => QUOTATIONS_WIDGET, 'label' => 'Quotations Widget'),
        array('id' => BOOKING_DETAILS_WIDGET, 'label' => 'Booking Details Widget'),
        array('id' => PAYMENT_DETAILS_WIDGET, 'label' => 'Payment Widget'),
        array('id' => SUCCESS_WIDGET, 'label' => 'Success Widget'),
        array('id' => LOGIN_WIDGET, 'label' => 'Login Widget'),
        array('id' => REGISTER_WIDGET, 'label' => 'Register Widget'),
        array('id' => USER_BOOKING_WIDGET, 'label' => 'User Booking Widget'),
    );

    // Add fields for each widget page

    foreach ($fields as $field) {
        add_settings_field(
            $field['id'], // Field ID
            $field['label'], // Title
            'nfpl_function_quotation_plugin_page_dropdown', // Callback
            NFP_MAIN_QOUTE_PAGE_SLUG, // Page slug
            'nfp_quotation_settings_section', // Section ID
            array('label_for' => $field['id']) // Args
        );
    }
    /*** END OF NEW DropMEnu FIELD ***/


    $data_fields = array(
        array('id' => 'nfpl_data_tenant_owner_id', 'label' => 'Tenant Owner ID'),
        array('id' => 'nfpl_data_api_url_prefix', 'label' => 'API URL Prefix'),
        array('id' => 'nfpl_data_api_key', 'label' => 'API Key'),
        array('id' => 'nfpl_data_terms_conditions', 'label' => 'Your Terms & Condition Link'),
    );

    foreach ($data_fields as $field) {
        add_settings_field(
            $field['id'], // Field ID
            $field['label'], // Title
            'nfpl_function_quotation_plugin_text_input',
            NFP_MAIN_QOUTE_PAGE_SLUG, // Page slug
            'nfp_quotation_settings_section', // Section ID
            array('label_for' => $field['id']) // Args
        );
    }
}


add_action('admin_init', 'nfpl_function_quotation_plugin_settings_init');


/**
 * Section callback to render a description.
 */
function nfpl_function_quotation_plugin_settings_section_callback()
{

    //   fleetly_main_plugin_html()
    echo esc_html('Configure the plugin by assigning pages and providing API settings.');
}

/**
 * Dropdown field callback for page selection.
 */
function nfpl_function_quotation_plugin_page_dropdown($args)
{
    $options = get_option('nfp_quotation_settings_group_options');
    $selected = isset($options[$args['label_for']]) ? $options[$args['label_for']] : '';


    wp_dropdown_pages(array(
        'name' => 'nfp_quotation_settings_group_options[' . esc_attr($args['label_for']) . ']',
        'selected' => $selected,
    ));
    echo '<span class="dashicons dashicons-admin-page nfp-copy-icon" data-shortcode="[' . esc_attr($args['label_for']) . ']"></span>';

}



/**
 * Text input field callback.
 */
function nfpl_function_quotation_plugin_text_input($args)
{
    $options = get_option('nfp_quotation_settings_group_options');
    $value = isset($options[$args['label_for']]) ? esc_attr($options[$args['label_for']]) : '';
    echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="nfp_quotation_settings_group_options[' . esc_attr($args['label_for']) . ']" value="' . $value . '">';
}

/**
 * Sanitization callback for settings.
 */
function nfpl_function_sanitize_quotation_plugin_settings($input)
{
    $sanitized = array();
    foreach ($input as $key => $value) {
        if (in_array($key, array('nfpl_data_tenant_owner_id', 'nfpl_data_api_url_prefix', 'nfpl_data_api_key'), true)) {
            $sanitized[$key] = sanitize_text_field($value);
        } else {
            $sanitized[$key] = absint($value); // Ensure page IDs are integers
        }
    }
    return $sanitized;
}




// Function to get tenantOwner ID from settings
if (!function_exists('nfpl_function_get_tenant_owner_id')) {
    function nfpl_function_get_tenant_owner_id()
    {
        $options = get_option('nfp_quotation_settings_group_options');
        return isset($options['nfpl_data_tenant_owner_id']) ? $options['nfpl_data_tenant_owner_id'] : '';
    }

}

// Function to get API URL prefix from settings
if (!function_exists('nfpl_function_get_api_url_prefix')) {
    function nfpl_function_get_api_url_prefix()
    {
        $options = get_option('nfp_quotation_settings_group_options');
        return isset($options['nfpl_data_api_url_prefix']) ? esc_url($options['nfpl_data_api_url_prefix']) : '';
    }

}


// Function to get API Key from settings
if (!function_exists('nfpl_function_get_api_key')) {
    function nfpl_function_get_api_key()
    {
        $options = get_option('nfp_quotation_settings_group_options');
        return isset($options['nfpl_data_api_key']) ? sanitize_text_field($options['nfpl_data_api_key']) : '';
    }
}


// Use user-selected pages for navigation
if(!function_exists('nfpl_function_get_navigation_url')) {
    function nfpl_function_get_navigation_url($widget_type) {
        $options = get_option('nfp_quotation_settings_group_options');
        $page_id = isset($options[$widget_type]) ? $options[$widget_type] : 0;
        if ($page_id) {
            return get_permalink($page_id);
        }
        return '#'; // Return a fallback if no page is selected
    }
}



// Function to get API URL prefix from settings
if (!function_exists('nfpl_function_get_terms_and_conditions_url')) {
    function nfpl_function_get_terms_and_conditions_url()
    {
        $options = get_option('nfp_quotation_settings_group_options');
        return isset($options['nfpl_data_terms_conditions']) ? esc_url($options['nfpl_data_terms_conditions']) : '';
    }

}



// // Function to render the custom plugin file editor page
function fleetly_plugin_file_editor()
{
    include(NFP_PLUGIN_DIR_PATH . 'nfpl_plugi-editor.php');
}



?>