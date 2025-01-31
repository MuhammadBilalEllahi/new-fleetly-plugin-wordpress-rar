<div class="nfpl_styles_container_auth">
    <!-- Left Section - Login Form -->
    <div class="nfpl_styles_auth_login_section">
      <h2>Fleetly ACCOUNT</h2>
      <h1>Sign in to your account</h1>
      <p>Enter your credentials to view all insights</p>

      <form >
        <label for="nfpl_styles_auth_email">Email address</label>
        <input type="email" value="test@gmail.com"  name="email" id="nfpl_styles_auth_email" placeholder="Enter your email address" required>

        <label for="nfpl_styles_auth_password">Password</label>
        <input type="password" value="12345678" name="password" id="nfpl_styles_auth_password" placeholder="Enter your password" required>

        <button id="nfpl_styles_auth_submit_btn" class="nfpl_styles_auth_submit_btn">Submit &rarr;</button>
        <a href="/register">
            <input type="button" id="nfpl_styles_auth_send_message" value="Sign Up" class="btn-main btn-fullwidth rounded-3" />
        </a>

        <div class="nfpl_styles_auth_google_login">
          <button type="button" disabled class="nfpl_styles_auth_google_btn">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo">
            Sign in with Google
          </button>
        </div>
      </form>
    </div>


     <!-- Sign Out Button (Hidden initially) -->
     <div id="sign-out-btn" style="display: none; padding: 3% 5%;">
        <h5 style="margin: 3% 0; font-weight:700;">You're Logged In <span style="font-weight: 300; ">Do you want to Logout?</span></h5>
        <button class="btn" onclick="signOut()">Sign Out</button>
    </div>
  </div>


<style>


/* Container */
.nfpl_styles_container_auth {
  display: flex;
  background-color: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  justify-content: center;
  align-items: center;
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 100%;
}

/* Left Section - Login */
.nfpl_styles_container_auth .nfpl_styles_auth_login_section {
  padding: 40px;
  width: 40%;
  margin: 2% 0;
}

.nfpl_styles_container_auth h2 {
  font-size: 14px;
  color: #666;
}

.nfpl_styles_container_auth h1 {
  font-size: 28px;
  margin-top: 5px;
  color: #000;
}

.nfpl_styles_container_auth p {
  margin: 10px 0 30px;
  color: #777;
  font-size: 14px;
}

.nfpl_styles_container_auth label {
  display: block;
  margin-bottom: 8px;
  color: #333;
  font-weight: bold;
}

.nfpl_styles_container_auth input {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
}

.nfpl_styles_container_auth .nfpl_styles_auth_submit_btn {
  background-color: #3c5af7;
  color: #fff;
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  margin-bottom: 15px;
}

.nfpl_styles_container_auth .nfpl_styles_auth_submit_btn:hover {
  background-color: #2f4bcf;
}

.nfpl_styles_container_auth .nfpl_styles_auth_google_btn {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  background-color: #fff;
  color: #333;
  border-radius: 8px;
  cursor: pointer;
}

.nfpl_styles_container_auth .nfpl_styles_auth_google_btn img {
  height: 18px;
  margin-right: 10px;
}

.nfpl_styles_container_auth .nfpl_styles_auth_google_btn:hover {
  background-color: #f5f5f5;
}


@media (max-width: 1120px){
    .nfpl_styles_container_auth .nfpl_styles_auth_login_section {
        padding: 1.3rem;
        width: 55%;
        margin: 2% 0;
        }
}

@media (max-width: 786px){
    .nfpl_styles_container_auth .nfpl_styles_auth_login_section {
        padding: 1.3rem;
        width: 80%;
        margin: 2% 0;
        }
}

@media (max-width: 500px){
    .nfpl_styles_container_auth .nfpl_styles_auth_login_section {
        padding: 1.3rem;
        width: 100%;
        margin: 2% 0;
        }
}






</style>



<script>
    const apiUrlPrefixs = "<?php echo nfpl_function_get_api_url_prefix(); ?>";
    const apikey = "<?php echo nfpl_function_get_api_key(); ?>";
    const req_POST_login = `${apiUrlPrefixs}/plugin/dispatcher/widget/login`;
    const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";
    const nfpl_quotationPageUrlAndPageNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(INSTANT_QUOTE_WIDGET)); ?>';
    const nfpl_loginPageURlAndNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(LOGIN_WIDGET)); ?>';


    const headers = {
        'Content-Type': 'application/json',
        'tenant-widgetapikey': apikey,
        'tenant': tenantId
    }
</script>




<script>
// Function to check if the cookie exists
function checkIfLoggedIn() {
    const token = getCookie('nfpl_jt_tok'); // Get the JWT token from cookies

    if (token) {
        // If cookie exists, user is logged in, show sign out option
        showSignOutButton();
    } else {
        // If no cookie, show the login form
        showLoginForm();
    }
}

// Function to get a cookie value by its name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

// Function to show the login form
function showLoginForm() {
    document.querySelector('.nfpl_styles_auth_login_section').style.display = 'block';
    const signOutButton = document.querySelector('#sign-out-btn');
    if (signOutButton) {
        signOutButton.style.display = 'none'; // Hide the sign-out button if user is not logged in
    }
}

// Function to show the sign-out button
function showSignOutButton() {
    document.querySelector('.nfpl_styles_auth_login_section').style.display = 'none';
    const signOutButton = document.querySelector('#sign-out-btn');
    if (signOutButton) {
        signOutButton.style.display = 'block'; // Show the sign-out button
    }
}

// Function to clear the cookie and log out
function signOut() {
    // Clear the JWT cookie
    document.cookie = 'nfpl_jt_tok=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT; SameSite=Lax; secure=true;';
    window.location.href = nfpl_loginPageURlAndNumber; // Redirect to the Login Page

}

// Check if user is already logged in on page load
window.onload = checkIfLoggedIn;

</script>









<script>
/**
 * Handles the login form submission.
 * Sends the user's credentials to the backend, receives a JWT, and stores it as a cookie.
 */
document.querySelector('.nfpl_styles_auth_submit_btn').addEventListener('click', async (e) => {
    e.preventDefault(); // Prevent the form from submitting the traditional way.

    // Select input fields
    const nfpl_auth_var_loginEmail = document.querySelector('#nfpl_styles_auth_email').value.trim();
    const nfpl_auth_var_loginPassword = document.querySelector('#nfpl_styles_auth_password').value.trim();

    if (!nfpl_auth_var_loginEmail || !nfpl_auth_var_loginPassword) {
        alert("Please fill out both fields.");
        return;
    }

    try {
        // Send login data to the backend
        const nfpl_auth_response = await fetch(req_POST_login, {
            method: 'POST',
            headers: headers,
            body: JSON.stringify({
                email: nfpl_auth_var_loginEmail,
                password: nfpl_auth_var_loginPassword
             }),
        });

        // Check if the request was successful
        if (!nfpl_auth_response.ok) {
            const nfpl_auth_errorData = await nfpl_auth_response.json();
            throw new Error(nfpl_auth_errorData.message || "Login failed.");
        }

        // Parse the JSON nfpl_auth_response
        const nfpl_auth_responseData = await nfpl_auth_response.json();

        console.log("Data", nfpl_auth_responseData)
        if (nfpl_auth_responseData.token) {
            
            console.log("here", nfpl_auth_responseData.token)
            const token =nfpl_auth_responseData.token;
            // Store the JWT as a cookie
            // document.cookie = `nfpl_jwt_tok=${nfpl_auth_responseData.token}; path=/; SameSite=Strict;  HttpOnly`;
            document.cookie = `nfpl_jt_tok=${token}; path=/; SameSite=Lax; secure=true;`;


            console.log(document.cookie)
      


            // alert("Login successful!");

            // Redirect to the dashboard or another page
            // window.location.href = '/dashboard';
            window.location.href = nfpl_quotationPageUrlAndPageNumber; // Redirect to the Main Page

        } else {
            throw new Error("No token received.");
        }
    } catch (error) {
        console.error("Login error:", error.message);
        alert(`Error: ${error.message}`);
    }
});
</script>
