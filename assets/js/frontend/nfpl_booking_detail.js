

const getAllDataFromBookingId = async () => {
    try {
        const response = await fetch(nfpl_api_GET_WidgetPassengerDetailUrl, {
            method: 'GET',
            headers: nfpl_headers
        });
        const data = await response.json();
        console.log("Data: ", data);

        const booking = data.booking;
        const returnBooking = data.returnBooking;

        displayBookingDetails(booking, returnBooking)


        document.getElementById("nfpl_js_style_form_from").value = data.booking.from_desc;
        document.getElementById("nfpl_js_style_form_to").value = data.booking.to_desc;

        const forwardAddonList = document.getElementById('nfpl_js_style_journeyAddons')
        const returnAddonList = document.getElementById('nfpl_js_style_returnJourneyAddons')

        const nfpl_js_style_form_name = document.getElementById('nfpl_js_style_form_name')
        const nfpl_js_style_form_email = document.getElementById('nfpl_js_style_form_email')
        const nfpl_js_style_form_phNumber = document.getElementById('nfpl_js_style_form_phNumber')


        console.log(data.customer.name,
            data.customer.email,
            data.customer.phone)

        nfpl_js_style_form_name.value = data?.customer?.name ?? '';
        nfpl_js_style_form_email.value = data?.customer?.email ?? '';
        nfpl_js_style_form_phNumber.value = data?.customer?.phone ?? '';

        if (data?.addonsDefaultList.length != 0) {
            data.addonsDefaultList.map(addon => {
                console.log("ADDONS", addon)

                const isCheckedForward =
                    data.booking.addons.some((forwardAddon) => forwardAddon._id === addon._id);
                const isCheckedReturn =
                    data?.returnBooking?.addons.some((returnAddon) => returnAddon._id === addon._id);


                const addonDiv = document.createElement('div');

                // Add HTML content to the div
                addonDiv.innerHTML = `
                                    <label class="nfpl_js_style_checkbox_label">
                                        ${addon.title} <span>${addon.amount}</span>
                                        <input type="checkbox"  
                                        value="${addon._id}" 
                                        ${isCheckedForward && "checked"}
                                        class="checkbox-field nfpl_js_style_addon_input" 
                                        data-bookingid="${data.booking._id}" 
                                        data-isreturn="false" />
                                    </label>
                                `;

                // Append the div to the forwardAddonList
                forwardAddonList.appendChild(addonDiv);


                if (data.returnBooking) {
                    const returnAddonDiv = document.createElement('div');

                    // Add HTML content to the div
                    returnAddonDiv.innerHTML = `
                                                <label class="nfpl_js_style_checkbox_label">
                                                    ${addon.title} <span>${addon.amount}</span>
                                                    <input type="checkbox"
                                                     value="${addon._id}" 
                                                     ${isCheckedReturn && "checked"}

                                                     class="checkbox-field nfpl_js_style_addon_input"
                                                      data-bookingid="${data.returnBooking._id}"
                                                       data-isreturn="true" />
                                                </label>
                                            `;

                    // Append the div to the forwardAddonList
                    returnAddonList.appendChild(returnAddonDiv);
                }

            })
        }


        const addonInputs = document.querySelectorAll(".nfpl_js_style_addon_input");
        addonInputs && addonInputs.forEach((input) => {
            input.addEventListener("click", function (e) {

                const isReturn = e.target.dataset.isreturn
                console.log("ISRETUR", isReturn)

                const selectedAddons = Array.from(addonInputs)
                    .filter(
                        (addon) => {
                            console.log("here", addon)
                            return addon.checked && addon.dataset.bookingid && addon.dataset.isreturn === String(isReturn)
                        }
                    )
                    .map((addon) => addon.value);

                console.log("sel", selectedAddons)
                addonInputs.forEach((addon) => (addon.disabled = true));

                const nfpl_var_from_addon_bookingId = e.target.dataset.bookingid;
                // console.log("LO", nfpl_var_from_addon_bookingId, e.target, e.target.dataset.bookingid)
                console.log("log", selectedAddons)
                console.log("URL", nfpl_api_POST_add_addon_to_booking + nfpl_var_from_addon_bookingId)

                // data-bookindId
                fetch(nfpl_api_POST_add_addon_to_booking + nfpl_var_from_addon_bookingId, {
                    method: "POST",
                    headers: nfpl_headers,
                    body: JSON.stringify({
                        addons: selectedAddons,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data)
                        addonInputs.forEach((addon) => (addon.disabled = false));


                        const booking = data.booking;
                        const returnBooking = data.returnBooking
                        displayBookingDetails(booking, returnBooking)
                        console.log(data);


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












        console.log("sett", data.booking)


        // Populate booking details
        document.getElementById("referenceNumber").textContent = data.booking.reference;

        const pickupDetails = `
  <h3 class="nfpl_styles_booking_h3">Pickup Booking</h3>
  <p> <strong>Pickup Time:</strong> ${data.booking.startDate}</p>
  <p> <strong>Pickup Location:</strong> ${data.booking.from_desc}</p>
  <p> <strong>Dropoff Location:</strong> ${data.booking.to_desc}</p>
`;

        document.getElementById("pickupDetails").innerHTML = pickupDetails;

        if (data.returnBooking) {

            const returnDetails = `
        <h3 class="nfpl_styles_booking_h3">Return Booking</h3>
        <p> <strong> Return Pickup Time: </strong> ${data.returnBooking.startDate}</p>
        <p> <strong> Return Pickup Location: </strong> ${data.returnBooking.from_desc}</p>
        <p> <strong> Return Dropoff Location: </strong> ${data.returnBooking.to_desc}</p>
      `;

            document.getElementById("returnDetails").innerHTML = returnDetails;
        }




    } catch (error) {
        console.error("Error in getAllDataFromBookingId: ", error);
    }

}



/**
 * Display booking details in a compact table format.
 *
 * @param {Object} booking - Forward booking details.
 * @param {Object} returnBooking - Return booking details.
 */
function displayBookingDetails(booking, returnBooking) {
    const forwardBookingDetails = document.getElementById('forwardBookingDetails');
    const returnBookingDetails = document.getElementById('returnBookingDetails');
    const totalPriceDiv = document.getElementById('totalPriceBookingDetails');


    console.log("displayBookingDetails", booking, returnBooking);

    const totalPrice = booking.priceToCharge + (returnBooking ? returnBooking.priceToCharge : 0);


    // Helper function to generate rows for booking details
    const generateBookingRows = (data) => {
        const rows = `
            <tr >
                <th class="booking-table-th-td">Price to Charge</th>
                <td class="booking-table-th-td">${data.priceToCharge || 'N/A'}</td>
            </tr>
            
            ${data.voucherDiscount
                ? `<tr>
                    <th class="booking-table-th-td">Voucher Discount</th>
                    <td class="booking-table-th-td">${data.voucherDiscount}</td>
                   </tr>`
                : ''}
            ${data.addons && data.addons.length > 0
                ? data.addons.map(addon => `
                    <tr>
                        <th class="booking-table-th-td">Add-on</th>
                        <td class="booking-table-th-td">${addon.title} - ${addon.amount}</td>
                    </tr>`).join('')
                : ''}
        `;
        return rows;
    };

    // Populate forward booking details
    forwardBookingDetails.innerHTML = `
        <tr><th colspan="2">Forward Booking</th></tr>
        ${generateBookingRows(booking)}
    `;

    // Populate return booking details if present
    if (returnBooking) {
        returnBookingDetails.style.display = 'table';
        returnBookingDetails.innerHTML = `
            <tr><th colspan="2">Return Booking</th></tr>
            ${generateBookingRows(returnBooking)}
        `;
    }

    totalPriceDiv.innerHTML = `
    <tr>
    <th class="booking-table-th-td">Total Price</th>
    <td class="booking-table-th-td">${totalPrice || 'N/A'}</td>
</tr>`
}

document.addEventListener("DOMContentLoaded", (e) => {

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


            fetch(nfpl_api_POST_remove_voucher, {
                method: "POST",
                headers: nfpl_headers,
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
            fetch(nfpl_api_POST_apply_voucher, {
                method: "POST",
                headers: nfpl_headers,
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
            nfpl_submit_api_POST_WidgetPassengerDetailUrl,
            {
                method: "POST",
                headers: nfpl_headers,
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
                headers: nfpl_headers,
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






/**
 * Clears all input fields in the booking widget.
 */
function clearBookingFormFields() {
    // Get all input fields within the widget container

    const inputs = document.querySelectorAll(
        ".nfpl_booking_details_widget input"
    );

    inputs.forEach((input) => {
        // Clear the value of each input field
        input.value = "";

    });

}

/**
 * Handles the 'popstate' or 'beforeunload' events to clear form fields when navigating.
 */
window.addEventListener("beforeunload", clearBookingFormFields);
window.addEventListener("popstate", clearBookingFormFields);
