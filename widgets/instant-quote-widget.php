<div class="nfpl_styles_widget-container">
  <div class="">

    <div class="">
      <p class="nfp_styles_text_uppercase npfl_styles_online_booking_p">online booking</p>
      <h1 class="nfpl_styles_confirm_booking_h1">Confirm your booking now!</h1>

      <div class="">
        <!-- Input Field: From -->
        <div class="">
          <p style="font-size: large; font-weight:400;">From</p>
          <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
            <div class="nfpl_styles_input_label">

            </div>
            <input id="nfpl_form_style_js_from" name="nfpl_form_start-dest" type="text"
              class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="From" required
              autocomplete="off" />
            <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m"></div>
          </div>
        </div>



        <!-- Input Field: To -->
        <div class="">
          <p style="font-size: large; font-weight:400;">To</p>
          <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
            <div class="nfpl_styles_input_label">

            </div>
            <input required id="nfpl_form_style_js_to" name="nfpl_form_end_dest" type="text"
              class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="To" autocomplete="off" />
            <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m"></div>
          </div>
        </div>

      </div>

      <button id="nfpl_add_stop_btn" class="nfpl_styles_add_btn viaLocationPlus">
        stop
      </button>

      <div id="nfpl_js_styles_ViaStop_oneWay" class="">
        <!-- Input Field: via location -->
      </div>

      <div class="">
        <!-- Start Date/Time -->
        <div class="">
          <p style="font-size: large; font-weight:400;">Forward Date/Time</p>
          <div class="nfpl_js_styles_input_container ">
            <div class="nfpl_styles_input_label">

            </div>
            <input required id="nfpl_form_js_StartDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
              placeholder="Pickup Date/Time" />
          </div>
        </div>

        <!-- End Date/Time -->
        <div id="nfpl_js_styles_end_date_two_way_parent"
          class="nfpl_js_styles_d_none flex-column col-12 col-md-6 col-lg-6 my-2">
          <p style="font-size:medium; font-weight: 500;">Return Date/Time</p>
          <div id="end-date-two-way" class=" nfpl_js_styles_input_container ">
            <div class="nfpl_styles_input_label">

            </div>
            <input required id="nfpl_form_js_EndDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
              placeholder="Return Pickup Date/Time" />
          </div>
        </div>
      </div>


      <div>
        One way?
        <input required type="checkbox" id="nfpl_js_styles_OneWayCheckBox" checked="checked" />
      </div>

      <button id="add-return-btn" class="nfpl_js_styles_d_none nfpl_styles_add_btn viaLocationPlus">

        via return
      </button>

      <div id="nfpl_js_styles_iaRetrun_twoWay" class="">
        <!-- Input Field: via return location -->
      </div>
    </div>

    <div style="width: 90%; padding: 5% 0; ">
      <div class="npfl_js_styles_d_flex justify-content-end  flex-nowrap">
        <button id="nfpl_js_styles_submit_btn_widget">Calculate Price</button>
      </div>
    </div>
  </div>
</div>

<style>
  .nfpl_styles_widget-container {
    width: 100%;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 2% 0;
  }

  @media (max-width: 768px) {

    .npfl_styles_online_booking_p {
      color: var(--var-dark-text) !important;
    }
  }


  .npfl_styles_online_booking_p {
    font-weight: 600;
    color: var(--var-primary-color);
  }

  .nfpl_styles_confirm_booking_h1 {
    font-weight: bolder;
    color: var(--var-secondary-second-color);
  }

  .nfpl_js_styles_input_container {
    display: flex;
    align-items: center;
    max-width: 280px;
    width: 100%;
    margin: 2% 1%;
    border-radius: 0.4rem;
    background-color: var(--var-textfield-background);
    border: 1px solid var(--var-textfield-border);
    position: relative;
  }

  .nfpl_styles_input_label {
    color: var(--var-primary-color);
    font-size: 16px;
    width: 10%;
  }

  .nfpl_js_styles_input_field {
    flex: 1;
    border: none;
    padding: 8px 0;
    padding-left: 2%;
    font-size: 16px;
    width: 80%;
    outline: none;
    background-color: transparent !important;
  }

  .nfpl_js_styles_close_btn {
    background-color: transparent !important;
    color: var(--var-light-grey);
    border: none;
    padding: 8px;
    cursor: pointer;
  }

  .nfpl_js_styles_close_btn:hover {
    color: var(--var-dark-grey);
  }

  #nfpl_js_styles_submit_btn_widget {
    width: auto;
    height: 2.5rem;
    border: 0;

    padding: 1% 2%;
    border-radius: 0.3rem;
    background: var(--var-primary-color);
    color: var(--var-light-text);
  }

  .nfpl_styles_add_btn {
    background-color: var(--var-primary-color);
    color: var(--var-light-text);
    border: 0;
    padding: 1% 2%;
    margin: 2px 0;
    border-radius: 0.3rem;
    font-size: medium;
  }

  /* Checked box style */
  input[type="checkbox"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 1rem;
    height: 1rem;
    border: 2px solid var(--var-primary-color);
    border-radius: 4px;
    cursor: pointer;
    outline: none;
    transition: background-color 0.2s, border-color 0.2s;
  }

  input[type="checkbox"]:checked {
    background-color: var(--var-primary-color);
    border-color: var(--var-primary-color);
  }

  /* Checkmark style */
  input[type="checkbox"]:checked::after {
    content: "✔";
    font-size: 12px;
    margin: -2px;
    display: block;
    text-align: start;
  }

  /*TEst*/
  .nfpl_js_styles_drop-set.show {
    max-width: 500px;
    width: inherit;
    background-color: rgba(255, 255, 255, 0.9) !important;
    position: absolute;
    left: 0;
    top: 100%;
  }

  .nfpl_js_styles_dropdown_item {
    border-bottom: 1px solid rgba(0, 0, 0, 0.2) !important;
  }

  .nfpl_js_styles_dropdown_item {
    display: block;
    width: 100%;
    clear: both;
    font-weight: 400;
    color: #262626;
    text-align: inherit;
    text-decoration: none;
    white-space: normal !important;
    background-color: transparent;
    border: 0;
  }


  .nfpl_js_styles_d_none {
    display: none !important;
  }

  .npfl_js_styles_d_flex {
    display: flex !important;
  }
</style>


<script>
  // Be sure to have these functions in index.php file otherwise code UI and functionality will break!
  const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
  const nfpl_var_apiUrl = `${nfpl_var_apiUrlPrefixs}/api/public/google/autocomplete`;
  const nfpl_var_quoteUrl = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-get-quotations`;
  const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>'
</script>


<script>



  let nfpl_js_styles_ViaReturn = 1;
  let nfpl_js_styles_ViaStop = 1;

  // Toggle Checkbox to show/hide nfpl_js_styles_iaRetrun_twoWay section and inputs
  document.getElementById("nfpl_js_styles_OneWayCheckBox").addEventListener("change", function () {
    const nfpl_js_ViaReturnTwoWay = document.getElementById("nfpl_js_styles_iaRetrun_twoWay");
    const addReturnBtn = document.getElementById("add-return-btn");
    const endDateTwoWay = document.getElementById("nfpl_js_styles_end_date_two_way_parent");
    const endDateTimeInput = document.getElementById('nfpl_form_js_EndDateTime')

    if (this.checked) {
      // Hide nfpl_js_styles_iaRetrun_twoWay if checkbox is checked (One Way selected)
      nfpl_js_ViaReturnTwoWay.classList.add("nfpl_js_styles_d_none");
      addReturnBtn.classList.add("nfpl_js_styles_d_none");
      nfpl_js_ViaReturnTwoWay.innerHTML = "";

      endDateTwoWay.classList.remove("npfl_js_styles_d_flex");
      endDateTwoWay.classList.add("nfpl_js_styles_d_none");
      endDateTimeInput.removeAttribute('required')

    } else {
      // Show nfpl_js_styles_iaRetrun_twoWay if checkbox is unchecked (Round Trip selected)
      nfpl_js_ViaReturnTwoWay.classList.remove("nfpl_js_styles_d_none");
      addReturnBtn.classList.remove("nfpl_js_styles_d_none");


      endDateTwoWay.classList.remove("nfpl_js_styles_d_none");
      endDateTwoWay.classList.add("npfl_js_styles_d_flex");
      endDateTimeInput.setAttribute('required', true)
    }
  });

  // Format the date in the desired format: "October 16, 2024 08:00"
  function formatDateTime(date) {
    const options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    };
    return new Intl.DateTimeFormat('en-US', options).format(date);
  }



  // Set the formatted current date and time on page load
  function setCurrentDateTime() {
    const now = new Date();

    // Format the current date and time
    const formattedDateTime = now.toISOString().slice(0, 16); // This will format the date as "YYYY-MM-DDTHH:MM"

    // Set the value for nfpl_form_js_StartDateTime and nfpl_form_js_EndDateTime input fields
    document.getElementById('nfpl_form_js_StartDateTime').value = formattedDateTime;
    document.getElementById('nfpl_form_js_EndDateTime').value = formattedDateTime;

    // Set the min attribute to prevent selecting past dates
    document.getElementById('nfpl_form_js_StartDateTime').setAttribute('min', formattedDateTime);
    document.getElementById('nfpl_form_js_EndDateTime').setAttribute('min', formattedDateTime);
  }

  // Set current date and time on page load
  window.addEventListener('load', setCurrentDateTime);


  // Get Date Time code
  document.getElementById('nfpl_form_js_StartDateTime').addEventListener('change', (e) => {
    const startDateTimeVal = e.target.value;
    console.log('Start Date/Time Selected:', startDateTimeVal);
  });

  document.getElementById('nfpl_form_js_EndDateTime').addEventListener('change', (e) => {
    const endDateTimeVal = e.target.value;
    console.log('End Date/Time Selected:', endDateTimeVal);
  });


  // Inputs on InputFields when user types any character to find a location
  document.addEventListener("input", async function (event) {
    // Check if the event was triggered by an element with the 'nfpl_js_styles_place_input' class
    if (event.target.classList.contains("nfpl_js_styles_place_input")) {
      const inputField = event.target;
      const dropDownMenu = inputField.closest(".nfpl_js_styles_places").querySelector(".nfpl_js_styles_drop-set");

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
          headers: {
            "Content-Type": "application/json",
            'tenant-widgetapikey': `${nfpl_var_apikey}`

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
          item.classList.add("nfpl_js_styles_dropdown_item", "nfpl_js_styles_place-result");
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
        dropDownMenu.querySelectorAll(".nfpl_js_styles_dropdown_item").forEach(item => {
          item.addEventListener("click", function () {
            const selectedValue = this.getAttribute("nfpl_js_styles_description");
            const selectedPlaceId = this.getAttribute("nfpl_js_place_id");

            inputField.value = selectedValue; // Set input field value
            dropDownMenu.style.display = "none"; // Hide dropdown after selection
            dropDownMenu.classList.remove("show"); // Hide dropdown menu

            // set nfpl_js_styles_places id field on input field
            inputField.setAttribute("nfpl_js_place_id", selectedPlaceId)

          });
        });

      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }


  });

  document.addEventListener("click", (e) => {
    document.querySelectorAll(".nfpl_js_styles_drop-set").forEach((dropDownMenu) => {
      // Close any open dropdown menu if the click is outside the input or dropdown
      if (!e.target.closest(".nfpl_js_styles_places") || !e.target.classList.contains("nfpl_js_styles_place_input")) {
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
  document.getElementById("nfpl_add_stop_btn").addEventListener("click", function () {
    const viaStopOneWay = document.getElementById("nfpl_js_styles_ViaStop_oneWay");

    // Create a new input container
    const viaInputContainer = document.createElement("div");
    viaInputContainer.classList.add("npfl_js_styles_d_flex", "flex-column", "col-12", "col-md-6", "col-lg-6", "my-2");
    viaInputContainer.innerHTML = `
        <p style="font-size: large; font-weight:400;">Via Forward </p>
      <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
        <div class="nfpl_styles_input_label">
          <i class="fa-solid fa-map-pin"></i>
        </div>
        <input required
          type="text"
          name="nfpl_js_styles_ViaStop-${nfpl_js_styles_ViaStop}"
          class="nfpl_js_styles_input_field nfpl_js_styles_place_input"
          placeholder="via location"
          autocomplete="off"
        />
        <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m"></div>
        <button class="nfpl_js_styles_close_btn"><i class="fa-solid fa-xmark"></i></button>
        </div>
      `;

    // Append new input container to nfpl_js_styles_ViaStop_oneWay
    viaStopOneWay.appendChild(viaInputContainer);

    // Increment the nfpl_js_styles_ViaStop counter
    nfpl_js_styles_ViaStop += 1;

    // Add event listener for removing this input field when clicking the close button
    viaInputContainer.querySelector(".nfpl_js_styles_close_btn").addEventListener("click", function () {
      viaInputContainer.remove();
    });
  });

  // Function to add via return location input in nfpl_js_styles_iaRetrun_twoWay (for round trip)
  document.getElementById("add-return-btn").addEventListener("click", function () {
    const nfpl_js_ViaReturnTwoWay = document.getElementById("nfpl_js_styles_iaRetrun_twoWay");



    // Create a new input container
    const returnInputContainer = document.createElement("div");
    returnInputContainer.classList.add("npfl_js_styles_d_flex", "flex-column", "col-12", "col-md-6", "col-lg-6", "my-2");
    returnInputContainer.innerHTML = `
      <p style="font-size: large; font-weight:400;">Via Return </p>
      <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
            <div class="nfpl_styles_input_label">
              <i class="fa-solid fa-map-pin"></i>
            </div>
            <input 
            required
              type="text"
              name="nfpl_js_styles_ViaReturn-${nfpl_js_styles_ViaReturn}"
              class="nfpl_js_styles_input_field nfpl_js_styles_place_input"
              placeholder="via return location"
              autocomplete="off"
            />
            <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m"></div>
            <button class="nfpl_js_styles_close_btn"><i class="fa-solid fa-xmark"></i></button>
            </div>
      `;

    // Append new input container to nfpl_js_styles_iaRetrun_twoWay
    nfpl_js_ViaReturnTwoWay.appendChild(returnInputContainer);

    // Increment the nfpl_js_styles_ViaReturn counter
    nfpl_js_styles_ViaReturn += 1;

    // Add event listener for removing this input field when clicking the close button
    returnInputContainer.querySelector(".nfpl_js_styles_close_btn").addEventListener("click", function () {
      returnInputContainer.remove();
    });
  });

  function isWidgetFormValid() {
    const fromInput = document.getElementById("nfpl_form_style_js_from").value.trim();
    const toInput = document.getElementById("nfpl_form_style_js_to").value.trim();

    // Check if both From and To fields are filled out
    return fromInput !== "" && toInput !== "";
  }

  // Function to collect data for submission nfpl_form_style_js_from elements
  function getDataToSubmit() {
    console.log("get Data")
    let returnBooking;
    const oneWayBool = document.getElementById("nfpl_js_styles_OneWayCheckBox").checked;

    console.log(document.getElementById("nfpl_form_style_js_from").getAttribute('nfpl_js_place_id'))
    // Collect base data


    function formatDateInput(dateInputId) {
      const dateValue = document.getElementById(dateInputId).value;
      const date = new Date(dateValue);
      let formated = formatDateTime(date);
      formated = formated.replace('at ', '').replace(',', '')

      return formated;
    }

    const
      booking = {
        from_desc: document.getElementById("nfpl_form_style_js_from").value,
        from_place_id: document.getElementById("nfpl_form_style_js_from").getAttribute('nfpl_js_place_id'),
        startTime: formatDateInput("nfpl_form_js_StartDateTime"),
        to_place_id: document.getElementById("nfpl_form_style_js_to").getAttribute('nfpl_js_place_id'),
        to_desc: document.getElementById("nfpl_form_style_js_to").value,
        no_of_passangers: 1,
        //   special_instructions:"",
        addons: [],
        via: [],
      }


    // Collect all via stops for one way (if any)
    const viaStopInputs = document.querySelectorAll("#nfpl_js_styles_ViaStop_oneWay .nfpl_js_styles_input_field");
    if (viaStopInputs.length > 0) {
      booking.via = Array.from(viaStopInputs).map(input => ({ place_id: input.getAttribute('nfpl_js_place_id'), desc: input.value }))
    }

    // If two way is selected, collect return via stops
    if (!oneWayBool) {
      returnBooking = {
        startTime: formatDateInput("nfpl_form_js_EndDateTime"),
        from_desc: document.getElementById("nfpl_form_style_js_to").value,
        from_place_id: document.getElementById("nfpl_form_style_js_to").getAttribute('nfpl_js_place_id'),
        to_place_id: document.getElementById("nfpl_form_style_js_from").getAttribute('nfpl_js_place_id'),
        to_desc: document.getElementById("nfpl_form_style_js_from").value,
        no_of_passangers: 1,
        addons: [],
        //    special_instructions:"",
        via: [],
      }


      const viaReturnInputs = document.querySelectorAll("#nfpl_js_styles_iaRetrun_twoWay .nfpl_js_styles_input_field");
      console.log(viaReturnInputs)
      if (viaReturnInputs.length > 0) {
        returnBooking.via = Array.from(viaReturnInputs).map(input => ({ "nfpl_js_place_id": input.getAttribute('nfpl_js_place_id'), desc: input.value }))
      }

      return { booking, returnBooking }
    }

    return { booking }
  }



  document.getElementById("nfpl_js_styles_submit_btn_widget").addEventListener("click", function () {
    console.log("working in submit by id")
    submitBookingForm();
  });

  function submitBookingForm() {
    console.log("submitBookingForm CLICKED");

    // Validate form fields
    if (!isWidgetFormValid()) {


      showToast({ message: "Please provide both Pickup and Dropoff Addresses.", type: 'info', duration: 3000 });

      // alert("Please provide both Pickup and Dropoff Addresses.");
      return false;
    }

    // Collect data to submit
    const data = getDataToSubmit();
    console.log("Data to submit:", data);


    // Display loading state
    const submitButton = document.getElementById("nfpl_js_styles_submit_btn_widget");
    submitButton.disabled = true;
    submitButton.innerHTML = `<span id="loadingSpinner" style="width: 100%; position: absolute; top:0; left:0; min-height: 100vh; "><i class="fa-solid fa-spinner fa-spin"></i></span> Calculating...`;

    showLoadingOverlay("Processing your Information");
    // "/api/public/cabify/get-quotations" 
    fetch(nfpl_var_quoteUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        'tenant-widgetapikey': `${nfpl_var_apikey}`
      },
      body: JSON.stringify(data),
    })
      .then(response => {
        if (!response.ok) {
          return response.json().then(err => {
            throw new Error(err.message || "Server error occurred.");
          });
        }
        return response.json();
      })
      .then(response => {

        showToast({ message: "Success!", type: 'success', duration: 3000 });

        window.location.href = "/dispatcher/quotations/" + response;

      })
      .catch(error => {
        console.error("Submission error:", error);
        alert("Error: " + error.message);
      })
      .finally(() => {
        // Reset the submit button state after completion
        submitButton.disabled = false;
        submitButton.innerHTML = "Calculate Price";
        hideLoadingOverlay();

      });
  }
</script>





<script>
  /**
 * Clears all input fields in the booking widget.
 */
  function clearBookingFormFields() {
    // Get all input fields within the widget container
    const inputs = document.querySelectorAll('.nfpl_styles_widget-container input');

    inputs.forEach(input => {
      // Clear the value of each input field
      input.value = '';

      // Remove any custom attributes like place_id
      input.removeAttribute('nfpl_js_place_id');
    });

    // Clear dynamically added via stops and return stops
    document.getElementById("nfpl_js_styles_ViaStop_oneWay").innerHTML = '';
    document.getElementById("nfpl_js_styles_iaRetrun_twoWay").innerHTML = '';

    // Reset checkboxes or other states
    document.getElementById("nfpl_js_styles_OneWayCheckBox").checked = true;

    // Hide return trip sections
    const endDateTwoWay = document.getElementById("nfpl_js_styles_end_date_two_way_parent");
    const nfpl_js_ViaReturnTwoWay = document.getElementById("nfpl_js_styles_iaRetrun_twoWay");
    const addReturnBtn = document.getElementById("add-return-btn");

    nfpl_js_ViaReturnTwoWay.classList.add("nfpl_js_styles_d_none");
    addReturnBtn.classList.add("nfpl_js_styles_d_none");
    endDateTwoWay.classList.remove("npfl_js_styles_d_flex");
    endDateTwoWay.classList.add("nfpl_js_styles_d_none");

    const endDateTimeInput = document.getElementById('nfpl_form_js_EndDateTime');
    endDateTimeInput.removeAttribute('required');
  }

  /**
   * Handles the 'popstate' or 'beforeunload' events to clear form fields when navigating.
   */
  window.addEventListener('beforeunload', clearBookingFormFields);
  window.addEventListener('popstate', clearBookingFormFields);

</script>















































<div id="loadingOverlay" style="display: none;">
    <div style=" padding: 20px; border-radius: 1rem; display: flex; flex-direction: column; text-align: center; justify-content: center; align-items: center;">
      <div id="loadingSpinner-2" class="spinner-2"></div>
      <h2 id="overlay-message" class="loadingText" style="color: var(--var-primary-color); padding: 45px 0;">
        Submitting Your Details ...
      </h2>
    </div>
  </div>


<style>
  #loadingOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
  }

  .loadingText {
    font-weight: 100;
    line-height: 0;
    color: var(--var-secondary-color);
  }

  /* 
  #loadingSpinner-2 {
      width: 40px;
      height: 40px;
      border: 5px solid var(--var-secondary-second-color);
      border-top: 5px solid var(--var-primary-color);
      border-radius: 50%;
      animation: spin 1s linear infinite;
  } */

  /* @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  } */


  /* HTML: <div class="loader"></div> */
  #loadingSpinner-2 {
    width: 60px;
    aspect-ratio: 2;
    --_g: no-repeat radial-gradient(circle closest-side, var(--var-primary-color) 90%, #39a07a00);
    background:
      var(--_g) 0% 50%,
      var(--_g) 50% 50%,
      var(--_g) 100% 50%;
    background-size: calc(100%/3) 50%;
    animation: nfpl_animation_loading 1s infinite linear;
  }

  @keyframes nfpl_animation_loading {
    20% {
      background-position: 0% 0%, 50% 50%, 100% 50%
    }

    40% {
      background-position: 0% 100%, 50% 0%, 100% 50%
    }

    60% {
      background-position: 0% 50%, 50% 100%, 100% 0%
    }

    80% {
      background-position: 0% 50%, 50% 50%, 100% 100%
    }
  }
</style>

<script>
  function showLoadingOverlay(message) {
    const overlayMessage = document.getElementById('overlay-message');
    if (overlayMessage) {
      overlayMessage.textContent = message;
    }
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
      loadingOverlay.style.display = 'flex';
      loadingOverlay.style = 'flex-direction: column;';
    }
  }

  function hideLoadingOverlay() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
      loadingOverlay.style.display = 'none';
    }
  }
</script>
