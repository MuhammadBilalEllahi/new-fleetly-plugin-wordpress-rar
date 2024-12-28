<?php 
function enqueue_custom_plugin_assets_FOR_BOOKING_DETAIL_WIDGET(){

    wp_enqueue_style('nfp_booking_detail_widget_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_booking_detail.css', array(), '1.0.1');
    wp_enqueue_script('nfp_booking_detail_widget_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_booking_detail.js', array(), '1.0.1',true);

} 
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_BOOKING_DETAIL_WIDGET');

?>

<script>

    const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>';
    const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';

    const rawSearch = window.location.search;
    // console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    // console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    // console.log("Booking ID:", bookingId);


    const nfpl_var_apiUrl_Google = `${nfpl_var_apiUrlPrefixs}/api/public/google/autocomplete`;
    const nfpl_submit_api_WidgetPassengerDetailUrl = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-passenger-details/${bookingId}`;
    const nfpl_api_remove_voucher = `/dispatcher/remove-voucher/${bookingId}`
    const nfpl_api_apply_voucher = `/dispatcher/apply-voucher/${bookingId}`
    const nfpl_api_add_addon_to_booking = `/dispatcher/add-addon-to-booking/${bookingId}`


    const paymentPageUrlAndPageNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(PAYMENT_DETAILS_WIDGET)); ?>';
    const getUserData = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;



</script>


<section class="nfpl_booking_details_widget">
    <div class="">
        <div class="">



            <div class="">
                <h5>Passenger Information</h5>
            </div>

            <div>
                <div>
                    <p>Full Name</p>
                    <div class="nfpl_js_style_input_container">
                        <div class="nfpl_js_style_input_label">
                            <i class="fa-solid fa-location-dot m-2"></i>
                        </div>
                        <input id="nfpl_js_style_form_name" name="customerName" type="text"
                            class="nfpl_js_style_input_field" placeholder="Name" value="" required />
                        <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                    </div>
                </div>

                <div>
                    <p>Email</p>
                    <div class="nfpl_js_style_input_container">
                        <div class="nfpl_js_style_input_label">
                            <i class="fa-solid fa-location-dot m-2"></i>
                        </div>
                        <input id="nfpl_js_style_form_email" name="customerEmail" type="email"
                            class="nfpl_js_style_input_field" placeholder="Email" value="" required />
                        <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                    </div>
                </div>




                <div>
                    <p>Phone Number</p>
                    <div class="nfpl_js_style_input_container " style="position: relative;">
                        <!-- Custom Dropdown with Search -->
                        <div class="custom-dropdown">
                            <div style="border: 1px solid #b4b4b4 ; border-radius: 0.3rem;">
                                <img id="flag-img-customer" src="https://flagcdn.com/gb.svg" width="30%" height="80%"
                                    style="margin-left: 4%;" />
                                <input type="text" id="nfpl_js_style_searchCountryCode_customer"
                                    class="nfpl_js_style_input_field px-0" style="border: none;" width="70%"
                                    placeholder="+0" value="+44" autocomplete="off" />
                            </div>
                            <div id="dropdownList-customer" style="display: none !important;" class="dropdown-list">
                                <!-- Dynamic country list will be injected here -->
                            </div>
                        </div>
                        <!-- Phone Number Input -->
                        <input id="nfpl_js_style_form_phNumber" name="customerPhone" type="text"
                            class="nfpl_js_style_input_field" placeholder="Phone Number" required />
                    </div>
                    <p style="color: red; font-size: small;" id="phoneError"></p>
                </div>




                <div>
                    <p>Landing Flight Number</p>
                    <div class="nfpl_js_style_input_container">
                        <div class="nfpl_js_style_input_label">
                            <i class="fa-solid fa-location-dot m-2"></i>
                        </div>
                        <input id="nfpl_js_style_flightNumber" name="nfpl_js_style_flightNumber" type="text"
                            class="nfpl_js_style_input_field" placeholder="Flight Number" required />
                        <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                    </div>
                </div>

                <div>
                    <p>Wait time after landing(minute)</p>
                    <div class="nfpl_js_style_input_container nfpl_js_style_custom_select" style="position: relative">
                        <label class="nfpl_js_style_input_label" for="waitingTimeAfterLanding">
                            <i class="fa-solid fa-clock m-2"></i>
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

                <div>
                    <p>No. of Suitcases</p>
                    <div class="nfpl_js_style_input_container nfpl_js_style_custom_select" style="position: relative">
                        <label class="nfpl_js_style_input_label" for="nfpl_js_style_no_of_suitcases">
                            <i class="fa-solid fa-clock m-2"></i>
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

                <div>
                    <p>No. of Passengers</p>
                    <div class="nfpl_js_style_input_container nfpl_js_style_custom_select" style="position: relative">
                        <label class="nfpl_js_style_input_label" for="nfpl_js_style_no_of_passangers">
                            <i class="fa-solid fa-clock m-2"></i>
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

                <div id="">
                    <div>
                        <label class="nfpl_js_style_checkbox_label">
                            <input type="checkbox" class="checkbox-field" data-booking-id=""
                                name="booking-else-passenger" id="nfpl_js_style_bookingForSomeoneElse_Checkbox" />
                            Booking for Someone Else?
                        </label>
                    </div>
                </div>

                <div id="bookingForSomeoneElse_Div" class=" nfpl_js_styles_d_none">
                    <div>
                        <p>Passenger Name</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <i class="fa-solid fa-location-dot m-2"></i>
                            </div>
                            <input id="nfpl_js_style_bookingForSomeoneElse_Name"
                                name="nfpl_js_style_bookingForSomeoneElse_Name" type="text"
                                class="nfpl_js_style_input_field" placeholder="Passenger Name" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>

                    <div>
                        <p>Passenger Email</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <i class="fa-solid fa-location-dot m-2"></i>
                            </div>
                            <input id="nfpl_js_style_bookingForSomeoneElse_Email" name="customerEmail" type="text"
                                class="nfpl_js_style_input_field" placeholder="Passenger Email" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                    </div>


                    <div>
                        <p>Passenger Phone</p>
                        <div class="nfpl_js_style_input_container " style="position: relative;">
                            <!-- Custom Dropdown with Search -->
                            <div class="custom-dropdown">
                                <div style="border: 1px solid #b4b4b4 ; border-radius: 0.3rem;">
                                    <img id="flag-img-passenger" src="https://flagcdn.com/gb.svg" width="30%"
                                        height="80%" style="margin-left: 4%;" />
                                    <input type="text" id="nfpl_js_style_searchCountryCode_passenger"
                                        class="nfpl_js_style_input_field px-0" style="border: none;" width="70%"
                                        placeholder="+0" value="+44" autocomplete="off" />
                                </div>
                                <div id="dropdownList-passenger" style="display: none !important;"
                                    class="dropdown-list">
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

                <div class="">
                    <div>
                        <p>Voucher</p>
                        <div class="nfpl_js_style_input_container">
                            <div class="nfpl_js_style_input_label">
                                <i class="fa-solid fa-location-dot m-2"></i>
                            </div>
                            <input data-booking-id="" id="voucher" type="text" class="nfpl_js_style_input_field"
                                placeholder="Voucher" required />
                            <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                        </div>
                        <p style="color: red; font-size: small; font-weight: 500" id="voucherError"></p>
                        <p style="color: #198754; font-size: small; font-weight: 500" id="voucherSuccess"></p>
                    </div>

                    <div class="align-items-end  col-11 col-sm-6 col-lg-4 my-2">
                        <button id="nfpl_js_style_Apply_voucher_button"
                            style="height: fit-content; max-width: min-content;">
                            <p style="color: var(--var-light-text)">Apply</p>
                        </button>
                    </div>
                </div>

                <div>
                    <p>Pickup</p>
                    <div class="nfpl_js_style_place nfpl_js_style_input_container" style="position: relative;">
                        <div class="nfpl_js_style_input_label">
                            <i class="fa-solid fa-location-dot m-2"></i>
                        </div>
                        <input id="nfpl_js_style_form_from" type="text" autocomplete="off"
                            class="nfpl_js_style_input_field nfpl_js_style_places_input" placeholder="From" value=""
                            required />
                        <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                    </div>
                </div>

                <div>
                    <p>Dropoff</p>
                    <div class="nfpl_js_style_place nfpl_js_style_input_container" style="position: relative;">
                        <div class="nfpl_js_style_input_label">
                            <i class="fa-solid fa-location-dot m-2"></i>
                        </div>
                        <input id="nfpl_js_style_form_to" autocomplete="off" name="end-dest" type="text"
                            class="nfpl_js_style_input_field nfpl_js_style_places_input" placeholder="To" value=""
                            required />
                        <div class="nfpl_js_style_dropdown_menu nfpl_js_style_dropdown_m"></div>
                    </div>
                </div>
            </div>



            <div id="nfpl_style_journeyAddons" class="" data-booking-id="">
                <h5>Select Add-Ons</h5>
                <div>

                    <div>
                        <label class="nfpl_js_style_checkbox_label">
                            <input data-booking-id="" />
                        </label>
                    </div>

                </div>
            </div>


            <hr />
            <div class="">
                <h5>Return Add Ons</h5>
                <div id="returnJourneyAddons">

                    <div>
                        <label class="nfpl_js_style_checkbox_label">
                            <input type="checkbox" class="checkbox-field nfpl_js_style_addon_input"
                                data-booking-id="" />

                        </label>
                    </div>
                </div>
            </div>

            <hr />

            <div class=" my-2">
                <h5 class="">Comment?</h5>
                <textarea id="nfpl_js_style_comment" class=" p-1" style="max-height: 7rem; min-height: 5rem"></textarea>
            </div>

            <div class=" flex-column ">
                <div class="my-1">
                    <label class="nfpl_js_style_checkbox_label" for="nfpl_js_style_form_terms">
                        <input id="nfpl_js_style_form_terms" name="nfpl_js_style_form_terms" type="checkbox"
                            class="checkbox-field" />
                            I accept the  <a href="/terms-and-conditions">terms and conditions.
                        </a>
                        <p id="nfpl_js_style_terms_error"
                            style="display: none; color: red; text-decoration: none !important; padding-left: 20px;">
                            please
                            accept the terms</p>
                    </label>
                </div> 

                <button id="nfpl_js_style_submitPassengerInfo" >
                    Proceed To Payment
                </button>
            </div>
        </div>

    </div>
</section>