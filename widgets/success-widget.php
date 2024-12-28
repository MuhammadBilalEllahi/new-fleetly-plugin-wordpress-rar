<?php 
function enqueue_custom_plugin_assets_FOR_INSTANT_QUOTE_WIDGET(){

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
    const apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);
    const req_GET_success_InfoOnLoadUrl = `${apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;
    const req_GET_price = `${apiUrlPrefixs}/plugin/dispatcher/widget-booking/${bookingId}/price`


    const headers = {
        'Content-Type': 'application/json',
        'tenant-widgetapikey': `${apikey}`
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
                </div>
                <div style="flex: 1;">
                    <p id="nfpl_js_style_payment_mode" style="margin-bottom: 5px; font-weight: bold;">CASH</p>
                    <p id="nfpl_js_style_total_due" style="margin-bottom: 5px;"></p>
                    <p id="nfpl_js_style_date" style="margin-bottom: 5px;"></p>
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
</section>