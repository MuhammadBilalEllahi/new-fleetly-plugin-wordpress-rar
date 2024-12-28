<!-- Payment Container -->

<div id="nfpl_style_payment_container">
    <h1 id="nfpl_style_payment_heading">Payment Method</h1>
    <p id="nfpl_style_payment_text">You can pay with cash to the driver or with a card</p>
    <div id="nfpl_style_payment_price">Price: £<span id="nfpl_js_style_price">Loading...</span></div>
    <div id="nfpl_js_style_payment_method">
        <div class="nfpl_style_payOption_button nfpl_style_cash_button" id="nfpl_js_style_cash_option">
            <input name="paymentMethod" value="cash" type="radio"> <span>Pay with Cash</span>
        </div>
        <div class="nfpl_style_payOption_button nfpl_style_card_button" id="nfpl_js_style_card_option">
            <input name="paymentMethod" value="card" type="radio"> <span>Pay with Card</span>
        </div>
    </div>
    <button id="nfpl_js_submit_button">Continue</button>
</div>

<!-- Spinner -->
<div id="nfpl_js_style_loading_spinner" style="display: none;">
    <i class="fas fa-spinner fa-spin"></i>
    <p>Processing payment, please wait...</p>
</div>


<style>
    #nfpl_style_payment_container {
        display: flex;
        flex-direction: column;
        justify-content: start;
        padding: 20px;
    }

    #nfpl_style_payment_heading {
        font-size: 1.5rem;
        margin-bottom: 3px;
    }

    #nfpl_style_payment_text {
        font-size: 1rem;
        margin-bottom: 2px;
    }

    #nfpl_style_payment_price {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    #nfpl_js_style_payment_method {
        display: flex;
        flex-direction: column;
        row-gap: 0.4rem;
        width: 100%;
    }

    .nfpl_style_payOption_button {
        display: flex;
        flex-direction: row;
        align-items: center;
        border: 0.7px solid var(--var-primary-color);
        width: 100%;
        padding:  0.5rem;
        background-color: transparent;
        border-radius: 0.5rem;

    }
    .nfpl_style_payOption_button span{
        font-size: 0.9rem;
    }

    .nfpl_style_cash_button {}

    .nfpl_style_card_button {}

    .nfpl_style_cash_button:hover,
    .nfpl_style_card_button:hover {
        opacity: 0.9;
    }

    #nfpl_js_submit_button{
        border: none;
        background-color: lightgreen !important;
        color: black;
        width: min-content;
        padding: 0.5rem 0.6rem;
        margin: 0.5rem 0;
        border-radius: 0.4rem;
    }

    #nfpl_js_style_loading_spinner {
        display: none;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.9);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
    }

    .nfpl_js_styles_d_none {
        display: none;
    }
</style>














<script>
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const rawSearch = window.location.search;
    // console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    // console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    const apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);


    const bookingPageUrl = '<?php echo esc_url(nfpl_function_get_navigation_url(SUCCESS_WIDGET)); ?>';
    const cancelPageUrl = '<?php echo esc_url(nfpl_function_get_navigation_url(PAYMENT_DETAILS_WIDGET)); ?>'; // Cancel URL

    const req_GET_price = `${apiUrlPrefixs}/plugin/dispatcher/widget-booking/${bookingId}/price`
    const req_POST_payment_cash = `${apiUrlPrefixs}/plugin/dispatcher/widget-paywithcash/${bookingId}`
    const req_POST_payment_card = `${apiUrlPrefixs}/plugin/dispatcher/widget-paywithcard/${bookingId}`

    const headers = {
        'Content-Type': 'application/json',
        'tenant-widgetapikey': `${apikey}`
    }

    const redirect_to_successPage = `${bookingPageUrl}?id=${bookingId}`;

    const CASH = 'cash';
    const CARD = 'card';
</script>


<script>
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
            } else if(paymentType === CARD) {
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
            else{
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
    document.getElementById('nfpl_js_style_cash_option').addEventListener('click', function() {
        this.closest('.nfpl_style_payOption_button').querySelector('input[type="radio"]').checked = true;
    });

    document.getElementById('nfpl_js_style_card_option').addEventListener('click', function() {
        this.closest('.nfpl_style_payOption_button').querySelector('input[type="radio"]').checked = true;
    });
    

    document.getElementById('nfpl_js_submit_button').addEventListener('click', function() {
        const paymentMethod = document.querySelector('input[type="radio"]:checked').value;
        paymentMethod === CARD ?
            processPayment(CARD) :
            paymentMethod === CASH ?
            processPayment(CASH) : null;
    });
</script>