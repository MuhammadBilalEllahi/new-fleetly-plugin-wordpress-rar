<section class="">
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
                        <input id="nfpl_js_style_form_email" name="customerEmail" type="email" class="nfpl_js_style_input_field"
                            placeholder="Email" value="" required />
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
                        <input id="nfpl_js_style_form_phNumber" name="customerPhone" type="text" class="nfpl_js_style_input_field"
                            placeholder="Phone Number" required />
                    </div>
                    <p style="color: red; font-size: small;" id="phoneError"></p>
                </div>




                <div>
                    <p>Landing Flight Number</p>
                    <div class="nfpl_js_style_input_container">
                        <div class="nfpl_js_style_input_label">
                            <i class="fa-solid fa-location-dot m-2"></i>
                        </div>
                        <input id="nfpl_js_style_flightNumber" name="nfpl_js_style_flightNumber" type="text" class="nfpl_js_style_input_field"
                            placeholder="Flight Number" required />
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
                        <button id="nfpl_js_style_Apply_voucher_button" style="height: fit-content; max-width: min-content;">
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
                            <input type="checkbox" class="checkbox-field nfpl_js_style_addon_input" data-booking-id="" />

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
                        <input id="nfpl_js_style_form_terms" name="nfpl_js_style_form_terms" type="checkbox" class="checkbox-field" />
                        <a href="/terms-and-conditions">I accept the terms and conditions.
                        </a>
                        <p id="nfpl_js_style_terms_error"
                            style="display: none; color: red; text-decoration: none !important; padding-left: 20px;">
                            please
                            accept the terms</p>
                    </label>
                </div>

                <button id="nfpl_js_style_submitPassengerInfo" class="btn-primary btn">
                    Proceed To Payment
                </button>
            </div>
        </div>

    </div>
</section>







<style>
    .nfpl_js_style_input_container {
        display: flex;
        align-items: center;
        border: 1px solid #b4b4b4;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        background: #fff;
    }

    .nfpl_js_style_input_label {
        padding: 0.5rem;
        color: #666;
        display: flex;
        align-items: center;
    }

    .nfpl_js_style_input_field {
        flex: 1;
        padding: 0.75rem;
        border: none;
        outline: none;
        font-size: 1rem;
        width: 100%;
    }

    .custom-dropdown {
        display: flex;
        align-items: center;
        min-width: 90px;
        margin-right: 10px;
    }

    .dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 0.3rem;
        z-index: 1000;
    }

    .nfpl_js_style_checkbox_label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .checkbox-field {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .nfpl_js_style_custom_select select {
        appearance: none;
        background: transparent;
        width: 100%;
        padding-right: 2rem;
        cursor: pointer;
    }

    .nfpl_js_style_custom_select::after {
        content: '▼';
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    textarea {
        width: 100%;
        border: 1px solid #b4b4b4;
        border-radius: 0.5rem;
        resize: vertical;
    }

    .btn-primary {
        background: #007bff;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        width: 100%;
        font-size: 1rem;
        margin-top: 1rem;
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    h5 {
        margin: 1.5rem 0 1rem;
        font-weight: 600;
    }

    .nfpl_js_styles_d_none {
        display: none;
    }

    /* Responsive Grid Layout */
    @media (min-width: 768px) {
        div[class^="booking-"] {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .full-width {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 767px) {
        .nfpl_js_style_input_container {
            margin-bottom: 0.75rem;
        }

        .btn-primary {
            padding: 0.75rem 1.5rem;
        }
    }

    /* Custom scrollbar for dropdowns */
    .dropdown-list::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .dropdown-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    /* Error states */
    .input-error {
        border-color: #dc3545;
    }

    p[id$="Error"] {
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
    }

    /* Success states */
    p[id$="Success"] {
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
    }

    /* Voucher section */
    #nfpl_js_style_Apply_voucher_button {
        background: #198754;
        color: white;
        border: none;
        border-radius: 0.3rem;
        padding: 0.5rem 1rem;
        cursor: pointer;
    }

    #nfpl_js_style_Apply_voucher_button:hover {
        background: #146c43;
    }
</style>




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
const getUserData= `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;



</script>


<!--  -->
<script>

    const getAllDataFromBookingId = async()=>{
       try {
        const response = await fetch(getUserData, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'tenant-widgetapikey': `${nfpl_var_apikey}`
                    }
                });
                const data = await response.json();
                console.log("Data: ", data);  

                document.getElementById("nfpl_js_style_form_from").value = data.from_desc;  
                document.getElementById("nfpl_js_style_form_to").value = data.to_desc; 

                
                // document.getElementById("nfpl_js_style_form_name").value = data.name;
                // document.getElementById("nfpl_js_style_form_email").value = data.email;
                // document.getElementById("nfpl_js_style_form_phNumber").value = data.phone;
                // document.getElementById("nfpl_js_style_form_from").value = data.complete_going_address;
                // document.getElementById("nfpl_js_style_form_to").value = data.complete_return_address;
                // document.getElementById("nfpl_js_style_no_of_passangers").value = data.numPassengers;
                // document.getElementById("nfpl_js_style_no_of_suitcases").value = data.numSuitcases;
                // document.getElementById("nfpl_js_style_flightNumber").value = data.flightIdNumber;
                // document.getElementById("waitingTimeAfterLanding").value = data.waitingTimeAfterLanding;
                // document.getElementById("nfpl_js_style_comment").value = data.comment;
                // document.getElementById("voucher").value = data.voucher;
                // document.getElementById("nfpl_js_style_bookingForSomeoneElse_Name").value = data.custName;
                // document.getElementById("nfpl_js_style_bookingForSomeoneElse_Email").value = data.custEmail;
                // document.getElementById("nfpl_js_style_bookingForSomeoneElse_PhNumber").value = data.custPhone;
                // document.getElementById("nfpl_js_style_searchCountryCode_customer").value = data.phone.slice(0, 3);
                // document.getElementById("nfpl_js_style_searchCountryCode_passenger").value = data.custPhone.slice(0, 3);





       } catch (error) {
        console.error("Error in getAllDataFromBookingId: ", error);
       }
        
    }

    document.addEventListener("DOMContentLoaded", (e)=>{
        
    getAllDataFromBookingId()
    })
    document.addEventListener("DOMContentLoaded", function () {




        // Initialize intlTelInput
        document.getElementById("nfpl_js_style_form_phNumber").addEventListener("input", () => {
            const phoneInput = document.getElementById("nfpl_js_style_form_phNumber");
            const phoneError = document.getElementById("phoneError");

            // Regular expression to allow only positive numbers and '+' sign
            const validPhoneRegex = /^[+]?[0-9]*$/;

            // Check if the input is valid
            if (!validPhoneRegex.test(phoneInput.value)) {
                phoneError.textContent = "Invalid phone number. Only numbers and '+' are allowed.";
                phoneInput.classList.add("error-border");
            } else {
                phoneError.textContent = ""; // Clear the error message
                phoneInput.classList.remove("error-border");
            }
            // Styling for error border
            const style = document.createElement("style");
            style.textContent = `
  .error-border {
    border-color: red !important;
  }
`;
            document.head.appendChild(style);
        });



        // voucher
        const voucherInput = document.getElementById("voucher");
        const voucherBtn = document.getElementById("nfpl_js_style_Apply_voucher_button");
        const voucherError = document.getElementById("voucherError");


        document.addEventListener("click", function (e) {
            if (e.target && e.target.id === "removeVoucherBtn") {

                if (!bookingId) return;

                e.preventDefault();
                e.target.disabled = true;


                fetch(nfpl_api_remove_voucher, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "tenant-widgetapikey": `${nfpl_var_apikey}`,
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        e.target.disabled = false;

                        // Update the booking pricing wrapper with the new pricing content
                        const bookingPricingWrapper = document.getElementById(
                            "bookingPricingWrapper"
                        );
                        if (bookingPricingWrapper) {
                            bookingPricingWrapper.innerHTML = data.pricingContent;
                        }

                        // Display success toast


                        showToast({
                            message: "Voucher removed successfully!",
                            type: "success",
                            duration: 2000,
                        });

                    })
                    .catch((err) => {
                        e.target.disabled = false;

                        // Log error and display error toast
                        console.error(err);
                        showToast({
                            message: "Something went Wrong!",
                            type: "error",
                            duration: 2000,
                        });

                    });
            }
        });

        voucherBtn.addEventListener("click", function (e) {
            const voucherValue = voucherInput.value;
            console.log("VOUCHER VALUE CHANGED", voucherValue, voucherValue.length);
            const loadingSpinner = document.getElementById("loadingSpinner-2");


            if (!voucherInput.value || !bookingId) return;

            if (voucherValue.length === 0) {
                voucherError.style.display = "none";
            } else {
                console.log("Val", voucherValue);

                e.target.disabled = true;
                fetch(nfpl_api_apply_voucher, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "tenant-widgetapikey": `${nfpl_var_apikey}`,

                    },
                    body: JSON.stringify({
                        code: voucherValue,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        e.target.disabled = false;
                        if (loadingSpinner) loadingSpinner.style.display = "none";
                        document.getElementById("bookingPricingWrapper").innerHTML =
                            data.pricingContent;
                        console.log("HEre");
                        console.log("RESPONSE: ", data);
                        voucherError.style.display = "none";
                        voucherSuccess.style.display = "block";
                        voucherSuccess.innerText = "Successfully Applied";


                        showToast({
                            message: "Voucher Applied successfully!",
                            type: "success",
                            duration: 2000,
                        });

                    })
                    .catch((err) => {
                        console.error("Error: ", err);
                        e.target.disabled = false;
                        voucherError.style.display = "block";
                        voucherSuccess.style.display = "none";

                        // voucherError.innerText = err.message || "Invalid voucher";
                        voucherError.innerText = "Invalid voucher";
                        showToast({
                            message: "Invalid Voucher!",
                            type: "error",
                            duration: 2000,
                        });
                    });
            }
        });

        const addonInputs = document.querySelectorAll(".nfpl_js_style_addon_input");
        addonInputs.forEach((input) => {
            input.addEventListener("click", function (e) {

                const selectedAddons = Array.from(addonInputs)
                    .filter(
                        (addon) =>
                            addon.checked &&
                            addon.getAttribute("data-booking-id") === bookingId
                    )
                    .map((addon) => addon.value);

                addonInputs.forEach((addon) => (addon.disabled = true));


                fetch(nfpl_api_add_addon_to_booking, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "tenant-widgetapikey": `${nfpl_var_apikey}`,

                    },
                    body: JSON.stringify({
                        addons: selectedAddons,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        addonInputs.forEach((addon) => (addon.disabled = false));
                        document.getElementById("bookingPricingWrapper").innerHTML =
                            data.pricingContent;
                        console.log(data.pricingContent);


                        showToast({
                            message: "Add-on processed  successfully!",
                            type: "success",
                            duration: 2000,
                        });
                    })
                    .catch((err) => {
                        addonInputs.forEach((addon) => (addon.disabled = false));
                        console.error(err);
                    });
            });
        });

        document
            .getElementById("nfpl_js_style_bookingForSomeoneElse_Checkbox")
            .addEventListener("change", function () {
                const bookingForSomeoneElse_Div = document.getElementById(
                    "bookingForSomeoneElse_Div"
                );

                const name = document.getElementById("nfpl_js_style_bookingForSomeoneElse_Name");
                const email = document.getElementById("nfpl_js_style_bookingForSomeoneElse_Email");
                const phoneNumber = document.getElementById(
                    "nfpl_js_style_bookingForSomeoneElse_PhNumber"
                );

                if (this.checked) {
                    bookingForSomeoneElse_Div.classList.remove("nfpl_js_styles_d_none");
                } else {
                    bookingForSomeoneElse_Div.classList.add("nfpl_js_styles_d_none");
                    name.value = "";
                    email.value = "";
                    phoneNumber.value = "";
                }
            });

        const submitBtn = document.getElementById("nfpl_js_style_submitPassengerInfo");
        submitBtn.addEventListener("click", function (e) {
            e.preventDefault();

            // Get all required input fields
            const fields = [
                { id: "nfpl_js_style_form_name", message: "Full Name is required" },
                { id: "nfpl_js_style_form_email", message: "Email is required" },
                { id: "nfpl_js_style_form_phNumber", message: "Phone Number is required" },
                { id: "nfpl_js_style_form_from", message: "Pickup location is required" },
                { id: "nfpl_js_style_form_to", message: "Dropoff location is required" },
            ];

            console.log(document.getElementById("nfpl_js_style_bookingForSomeoneElse_Checkbox").checked)
            if (document.getElementById("nfpl_js_style_bookingForSomeoneElse_Checkbox").checked) {
                fields.push(
                    { id: "nfpl_js_style_bookingForSomeoneElse_Name", message: "name required" },
                    { id: "nfpl_js_style_bookingForSomeoneElse_Email", message: "email required" },
                    { id: "nfpl_js_style_bookingForSomeoneElse_PhNumber", message: "phone required" })
            }
            // Clear any previous error messages
            fields.forEach((field) => {
                const input = document.getElementById(field.id);
                const errorElement = document.getElementById(`${field.id}-error`);
                if (errorElement) {
                    errorElement.remove();
                }
                input.classList.remove("error-border");
            });

            // Validate fields
            let isValid = true;
            fields.forEach((field) => {
                const input = document.getElementById(field.id);
                if (!input.value.trim()) {
                    // Add error message
                    const errorElement = document.createElement("p");
                    errorElement.id = `${field.id}-error`;
                    errorElement.style.color = "red";
                    errorElement.style.fontSize = "small";
                    errorElement.textContent = field.message;

                    input.parentNode.parentNode.appendChild(errorElement);
                    input.classList.add("error-border");

                    isValid = false;
                }
            });

            // Validate checkbox for terms
            const termsCheckbox = document.getElementById("nfpl_js_style_form_terms");
            const termsError = document.getElementById("nfpl_js_style_terms_error");
            if (!termsCheckbox.checked) {
                termsError.style.display = "block";
                isValid = false;
            } else {
                termsError.style.display = "none";
            }

            // If all fields are valid, proceed to the next step
            if (isValid) {
                console.log("Form is valid. Proceed to payment.");
                submitData();
            }

            fields.forEach((fieldId) => {
                // console.log(fieldId)
                const input = document.getElementById(fieldId.id);
                input.addEventListener("input", () => {
                    const errorElement = document.getElementById(`${fieldId.id}-error`);
                    // console.log("element",errorElement)
                    if (errorElement) {
                        errorElement.remove();
                    }
                    input.classList.remove("error-border");
                });
            });


            // Optional: Add styles for error borders
            const style = document.createElement("style");
            style.textContent = `
          .error-border {
            border-color: red !important;
          }`;
            document.head.appendChild(style);


            // phoneError.style.display = "none";
            // phoneError.style.display = "block";
            // phoneError.textContent = "Please enter a correct phone number";

        });

        function submitData() {
            const terms = document.getElementById("nfpl_js_style_form_terms").checked;
            const submitButton = document.getElementById("nfpl_js_style_submitPassengerInfo");
            const termsError = document.getElementById("nfpl_js_style_terms_error");



            console.log("before terms")
            if (!terms) {
                termsError.style.display = "block";
                return;
            }
            console.log("ok terms")
            termsError.style.display = "none";


            const addonInputs = document.querySelectorAll(".nfpl_js_style_addon_input");
            const addon_Ids = [];

            addonInputs.forEach((addon) => {
                if (addon.checked) {
                    addon_Ids.push(addon.value);
                }
            });

            console.log(addon_Ids);



            const searchInputCustomer = document.getElementById("nfpl_js_style_searchCountryCode_customer");
            const phoneInputCustomer = document.getElementById("nfpl_js_style_form_phNumber")
            const phoneCustomer = searchInputCustomer.value + "" + phoneInputCustomer.value


            console.log(phoneCustomer)
            const data = {
                name: document.getElementById("nfpl_js_style_form_name").value,
                email: document.getElementById("nfpl_js_style_form_email").value,
                phone: phoneCustomer,
                comment: document.getElementById("nfpl_js_style_comment").value,
                voucher: voucherInput.value,
                flightIdNumber: document.getElementById("nfpl_js_style_flightNumber").value,
                waitingTimeAfterLanding: document.getElementById("waitingTimeAfterLanding").value,
                terms: terms,

                addonIds: addon_Ids,
                complete_going_address: document.getElementById("nfpl_js_style_form_from").value,
                complete_return_address: document.getElementById("nfpl_js_style_form_to").value,
                numPassengers: document.getElementById("nfpl_js_style_no_of_passangers").value,
                numSuitcases: document.getElementById("nfpl_js_style_no_of_suitcases").value,


            };

            if (document.getElementById('nfpl_js_style_bookingForSomeoneElse_Checkbox').checked) {
                const searchInputPassenger = document.getElementById("nfpl_js_style_searchCountryCode_passenger");
                const phoneInputPassenger = document.getElementById("nfpl_js_style_bookingForSomeoneElse_PhNumber")
                const phonePassenger = searchInputPassenger.value + "" + phoneInputPassenger.value

                data.custName = document.getElementById("nfpl_js_style_bookingForSomeoneElse_Name").value
                data.custEmail = document.getElementById("nfpl_js_style_bookingForSomeoneElse_Email").value
                data.custPhone = phonePassenger
            }

            showLoadingOverlay("Processing your Information");



            console.table(data);

            fetch(
                nfpl_submit_api_WidgetPassengerDetailUrl,
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "tenant-widgetapikey": `${nfpl_var_apikey}`,

                    },
                    body: JSON.stringify(data),
                }
            )
                .then((response) => response.json())
                .then((response) => {
                    console.table(response);
                    hideLoadingOverlay();


                    window.location.href = `${paymentPageUrlAndPageNumber}?id=${response.bookingId}`;


                })
                .catch((err) => {
                    console.error("Error: ", err);
                    document.querySelector(
                        ".error-message-notification"
                    ).innerHTML = `<h3>${err.message || "An error occurred"}</h3>`;
                    hideLoadingOverlay();

                });
        }


    });



    // Hide nfpl_js_style_place input on click outside
    document.addEventListener("click", (e) => {
        document.querySelectorAll(".nfpl_js_style_dropdown_menu").forEach((dropDownMenu) => {
            // Close any open dropdown menu if the click is outside the input or dropdown
            if (!e.target.closest(".nfpl_js_style_place") || !e.target.classList.contains("nfpl_js_style_places_input")) {
                dropDownMenu.style.display = "none";
                dropDownMenu.classList.remove("show");
            }
        });
    });























    // Google api nfpl_js_style_place script
    // Inputs on InputFields when user types any character to find a location
    document.addEventListener("input", async function (event) {
        // Check if the event was triggered by an element with the 'nfpl_js_style_places_input' class
        if (event.target.classList.contains("nfpl_js_style_places_input")) {
            const inputField = event.target;
            const dropDownMenu = inputField.closest(".nfpl_js_style_place").querySelector(".nfpl_js_style_dropdown_menu");

            dropDownMenu.classList.add("show");
            dropDownMenu.style.display = "block";

            // Get input field's dimensions and position
            const inputRect = inputField.getBoundingClientRect();

            const query = inputField.value.trim();

            if (query.length === 0) {
                dropDownMenu.style.display = "none";
                dropDownMenu.classList.remove("show");
                return;
            }

            try {
                const response = await fetch(nfpl_var_apiUrl_Google, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "tenant-widgetapikey": `${nfpl_var_apikey}`,

                    },
                    body: JSON.stringify({ query }), // Send the query as JSON
                });

                if (!response.ok) throw new Error("Failed to fetch data");

                const places = await response.json(); // Parse JSON response

                // Clear previous results
                dropDownMenu.innerHTML = "";

                places.forEach(element => {
                    const truncatedText = element.description.substring(0, 55);
                    const remainingText = element.description.substring(55);
                    const item = document.createElement("button");
                    item.classList.add("nfpl_js_style_dropdown_item", "nfpl_js_style_place_result");
                    item.setAttribute("place_id", element.place_id);
                    item.setAttribute("description", element.description);

                    item.innerHTML = `
              <i class="icon-map-pin"></i>
              <span class="textDropDown" style="margin-bottom: 0;">${truncatedText}</span>
              <p class="textDropDown" style="margin-top: 0;">${remainingText}</p>
            `;
                    dropDownMenu.appendChild(item);
                });

                // Add click event to each dropdown item to set the value in the input field
                dropDownMenu.querySelectorAll(".nfpl_js_style_dropdown_item").forEach(item => {
                    item.addEventListener("click", function () {
                        const selectedValue = this.getAttribute("description");
                        const selectedPlaceId = this.getAttribute("place_id");

                        inputField.value = selectedValue; // Set input field value
                        dropDownMenu.style.display = "none"; // Hide dropdown after selection
                        dropDownMenu.classList.remove("show"); // Hide dropdown menu

                        // set nfpl_js_style_place id field on input field
                        inputField.setAttribute("place_id", selectedPlaceId)

                    });
                });

            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }
    });

</script>










<!--Phone Script-->
<script>
    async function loadCountryCodesWithSearch(inputId, dropdownId, flagImgId) {
        const searchInput = document.getElementById(inputId);
        const dropdownList = document.getElementById(dropdownId);
        const searchFlag = document.getElementById(flagImgId);
        // searchFlag.src =  "https://flagcdn.com/gb.svg"  

        // console.log("flages 2", searchFlag)


        try {
            const response = await fetch("https://restcountries.com/v3.1/all");
            const countries = await response.json();

            // Sort countries alphabetically by name
            countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

            // Store country data for filtering
            const countryData = countries.map(country => ({
                name: country.name.common,
                dialCode: country.idd?.root + (country.idd?.suffixes?.[0] || ""),
                flag: country.flags?.svg,
            }));

            // Populate the dropdown with all countries
            function populateDropdown(filteredCountries) {
                dropdownList.innerHTML = ""; // Clear existing items // flag-img

                filteredCountries.forEach(({ name, dialCode, flag }) => {
                    if (dialCode && flag) {
                        const item = document.createElement("div");
                        item.innerHTML = `
            <img src="${flag}" alt="flag" class="flag-icon">
            <span>${name} (${dialCode})</span>
          `;
                        // console.log("flag", flag, name)
                        item.addEventListener("click", () => {
                            searchInput.value = `${dialCode}`;
                            searchFlag.src = flag

                            // console.log("flag here",flag)
                            dropdownList.style.display = "none"; // Hide the dropdown
                        });
                        dropdownList.appendChild(item);
                    }
                });

                dropdownList.style.width = dropdownList.parentElement.parentElement.style.width;
                console.log("j", dropdownList.parentElement.parentElement, "l", dropdownList.style.width)

            }

            // Show all countries initially

            populateDropdown(countryData);

            // Filter countries on input
            searchInput.addEventListener("input", () => {
                const query = searchInput.value.toLowerCase();
                const filteredCountries = countryData.filter(({ name, dialCode }) =>
                    name.toLowerCase().includes(query) || dialCode.includes(query)
                );
                populateDropdown(filteredCountries);
            });

            // Hide dropdown on outside click
            document.addEventListener("click", (e) => {
                if (!e.target.closest(".custom-dropdown")) {
                    dropdownList.style.display = "none !important";
                }
            });
        } catch (error) {
            console.error("Error loading country codes:", error);
        }
    }

    // Initialize on page load
    loadCountryCodesWithSearch("nfpl_js_style_searchCountryCode_passenger", "dropdownList-passenger", "flag-img-passenger");
    loadCountryCodesWithSearch("nfpl_js_style_searchCountryCode_customer", "dropdownList-customer", "flag-img-customer");



    const searchInputCustomer = document.getElementById("nfpl_js_style_searchCountryCode_customer");
    const searchInputPassenger = document.getElementById("nfpl_js_style_searchCountryCode_passenger");

    const dropdownListCustomer = document.getElementById("dropdownList-customer");
    const dropdownListPassenger = document.getElementById("dropdownList-passenger");


    searchInputCustomer.addEventListener("click", () => {
        console.log(dropdownListCustomer.style.display, "here", dropdownListCustomer.style.display === "none")
        if (dropdownListCustomer.style.display === "none") {
            dropdownListCustomer.style.display = "block";
            console.log("check", dropdownListCustomer.style.display)

        }
    });

    searchInputPassenger.addEventListener("click", () => {
        console.log(dropdownListPassenger.style.display, "here", dropdownListPassenger.style.display === "none")
        if (dropdownListPassenger.style.display === "none") {
            dropdownListPassenger.style.display = "block";
            console.log("check", dropdownListPassenger.style.display)

        }
    });


</script>
<!--Phone Style-->
<style>
    .custom-dropdown {
        max-width: 100px;
        margin-right: 5px;
    }


    #nfpl_js_style_searchCountryCode_customer {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        font-size: 14px;
    }

    #nfpl_js_style_searchCountryCode_passenger {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        font-size: 14px;
    }




    .dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 200px;
        overflow-y: auto;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        z-index: 1000;
        display: none;
        /* Hidden by default */
    }

    .dropdown-list div {
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .dropdown-list div:hover {
        background-color: #f1f1f1;
    }

    .flag-icon {
        width: 20px;
        height: 15px;
        margin-right: 10px;
        vertical-align: middle;
    }
</style>