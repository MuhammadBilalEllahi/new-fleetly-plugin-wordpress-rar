<?php
function enqueue_custom_plugin_assets_FOR_INSTANT_QUOTE_WIDGET()
{

    //   wp_enqueue_style('nfp_success_widget_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_success_widget.css', array(), '1.0.3');
    wp_enqueue_script('nfp_success_widget_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_success_widget.js', array(), '1.0.0', true);


}
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_INSTANT_QUOTE_WIDGET');

?>


<script>
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const rawSearch = window.location.search;
    console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    const nfpl_var_apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);
    const req_GET_success_InfoOnLoadUrl = `${apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;
    const req_GET_price = `${apiUrlPrefixs}/plugin/dispatcher/widget-booking/${bookingId}/price`;


    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

    const nfpl_headers = {
        ...getNFPLAuthHeaders(),
        "Content-Type": "application/json",
        "tenant-widgetapikey": `${nfpl_var_apikey}`,
        'tenant': tenantId,

    }

</script>


<!-- 
<section>
    <div>
        <div id="nfpl_js_style_main_payment_box" style="display: none;">
            <h6>Great!</h6>
            <h5>Booking Ref: <span id="nfpl_js_style_booking_ref"></span> </h5>

            <div class="" style="display:flex; flex-direction:row;">
                <div>
                    <h6>Payment Mode: </h6>
                    <h6>Total Due: </h6>
                    <h6>Date: </h6>
                </div>
                <div>
                    <p id="nfpl_js_style_payment_mode">CASH</p>
                    <p id="nfpl_js_style_total_due"></p>
                    <p id="nfpl_js_style_date"></p>
                </div>
            </div>

            <p>
                A "Booking Received" email has been sent to your inbox. If it&apos;s not there, please check your junk
                or spam folder. Once one of our agents reviews your booking, we&apos;ll send a confirmation email. Thank
                you for booking with us, and we wish you a pleasant journey!
            </p>

        </div>

        <div id="nfpl_js_style_no_booking_to_show" style="display:none;">
            <h2>No booking to show</h2>
        </div>
    </div>
</section> -->




<section>
    <div>
        <!-- Main Payment Box -->
        <div id="nfpl_js_style_main_payment_box" style="
            display: none;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        ">
            <h6 style="color: #4caf50; font-size: 1.2rem; margin-bottom: 10px;">Great!</h6>
            <h5 style="font-size: 1.5rem; margin-bottom: 15px;">
                Booking Ref: <span id="nfpl_js_style_booking_ref" style="color: #007bff;"></span>
            </h5>

            <div style="display: flex; flex-direction: row; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <h6 style="margin-bottom: 5px;">Payment Mode:</h6>
                    <h6 style="margin-bottom: 5px;">Total Due:</h6>
                    <h6 style="margin-bottom: 5px;">Date:</h6>
                    <h6 style="margin-bottom: 5px;">Payment Status:</h6>
                    <h6 style="margin-bottom: 5px;">Payment Paid:</h6>
                </div>
                <div style="flex: 1;">
                    <p id="nfpl_js_style_payment_mode" style="margin-bottom: 5px; font-weight: bold;">CASH</p>
                    <p id="nfpl_js_style_total_due" style="margin-bottom: 5px;"></p>
                    <p id="nfpl_js_style_date" style="margin-bottom: 5px;"></p>
                    
                    <p id="nfpl_js_style_payment_status" style="margin-bottom: 5px;"></p>
                    <p id="nfpl_js_style_payment_paid" style="margin-bottom: 5px;"></p>
                </div>
            </div>

            <p style="font-size: 0.9rem; line-height: 1.5; color: #555;">
                A "Booking Received" email has been sent to your inbox. If it&apos;s not there, please check your junk
                or spam folder. Once one of our agents reviews your booking, we&apos;ll send a confirmation email. Thank
                you for booking with us, and we wish you a pleasant journey!
            </p>
        </div>

        <!-- No Booking Box -->
        <div id="nfpl_js_style_no_booking_to_show" style="
            display: none;
            text-align: center;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            background: #fff3f3;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            color: #721c24;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        ">
            <h2 style="font-size: 1.8rem; margin-bottom: 10px;">No booking to show</h2>
        </div>
    </div>



    <div id="nfpl_styles_booking_details">
        <h2 style="text-align:center;">Passenger Booking Details</h2>
        <div id="nfpl_styles_sub_booking_details">



            <div style="display: flex; flex-direction: row; width: 100%;">
                <div class="nfpl_styles_detail">
                    <div class="nfpl_styles_detail_sub">
                        <h3>Reference #:</h3>
                        <p id="nfpl_js_styles_reference">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <h3>Pickup Location:</h3>
                        <p id="nfpl_js_styles_pickup_location">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <h3>Dropoff Location:</h3>
                        <p id="nfpl_js_styles_dropoff_location">Loading...</p>
                    </div>

                    <div class="nfpl_styles_detail_sub">
                        <h3>Pickup Time:</h3>
                        <p id="nfpl_js_styles_pickup_time">Loading...</p>
                    </div>
                    
                    <div class="nfpl_styles_detail_sub">
                        <h3>Booked At:</h3>
                        <p id="nfpl_js_styles_booked_at">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <h3>Duration:</h3>
                        <p id="nfpl_js_styles_duration">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <h3>Via:</h3>
                        <p id="nfpl_js_styles_via_locations">Loading...</p>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
</section>




<style>
    /* Booking Details Section */
    #nfpl_styles_booking_details {
        background: var(--var-box-bg);
        width: 100%;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 3rem;
        border: 1px solid var(--var-border-color);
    }

    .nfpl_styles_detail,
    .nfpl_styles_detail2 {
        background: transparent;
        /* padding: 0; */
        border: none;
        border-radius: 0;
        display: flex;
        flex-direction: column;
        width: 100%;

        /* gap: 0.5rem; */
    }

    .nfpl_styles_detail h3 {
        color: var(--var-quote-h3-color);
        font-size: 1rem;
        padding-right: 1%;
        font-weight: 600;
        
    }

    .nfpl_styles_detail2 p {
        color: var(--var-quote-p-color);
        margin: 0;
        font-size: 1.1rem;
    }

    /* Via Locations Special Styling */
    #nfpl_js_styles_via_locations {
        color: #ff8c00;
        position: relative;
        padding-left: 0.5rem;
    }

    #nfpl_js_styles_via_locations:before {
        content: "•";
        position: absolute;
        left: -0rem;
        color: #ff8c00;
    }
    .nfpl_styles_detail_sub {
        display: flex;
        flex-direction: column;

align-items: start;
        gap: 1rem;
    }
    @media (min-width: 768px) {
        .nfpl_styles_detail_sub {
            display: flex;
            flex-direction: row;
            gap: 2rem;
        }
        
    }
</style>