
document.addEventListener("DOMContentLoaded", async () => {

    if (!bookingId) {
        showToast({
            message: "No Booking Id Found", type: "error",
            duration: 2000,
        });
        return;
    }

    const spinner = document.getElementById("nfpl_js_styles_spinner");
    spinner.style.display = "block"; // Show the spinner

    try {
        const response = await fetch(req_GET_quotations
            ,
            {
                method: "GET",
                headers: nfpl_headers,
            }
        );

        if (response.ok) {
            const bookingData = await response.json();
            console.log("Booking Details:", bookingData, bookingData.staticMap);

            const returnBookingExists = bookingData?.isReturn;
            console.log("AYO", returnBookingExists)

            if (returnBookingExists) {
                document.getElementById("nfpl_js_styles_isReturn").style.display = 'flex';

                document.getElementById("nfpl_js_styles_pickup_time_return").textContent =
                    bookingData.returnBooking.startDate;
                document.getElementById("nfpl_js_styles_pickup_location_return").textContent =
                    bookingData.returnBooking.from_desc;
                document.getElementById("nfpl_js_styles_dropoff_location_return").textContent =
                    bookingData.returnBooking.to_desc;



                // Via locations handling
                const viaLocationsDiv = document.getElementById("nfpl_js_styles_via_locations_return");
                viaLocationsDiv.innerHTML = "";

                if (bookingData.returnBooking.via && bookingData.returnBooking.via.length > 0) {
                    bookingData.returnBooking.via.forEach((viaLocation) => {
                        const viaLocationP = document.createElement("p");
                        viaLocationP.innerHTML = `${viaLocation.desc}`;
                        viaLocationsDiv.appendChild(viaLocationP);
                    });
                } else {
                    viaLocationsDiv.innerHTML = "<p>N/A</p>";
                }

            }

            // Set booking details
            // document.getElementById("nfpl_js_styles_reference").textContent =
            //     bookingData.reference !== "" ? bookingData.reference : 'Nil';
            document.getElementById("nfpl_js_styles_pickup_time").textContent =
                bookingData.startDate;
            document.getElementById("nfpl_js_styles_pickup_location").textContent =
                bookingData.from_desc;
            document.getElementById("nfpl_js_styles_dropoff_location").textContent =
                bookingData.to_desc;
            document.getElementById("nfpl_js_styles_booked_at").textContent =
                bookingData.bookedAt;
            document.getElementById("nfpl_js_styles_duration").textContent =
                bookingData.duration;
            document.getElementById("nfpl_map").src = bookingData.staticMap;

            const realTotalPrice = 0;
            // bookingData.booking.priceToCharge + (bookingData.booking?.linkedBooking?.priceToCharge ? bookingData.booking.linkedBooking.priceToCharge : 0);

            // Via locations handling
            const viaLocationsDiv = document.getElementById("nfpl_js_styles_via_locations");
            viaLocationsDiv.innerHTML = "";

            if (bookingData.via && bookingData.via.length > 0) {
                bookingData.via.forEach((viaLocation) => {
                    const viaLocationP = document.createElement("p");
                    viaLocationP.innerHTML = `${viaLocation.desc}`;
                    viaLocationsDiv.appendChild(viaLocationP);
                });
            } else {
                viaLocationsDiv.innerHTML = "<p>N/A</p>";
            }

            // Generate quotation cards
            const quotationsDiv = document.getElementById(
                "nfpl_js_style_quotation_cards"
            );
            bookingData.quotations.forEach((quotation, index) => {
                const quotationCard = document.createElement("div");
                quotationCard.classList.add("nfpl_js_styles_quotation_card");
                quotationCard.innerHTML = `
                <img src="${quotation.vehicle_type_icon}" alt="${quotation.vehicle_type_name
                    }">
                <h3 id="fleet-title-quotation">${quotation.vehicle_type_name
                    }</h3>
                <div class="quotation-details">
                    <p>Capacity: x${quotation.vehicle_type_capacity}</p>
                    <p>Luggage: x${quotation.vehicle_type_luggage_capacity
                    }</p>
                    <p>Small Luggage: x${quotation.vehicle_type_small_luggage
                    }</p>
                </div>
                <div class="quotation-price">£${quotation.priceToCharge}</div>
                 ${!returnBookingExists
                        ? `<button >   
                          <p class="nfpl_book_now_button" data-quotation-index="${index}">  Book Now</p>
                            <div  id="nfpl_completeButton_spinner" style="display: none; height: 5px; width: 5px;" class="nfpl_js_styles_spinner nfpl_bookNowButton_spinner">
                            </div>
                            </button>`
                        : `<input type="radio" style="width: 15px; height: 15px" name="nfpl_js_style_radio_select_quotation"
                        id="nfpl_js_styles_select_${index}" class="nfpl_styles_select_radio"
                        data-quotation-index="${index}" />`
                    }
            `;

                if (!returnBookingExists) {
                    quotationCard.addEventListener("click", () =>
                        selectQuotation(index, bookingId, false)
                    );
                }
                quotationsDiv.appendChild(quotationCard);
            });

            if (returnBookingExists) {
                const returnQuotationH1 = document.getElementById(
                    "nfpl_js_style_return_quotation_h1"
                );
                returnQuotationH1.style.display = "block";

                const returnQuotationDiv = document.getElementById(
                    "nfpl_js_style_return_quotation_cards"
                );

                bookingData.returnQuotations.forEach((returnQuotation, index) => {
                    const returnQuotationCard = document.createElement("div");
                    returnQuotationCard.classList.add("nfpl_js_styles_quotation_card");
                    returnQuotationCard.innerHTML = `
                    <img src="${returnQuotation.vehicle_type_icon}" alt="${returnQuotation.vehicle_type_name}">
                    <h3 id="fleet-title-quotation">${returnQuotation.vehicle_type_name}</h3>
                    <div class="quotation-details">
                        <p>Capacity: x${returnQuotation.vehicle_type_capacity}</p>
                        <p>Luggage: x${returnQuotation.vehicle_type_luggage_capacity}</p>
                        <p>Small Luggage: x${returnQuotation.vehicle_type_small_luggage}</p>
                    </div>
                    <div class="quotation-price">£${returnQuotation.totalPrice}</div>
                    <input type="radio" style="width: 15px; height: 15px" name="nfpl_js_style_radio_select_return_quotation"
                                id="nfpl_js_styles_select_return_${index}" class="nfpl_styles_select_return_radio"
                                data-quotation-index="${index}" />

                `;
                    returnQuotationDiv.appendChild(returnQuotationCard);
                });
            }

            if (returnBookingExists) {
                addEventToRadio();
            }

            if (returnBookingExists) {
                const returnBookingButton = document.getElementById(
                    "nfpl_js_btn_onCompelete_return"
                );
                returnBookingButton.style.display = "block";

                returnBookingButton.addEventListener("click", () => {
                    console.log("clicks");
                    // Get the selected going quotation
                    const selectedGoingQuotation = document.querySelector(
                        'input[name="nfpl_js_style_radio_select_quotation"]:checked'
                    );
                    const goingQuotationIndex = selectedGoingQuotation
                        ? selectedGoingQuotation.dataset.quotationIndex
                        : null;

                    // Get the selected return quotation if available
                    const selectedReturnQuotation = document.querySelector(
                        'input[name="nfpl_js_style_radio_select_return_quotation"]:checked'
                    );
                    const returnQuotationIndex = selectedReturnQuotation
                        ? selectedReturnQuotation.dataset.quotationIndex
                        : null;

                    if (!selectedReturnQuotation) {
                        showToast({
                            message: "Select a Quotation", type: "info",
                            duration: 2000,
                        });
                        return

                    }

                    if (!selectedGoingQuotation) {
                        showToast({
                            message: "Select a Quotation", type: "info",
                            duration: 2000,
                        });
                        return
                    }
                    // console.log("checked ", selectedGoingQuotation);

                    const data = {
                        bookingId: bookingId,
                        quotation: goingQuotationIndex,
                        returnQuotation: returnQuotationIndex,
                    };

                    // console.log("Sending data for next step:", data);
                    runQuery(data, bookingId, true);
                });
            }
        } else {
            console.error("Failed to fetch booking details:", response.statusText);
        }
    } catch (error) {
        console.error("Error fetching booking details:", error);
    } finally {
        spinner.style.display = "none"; // Hide the spinner after the fetch is done
        document.getElementById('npfl_style_quotation_container_child').style.display = 'block'
    }



});

async function selectQuotation(index, bookingId, returnBookingExists) {
    const data = {
        returnQuotation: "",
        quotation: index.toString(),
        hasReturnQuotation: "0",
    };

    runQuery(data, bookingId, returnBookingExists, index);
}

async function runQuery(data, bookingId, returnBookingExists, index) {


    if (returnBookingExists) {
        // Show the spinner while selecting quotation
        const spinner = document.getElementById("nfpl_completeButton_spinner");
        spinner.style.display = "block"; // Show spinner

        const completeButton = document.getElementById("nfpl_completeButton");
        completeButton.style.display = "none"; // Show spinner

        const nfpl_js_style_quotation_cards = document.getElementById("nfpl_js_style_quotation_cards")
        const nfpl_js_style_return_quotation_cards = document.getElementById("nfpl_js_style_return_quotation_cards")

        nfpl_js_style_quotation_cards.style.opacity = "0.7";
        nfpl_js_style_return_quotation_cards.style.opacity = "0.7";

        nfpl_js_style_quotation_cards.style.pointerEvents = "none";
        nfpl_js_style_return_quotation_cards.style.pointerEvents = "none";
    } else {

        const nfpl_book_now_buttons = document.querySelectorAll('.nfpl_book_now_button');

        nfpl_book_now_buttons.forEach(button => {
            // console.log("data set", button.dataset.quotationIndex, index, button.dataset.quotationIndex === index.toString(), button.dataset.quotationIndex === index)
            if (button.dataset.quotationIndex === index.toString()) {
                button.textContent = 'Selected'

            } else {
                button.style.display = 'none'

            }
        })

        const spinners = document.querySelectorAll(".nfpl_bookNowButton_spinner");
        spinners.forEach(spinner => spinner.style.display = 'block');
        const nfpl_js_style_quotation_cards = document.getElementById("nfpl_js_style_quotation_cards")
        nfpl_js_style_quotation_cards.style.opacity = "0.7";
        nfpl_js_style_quotation_cards.style.pointerEvents = "none";

        const nfpl_js_styles_quotation_card = document.querySelectorAll('.nfpl_js_styles_quotation_card')
        nfpl_js_styles_quotation_card.forEach(card => console.log(card))


    }


    // console.log(nfpl_js_style_quotation_cards)


    try {
        const response = await fetch(req_POST_quotations
            ,
            {
                method: "POST",
                headers: nfpl_headers,
                body: JSON.stringify(data),
            }
        );

        if (response.ok) {
            console.log("Quotation selected successfully", data);

            showToast({
                message: "The quotation has been selected successfully.",
                type: "success",
                duration: 2000,
            });

            window.location.href = `${bookingPageUrl}?id=${bookingId}`;

        } else {
            console.error("Failed to select quotation:", response.statusText);
            showToast({
                message: "An error occurred while selecting the quotation.",
                type: "error",
                duration: 2000,
            });
        }
    } catch (error) {
        console.error("Error selecting quotation:", error);
        showToast({
            message: "Error Selecting a Quotation", type: "error",
            duration: 2000,
        });
    } finally {
        if (returnBookingExists) {

            const spinner = document.getElementById("nfpl_completeButton_spinner");
            const completeButton = document.getElementById("nfpl_completeButton");
            const nfpl_js_style_quotation_cards = document.getElementById("nfpl_js_style_quotation_cards")
            const nfpl_js_style_return_quotation_cards = document.getElementById("nfpl_js_style_return_quotation_cards")


            spinner.style.display = "none"; // Hide spinner after the process is complete
            completeButton.style.display = "block"; // Show spinner

            nfpl_js_style_quotation_cards.style.opacity = "1";
            nfpl_js_style_return_quotation_cards.style.opacity = "1";

            nfpl_js_style_quotation_cards.style.pointerEvents = "unset";
            nfpl_js_style_return_quotation_cards.style.pointerEvents = "unset";
        } else {
            const nfpl_book_now_buttons = document.querySelectorAll('.nfpl_book_now_button');

            nfpl_book_now_buttons.forEach(button => {
                button.textContent = 'Book Now';

                button.style.display = 'block'
            })

            const spinners = document.querySelectorAll(".nfpl_bookNowButton_spinner");
            spinners.forEach(spinner => spinner.style.display = 'none');
            const nfpl_js_style_quotation_cards = document.getElementById("nfpl_js_style_quotation_cards")
            nfpl_js_style_quotation_cards.style.opacity = "1";
            nfpl_js_style_quotation_cards.style.pointerEvents = "unset";
        }

    }
}

function addEventToRadio() {
    const nfpl_quotation_cards = document.getElementById(
        "nfpl_js_style_quotation_cards"
    );
    const nfpl_return_quotation_cards = document.getElementById(
        "nfpl_js_style_return_quotation_cards"
    );

    const quotationCards = nfpl_quotation_cards.querySelectorAll(
        ".nfpl_js_styles_quotation_card "
    );
    const returnQuotationCards = nfpl_return_quotation_cards.querySelectorAll(
        ".nfpl_js_styles_quotation_card "
    );

    function handleCardClick(card, radioInput) {
        // Unhighlight all cards
        quotationCards.forEach((card) => {
            card.style.borderColor = "var(--var-border-color)";
            card.classList.remove("selected");
        });

        // Select the radio input and highlight the clicked card
        radioInput.checked = true;
        card.style.borderColor = "gold";
        card.classList.add("selected");
    }
    function handleCardClickReturn(card, radioInput) {
        // Unhighlight all cards
        returnQuotationCards.forEach((card) => {
            card.style.borderColor = "var(--var-border-color)";
            card.classList.remove("selected");
        });

        // Select the radio input and highlight the clicked card
        radioInput.checked = true;
        card.style.borderColor = "gold";
        card.classList.add("selected");
    }

    quotationCards.forEach((card) => {
        const radioInput = card.querySelector("input[type='radio']");
        if (radioInput) {
            card.addEventListener("click", () => handleCardClick(card, radioInput));
        }
    });

    returnQuotationCards.forEach((card) => {
        const radioInput = card.querySelector("input[type='radio']");
        if (radioInput) {
            card.addEventListener("click", () =>
                handleCardClickReturn(card, radioInput)
            );
        }
    });
}




/**
 * Clears all input fields in the booking widget.
 */
function clearBookingFormFields() {
    // Get all input fields within the widget container

    const inputs = document.querySelectorAll(
        ".npfl_style_quotation_container input"
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
