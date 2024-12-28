
// Function to fetch price dynamically based on booking ID
async function fetchPrice() {
    try {

        const response = await fetch(req_GET_price, {
            method: 'GET',
            headers: headers
        });
        if (response.ok) {
            const data = await response.json();
            console.log('Price:', data);
            document.getElementById('nfpl_js_style_price').textContent = data.price;
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
                headers: headers,
                body: JSON.stringify({
                    bookingPageUrl
                })
            });
        } else if (paymentType === CARD) {
            // Card payment with cancel URL
            response = await fetch(req_POST_payment_card, {
                method: 'POST',
                headers: headers,
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
});

document.getElementById('nfpl_js_style_card_option').addEventListener('click', function () {
    this.closest('.nfpl_style_payOption_button').querySelector('input[type="radio"]').checked = true;
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
