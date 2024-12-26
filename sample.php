


<script>
  document.addEventListener("DOMContentLoaded", function () {




    // Initialize intlTelInput
    document.getElementById("phNumber").addEventListener("input", () => {
      const phoneInput = document.getElementById("phNumber");
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
    const voucherBtn = document.getElementById("apply-voucher-btn");
    const voucherError = document.getElementById("voucherError");


    document.addEventListener("click", function (e) {
      if (e.target && e.target.id === "removeVoucherBtn") {
        const bookingId = e.target.getAttribute("data-booking-id");
        if (!bookingId) return;

        e.preventDefault();
        e.target.disabled = true;

        fetch(`/dispatcher/remove-voucher/${bookingId}`, {
          method: "POST",
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
            Toastify({
              text: "Voucher removed successfully!",
              duration: 3000,
              backgroundColor: "green",
            }).showToast();
          })
          .catch((err) => {
            e.target.disabled = false;

            // Log error and display error toast
            console.error(err);
            Toastify({
              text: "Something went wrong!",
              duration: 3000,
              backgroundColor: "red",
            }).showToast();
          });
      }
    });

    voucherBtn.addEventListener("click", function (e) {
      const voucherValue = voucherInput.value;
      console.log("VOUCHER VALUE CHANGED", voucherValue, voucherValue.length);
      const loadingSpinner = document.getElementById("loadingSpinner-2");
      const bookingId = voucherInput.getAttribute("data-booking-id");

      if (!voucherInput.value || !bookingId) return;

      if (voucherValue.length === 0) {
        voucherError.style.display = "none";
      } else {
        console.log("Val", voucherValue);
        e.target.disabled = true;
        fetch(`/dispatcher/apply-voucher/${bookingId}`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
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

            Toastify({
              text: "Voucher Applied successfully!",
              duration: 3000,
              backgroundColor: "green",
            }).showToast();
          })
          .catch((err) => {
            console.error("Error: ", err);
            e.target.disabled = false;
            voucherError.style.display = "block";
            voucherSuccess.style.display = "none";

            // voucherError.innerText = err.message || "Invalid voucher";
            voucherError.innerText = "Invalid voucher";
            Toastify({
              text: "Invalid Voucher!",
              duration: 3000,
              backgroundColor: "red",
            }).showToast();
          });
      }
    });

    const addonInputs = document.querySelectorAll(".addon-input");
    addonInputs.forEach((input) => {
      input.addEventListener("click", function (e) {
        const bookingId = e.target.getAttribute("data-booking-id");
        const selectedAddons = Array.from(addonInputs)
          .filter(
            (addon) =>
              addon.checked &&
              addon.getAttribute("data-booking-id") === bookingId
          )
          .map((addon) => addon.value);

        addonInputs.forEach((addon) => (addon.disabled = true));

        fetch(`/dispatcher/add-addon-to-booking/${bookingId}`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
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

            Toastify({
              text: "Add-on processed  successfully!",
              duration: 3000,
              backgroundColor: "green",
            }).showToast();
          })
          .catch((err) => {
            addonInputs.forEach((addon) => (addon.disabled = false));
            console.error(err);
          });
      });
    });

    document
      .getElementById("bookingForSomeoneElse_Checkbox")
      .addEventListener("change", function () {
        const bookingForSomeoneElse_Div = document.getElementById(
          "bookingForSomeoneElse_Div"
        );

        const name = document.getElementById("bookingForSomeoneElse_Name");
        const email = document.getElementById("bookingForSomeoneElse_Email");
        const phoneNumber = document.getElementById(
          "bookingForSomeoneElse_PhNumber"
        );

        if (this.checked) {
          bookingForSomeoneElse_Div.classList.remove("nfpl_js_styles_d_none">);
        } else {
          bookingForSomeoneElse_Div.classList.add("nfpl_js_styles_d_none">);
          name.value = "";
          email.value = "";
          phoneNumber.value = "";
        }
      });

    const submitBtn = document.getElementById("submitPassInfo");
    submitBtn.addEventListener("click", function (e) {
      e.preventDefault();

      // Get all required input fields
      const fields = [
        { id: "name", message: "Full Name is required" },
        { id: "email", message: "Email is required" },
        { id: "phNumber", message: "Phone Number is required" },
        { id: "flightNumber", message: "Flight Number is required" },
        { id: "from", message: "Pickup location is required" },
        { id: "to", message: "Dropoff location is required" },
      ];

      console.log(document.getElementById("bookingForSomeoneElse_Checkbox").checked)
      if (document.getElementById("bookingForSomeoneElse_Checkbox").checked) {
        fields.push(
          { id: "bookingForSomeoneElse_Name", message: "name required" },
          { id: "bookingForSomeoneElse_Email", message: "email required" },
          { id: "bookingForSomeoneElse_PhNumber", message: "phone required" })
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
      const termsCheckbox = document.getElementById("terms");
      const termsError = document.getElementById("terms-error");
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
      const terms = document.getElementById("terms").checked;
      const submitButton = document.getElementById("submitPassInfo");
      const termsError = document.getElementById("terms-error");
      


      console.log("before terms")
      if (!terms) {
        termsError.style.display = "block";
        return;
      }
      console.log("ok terms")
      termsError.style.display = "none";


      const addonInputs = document.querySelectorAll(".addon-input");
      const addon_Ids = [];

      addonInputs.forEach((addon) => {
        if (addon.checked) {
          addon_Ids.push(addon.value);
        }
      });

      console.log(addon_Ids);


      
    const searchInputCustomer = document.getElementById("searchCountryCode-customer");
      const phoneInputCustomer = document.getElementById("phNumber")
      const phoneCustomer =  searchInputCustomer.value + "" + phoneInputCustomer.value

    
      console.log(phoneCustomer)
      const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone: phoneCustomer,
        comment: document.getElementById("comment").value,
        voucher: voucherInput.value,
        flightIdNumber: document.getElementById("flightNumber").value,
        waitingTimeAfterLanding: document.getElementById("waitingTimeAfterLanding").value,
        terms: terms,

        addonIds: addon_Ids,
        complete_going_address: document.getElementById("from").value,
        complete_return_address: document.getElementById("to").value,
        numPassengers: document.getElementById("no_of_passangers").value,
        numSuitcases: document.getElementById("no_of_suitcases").value,

        
      };

      if(document.getElementById('bookingForSomeoneElse_Checkbox').checked){
        const searchInputPassenger = document.getElementById("searchCountryCode-passenger");
        const phoneInputPassenger = document.getElementById("bookingForSomeoneElse_PhNumber")
        const phonePassenger =  searchInputPassenger.value + "" + phoneInputPassenger.value

        data.custName= document.getElementById("bookingForSomeoneElse_Name").value
        data.custEmail= document.getElementById("bookingForSomeoneElse_Email").value
        data.custPhone= phonePassenger
      }

      showLoadingOverlay("Processing your Information");



      console.table(data);

      fetch(
        `/dispatcher/passenger-details/<%-bookingId%>`,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        }
      )
        .then((response) => response.json())
        .then((response) => {
          console.table(response);
          hideLoadingOverlay();
          window.location.href = `/dispatcher/passenger-details/${response.bookingId}`;

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



  // Hide place input on click outside
  document.addEventListener("click", (e) => {
  document.querySelectorAll(".dropdown-menu").forEach((dropDownMenu) => {
    // Close any open dropdown menu if the click is outside the input or dropdown
    if (!e.target.closest(".place") || !e.target.classList.contains("place-input")) {
      dropDownMenu.style.display = "none";
      dropDownMenu.classList.remove("show");
    }
  });
});

</script>


<script>
  // Google api place script
  // Inputs on InputFields when user types any character to find a location
  document.addEventListener("input", async function (event) {
    // Check if the event was triggered by an element with the 'place-input' class
    if (event.target.classList.contains("place-input")) {
      const inputField = event.target;
      const dropDownMenu = inputField.closest(".place").querySelector(".dropdown-menu");

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
        const response = await fetch("/api/public/google/autocomplete", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
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
          item.classList.add("dropdown-item", "place-result");
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
        dropDownMenu.querySelectorAll(".dropdown-item").forEach(item => {
          item.addEventListener("click", function () {
            const selectedValue = this.getAttribute("description");
            const selectedPlaceId = this.getAttribute("place_id");

            inputField.value = selectedValue; // Set input field value
            dropDownMenu.style.display = "none"; // Hide dropdown after selection
            dropDownMenu.classList.remove("show"); // Hide dropdown menu

            // set place id field on input field
            inputField.setAttribute("place_id", selectedPlaceId)

          });
        });

      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }
  });

</script>











































<style>
.booking-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.passenger-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.location-group {
    margin-bottom: 20px;
}

.location-input {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.billing-section {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.billing-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.addons-section {
    margin: 20px 0;
}

.addon-option {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.comment-section {
    margin-bottom: 20px;
}

.comment-section textarea {
    width: 100%;
    height: 100px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.submit-button {
    background: #4CAF50;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

.submit-button:hover {
    background: #45a049;
}

.terms-checkbox {
    margin: 20px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Phone input specific styling */
.phone-input-container {
    display: flex;
    gap: 10px;
}

.country-code {
    width: 80px;
}

/* Loading spinner */
.loading-spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.loading-spinner i {
    font-size: 40px;
    color: #4CAF50;
}
</style>

<div class="booking-container">
    <form id="booking-form">
        <h2>Passenger Information</h2>
        <div class="passenger-info">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullName" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <div class="phone-input-container">
                    <select class="country-code" name="countryCode">
                        <option value="44">+44</option>
                        <!-- Add more country codes -->
                    </select>
                    <input type="tel" name="phone" required>
                </div>
            </div>
            <div class="form-group">
                <label>Landing Flight Number</label>
                <input type="text" name="flightNumber">
            </div>
            <div class="form-group">
                <label>Wait time after landing(minute)</label>
                <select name="waitTime">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
            <div class="form-group">
                <label>No. of Suitcases</label>
                <select name="suitcases">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>

        <div class="location-group">
            <div class="form-group">
                <label>Pickup</label>
                <input type="text" name="pickup" required>
            </div>
            <div class="form-group">
                <label>Dropoff</label>
                <input type="text" name="dropoff" required>
            </div>
        </div>

        <div class="billing-section">
            <h3>Billing (£)</h3>
            <div class="billing-row">
                <span>Forward Journey:</span>
                <span>228.26£</span>
            </div>
            <div class="billing-row">
                <strong>Total</strong>
                <strong>228.26£</strong>
            </div>
        </div>

        <div class="addons-section">
            <h3>Select Add-Ons</h3>
            <div class="addon-option">
                <input type="checkbox" name="addon1" value="1">
                <label>Add on 2 - 1£</label>
            </div>
            <div class="addon-option">
                <input type="checkbox" name="childSeat" value="10">
                <label>Child seat - 10£</label>
            </div>
        </div>

        <div class="comment-section">
            <label>Comment?</label>
            <textarea name="comment"></textarea>
        </div>

        <div class="terms-checkbox">
            <input type="checkbox" name="terms" required>
            <label>I accept the terms and conditions</label>
        </div>

        <button type="submit" class="submit-button">Proceed To Payment</button>
    </form>
</div>

<script>
document.getElementById('booking-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const apiUrlPrefix = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
    const apiKey = '<?php echo nfpl_function_get_api_key(); ?>';

    // Show loading spinner
    document.querySelector('.loading-spinner').style.display = 'flex';

    try {
        const response = await fetch(`${apiUrlPrefix}/booking/create`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'tenant-widgetapikey': apiKey
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (response.ok) {
            const result = await response.json();
            // Redirect to payment page
            window.location.href = `<?php echo nfpl_function_get_navigation_url('payment_page'); ?>?id=${result.bookingId}`;
        } else {
            Toastify({
                text: 'Error submitting booking',
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "red"
            }).showToast();
        }
    } catch (error) {
        console.error('Booking error:', error);
    } finally {
        document.querySelector('.loading-spinner').style.display = 'none';
    }
});
</script>