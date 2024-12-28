<section>
    <div>
        <div id="nfpl_js_style_main_payment_box" style="display: none;">
            <h6>Great!</h6>
            <h5>Booking Ref: <span id="nfpl_js_style_booking_ref"></span> </h5>

            <div class="" style="display:flex; flex-direction:row;">
                <div>
                    <h6>Payment Mode: </h6>
                    <h6>Total Due: </h6>
                    <h6>Date: </h6>
                </div>
                <div>
                    <p id="nfpl_js_style_payment_mode">CASH</p>
                    <p id="nfpl_js_style_total_due"></p>
                    <p id="nfpl_js_style_date"></p>
                </div>
            </div>

            <p>
                A "Booking Received" email has been sent to your inbox. If it&apos;s not there, please check your junk
                or spam folder. Once one of our agents reviews your booking, we&apos;ll send a confirmation email. Thank
                you for booking with us, and we wish you a pleasant journey!
            </p>

        </div>

        <div id="nfpl_js_style_no_booking_to_show" style="display:none;">
            <h2>No booking to show</h2>
        </div>
    </div>
</section>

<script>
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const rawSearch = window.location.search;
    console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    const apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);
    const req_GET_success_InfoOnLoadUrl = `${apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`;
    const req_GET_price = `${apiUrlPrefixs}/plugin/dispatcher/widget-booking/${bookingId}/price`


    const headers = {
        'Content-Type': 'application/json',
        'tenant-widgetapikey': `${apikey}`
    }

</script>
<!-- ?id=676efdcc7bb7ba3d90bf65f5 -->

<script>
    const fetchInfo = async () => {
        const nfpl_var_paymentMode = document.getElementById('nfpl_js_style_payment_mode');
        const nfpl_var_paymentDue = document.getElementById('nfpl_js_style_total_due');
        const nfpl_var_paymentDate = document.getElementById('nfpl_js_style_date');

        const nfpl_var_bookingRef = document.getElementById('nfpl_js_style_booking_ref');


        const nfpl_var_paymentBox = document.getElementById('nfpl_js_style_main_payment_box')
        const nfpl_var_NoPaymentToShowBox = document.getElementById('nfpl_js_style_no_booking_to_show')

        console.log(nfpl_var_paymentBox, nfpl_var_NoPaymentToShowBox)

        if (!bookingId) {
            nfpl_var_paymentBox.style.display = 'none';
            nfpl_var_NoPaymentToShowBox.style.display = 'block';
            console.log(nfpl_var_paymentBox, nfpl_var_NoPaymentToShowBox)

            return;
        }


        nfpl_var_paymentBox.style.display = 'block';
        nfpl_var_NoPaymentToShowBox.style.display = 'none';


        
        try {
            const response = await fetch(req_GET_success_InfoOnLoadUrl,
                {
                    method: 'GET',
                    headers: headers
                }
            )
            const data = await response.json()
            console.log("DATA HERE", data)
            // return data

            nfpl_var_paymentDate.innerText=data.bookedAt;
            nfpl_var_bookingRef.innerText= data.reference;

        } catch (error) {
            console.error(error)
        }


        try {
            const response2 = await fetch(req_GET_price,
                {
                    method: 'GET',
                    headers: headers
                }
            )
            const data2 = await response2.json()
            console.log("DATA HERE2", data2)

            
            nfpl_var_paymentMode.innerText = 'CASH'
            nfpl_var_paymentDue.innerText= data2.price;
            // return data2
        } catch (error) {
            console.error(error)
        }
    }

    document.addEventListener('DOMContentLoaded', (e) => {
        fetchInfo()
    })
</script>