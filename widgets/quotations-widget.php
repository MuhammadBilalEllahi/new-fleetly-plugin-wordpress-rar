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
            <h2 style="text-align:center; color: black; margin-bottom: 1rem;">Passenger Booking Details</h2>
            <div id="nfpl_styles_sub_booking_details">



                <div id="nfpl_js_styles_forward_booking_id" style=" width: 100%; border: 1px solid #b5b5b5">
                    <h4 style="width: 100%; text-align: center; font-size: 1.5rem;">Forward Booking</h4>
                   <div style="display: flex; flex-direction: row; border-top: 1px solid #b5b5b5;">
                   <div class="nfpl_styles_detail2">
                        <!-- <p style="font-weight:600;">Reference #:</p> -->
                        <p style="font-weight:600;">Pickup Location:</p>
                        <p style="font-weight:600;">Dropoff Location:</p>

                        <p style="font-weight:600;">Pickup Time:</p>
                        <p style="font-weight:600;">Booked At:</p>
                        <p style="font-weight:600;">Duration:</p>
                        <p style="font-weight:600;">Via:</p>
                    </div>

                    <div class="nfpl_styles_detail2">
                        <!-- <p id="nfpl_js_styles_reference">Loading...</p> -->
                        <p id="nfpl_js_styles_pickup_location">Loading...</p>
                        <p id="nfpl_js_styles_dropoff_location">Loading...</p>

                        <p id="nfpl_js_styles_pickup_time">Loading...</p>
                        <p id="nfpl_js_styles_booked_at">Loading...</p>
                        <p id="nfpl_js_styles_duration">Loading...</p>
                        <p id="nfpl_js_styles_via_locations">Loading...</p>
                    </div>
                   </div>
                </div>




                <div style="
                           min-width: 33%;
                        ">
                    <img id="nfpl_map" src="" alt="Map Image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>



                <div id="nfpl_js_styles_isReturn" style="display: none; flex-direction: column;  width: 100%; border: 1px solid #b5b5b5">
                  <h4 style="width: 100%; text-align: center; font-size: 1.5rem;">Return Booking</h4>
                        <div style="display: flex; flex-direction: row; border-top: 1px solid #b5b5b5;">

                            <div class="nfpl_styles_detail2">
                                <!-- <p style="font-weight:600;">Reference #:</p> -->
                                <p style="font-weight:600;">Pickup Location:</p>
                                <p style="font-weight:600;">Dropoff Location:</p>

                                <p style="font-weight:600;">Pickup Time:</p>
                                <p style="font-weight:600;">Via:</p>
                            </div>

                            <div class="nfpl_styles_detail2">
                                <!-- <p id="nfpl_js_styles_reference">Loading...</p> -->
                                <p id="nfpl_js_styles_pickup_location_return">Loading...</p>
                                <p id="nfpl_js_styles_dropoff_location_return">Loading...</p>

                                <p id="nfpl_js_styles_pickup_time_return">Loading...</p>
                                <p id="nfpl_js_styles_via_locations_return">Loading...</p>
                            </div>
                        </div>
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