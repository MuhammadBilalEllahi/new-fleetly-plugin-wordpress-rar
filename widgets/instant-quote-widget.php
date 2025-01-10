<?php 
function enqueue_custom_plugin_assets_FOR_INSTANT_QUOTE_WIDGET(){

  wp_enqueue_style('nfp_instant_quote_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_instant_quote.css', array(), '1.0.0');
  wp_enqueue_script('nfp_instant_quote_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_instant_quote.js', array(), '1.0.0', true);


  wp_enqueue_style('nfp_calender_time_date_style', NFP_PLUGIN_DIR_URL . 'assets/css/frontend/nfpl_calender_time_date.css', array(), '1.0.2');
  wp_enqueue_script('nfp_calender_time_date_script', NFP_PLUGIN_DIR_URL . 'assets/js/frontend/nfpl_calender_time_date.js', array(), '1.0.0', true);


} 
//UNDERSTAND MORE : https://developer.wordpress.org/reference/functions/add_action/
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_assets_FOR_INSTANT_QUOTE_WIDGET');

?>






<script>

  // Be sure to have these functions in index.php file otherwise code UI and functionality will break!
  const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
  const nfpl_var_apiUrl = `${nfpl_var_apiUrlPrefixs}/api/public/google/autocomplete`;
  const nfpl_var_quoteUrl = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-get-quotations`;
  const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>'
  const quotationPageUrlAndPageNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(QUOTATIONS_WIDGET)); ?>';


  const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

  
// // Function to get a cookie value by its name
// function getCookie(name) {
//     const value = `; ${document.cookie}`;
//     const parts = value.split(`; ${name}=`);
//     if (parts.length === 2) return parts.pop().split(';').shift();
//     return null;
// }

// // Function to add JWT token to headers
// function getAuthHeaders() {
//     const token = getCookie('nfpl_jt_tok'); // Retrieve JWT from cookie
//     return token ? { 'Authorization': `Bearer ${token}` } : {}; // Attach token in Authorization header if it exists
// }





  console.log(getNFPLAuthHeaders())

  const nfpl_headers = {
    ...getNFPLAuthHeaders(),
    "Content-Type": "application/json",
    "tenant-widgetapikey": `${nfpl_var_apikey}`,
    'tenant': tenantId,
    
}
</script>







<!-- HTML -->
<div class="nfpl_styles_widget-container" style="position: relative;">
  <div id="loadingOverlay" style="display: none;">
    <div
      style=" padding: 20px; border-radius: 1rem; display: flex; flex-direction: column; text-align: center; justify-content: center; align-items: center;">
      <div id="loadingSpinner-2" class="spinner-2"></div>
      <h2 id="overlay-message" class="loadingText" style="color: var(--var-primary-color); padding: 45px 0;">
        Submitting Your Details ...
      </h2>
    </div>
  </div>


  <div class="booking-container">
    <div class="booking-header">
      <p class="booking-label">online booking</p>
      <h1 class="booking-title">Confirm your booking now!</h1>
    </div>

    <div class="form-grid">
      <!-- From Location -->
      <div class="form-group">
        <label class="input-label">From</label>
        <div class="nfpl_js_styles_places input-wrapper">
          <div class="input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
              stroke-width="2" width="24" height="24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 2c3.866 0 7 3.134 7 7 0 5.25-7 13-7 13S5 14.25 5 9c0-3.866 3.134-7 7-7z" />
              <circle cx="12" cy="9" r="2.5" fill="none" />
            </svg>
          </div>
          <input id="nfpl_form_style_js_from" name="nfpl_form_start-dest" type="text"
            class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="Enter pickup location" required
            autocomplete="off" />
          <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-menu"></div>
        </div>
      </div>

      <!-- To Location -->
      <div class="form-group">
        <label class="input-label">To</label>
        <div class="nfpl_js_styles_places input-wrapper">
          <div class="input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
              stroke-width="2" width="24" height="24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 2c3.866 0 7 3.134 7 7 0 5.25-7 13-7 13S5 14.25 5 9c0-3.866 3.134-7 7-7z" />
              <circle cx="12" cy="9" r="2.5" fill="none" />
            </svg>
          </div>

          <input required id="nfpl_form_style_js_to" name="nfpl_form_end_dest" type="text"
            class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="Enter drop-off location"
            autocomplete="off" />
          <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-menu"></div>
        </div>
      </div>
    </div>

    <button id="nfpl_add_stop_btn" class="form-grid add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Stop
    </button>

    <div id="nfpl_js_styles_ViaStop_oneWay" class="form-grid via-stops"></div>

    <div class="form-grid">
      <!-- Forward Date/Time -->
      <div class="form-group">
        <label class="input-label">Forward Date/Time</label>
        <div class="input-wrapper">
          <div class="input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
              stroke-width="2" width="24" height="24">
              <rect x="3" y="4" width="18" height="16" rx="2" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M16 4v4M8 4v4" />
            </svg>
          </div>

          <!-- <input required id="nfpl_form_js_StartDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
            placeholder="Pickup Date/Time" /> -->




          <input type="text" required data-calendar="true" class="nfpl_js_styles_input_field" id="nfpl_form_js_StartDateTime"
            placeholder="Select date and time" readonly>

          <div class="_calendar_c_container" id="_calendar_c_calendarContainer">
            <div class="_calendar_c_header">
              <button id="_calendar_c_prevMonth">&lt;</button>
              <h3 id="_calendar_c_currentMonth"></h3>
              <button id="_calendar_c_nextMonth">&gt;</button>
            </div>
            <div class="_calendar_c_days" id="_calendar_c_calendarDays"></div>
            <div class="_calendar_c_time-picker">
              <label for="_calendar_c_time">Time:</label>
              <input type="time" id="_calendar_c_time">
            </div>
            <button id="_calendar_c_submit" class="btn">Submit</button>
          </div>
        </div>
      </div>

      <!-- Return Date/Time -->
      <div class="form-group">
        <div id="nfpl_js_styles_end_date_two_way_parent" class="nfpl_js_styles_d_none form-group">
          <label class="input-label">Return Date/Time</label>
          <div class="input-wrapper">
            <div class="input-icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2" width="24" height="24">
                <rect x="3" y="4" width="18" height="16" rx="2" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M16 4v4M8 4v4" />
              </svg>
            </div>
            <!-- <input required id="nfpl_form_js_EndDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
              placeholder="Return Pickup Date/Time" /> -->

              
            <input type="text" required data-calendar="true" class="nfpl_js_styles_input_field" id="nfpl_form_js_EndDateTime"
              placeholder="Select date and time" readonly>

              
              <div class="_calendar_c_container" id="_calendar_c_calendarContainer">
              <div class="_calendar_c_header">
                <button id="_calendar_c_prevMonth">&lt;</button>
                <h3 id="_calendar_c_currentMonth"></h3>
                <button id="_calendar_c_nextMonth">&gt;</button>
              </div>
              <div class="_calendar_c_days" id="_calendar_c_calendarDays"></div>
              <div class="_calendar_c_time-picker">
                <label for="_calendar_c_time">Time:</label>
                <input type="time" id="_calendar_c_time">
              </div>
              <button id="_calendar_c_submit">Submit</button>
            </div>


          </div>
        </div>
      </div>


    </div>
      

    <div class="form-grid">
      <div class="form-group">
          <div class="toggle-container">
          <label class="toggle">
            <span class="toggle-label">One way?</span>
            <input style="display: none;" type="checkbox" id="nfpl_js_styles_OneWayCheckBox" checked="checked" />
            <span class="toggle-slider"></span>
          </label>
        </div>
      </div>
    </div>

    <button id="add-return-btn" class="nfpl_js_styles_d_none add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Return Stop
    </button>

    <div id="nfpl_js_styles_iaRetrun_twoWay" class="form-grid via-stops"></div>

    <div class="">
      <button id="nfpl_js_styles_submit_btn_widget" class="btn">Calculate Price</button>
    </div>
  </div>
</div>