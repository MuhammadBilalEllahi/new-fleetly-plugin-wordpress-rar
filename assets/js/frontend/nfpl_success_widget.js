
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

        nfpl_var_paymentDate.innerText = data.bookedAt;
        nfpl_var_bookingRef.innerText = data.reference;

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
        nfpl_var_paymentDue.innerText = data2.price;
        // return data2
    } catch (error) {
        console.error(error)
    }
}

document.addEventListener('DOMContentLoaded', (e) => {
    fetchInfo()
})