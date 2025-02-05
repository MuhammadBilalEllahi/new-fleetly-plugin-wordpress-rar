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

<div id="nfpl_style_payment_container_parent">


<div id="nfpl_style_payment_container">
    <div id="nfpl_style_payment_container_child" style="position: relative !important;">
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


<div id="nfpl_stlyes_details_with_map" >
    
<div style="min-width: fit-content; height: fit-content;">
        <img id="nfpl_map" src="" alt="Map Image" style="width: 100%; height: 100%; object-fit: contain;">
    </div>


    <div class="nfpl_styles_detail" style="display: flex; flex-direction: row; width: 100%;">
        <div >
            <h4 style="border-bottom: 1px solid #b5b5b5;">Forward Booking</h4>
            <div class="nfpl_details">

                <p><strong>Reference #:</strong></p>
                <p id="nfpl_js_styles_reference">Loading...</p>

            </div>

            <div class="nfpl_details">
                <p><strong>Pickup Location:</strong></p>
                <p id="nfpl_js_styles_pickup_location">Loading...</p>
            </div>
            <div class="nfpl_details">

                <p><strong>Dropoff Location:</strong></p>
                <p id="nfpl_js_styles_dropoff_location">Loading...</p>

            </div>

            <div class="nfpl_details">
                <p><strong>Pickup Time:</strong></p>
                <p id="nfpl_js_styles_pickup_time">Loading...</p>

            </div>
            <div class="nfpl_details">
                <p><strong>Booked At:</strong></p>
                <p id="nfpl_js_styles_booked_at">Loading...</p>

            </div>
            <div class="nfpl_details">
                <p><strong>Duration:</strong></p>
                <p id="nfpl_js_styles_duration">Loading...</p>

            </div>
            <div class="nfpl_details">
                <p><strong>Via:</strong></p>
                <p id="nfpl_js_styles_via_locations">Loading...</p>

            </div>
        </div>

    </div>

   


     <div id="nfpl_js_style_isReturn" class="nfpl_styles_detail" style="display: none; flex-direction: row; width: 100%;">
        <div >
            <h4 style="border-bottom: 1px solid #b5b5b5;">Return Booking</h4>
            

            <div class="nfpl_details">
                <p><strong>Pickup Location:</strong></p>
                <p id="nfpl_js_styles_pickup_location_return">Loading...</p>
            </div>
            <div class="nfpl_details">

                <p><strong>Dropoff Location:</strong></p>
                <p id="nfpl_js_styles_dropoff_location_return">Loading...</p>

            </div>

            <div class="nfpl_details">
                <p><strong>Pickup Time:</strong></p>
                <p id="nfpl_js_styles_pickup_time_return">Loading...</p>

            </div>
            <div class="nfpl_details">
                <p><strong>Via:</strong></p>
                <p id="nfpl_js_styles_via_locations_return">Loading...</p>

            </div>
        </div>

    </div>


</div>


</div>


<style>
    
    #nfpl_style_payment_container_child{
        width: 100%;
    }
    #nfpl_stlyes_details_with_map{
        width: 55%;  display: flex; flex-direction: column;
        margin: 0 5%
    }

    #nfpl_style_payment_container_parent{
        display: flex !important;
        flex-direction: row !important;
        width: 100%;
    }
    .nfpl_details{
        display: flex;
        flex-direction: row;
    }
.nfpl_details{
    font-size:medium;
}
    @media (max-width: 768px) {
        
   
    #nfpl_style_payment_container_parent{
        display: flex !important;
        flex-direction: column !important;
        width: 100%;
    }
    #nfpl_stlyes_details_with_map{
        width: 100%;
        padding: 5%;
        margin: 0;
    }

    }


    @media (max-width: 500px) {
        .nfpl_details{
        display: flex;
        flex-direction: column;
    }
    }

    .nfpl_styles_detail{
        border: 1px solid #b5b5b5;
        padding: 2%;
    }
</style>