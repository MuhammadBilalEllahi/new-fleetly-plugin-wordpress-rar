<div id="bookingwWrapper">
    <!-- Sign In Message -->
    <div id="signInMessage" style="display: none;">
        <h2>Sign In Required</h2>
        <p>Please sign in to view your bookings.</p>
        <button id="signInButton">Sign In</button>
    </div>

    <!-- Booking Tables -->
    <table id="forwardBookingTable" class="booking-table" style="display: none;">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Pickup Time</th>
                <th>Distance</th>
                <th>Reference No</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="forwardBookingRows"></tbody>
    </table>

    <!-- <table id="returnBookingTable" class="booking-table" style="display: none;">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Pickup Time</th>
                <th>Distance</th>
                <th>Reference No</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="returnBookingRows"></tbody>
    </table> -->
</div>

<style>
    .booking-table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
        font-size: 14px;
    }

    .booking-table th,
    .booking-table td {
        border: 1px solid #ccc;
        padding: 8px 10px;
        text-align: left;
        vertical-align: top;
    }

    .booking-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .booking-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>


<script>
    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";
    const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>';
    const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';


    const nfpl_headers = {
        ...getNFPLAuthHeaders(),
        "Content-Type": "application/json",
        "tenant-widgetapikey": `${nfpl_var_apikey}`,
        'tenant': tenantId,

    }

    const nfpl_var_GET_MyBooking = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget/my-bookings`;

</script>

<script>
    // Check if the user is logged in by checking for the JWT token (cookie or header)
    const checkUserLogin = () => {
        // Check for token in cookies (could also check in localStorage or headers)
        const token = document.cookie.match(/^(.*;)?\s*nfpl_jt_tok\s*=\s*[^;]+(.*)?$/) ? true : false;
        console.log("CHECKED", token)
        return token;
    };

    // Fetch booking data from backend if the user is logged in
    const fetchBookingData = async () => {
        if (checkUserLogin()) {
            // Fetch data from backend (replace with your actual endpoint)
            try {
                const response = await fetch(nfpl_var_GET_MyBooking, {
                    method: 'GET', 
                    headers: nfpl_headers
                });

                if (response.ok) {
                    const data = await response.json(); // Assuming backend sends JSON data
                    console.log('Booking Data:', data);

                    // Populate the tables
                    populateBookingTable(data.bookings, 'forwardBookingRows');
                    // populateBookingTable(data.returnBookings, 'returnBookingRows');

                    // Show tables
                    document.getElementById('forwardBookingTable').style.display = 'table';
                    document.getElementById('returnBookingTable').style.display = 'table';
                } else {
                    console.error('Failed to fetch booking data');
                }
            } catch (error) {
                console.error('Error fetching booking data:', error);
            }
        } else {
            // If the user is not logged in, show the "Sign In Required" message
            document.getElementById('signInMessage').style.display = 'block';
        }
    };

    // Populate the booking table with data
    const populateBookingTable = (bookings, tableId) => {
        const tableBody = document.getElementById(tableId);
        tableBody.innerHTML = ''; // Clear any existing rows

        bookings.forEach(booking => {
            const row = document.createElement('tr');
            row.id = booking._id
            row.innerHTML = `
                <td>${booking.from_desc}</td>
                <td>${booking.to_desc}</td>
                <td>${booking.startTime}</td>
                <td>${booking.distanceText}</td>
                <td>${booking.reference}</td>
                <td>${booking.status}</td>
            `;
            tableBody.appendChild(row);
        });

        







    };

    // Utility function to get a cookie by name
    const getCookie = (name) => {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    };

    // Call fetchBookingData when the page loads
    document.addEventListener('DOMContentLoaded', fetchBookingData);

    // Optional: Handle "Sign In" button click to redirect user to the sign-in page
    document.getElementById('signInButton')?.addEventListener('click', () => {
        window.location.href = '/login'; // Redirect to login page
    });
</script>