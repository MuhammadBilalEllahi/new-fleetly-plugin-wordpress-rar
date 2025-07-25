<?php
function enqueue_custom_plugin_assets_FOR_BOOKING_DETAIL_WIDGET()
{

    wp_enqueue_style('nfp_booking_detail_widget_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_booking_detail.css', array(), '1.0.0');
    wp_enqueue_script('nfp_booking_detail_widget_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_booking_detail.js', array(), '1.0.1', true);

}
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_BOOKING_DETAIL_WIDGET');

?>

<script>

    const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>';
    const nfpl_var_nfpl_API_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';

    const rawSearch = window.location.search;
    // console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    // console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    // console.log("Booking ID:", bookingId);


    // let nfpl_var_getFrom_UserData_returnBooking='';
    const nfpl_var_apiUrl_Google = `${nfpl_var_nfpl_API_apiUrlPrefixs}/api/public/google/autocomplete`;
    const nfpl_api_GET_WidgetPassengerDetailUrl = `${nfpl_var_nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-passenger-details/${bookingId}`;

    // const nfpl_GET_api_UserData = `${nfpl_var_nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;
    const nfpl_submit_api_POST_WidgetPassengerDetailUrl = `${nfpl_var_nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-passenger-details/${bookingId}`;
    const nfpl_api_POST_remove_voucher = `/dispatcher/widget-remove-voucher/${bookingId}`
    const nfpl_api_POST_apply_voucher = `/dispatcher/widget-apply-voucher/${bookingId}`
    const nfpl_api_POST_add_addon_to_booking = `${nfpl_var_nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-add-addon-to-booking/`
    // let nfpl_api_POST_add_addon_to_Return_booking = `/dispatcher/widget-add-addon-to-booking/${bookingId}`


    const paymentPageUrlAndPageNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(PAYMENT_DETAILS_WIDGET)); ?>';
    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

    const nfpl_headers = {
    ...getNFPLAuthHeaders(),
    "Content-Type": "application/json",
    "tenant-widgetapikey": `${nfpl_var_apikey}`,
    'tenant': tenantId,
    
}
</script> 


<section class="nfpl_booking_details_widget">
    <div class="">
        <div class="">



            <div class="">
                <h5 class="nfpl_style_js_heading">Passenger Information</h5>
            </div>

            <div class="nfpl_styles_1_form-container">

                <div class="nfpl_styles_form-grid">

                    <div class="nfpl_styles_form-group">
                        <p>Full Name</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <input id="nfpl_js_style_form_name" name="customerName" type="text"
                                class="nfpl_js_style_input_field" placeholder="Name" value="" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>

                    <div class="nfpl_styles_form-group">
                        <p>Email</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </div>
                            <input id="nfpl_js_style_form_email" name="customerEmail" type="email"
                                class="nfpl_js_style_input_field" placeholder="Email" value="" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>




                    <div class="nfpl_styles_form-group">
                        <p>Phone Number</p>
                        <div class="nfpl_js_style_input_container " style="position: relative;">
                            <!-- Custom Dropdown with Search -->
                            <div class="nfpl_styles_1_custom-dropdown">
                                <div style="border: 1px solid #b4b4b4 ; border-radius: 0.3rem;" class="nfpl_styles_1_custom-correct">
                                    <img id="nfpl_styles_1_flag-img-customer" src="https://flagcdn.com/gb.svg" width="30%"
                                        height="80%" style="margin-left: 4%;" />
                                    <input type="text" id="nfpl_js_style_searchCountryCode_customer"
                                        class="nfpl_js_style_input_field" style="border: none;" width="70%"
                                        placeholder="+0" value="+44" autocomplete="off" />
                                </div>
                                <div id="nfpl_styles_1_dropdownList-customer" style="display: none !important;" class="nfpl_styles_1_dropdown-list">
                                    <!-- Dynamic country list will be injected here -->
                                </div>
                            </div>
                            <!-- Phone Number Input -->
                            <input id="nfpl_js_style_form_phNumber" name="customerPhone" type="text"
                                class="nfpl_js_style_input_field" placeholder="Phone Number" required />
                        </div>
                        <p style="color: red; font-size: small;" id="phoneError"></p>
                    </div>

                </div>

                <div class="nfpl_styles_form-grid">


                    <div class="nfpl_styles_form-group">
                        <p>Landing Flight Number</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21 4 19 4s-2 2-3.5 3.5L11 16l-8.2 1.8c-.5.1-.8.6-.8 1.1s.3 1 .8 1.1L11 18.5 12.5 22c.1.5.6.8 1.1.8s1-.3 1.1-.8L16 13.5l5.2-1.8c.5-.1.8-.6.8-1.1s-.3-1-.8-1.1Z"/>
                                </svg>
                            </div>
                            <input id="nfpl_js_style_flightNumber" name="nfpl_js_style_flightNumber" type="text"
                                class="nfpl_js_style_input_field" placeholder="Flight Number" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>

                    <div class="nfpl_styles_form-group">
                        <p>Wait time after landing(minute)</p>
                        <div class="nfpl_js_style_input_container nfpl_js_style_custom_select"
                            style="position: relative">
                            <label class="nfpl_js_style_input_label" for="waitingTimeAfterLanding">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12,6 12,12 16,14"/>
                                </svg>
                            </label>
                            <select id="waitingTimeAfterLanding" name="waitingTimeAfterLanding"
                                class=" nfpl_js_style_input_field">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                                <option value="60">60</option>
                                <option value="65">65</option>
                                <option value="70">70</option>
                                <option value="75">75</option>
                                <option value="80">80</option>
                                <option value="85">85</option>
                                <option value="90">90</option>
                                <option value="95">95</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div class="nfpl_styles_form-group">
                        <p>Suitcases</p>
                        <div class="nfpl_js_style_input_container nfpl_js_style_custom_select"
                            style="position: relative">
                            <label class="nfpl_js_style_input_label" for="nfpl_js_style_no_of_suitcases">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <path d="M16 10H8a6 6 0 0 0-6 6v1c0 1 1 2 2 2h16c1 0 2-1 2-2v-1a6 6 0 0 0-6-6z"/>
                                    <path d="M9 12v4"/>
                                    <path d="M15 12v4"/>
                                </svg>
                            </label>
                            <select name="seats" id="nfpl_js_style_no_of_suitcases" class=" nfpl_js_style_input_field">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="nfpl_styles_form-grid">

                    <div class="nfpl_styles_form-group">
                        <p>Passengers</p>
                        <div class="nfpl_js_style_input_container nfpl_js_style_custom_select"
                            style="position: relative">
                            <label class="nfpl_js_style_input_label" for="nfpl_js_style_no_of_passangers">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </label>
                            <select name="seats" id="nfpl_js_style_no_of_passangers" class=" nfpl_js_style_input_field">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div id="">
                    <div>
                        <label class="nfpl_js_style_checkbox_label">
                            <input type="checkbox" class="checkbox-field" 
                                name="booking-else-passenger" id="nfpl_js_style_bookingForSomeoneElse_Checkbox" />
                            Booking for Someone Else?
                        </label>
                    </div>
                </div>

                <div id="nfpl_styles_1_bookingForSomeoneElse_Div" class=" nfpl_js_styles_d_none">

                    <div class="nfpl_styles_form-grid">
                        <div class="nfpl_styles_form-group">
                            <p>Passenger Name</p>
                            <div class="nfpl_js_style_input_container">
                                <div class="nfpl_js_style_input_label">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </div>
                                <input id="nfpl_js_style_bookingForSomeoneElse_Name"
                                    name="nfpl_js_style_bookingForSomeoneElse_Name" type="text"
                                    class="nfpl_js_style_input_field" placeholder="Passenger Name" required />
                                <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                            </div>
                        </div>

                        <div class="nfpl_styles_form-group">
                            <p>Passenger Email</p>
                            <div class="nfpl_js_style_input_container">
                                <div class="nfpl_js_style_input_label">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </div>
                                <input id="nfpl_js_style_bookingForSomeoneElse_Email" name="customerEmail" type="text"
                                    class="nfpl_js_style_input_field" placeholder="Passenger Email" required />
                                <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                            </div>
                        </div>


                        <div class="nfpl_styles_form-group">
                            <p>Passenger Phone</p>
                            <div class="nfpl_js_style_input_container " style="position: relative;">
                                <!-- Custom Dropdown with Search -->
                                <div class="nfpl_styles_1_custom-dropdown">
                                    <div style="border: 1px solid #b4b4b4 ; border-radius: 0.3rem;"
                                        class="nfpl_styles_1_custom-correct">
                                        <img id="nfpl_styles_1_flag-img-passenger" src="https://flagcdn.com/gb.svg" width="30%"
                                            height="80%" style="margin-left: 4%;" />
                                        <input type="text" id="nfpl_js_style_searchCountryCode_passenger"
                                            class="nfpl_js_style_input_field px-0" style="border: none;" width="70%"
                                            placeholder="+0" value="+44" autocomplete="off" />
                                    </div>
                                    <div id="nfpl_styles_1_dropdownList-passenger" style="display: none !important;"
                                        class="nfpl_styles_1_dropdown-list">
                                        <!-- Dynamic country list will be injected here -->
                                    </div>
                                </div>
                                <!-- Phone Number Input -->
                                <input id="nfpl_js_style_bookingForSomeoneElse_PhNumber"
                                    name="nfpl_js_style_bookingForSomeoneElse_PhNumber" type="text"
                                    class="nfpl_js_style_input_field" placeholder="Passenger Phone Number" required />
                            </div>
                            <p style="color: red; font-size: small;" id="phoneError"></p>
                        </div>


                    </div>

                </div>

                <div class="nfpl_styles_form-grid">
                    <div class="nfpl_styles_form-group">
                        <p>Voucher</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14,2 14,8 20,8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10,9 9,9 8,9"/>
                                </svg>
                            </div>
                            <input  id="voucher" type="text" class="nfpl_js_style_input_field"
                                placeholder="Voucher" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                        <p style="color: red; font-size: small; font-weight: 500" id="nfpl_styles_1_voucherError"></p>
                        <p style="color: #198754; font-size: small; font-weight: 500" id="nfpl_styles_1_voucherSuccess"></p>
                    </div>

                    <div class="nfpl_styles_form-group" style="justify-content: end;">
                        <button id="nfpl_js_style_Apply_voucher_button"
                            style="height: fit-content; max-width: min-content;">
                            <p style="color: var(--var-nfpl-light-text)">Apply</p>
                        </button>
                    </div>
                </div>



                <div class="nfpl_styles_form-grid">
                    <div class="nfpl_styles_form-group">
                        <p>Pickup</p>
                        <div class="nfpl_js_style_place nfpl_js_style_input_container" style="position: relative;">
                            <div class="nfpl_js_style_input_label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <input id="nfpl_js_style_form_from" type="text" autocomplete="off"
                                class="nfpl_js_style_input_field nfpl_js_style_places_input" placeholder="From" value=""
                                required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>

                    <div class="nfpl_styles_form-group">
                        <p>Dropoff</p>
                        <div class="nfpl_js_style_place nfpl_js_style_input_container" style="position: relative;">
                            <div class="nfpl_js_style_input_label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <input id="nfpl_js_style_form_to" autocomplete="off" name="end-dest" type="text"
                                class="nfpl_js_style_input_field nfpl_js_style_places_input" placeholder="To" value=""
                                required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>

                </div>




                <div class="" >
                    <h5>Select Add-Ons</h5>
                    <div id="nfpl_js_style_journeyAddons" >
                        
                    </div>

                </div>


                <hr />
                <div class="">
                    <h5>Return Add Ons</h5>
                    <div id="nfpl_js_style_returnJourneyAddons">
                       
                    </div>
                </div>

                <hr />

<div id="nfpl_styles_1_bookingPricingWrapper">
  <!-- <h2>Forward Booking</h2> -->
  <table id="nfpl_styles_1_forwardBookingDetails" class="booking-table"></table>
  <!-- <h2>Return Booking</h2> -->
  <table id="nfpl_styles_1_returnBookingDetails" class="booking-table" style="display: none;"></table>
  <div id="nfpl_styles_1_totalPriceBookingDetails"></div>
</div>

                <div class=" my-2">
                    <h5 class="">Comment?</h5>
                    <textarea id="nfpl_js_style_comment" class=" p-1"
                        style="max-height: 7rem; min-height: 5rem"></textarea>
                </div>

                <div class="">
                    <div class="my-1">
                        <label class="nfpl_js_style_checkbox_label" for="nfpl_js_style_form_terms">
                            <input id="nfpl_js_style_form_terms" name="nfpl_js_style_form_terms" type="checkbox"
                                class="checkbox-field" />
                            I accept the <a href="<?php echo nfpl_function_get_terms_and_conditions_url() ?>">terms and
                                conditions.
                            </a>
                            <p id="nfpl_js_style_terms_error"
                                style="display: none; color: red; text-decoration: none !important; padding-left: 20px;">
                                please
                                accept the terms</p>
                        </label>
                    </div>

                    <button id="nfpl_js_style_submitPassengerInfo" class="nfpl-btn">
                        Proceed To Payment
                    </button>
                </div>
            </div>

        </div>

</section>


<div class="nfpl_booking_container">
  <img src="https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyBxlCPMKTJnAEuy43rjvfhkZ8twF0Wumdo&size=500x400&markers=color%3Ablue%7Csize%3Amid%7Cscale%3A4%7C51.764391%2C-1.2188774%7C51.5098597%2C-0.1342809&path=weight%3A3%7Ccolor%3Ablue%7Cenc%3Ay~%7CzHlamFT%60%40t%40%3FPNe%40xAyC%7CFeDfJKzAtDjJV~AnBwBlOqMzKwKdDyDiJqa%40qIsc%40kCoPcCkX%7D%40iNoAyIi%40%7BAXw%40zAuX~%40qZkBqd%40_C%7D%5ELkm%40j%40iLlByLvOos%40tOot%40hCyIvIyQnVsZvFoMbE%7DOlB%7BNx%40aNxAcWzEi%60%40fHgZxGsQzWwk%40bKuWlEiQlL%7Br%40fCsVKqY%60%40kPdCcMp%5Bu_A%60Sem%40zKwf%40jEy%5CbBkTjH%7Bs%40pHia%40hN%7Df%40zRod%40vPsZrNw%5EnQqn%40%7CNga%40bS%7Ba%40nLsRbXg%5D%7COwO~YcXvUu%5BvTg%5ElFsGxQ%7DOpOaI%7CPaNnMyQlJoTxIm%5EpCaU%7CAac%40ImNkBs%5EaAi%5DdAy%5BtBwQrPk%7D%40~C%7BO~Je%5BzGwMfKeNnG%7BFdRuK%60b%40qV%60QoMpP%7DOrJkMdLuRvQmd%40dHsWzDmSrCe%5DJ%7BWq%40m%5D%5EgNbBkP~D%7BTtAcQJyPw%40wYd%40%7BSfDqVbTsq%40jx%40geC~DuRbBaPp%40sQEaRwIyhAyEej%40wH_%7C%40e%40wONcPlCyY~EgTjHk%5ChDab%40RoRa%40aTaAm%5Bh%40eV%7CBmUnCsMhBuGvHmQrIyOlDgKfCqNfAcSb%40gUrAgPpHo%5CxRmw%40fBaOj%40gPaAoj%40sAyn%40Uqv%40hDcn%40jHqg%40%7CNqt%40t%5CkcBzVqoArJ_g%40nCgLhG_O~D%7BFnIoH%7COyJvLwMjIsO~EsNtJwf%40jKsd%40%7CPwj%40~AqKpA%7BL%7C%40qOl%40%7BVHqTpAiF~C%7BEpHsK%7CDsIvHcX%60BmDrDmCfF%7B%40hFyBtHwGlHsKlHsO%60DiKbCyJbCcNvDwWdCyJhJyRlFkGnF%7BDn%5CqL%60ReEbUyC%7CWmA%60%5Df%40nOvBnUfJjNfDvKJtGu%40fJ%7DCbQgMvNcLpJgG%60HiGtF%7BG~I%7BOzAiG%5CyJ%5CiY%3FgX%7BF_xAWck%40%60Aci%40pEabAnFibBhEyuAzAaRjFg%5ClIye%40%60DaY%7C%40mZI%7DMoBw%5CyDyg%40eDkd%40%7DGo%5DeMqd%40iDwVyDgfAm%40iZ%60AoWpCwOhNsd%40bLg_%40rDcRf%40sRgAqOyF_WkBiQ%3Fu%7B%40q%40wMyF%7BUDcGxCcRdKeZxFuUrBoRb%40iLvAqSFut%40tBe%5Dg%40eEmDcMqLw%60%40aEoWY%7DUnAga%40i%40%7B%5DWih%40nAqOVqLH_Mj%40gLIyK_BwPmBsS%7DBoIcDsF%7BCsLwBaJ%7B%40_KLwc%40oAwa%40iCoz%40qAgNwBaJyEeKgJ%7DSmKsNeAqGs%40wGsAsRkAoQMoB_AqBeBf%40k%40bCg%40d%40%7BB_%40aEJw%40%60%40Ys%40n%40_CSi%40s%40mJeAeMmD%7C%40cEkJ%7DE~Fy%40Bk%40qDf%40oAcCuG%7BAgEwDiFT%7BA%60B%7DAkAcEEwArFyEtBcCh%40kCO%7BI%40iF" 
       alt="Map Preview" class="nfpl_styles_1_map-image">
  <h2>PASSENGER BOOKING DETAILS</h2>
  <p style="text-align: center;"><strong>Reference #:</strong> <span id="nfpl_styles_1_referenceNumber"></span></p>
  
  <div class="nfpl_styles_1_booking_details_div">
    <div id="nfpl_styles_1_pickupDetails"></div>
    <div id="nfpl_styles_1_returnDetails"></div>
  </div>
</div>



