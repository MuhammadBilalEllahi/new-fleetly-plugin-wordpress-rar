<?php
function enqueue_custom_plugin_assets_FOR_PAYMENT_DETAIL_WIDGET()
{

    wp_enqueue_style('nfp_payment_detail_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_payment_detail.css', array(), '1.0.0');
    wp_enqueue_script('nfp_payment_detail_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_payment_detail.js', array(), '1.0.0', true);


}
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_PAYMENT_DETAIL_WIDGET');

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


    const bookingPageUrl = '<?php echo esc_url(nfpl_function_get_navigation_url(SUCCESS_WIDGET)); ?>';
    const cancelPageUrl = '<?php echo esc_url(nfpl_function_get_navigation_url(PAYMENT_DETAILS_WIDGET)); ?>'; // Cancel URL

    const req_GET_price = `${apiUrlPrefixs}/plugin/dispatcher/widget-booking/${bookingId}/price`
    const req_POST_payment_cash = `${apiUrlPrefixs}/plugin/dispatcher/widget-paywithcash/${bookingId}`
    const req_POST_payment_card = `${apiUrlPrefixs}/plugin/dispatcher/widget-paywithcard/${bookingId}`

    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

    const nfpl_headers = {
        ...getNFPLAuthHeaders(),
        "Content-Type": "application/json",
        "tenant-widgetapikey": `${nfpl_var_apikey}`,
        'tenant': tenantId,

    }
    const redirect_to_successPage = `${bookingPageUrl}?id=${bookingId}`;

    const CASH = 'cash';
    const CARD = 'card';
</script>




<!-- Payment Container -->

<div id="nfpl_style_payment_container">
    <div style="position: relative !important;">
        <h1 id="nfpl_style_payment_heading">Payment Method</h1>
        <p id="nfpl_style_payment_text">You can pay with cash to the driver or with a card</p>
        <div id="nfpl_style_payment_price">Price: £<span id="nfpl_js_style_price">Loading...</span></div>
        <div id="nfpl_js_style_payment_method" class="nfpl_js_style_payment_method">
            <div class="nfpl_style_payOption_button nfpl_style_cash_button" id="nfpl_js_style_cash_option">
                <input name="paymentMethod" value="cash" type="radio"> <span>Pay with Cash</span>
            </div>
            <div class="nfpl_style_payOption_button nfpl_style_card_button" id="nfpl_js_style_card_option">
                <input name="paymentMethod" value="card" type="radio"> <span>Pay with Card</span>
            </div>
        </div>
        <button id="nfpl_js_submit_button" class="btn">Continue</button>

        <!-- Spinner -->
        <div id="nfpl_js_style_loading_spinner" style="display: none;">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Processing payment, please wait...</p>
        </div>
    </div>
</div>


<div>
    <div style="
        border-radius: 10px; 
        overflow: hidden; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-height: 300px;
        border: 2px solid #ddd;
    ">
        <img id="nfpl_map" src="" alt="Map Image" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <div style="display: flex; flex-direction: row; width: 100%;">
        <div class="nfpl_styles_detail">
            <div class="nfpl_details">

                <h3>Reference #:</h3>
                <p id="nfpl_js_styles_reference">Loading...</p>

            </div>

            <div class="nfpl_details">
                <h3>Pickup Location:</h3>
                <p id="nfpl_js_styles_pickup_location">Loading...</p>
            </div>
            <div class="nfpl_details">

                <h3>Dropoff Location:</h3>
                <p id="nfpl_js_styles_dropoff_location">Loading...</p>

            </div>

            <div class="nfpl_details">
                <h3>Pickup Time:</h3>
                <p id="nfpl_js_styles_pickup_time">Loading...</p>

            </div>
            <div class="nfpl_details">
                <h3>Pickup Location:</h3>
                <p id="nfpl_js_styles_pickup_location">Loading...</p>

            </div>
            <div class="nfpl_details">
                <h3>Dropoff Location:</h3>
                <p id="nfpl_js_styles_dropoff_location">Loading...</p>

            </div>
            <div class="nfpl_details">
                <h3>Booked At:</h3>
                <p id="nfpl_js_styles_booked_at">Loading...</p>

            </div>
            <div class="nfpl_details">
                <h3>Duration:</h3>
                <p id="nfpl_js_styles_duration">Loading...</p>

            </div>
            <div class="nfpl_details">
                <h3>Via:</h3>
                <p id="nfpl_js_styles_via_locations">Loading...</p>

            </div>
        </div>

    </div>


</div>


<style>
    .nfpl_details{
        display: flex;
        flex-direction: row;
    }

    @media (max-width: 768px) {
        
    .nfpl_details{
        display: flex;
        flex-direction: column;
    }
    }
</style>