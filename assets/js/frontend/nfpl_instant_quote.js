
let nfpl_js_styles_ViaReturn = 1;
let nfpl_js_styles_ViaStop = 1;

// Toggle Checkbox to show/hide nfpl_js_styles_iaRetrun_twoWay section and inputs
document
    .getElementById("nfpl_js_styles_OneWayCheckBox")
    .addEventListener("change", function () {
        const nfpl_js_ViaReturnTwoWay = document.getElementById(
            "nfpl_js_styles_iaRetrun_twoWay"
        );
        const addReturnBtn = document.getElementById("nfpl_styles_1_add-return-btn");
        const endDateTwoWay = document.getElementById(
            "nfpl_js_styles_end_date_two_way_parent"
        );
        const endDateTimeInput = document.getElementById(
            "nfpl_form_js_EndDateTime"
        );

        if (this.checked) {
            // Hide nfpl_js_styles_iaRetrun_twoWay if checkbox is checked (One Way selected)
            nfpl_js_ViaReturnTwoWay.classList.add("nfpl_js_styles_d_none");
            addReturnBtn.classList.add("nfpl_js_styles_d_none");
            nfpl_js_ViaReturnTwoWay.innerHTML = "";

            endDateTwoWay.classList.remove("npfl_js_styles_d_flex");
            endDateTwoWay.classList.add("nfpl_js_styles_d_none");
            endDateTimeInput.removeAttribute("required");
        } else {
            // Show nfpl_js_styles_iaRetrun_twoWay if checkbox is unchecked (Round Trip selected)
            nfpl_js_ViaReturnTwoWay.classList.remove("nfpl_js_styles_d_none");
            addReturnBtn.classList.remove("nfpl_js_styles_d_none");

            endDateTwoWay.classList.remove("nfpl_js_styles_d_none");
            endDateTwoWay.classList.add("npfl_js_styles_d_flex");
            endDateTimeInput.setAttribute("required", true);
        }
    });

// Format the date in the desired format: "October 16, 2024 08:00"
// function formatDateTime(date) {
//     const options = {
//         year: "numeric",
//         month: "long",
//         day: "numeric",
//         hour: "2-digit",
//         minute: "2-digit",
//         hour12: false,
//     };
//     return new Intl.DateTimeFormat("en-US", options).format(date);
// }

function formatDateTime(date) {
    try {
        if (!date) {
            showToast({
                message: "Invalid date.",
                type: "error",
                duration: 3000,
            });
            return false;
        };

        const options = {
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: false,
        };

        return new Intl.DateTimeFormat("en-US", options).format(date);
    } catch (error) {

        showToast({
            message: `Invalid date. Reason: \n ${error?.message || "No Date/Time"}`,
            type: "error",
            duration: 3000,
        });
        return false;
    }
}



// Set the formatted current date and time on page load
function setCurrentDateTime() {
    const now = new Date();

    // Format the current date and time
    const formattedDateTime = now.toISOString().slice(0, 16); // This will format the date as "YYYY-MM-DDTHH:MM"

    // Set the value for nfpl_form_js_StartDateTime and nfpl_form_js_EndDateTime input fields
    document.getElementById("nfpl_form_js_StartDateTime").value =
        formattedDateTime;
    document.getElementById("nfpl_form_js_EndDateTime").value = formattedDateTime;

    // Set the min attribute to prevent selecting past dates
    document
        .getElementById("nfpl_form_js_StartDateTime")
        .setAttribute("min", formattedDateTime);
    document
        .getElementById("nfpl_form_js_EndDateTime")
        .setAttribute("min", formattedDateTime);
}

// Set current date and time on page load
window.addEventListener("load", setCurrentDateTime);

// Get Date Time code
document
    .getElementById("nfpl_form_js_StartDateTime")
    .addEventListener("change", (e) => {
        const startDateTimeVal = e.target.value;
        console.log("Start Date/Time Selected:", startDateTimeVal);
    });

document
    .getElementById("nfpl_form_js_EndDateTime")
    .addEventListener("change", (e) => {
        const endDateTimeVal = e.target.value;
        console.log("End Date/Time Selected:", endDateTimeVal);
    });

// Inputs on InputFields when user types any character to find a location
document.addEventListener("input", async function (event) {
    // Check if the event was triggered by an element with the 'nfpl_js_styles_place_input' class
    if (event.target.classList.contains("nfpl_js_styles_place_input")) {
        const inputField = event.target;
        const dropDownMenu = inputField
            .closest(".nfpl_js_styles_places")
            .querySelector(".nfpl_js_styles_drop-set");

        dropDownMenu.classList.add("show");
        dropDownMenu.style.display = "block";

        // Get input field's dimensions and position
        const inputRect = inputField.getBoundingClientRect();

        // Set dropdown menu's position based on input field
        // dropDownMenu.style.top = `${inputRect.top / 2 + window.scrollY / 2 + inputRect.height}px`;
        // dropDownMenu.style.left = `${inputRect.left / 2 + inputRect.left / 8}px`;
        // dropDownMenu.style.width = `${inputRect.width}px`;

        const query = inputField.value.trim();

        if (query.length === 0) {
            dropDownMenu.style.display = "none";
            dropDownMenu.classList.remove("show");
            return;
        }

        try {
            console.log("fetching data for:", nfpl_var_apiUrl);

            const response = await fetch(nfpl_var_apiUrl, {
                method: "POST",
                headers: nfpl_headers,
                body: JSON.stringify({ query }), // Send the query as JSON
            });

            if (!response.ok) throw new Error("Failed to fetch data");

            const places = await response.json(); // Parse JSON response

            // Clear previous results
            dropDownMenu.innerHTML = "";

            places.forEach((element) => {
                const truncatedText = element.description.substring(0, 55);
                const remainingText = element.description.substring(55);
                const item = document.createElement("button");
                item.classList.add(
                    "nfpl_js_styles_dropdown_item",
                    "nfpl_js_styles_place-result"
                );
                item.setAttribute("nfpl_js_place_id", element.place_id);
                item.setAttribute("nfpl_js_styles_description", element.description);

                item.innerHTML = `
              <i class="icon-map-pin"></i>
              <span class="textDropDown" style="margin-bottom: 0;">${truncatedText}</span>
              <p class="textDropDown" style="margin-top: 0;">${remainingText}</p>
            `;
                dropDownMenu.appendChild(item);
            });

            // Add click event to each dropdown item to set the value in the input field
            dropDownMenu
                .querySelectorAll(".nfpl_js_styles_dropdown_item")
                .forEach((item) => {
                    item.addEventListener("click", function () {
                        const selectedValue = this.getAttribute(
                            "nfpl_js_styles_description"
                        );
                        const selectedPlaceId = this.getAttribute("nfpl_js_place_id");

                        inputField.value = selectedValue; // Set input field value
                        dropDownMenu.style.display = "none"; // Hide dropdown after selection
                        dropDownMenu.classList.remove("show"); // Hide dropdown menu

                        // set nfpl_js_styles_places id field on input field
                        inputField.setAttribute("nfpl_js_place_id", selectedPlaceId);
                    });
                });
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }
});

document.addEventListener("click", (e) => {
    document
        .querySelectorAll(".nfpl_js_styles_drop-set")
        .forEach((dropDownMenu) => {
            // Close any open dropdown menu if the click is outside the input or dropdown
            if (
                !e.target.closest(".nfpl_js_styles_places") ||
                !e.target.classList.contains("nfpl_js_styles_place_input")
            ) {
                dropDownMenu.style.display = "none";
                dropDownMenu.classList.remove("show");
            }
        });
});

//   // Hide dropdown on outside click
//   document.addEventListener("click", (e) => {
//   if (!e.target.closest(".nfpl_js_styles_place_input")) {
//     dropDownMenu.style.display = "none !important";
//     dropDownMenu.classList.remove("show");
//   }
// });

// Function to add via stop location input in nfpl_js_styles_ViaStop_oneWay (for one trip)
document
    .getElementById("nfpl_add_stop_btn")
    .addEventListener("click", function () {
        const viaStopOneWay = document.getElementById(
            "nfpl_js_styles_ViaStop_oneWay"
        );

        // Create a new input container
        const viaInputContainer = document.createElement("div");
        viaInputContainer.classList.add("nfpl_styles_form-group");
        viaInputContainer.innerHTML = `
        <p class="nfpl_styles_input-label">Via Forward </p>
      <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
        <div class="nfpl_styles_input_label nfpl_styles_input-wrapper" style="position: relative;">
          
                            <div class="nfpl_styles_input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2c3.866 0 7 3.134 7 7 0 5.25-7 13-7 13S5 14.25 5 9c0-3.866 3.134-7 7-7z" />
                                <circle cx="12" cy="9" r="2.5" fill="none" />
                                </svg>
                            </div>
          
        <input required
          type="text"
          name="nfpl_js_styles_ViaStop-${nfpl_js_styles_ViaStop}"
          class="nfpl_js_styles_input_field nfpl_js_styles_place_input"
          placeholder="via location"
          autocomplete="off"
        />

                        <button class="nfpl_js_styles_close_btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                        </button>
            


                    <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set nfpl_styles_dropdown-menu"></div>

            </div>
      `;

        // Append new input container to nfpl_js_styles_ViaStop_oneWay
        viaStopOneWay.appendChild(viaInputContainer);

        // Increment the nfpl_js_styles_ViaStop counter
        nfpl_js_styles_ViaStop += 1;

        // Add event listener for removing this input field when clicking the close button
        viaInputContainer
            .querySelector(".nfpl_js_styles_close_btn")
            .addEventListener("click", function () {
                viaInputContainer.remove();
            });
    });

// Function to add via return location input in nfpl_js_styles_iaRetrun_twoWay (for round trip)
document
    .getElementById("nfpl_styles_1_add-return-btn")
    .addEventListener("click", function () {
        const nfpl_js_ViaReturnTwoWay = document.getElementById(
            "nfpl_js_styles_iaRetrun_twoWay"
        );

        // Create a new input container
        const returnInputContainer = document.createElement("div");
        returnInputContainer.classList.add("nfpl_styles_form-group");
        returnInputContainer.innerHTML = `
      <p class="nfpl_styles_input-label">Via Return </p>
      <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
               <div class="nfpl_styles_input_label nfpl_styles_input-wrapper">

                                                                        <div class="nfpl_styles_input-icon" style="top: 7; bottom: 0;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
                                                                            stroke-width="2" width="24" height="24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                d="M12 2c3.866 0 7 3.134 7 7 0 5.25-7 13-7 13S5 14.25 5 9c0-3.866 3.134-7 7-7z" />
                                                                            <circle cx="12" cy="9" r="2.5" fill="none" />
                                                                            </svg>
                                                                        </div>
                                            
                                           
                                                                    <input 
                                                                    required
                                                                    type="text"
                                                                    name="nfpl_js_styles_ViaReturn-${nfpl_js_styles_ViaReturn}"
                                                                    class="nfpl_js_styles_input_field nfpl_js_styles_place_input"
                                                                    placeholder="via return location"
                                                                    autocomplete="off"
                                                                    />
            
            
                                                                    <button class="nfpl_js_styles_close_btn">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="24" height="24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                        </svg>
                                                                    </button>


                                                                    <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m">
                                                                    </div>


            </div>

      `;

        // Append new input container to nfpl_js_styles_iaRetrun_twoWay
        nfpl_js_ViaReturnTwoWay.appendChild(returnInputContainer);

        // Increment the nfpl_js_styles_ViaReturn counter
        nfpl_js_styles_ViaReturn += 1;

        // Add event listener for removing this input field when clicking the close button
        returnInputContainer
            .querySelector(".nfpl_js_styles_close_btn")
            .addEventListener("click", function () {
                returnInputContainer.remove();
            });
    });

function isWidgetFormValid() {
    const fromInput = document
        .getElementById("nfpl_form_style_js_from")
        .value.trim();
    const toInput = document.getElementById("nfpl_form_style_js_to").value.trim();

    // Check if both From and To fields are filled out
    if (fromInput === "" || toInput === "") {
        return false;
    }

    // Check if start date/time is selected
    const startDateTime = getDateTimeValue("nfpl_form_js_StartDateTime");
    if (!startDateTime) {
        return false;
    }

    // Check if return date/time is selected for two-way trips
    const oneWayBool = document.getElementById("nfpl_js_styles_OneWayCheckBox").checked;
    if (!oneWayBool) {
        const endDateTime = getDateTimeValue("nfpl_form_js_EndDateTime");
        if (!endDateTime) {
            return false;
        }
    }

    return true;
}

// Function to collect data for submission nfpl_form_style_js_from elements
function getDataToSubmit() {
    console.log("get Data");
    let returnBooking;
    const oneWayBool = document.getElementById(
        "nfpl_js_styles_OneWayCheckBox"
    ).checked;

    console.log(
        document
            .getElementById("nfpl_form_style_js_from")
            .getAttribute("nfpl_js_place_id")
    );
    // Collect base data

    function formatDateInput(dateInputId) {
        // Get the ISO datetime value from the custom calendar input
        const dateValue = getDateTimeValue(dateInputId);
        if (!dateValue) {
            showToast({
                message: "Please select a date and time.",
                type: "error",
                duration: 3000,
            });
            return null;
        }
        
        const date = new Date(dateValue);
        let formated = formatDateTime(date);
        formated = formated.replace("at ", "").replace(",", "");

        return formated;
    }

    const startTime = formatDateInput("nfpl_form_js_StartDateTime");
    if (!startTime) {
        return null; // Return null if date formatting fails
    }

    const booking = {
        from_desc: document.getElementById("nfpl_form_style_js_from").value,
        from_place_id: document
            .getElementById("nfpl_form_style_js_from")
            .getAttribute("nfpl_js_place_id"),
        startTime: startTime,
        to_place_id: document
            .getElementById("nfpl_form_style_js_to")
            .getAttribute("nfpl_js_place_id"),
        to_desc: document.getElementById("nfpl_form_style_js_to").value,
        no_of_passangers: 1,
        //   special_instructions:"",
        addons: [],
        via: [],
    };

    // Collect all via stops for one way (if any)
    const viaStopInputs = document.querySelectorAll(
        "#nfpl_js_styles_ViaStop_oneWay .nfpl_js_styles_input_field"
    );
    if (viaStopInputs.length > 0) {
        booking.via = Array.from(viaStopInputs).map((input) => ({
            place_id: input.getAttribute("nfpl_js_place_id"),
            desc: input.value,
        }));
    }

    // If two way is selected, collect return via stops
    if (!oneWayBool) {
        const returnStartTime = formatDateInput("nfpl_form_js_EndDateTime");
        if (!returnStartTime) {
            return null; // Return null if return date formatting fails
        }

        returnBooking = {
            startTime: returnStartTime,
            from_desc: document.getElementById("nfpl_form_style_js_to").value,
            from_place_id: document
                .getElementById("nfpl_form_style_js_to")
                .getAttribute("nfpl_js_place_id"),
            to_place_id: document
                .getElementById("nfpl_form_style_js_from")
                .getAttribute("nfpl_js_place_id"),
            to_desc: document.getElementById("nfpl_form_style_js_from").value,
            no_of_passangers: 1,
            addons: [],
            //    special_instructions:"",
            via: [],
            // returnBooking: true,
            isReturn: true
        };
        // booking.returnBooking = true

        const viaReturnInputs = document.querySelectorAll(
            "#nfpl_js_styles_iaRetrun_twoWay .nfpl_js_styles_input_field"
        );
        console.log(viaReturnInputs);
        if (viaReturnInputs.length > 0) {
            returnBooking.via = Array.from(viaReturnInputs).map((input) => ({
                place_id: input.getAttribute("nfpl_js_place_id"),
                desc: input.value,
            }));
        }

        return { booking, returnBooking };
    }

    return { booking };
}

document
    .getElementById("nfpl_js_styles_submit_btn_widget")
    .addEventListener("click", function () {
        console.log("working in submit by id");
        submitBookingForm();
    });

function submitBookingForm() {
    console.log("submitBookingForm CLICKED");

    // Validate form fields
    if (!isWidgetFormValid()) {
        const fromInput = document.getElementById("nfpl_form_style_js_from").value.trim();
        const toInput = document.getElementById("nfpl_form_style_js_to").value.trim();
        const startDateTime = getDateTimeValue("nfpl_form_js_StartDateTime");
        const oneWayBool = document.getElementById("nfpl_js_styles_OneWayCheckBox").checked;
        const endDateTime = !oneWayBool ? getDateTimeValue("nfpl_form_js_EndDateTime") : true;

        let errorMessage = "Please provide: ";
        let errors = [];

        if (!fromInput) errors.push("pickup location");
        if (!toInput) errors.push("dropoff location");
        if (!startDateTime) errors.push("forward date/time");
        if (!oneWayBool && !endDateTime) errors.push("return date/time");

        errorMessage += errors.join(", ");

        showToast({
            message: errorMessage,
            type: "info",
            duration: 3000,
        });

        return false;
    }

    // Collect data to submit
    const data = getDataToSubmit();
    if (!data) {
        return false; // Exit if data collection fails
    }
    console.log("Data to submit:", data);

    // Display loading state
    const submitButton = document.getElementById(
        "nfpl_js_styles_submit_btn_widget"
    );
    submitButton.disabled = true;
    submitButton.innerHTML = `<span id="loadingSpinner" style="width: 100%; position: absolute; top:0; left:0; min-height: 100vh; "><i class="fa-solid fa-spinner fa-spin"></i></span> Calculating...`;

    shownfpl_styles_loadingOverlay("Processing your Information");
    // "/api/public/cabify/get-quotations"
    fetch(nfpl_var_quoteUrl, {
        method: "POST",
        headers: nfpl_headers,
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                return response.json().then((err) => {
                    throw new Error(err.message || "Server error occurred.");
                });
            }
            return response.json();
        })
        .then((response) => {
            showToast({ message: "Success!", type: "success", duration: 3000 });

            // console.log("Submission successful:", response);
            // console.log("WIDGET:", <?php echo INSTANT_QUOTE_WIDGET ?>);
            // ### in response , data will be booking Id
            window.location.href = `${quotationPageUrlAndPageNumber}?id=${response}`;
        })
        .catch((error) => {
            console.error("Submission error:", error);

            showToast({
                message: "Error: " + error.message, type: "error",
                duration: 2000,
            });
        })
        .finally(() => {
            // Reset the submit button state after completion
            submitButton.disabled = false;
            submitButton.innerHTML = "Calculate Price";
            hidenfpl_styles_loadingOverlay();
        });
}

/**
 * Clears all input fields in the booking widget.
 */
function clearBookingFormFields() {
    // Get all input fields within the widget container
    const inputs = document.querySelectorAll(
        ".nfpl_styles_widget-container input"
    );

    inputs.forEach((input) => {
        // Clear the value of each input field
        input.value = "";

        // Remove any custom attributes like place_id
        input.removeAttribute("nfpl_js_place_id");
        
        // Clear datetime value for custom calendar inputs
        if (input.hasAttribute("data-calendar")) {
            input.removeAttribute("data-datetime-value");
            input.placeholder = "October 16 2024 08:00";
        }
    });

    // Clear dynamically added via stops and return stops
    document.getElementById("nfpl_js_styles_ViaStop_oneWay").innerHTML = "";
    document.getElementById("nfpl_js_styles_iaRetrun_twoWay").innerHTML = "";

    // Reset checkboxes or other states
    document.getElementById("nfpl_js_styles_OneWayCheckBox").checked = true;

    // Hide return trip sections
    const endDateTwoWay = document.getElementById(
        "nfpl_js_styles_end_date_two_way_parent"
    );
    const nfpl_js_ViaReturnTwoWay = document.getElementById(
        "nfpl_js_styles_iaRetrun_twoWay"
    );
    const addReturnBtn = document.getElementById("nfpl_styles_1_add-return-btn");

    nfpl_js_ViaReturnTwoWay.classList.add("nfpl_js_styles_d_none");
    addReturnBtn.classList.add("nfpl_js_styles_d_none");
    endDateTwoWay.classList.remove("npfl_js_styles_d_flex");
    endDateTwoWay.classList.add("nfpl_js_styles_d_none");

    const endDateTimeInput = document.getElementById("nfpl_form_js_EndDateTime");
    endDateTimeInput.removeAttribute("required");
}

/**
 * Handles the 'popstate' or 'beforeunload' events to clear form fields when navigating.
 */
window.addEventListener("beforeunload", clearBookingFormFields);
window.addEventListener("popstate", clearBookingFormFields);
