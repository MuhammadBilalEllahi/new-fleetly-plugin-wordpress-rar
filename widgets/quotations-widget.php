<?php
function enqueue_custom_plugin_assets_FOR_QUOTATIONS_WIDGET()
{

    wp_enqueue_style('nfp_quotations_widget_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_quotations_widget.css', array(), '1.0.1');
    wp_enqueue_script('nfp_quotations_widget_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_quotations_widget.js', array(), '1.0.1', true);
}
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_QUOTATIONS_WIDGET');

?>

<script>
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const rawSearch = window.location.search;
    // console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    // console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    const nfpl_var_apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);



    const req_GET_quotations = `${apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`
    const req_POST_quotations = `${apiUrlPrefixs}/plugin/dispatcher/widget-passenger-information/${bookingId}`;
    const bookingPageUrl = "<?php echo esc_url(nfpl_function_get_navigation_url(BOOKING_DETAILS_WIDGET)); ?>";

    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

    const nfpl_headers = {
        ...getNFPLAuthHeaders(),
        "Content-Type": "application/json",
        "tenant-widgetapikey": `${nfpl_var_apikey}`,
        'tenant': tenantId,

    }
</script>

<!-- HTML Structure -->
<div id="npfl_style_quotation_container">
    <div id="npfl_style_quotation_container_child">
        <!-- Booking Details Section -->
        <div id="nfpl_styles_booking_details">
            <h2 style="text-align:center; color: black;">Passenger Booking Details</h2>
            <div id="nfpl_styles_sub_booking_details">



                <div style="display: flex; flex-direction: row; width: 100%;">
                    <div class="nfpl_styles_detail">
                        <h3>Reference #:</h3>
                        <h3>Pickup Location:</h3>
                        <h3>Dropoff Location:</h3>

                        <h3>Pickup Time:</h3>
                        <h3>Pickup Location:</h3>
                        <h3>Dropoff Location:</h3>
                        <h3>Booked At:</h3>
                        <h3>Duration:</h3>
                        <h3>Via:</h3>
                    </div>

                    <div class="nfpl_styles_detail2">
                        <p id="nfpl_js_styles_reference">Loading...</p>
                        <p id="nfpl_js_styles_pickup_location">Loading...</p>
                        <p id="nfpl_js_styles_dropoff_location">Loading...</p>

                        <p id="nfpl_js_styles_pickup_time">Loading...</p>
                        <p id="nfpl_js_styles_pickup_location">Loading...</p>
                        <p id="nfpl_js_styles_dropoff_location">Loading...</p>
                        <p id="nfpl_js_styles_booked_at">Loading...</p>
                        <p id="nfpl_js_styles_duration">Loading...</p>
                        <p id="nfpl_js_styles_via_locations">Loading...</p>
                    </div>
                </div>

                <div style="
                            border-radius: 10px; 
                            overflow: hidden; 
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                            border: 2px solid #ddd;
                        ">
                    <img id="nfpl_map" src="" alt="Map Image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>

            </div>
        </div>

        <h2 id="nfpl_styles_title2_quotation">Please Select A Fleet</h2>

        <!-- Spinner Element -->
        <h1 id="nfpl_styles_title_quotation" style="text-align:center;">Quotations</h1>

        <div id="nfpl_js_style_quotation_cards"></div>
        <!-- Dynamic fleet/quotation cards will be generated here -->
        <h1 id="nfpl_js_style_return_quotation_h1" style="display: none;">Return Quotations</h1>
        <div id="nfpl_js_style_return_quotation_cards"></div>
        <button id="nfpl_js_btn_onCompelete_return" style="display: none;">
            <p id="nfpl_completeButton">Complete</p>
            <div id="nfpl_completeButton_spinner" style="display: none; height: 5px; width: 5px;"
                class="nfpl_js_styles_spinner"></div>

        </button>
    </div>
    <div id="nfpl_js_styles_spinner" style="display: none;" class="nfpl_js_styles_spinner"></div>

</div>