
const fetchInfo = async () => {
    const nfpl_var_paymentMode = document.getElementById('nfpl_js_style_payment_mode');
    const nfpl_var_paymentDue = document.getElementById('nfpl_js_style_total_due');
    const nfpl_var_paymentDate = document.getElementById('nfpl_js_style_date');

    const nfpl_var_bookingRef = document.getElementById('nfpl_js_style_booking_ref');


    const nfpl_var_paymentBox = document.getElementById('nfpl_js_style_main_payment_box')
    const nfpl_var_NoPaymentToShowBox = document.getElementById('nfpl_js_style_no_booking_to_show')


    const nfpl_var_paymentStatus = document.getElementById('nfpl_js_style_payment_status')
    const nfpl_var_paymentPaid = document.getElementById('nfpl_js_style_payment_paid')

    console.log(nfpl_var_paymentBox, nfpl_var_NoPaymentToShowBox)

    if (!bookingId) {
        nfpl_var_paymentBox.style.display = 'none';
        nfpl_var_NoPaymentToShowBox.style.display = 'block';
        console.log(nfpl_var_paymentBox, nfpl_var_NoPaymentToShowBox)

        return;
    }


    nfpl_var_paymentBox.style.display = 'block';
    nfpl_var_NoPaymentToShowBox.style.display = 'none';



    // try {
    //     const response = await fetch(req_GET_success_InfoOnLoadUrl,
    //         {
    //             method: 'GET',
    //             headers: headers
    //         }
    //     )
    //     const data = await response.json()
    //     console.log("DATA HERE", data)
    //     // return data





    // } catch (error) {
    //     console.error(error)
    // }


    try {
        const response2 = await fetch(req_GET_price,
            {
                method: 'GET',
                headers: headers
            }
        )
        const data2 = await response2.json()
        console.log("DATA HERE2", data2)




        const realTotalPrice = data2.booking.totalPrice + (data2.booking?.linkedBooking?.totalPrice || 0);
        // console.log("REAL TOTAL PRICE", realTotalPrice, data2.booking.totalPrice, data2.booking.linkedBooking.totalPrice)
        nfpl_var_paymentMode.innerText = data2.booking.paymentMethod
        nfpl_var_paymentStatus.innerText = data2.booking.paid
        nfpl_var_paymentPaid.innerText = data2.booking.payment_status
        nfpl_var_paymentDue.innerText = realTotalPrice;

        nfpl_var_paymentDate.innerText = data2.booking.booked_at;
        nfpl_var_bookingRef.innerText = data2.booking.reference;


        document.getElementById("nfpl_js_styles_reference").textContent =
            data2.booking.reference;
        document.getElementById("nfpl_js_styles_pickup_time").textContent =
            data2.booking.startTime;
        document.getElementById("nfpl_js_styles_pickup_location").textContent =
            data2.booking.from_desc;
        document.getElementById("nfpl_js_styles_dropoff_location").textContent =
            data2.booking.to_desc;
        document.getElementById("nfpl_js_styles_booked_at").textContent =
            data2.booking.booked_at;
        document.getElementById("nfpl_js_styles_duration").textContent =
            data2.booking.duration;
        // return data2
    } catch (error) {
        console.error(error)
    }
}

document.addEventListener('DOMContentLoaded', (e) => {
    fetchInfo()
})




// bookingData.quotations.forEach((quotation, index) => {
//     const quotationCard = document.createElement("div");
//     quotationCard.classList.add("nfpl_js_styles_quotation_card");
//     quotationCard.innerHTML = `
//     <img src="${quotation.vehicle_type_icon}" alt="${quotation.vehicle_type_name
//         }">
//     <h3 id="fleet-title-quotation">${quotation.vehicle_type_name
//         }</h3>
//     <div class="quotation-details">
//         <p>Capacity: x${quotation.vehicle_type_capacity}</p>
//         <p>Luggage: x${quotation.vehicle_type_luggage_capacity
//         }</p>
//         <p>Small Luggage: x${quotation.vehicle_type_small_luggage
//         }</p>
//     </div>
//     <div class="quotation-price">£${quotation.totalPrice}</div>
//      ${!returnBookingExists
//             ? "<button>Book Now</button>"
//             : `<input type="radio" style="width: 15px; height: 15px" name="nfpl_js_style_radio_select_quotation"
//             id="nfpl_js_styles_select_${index}" class="nfpl_styles_select_radio"
//             data-quotation-index="${index}" />`
//         }
// `;

//     if (!returnBookingExists) {
//         quotationCard.addEventListener("click", () =>
//             selectQuotation(index, bookingId)
//         );
//     }
//     quotationsDiv.appendChild(quotationCard);
// });