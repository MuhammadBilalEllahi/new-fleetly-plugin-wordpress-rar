
// Function to fetch price dynamically based on booking ID
async function fetchPrice() {
    try {

        const response = await fetch(req_GET_price, {
            method: 'GET',
            headers: nfpl_headers
        });
        if (response.ok) {
            const data = await response.json();
            console.log('Price:', data);
            document.getElementById('nfpl_js_style_price').textContent = data.booking.priceToCharge + (data?.returnBooking?.priceToCharge ?? 0);

            // const returnBookingExists = data?.booking?.returnQuotations?.length > 0;
            const returnBookingExists = data?.returnBooking?.isReturn;
            // Set booking details
            document.getElementById("nfpl_js_styles_reference").textContent =
                data.booking.reference;
            document.getElementById("nfpl_js_styles_pickup_time").textContent =
                data.booking.startDate;
            document.getElementById("nfpl_js_styles_pickup_location").textContent =
                data.booking.from_desc;
            document.getElementById("nfpl_js_styles_dropoff_location").textContent =
                data.booking.to_desc;
            document.getElementById("nfpl_js_styles_booked_at").textContent =
                data.booking.booked_at;
            document.getElementById("nfpl_js_styles_duration").textContent =
                data.booking.durationText;
            document.getElementById("nfpl_map").src = data.booking.staticmap;

            console.log(returnBookingExists)
            if (returnBookingExists) {
                document.getElementById('nfpl_js_style_isReturn').style.display = 'flex';
                document.getElementById("nfpl_js_styles_pickup_time_return").textContent =
                    data.returnBooking?.startDate;
                document.getElementById("nfpl_js_styles_pickup_location_return").textContent =
                    data.returnBooking?.from_desc;
                document.getElementById("nfpl_js_styles_dropoff_location_return").textContent =
                    data.returnBooking?.to_desc;


                const viaLocationsDiv = document.getElementById("nfpl_js_styles_via_locations_return");
                viaLocationsDiv.innerHTML = "";

                console.log("WHAT", data.returnBooking)
                if (data.returnBooking.via && data.returnBooking.via.length > 0) {
                    data.returnBooking.via.forEach((viaLocation) => {
                        const viaLocationP = document.createElement("p");
                        viaLocationP.innerHTML = `${viaLocation.desc}`;
                        viaLocationsDiv.appendChild(viaLocationP);
                    });
                } else {
                    viaLocationsDiv.innerHTML = "<p>N/A</p>";
                }
            }

            // Via locations handling
            const viaLocationsDiv = document.getElementById("nfpl_js_styles_via_locations");
            viaLocationsDiv.innerHTML = "";

            console.log("WHAT", data.booking)
            if (data.booking.via && data.booking.via.length > 0) {
                data.booking.via.forEach((viaLocation) => {
                    const viaLocationP = document.createElement("p");
                    viaLocationP.innerHTML = `${viaLocation.desc}`;
                    viaLocationsDiv.appendChild(viaLocationP);
                });
            } else {
                viaLocationsDiv.innerHTML = "<p>N/A</p>";
            }



        } else {
            document.getElementById('nfpl_js_style_price').textContent = 'Error fetching price';
        }
    } catch (error) {
        console.error('Error fetching price:', error);
        document.getElementById('nfpl_js_style_price').textContent = 'Error';
    }
}

// Fetch price when the page loads
document.addEventListener('DOMContentLoaded', fetchPrice);

// Show spinner and hide payment buttons
function showSpinner() {
    document.getElementById('nfpl_js_submit_button').disabled = true;
    document.getElementById('nfpl_js_style_loading_spinner').style.display = 'flex';
}

// Hide spinner and show payment buttons (if needed for error handling)
function hideSpinner() {
    document.getElementById('nfpl_js_submit_button').disabled = false;
    document.getElementById('nfpl_js_style_loading_spinner').style.display = 'none';
}

// Payment method actions for cash and card
async function processPayment(paymentType) {
    console.log(`${paymentType} payment selected`);
    showSpinner(); // Show spinner when payment starts

    try {
        let response;
        if (paymentType === CASH) {
            // Cash payment

            response = await fetch(req_POST_payment_cash, {
                method: 'POST',
                headers: nfpl_headers,
                body: JSON.stringify({
                    bookingPageUrl
                })
            });
        } else if (paymentType === CARD) {
            // Card payment with cancel URL
            response = await fetch(req_POST_payment_card, {
                method: 'POST',
                headers: nfpl_headers,
                body: JSON.stringify({
                    bookingPageUrl,
                    cancelPageUrl // Send cancel page URL as part of the request body
                })
            });

            if (response.ok) {
                const data = await response.json();
                window.location.href = data.url; // Redirect to Stripe's payment page
                return;
            }
        }
        else {
            console.error('Invalid payment type');
            hideSpinner(); // Hide spinner if payment fails
        }

        if (response.ok) {
            window.location.href = redirect_to_successPage;
        } else {
            console.error('Payment failed');
            hideSpinner(); // Hide spinner if payment fails
        }
    } catch (error) {
        console.error('Error during payment:', error);
        hideSpinner(); // Hide spinner if there is an error
    }
}



// Event listeners for the buttons
document.getElementById('nfpl_js_style_cash_option').addEventListener('click', function () {
    this.closest('.nfpl_style_payOption_button').querySelector('input[type="radio"]').checked = true;

    const nfpl_js_style_cash_option = document.getElementById('nfpl_js_style_cash_option')
    const nfpl_js_style_card_option = document.getElementById('nfpl_js_style_card_option')


    nfpl_js_style_cash_option.classList.add('active')
    nfpl_js_style_card_option.classList.remove('active')


});

document.getElementById('nfpl_js_style_card_option').addEventListener('click', function () {
    this.closest('.nfpl_style_payOption_button').querySelector('input[type="radio"]').checked = true;

    const nfpl_js_style_cash_option = document.getElementById('nfpl_js_style_cash_option')
    const nfpl_js_style_card_option = document.getElementById('nfpl_js_style_card_option')

    nfpl_js_style_card_option.classList.add('active')
    nfpl_js_style_cash_option.classList.remove('active')

});


document.getElementById('nfpl_js_submit_button').addEventListener('click', function () {
    const paymentMethod = document.querySelector('input[type="radio"]:checked').value;
    paymentMethod === CARD ?
        processPayment(CARD) :
        paymentMethod === CASH ?
            processPayment(CASH) : null;
});











/**
 * Clears all input fields in the payment widget.
 */
function clearBookingFormFields() {
    // Get all input fields within the widget container
    const inputs = document.querySelectorAll(
        ".nfpl_js_style_payment_method input"
    );

    inputs.forEach((input) => {
        // Clear the value of each input field
        input.value = "";

    });
    const spinner = document.getElementById('nfpl_js_style_loading_spinner').style.display = 'none';

}

/**
 * Handles the 'popstate' or 'beforeunload' events to clear form fields when navigating.
 */
window.addEventListener("beforeunload", clearBookingFormFields);
window.addEventListener("popstate", clearBookingFormFields);
