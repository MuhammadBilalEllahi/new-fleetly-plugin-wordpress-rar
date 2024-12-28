<!-- HTML Structure -->
<div id="npfl_style_quotation_container">
    <h1 id="nfpl_styles_title_quotation" style="text-align:center;">Quotations</h1>
    <!-- Booking Details Section -->
    <div id="nfpl_styles_booking_details">
        <h2 style="text-align:center;">Passenger Booking Details</h2>
        <div id="nfpl_styles_sub_booking_details">
        <div class="nfpl_styles_detail">
                <h3>Pickup Location:</h3>
                <p style="width: 100%;" id="nfpl_js_styles_pickup_location">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Dropoff Location:</h3>
                <p style="width: 100%;" id="nfpl_js_styles_dropoff_location">Loading...</p>
            </div>


            <div class="nfpl_styles_detail">
                <h3>Reference #:</h3>
                <p id="nfpl_js_styles_reference">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Pickup Time:</h3>
                <p id="nfpl_js_styles_pickup_time">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Pickup Location:</h3>
                <p id="nfpl_js_styles_pickup_location">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Dropoff Location:</h3>
                <p id="nfpl_js_styles_dropoff_location">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Booked At:</h3>
                <p id="nfpl_js_styles_booked_at">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Duration:</h3>
                <p id="nfpl_js_styles_duration">Loading...</p>
            </div>
            <div class="nfpl_styles_detail">
                <h3>Via:</h3>
                <p id="nfpl_js_styles_via_locations">Loading...</p>
            </div>
        </div>
    </div>

    <h2 id="nfpl_styles_title2_quotation">Please Select A Fleet</h2>

    <div id="nfpl_js_styles_spinner" style="display: none;" class="nfpl_js_styles_spinner"></div>
    <!-- Spinner Element -->
    <div id="nfpl_js_style_quotation_cards"></div>
    <!-- Dynamic fleet/quotation cards will be generated here -->
    <h1 id="nfpl_js_style_return_quotation_h1" style="display: none;">Return Quotations</h1>
    <div id="nfpl_js_style_return_quotation_cards"></div>
    <button id="nfpl_js_btn_onCompelete_return" style="display: none;">Complete</button>
</div>







<script>
    document.addEventListener("DOMContentLoaded", async () => {
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const rawSearch = window.location.search;
    // console.log("Raw search string:", rawSearch);
    const cleanedSearch = rawSearch.replace(/\?([^?]*)\?/, "?$1&");
    // console.log("Cleaned search string:", cleanedSearch);
    const urlParams = new URLSearchParams(cleanedSearch);
    const bookingId = urlParams.get("id");
    const apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    console.log("Booking ID:", bookingId);

    if (!bookingId) {
        alert("No booking found.");
        return;
    }

    const spinner = document.getElementById("nfpl_js_styles_spinner");
    spinner.style.display = "block"; // Show the spinner

    try {
        const response = await fetch(
            `${apiUrlPrefixs}/plugin/dispatcher/widget-quotations/${bookingId}`,
            {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "tenant-widgetapikey": `${apikey}`,
                },
            }
        );

        if (response.ok) {
            const bookingData = await response.json();
            console.log("Booking Details:", bookingData);

            const returnBookingExists = bookingData?.returnQuotations.length > 0;
            // Set booking details
            document.getElementById("nfpl_js_styles_reference").textContent =
                bookingData.reference;
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

            // Via locations handling
            const viaLocationsDiv = document.getElementById(
                "nfpl_js_styles_via_locations"
            );
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
                    <div class="quotation-price">£${quotation.totalPrice}</div>
                     ${!returnBookingExists
                        ? "<button>Book Now</button>"
                        : `<input type="radio" style="width: 15px; height: 15px" name="nfpl_js_style_radio_select_quotation"
                            id="nfpl_js_styles_select_${index}" class="nfpl_styles_select_radio"
                            data-quotation-index="${index}" />`
                    }
                `;

                if (!returnBookingExists) {
                    quotationCard.addEventListener("click", () =>
                        selectQuotation(index, bookingId)
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
                        return alert("select a quotation");
                    }

                    if (!selectedGoingQuotation) {
                        return alert("select a quotation");
                    }
                    // console.log("checked ", selectedGoingQuotation);

                    const data = {
                        bookingId: bookingId,
                        quotation: goingQuotationIndex,
                        returnQuotation: returnQuotationIndex,
                    };

                    // console.log("Sending data for next step:", data);
                    runQuery(data, bookingId);
                });
            }
        } else {
            console.error("Failed to fetch booking details:", response.statusText);
        }
    } catch (error) {
        console.error("Error fetching booking details:", error);
    } finally {
        spinner.style.display = "none"; // Hide the spinner after the fetch is done
    }
});

async function selectQuotation(index, bookingId) {
    const data = {
        returnQuotation: "",
        quotation: index.toString(),
        hasReturnQuotation: "0",
    };

    runQuery(data, bookingId);
}

async function runQuery(data, bookingId) {
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const apikey = "<?php echo nfpl_function_get_api_key(); ?>";

    // Show the spinner while selecting quotation
    const spinner = document.getElementById("nfpl_js_styles_spinner");
    spinner.style.display = "block"; // Show spinner

    try {
        const response = await fetch(
            `${apiUrlPrefixs}/plugin/dispatcher/widget-passenger-information/${bookingId}`,
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "tenant-widgetapikey": `${apikey}`,
                },
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

            const bookingPageUrl =
                "<?php echo esc_url(nfpl_function_get_navigation_url( BOOKING_DETAILS_WIDGET)); ?>";
            setTimeout(function () {
                window.location.href = `${bookingPageUrl}?id=${bookingId}`;
            }, 3000);
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
        alert("Error selecting quotation");
    } finally {
        spinner.style.display = "none"; // Hide spinner after the process is complete
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
            card.style.borderColor = "#333";
        });

        // Select the radio input and highlight the clicked card
        radioInput.checked = true;
        card.style.borderColor = "gold";
    }
    function handleCardClickReturn(card, radioInput) {
        // Unhighlight all cards
        returnQuotationCards.forEach((card) => {
            card.style.borderColor = "#333";
        });

        // Select the radio input and highlight the clicked card
        radioInput.checked = true;
        card.style.borderColor = "gold";
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

</script>
