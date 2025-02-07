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
    const nfpl_API_apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const rawSearch = window.location.search;
    console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    const nfpl_var_apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);
    const req_GET_success_InfoOnLoadUrl = `${nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;
    const req_GET_price = `${nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-booking/${bookingId}/price`;


    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

    const nfpl_headers = {
        ...getNFPLAuthHeaders(),
        "Content-Type": "application/json",
        "tenant-widgetapikey": `${nfpl_var_apikey}`,
        'tenant': tenantId,

    }

</script>





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

            <div style="display: flex; flex-direction: row; gap: 20px; ">
                <div style="flex: 1;">
                    <h6 >Payment Mode:</h6>
                    <h6 >Total Due:</h6>
                    <h6 >Date:</h6>
                    <h6 >Payment Status:</h6>
                    <!-- <h6 >Payment Paid:</h6> -->
                </div>
                <div style="flex: 1;">
                    <h6 id="nfpl_js_style_payment_mode" >CASH</h6>
                    <h6 id="nfpl_js_style_total_due" ></h6>
                    <h6 id="nfpl_js_style_date" ></h6>
                    
                    <h6 id="nfpl_js_style_payment_status" ></h6>
                    <!-- <p id="nfpl_js_style_payment_paid" ></p> -->
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



    <div id="nfpl_styles_booking_details" style="height: fit-content;">
        <h2 style="text-align:center;">Passenger Booking Details</h2>
        <div id="nfpl_styles_sub_booking_details">



            <div style="display: flex; flex-direction: column; width: 100%;">
                <div class="nfpl_styles_detail">
                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Reference #</strong>:</p>
                        <p id="nfpl_js_styles_reference">Loading...</p>
                    </div>

                    <h4 style="border-bottom: 1px solid #b5b5b5; border-top: 1px solid #b5b5b5">Forward Booking</h4>

                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Pickup Location:</strong></p>
                        <p id="nfpl_js_styles_pickup_location">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Dropoff Location:</strong></p>
                        <p id="nfpl_js_styles_dropoff_location">Loading...</p>
                    </div>

                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Pickup Time:</strong></p>
                        <p id="nfpl_js_styles_pickup_time">Loading...</p>
                    </div>
                    
                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Booked At:</strong></p>
                        <p id="nfpl_js_styles_booked_at">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Duration:</strong></p>
                        <p id="nfpl_js_styles_duration">Loading...</p>
                    </div>
                    <div class="nfpl_styles_detail_sub">
                        <p><strong>Via:</strong></p>
                        <p id="nfpl_js_styles_via_locations">Loading...</p>
                    </div>
                </div>


                <div  id="nfpl_js_styles_isReturn" class="nfpl_styles_detail" style="display: none; flex-direction:column;">
            <h4 style="border-bottom: 1px solid #b5b5b5; border-top: 1px solid #b5b5b5">Return Booking</h4>
            

            <div class="nfpl_styles_detail_sub">
                <p><strong>Pickup Location:</strong></p>
                <p id="nfpl_js_styles_pickup_location_return">Loading...</p>
            </div>
            <div class="nfpl_styles_detail_sub">

                <p><strong>Dropoff Location:</strong></p>
                <p id="nfpl_js_styles_dropoff_location_return">Loading...</p>

            </div>

            <div class="nfpl_styles_detail_sub">
                <p><strong>Pickup Time:</strong></p>
                <p id="nfpl_js_styles_pickup_time_return">Loading...</p>

            </div>
            <div class="nfpl_styles_detail_sub">
                <p><strong>Via:</strong></p>
                <p id="nfpl_js_styles_via_locations_return">Loading...</p>

            </div>
                </div>

            </div>
        </div>

       <div style="display:flex;
    justify-content:center;">
       <div id="nfpl_map_parent" style="
    max-width: 70%;
    max-height: 30%;
    display:flex;
    
    ">
        <img id="nfpl_map" src="" alt="Map Image" style="width: 100%; height: 100%; object-fit: contain;">
    </div>
       </div>
    </div>
    
</section>




<style>
    /* Booking Details Section */
    #nfpl_styles_booking_details {
        background: var(--var-nfpl-box-bg);
        width: 100%;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 3rem;
        border: 1px solid var(--var-nfpl-border-color);
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
        color: var(--var-nfpl-quote-h3-color);
        font-size: 1rem;
        padding-right: 1%;
        font-weight: 600;
        
    }

    .nfpl_styles_detail2 p {
        color: var(--var-nfpl-quote-p-color);
        margin: 0;
        font-size: 1rem;
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
        /* #nfpl_js_styles_isReturn{
            flex-direction: column;
        } */
        
    }

    @media (max-width: 768px) {
        #nfpl_map_parent{
            max-width: 100% !important;
        }
    }
</style>