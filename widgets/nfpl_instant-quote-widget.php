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
  const nfpl_var_nfpl_API_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
  const nfpl_var_apiUrl = `${nfpl_var_nfpl_API_apiUrlPrefixs}/api/public/google/autocomplete`;
  const nfpl_var_quoteUrl = `${nfpl_var_nfpl_API_apiUrlPrefixs}/plugin/dispatcher/widget-get-quotations`;
  const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>'
  const quotationPageUrlAndPageNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(QUOTATIONS_WIDGET)); ?>';


  const tenantId = "<?php echo nfpl_function_get_tenant_owner_id(); ?>";

  // console.log(getNFPLAuthHeaders())

  const nfpl_headers = {
    ...getNFPLAuthHeaders(),
    "Content-Type": "application/json",
    "tenant-widgetapikey": `${nfpl_var_apikey}`,
    'tenant': tenantId,
    
}
</script>







<!-- HTML -->
<div class="nfpl_styles_widget-container" style="position: relative;">
  <div id="nfpl_styles_loadingOverlay" style="display: none;">
    <div
      style=" padding: 20px; border-radius: 1rem; display: flex; flex-direction: column; text-align: center; justify-content: center; align-items: center;">
      <div id="nfpl_styles_loadingSpinner-2" class="nfpl_styles_spinner-2"></div>
      <h2 id="nfpl_styles_overlay-message" class="nfpl_styles_loadingText" style="color: var(--var-nfpl-primary-color); padding: 45px 0;">
        Submitting Your Details ...
      </h2>
    </div>
  </div>


  <div class="nfpl_styles_booking-container">
    <div class="nfpl_styles_booking-header">
      <p class="nfpl_styles_booking-label">online booking</p>
      <h1 class="nfpl_styles_booking-title">Confirm your booking now!</h1>
    </div>

    <div class="nfpl_styles_form-grid">
      <!-- From Location -->
      <div class="nfpl_styles_form-group">
        <label class="nfpl_styles_input-label">From</label>
        <div class="nfpl_js_styles_places nfpl_styles_input-wrapper">
          <div class="nfpl_styles_input-icon">
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
          <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set nfpl_styles_dropdown-menu"></div>
        </div>
      </div>

      <!-- To Location -->
      <div class="nfpl_styles_form-group">
        <label class="nfpl_styles_input-label">To</label>
        <div class="nfpl_js_styles_places nfpl_styles_input-wrapper">
          <div class="nfpl_styles_input-icon">
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
          <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set nfpl_styles_dropdown-menu"></div>
        </div>
      </div>
    </div>

    <button id="nfpl_add_stop_btn" class="nfpl_styles_form-grid nfpl_styles_1_add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Stop
    </button>

    <div id="nfpl_js_styles_ViaStop_oneWay" class="nfpl_styles_form-grid nfpl_styles_1_via-stops"></div>

    <div class="nfpl_styles_form-grid">
      <!-- Forward Date/Time -->
      <div class="nfpl_styles_form-group" style="position: relative;">
        <label class="nfpl_styles_input-label">Forward Date/Time</label>
        <div class="nfpl_styles_input-wrapper">
          <div class="nfpl_styles_input-icon">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGNsYXNzPSJsdWNpZGUgbHVjaWRlLWNhbGVuZGFyLWljb24gbHVjaWRlLWNhbGVuZGFyIj48cGF0aCBkPSJNOCAydjQiLz48cGF0aCBkPSJNMTYgMnY0Ii8+PHJlY3Qgd2lkdGg9IjE4IiBoZWlnaHQ9IjE4IiB4PSIzIiB5PSI0IiByeD0iMiIvPjxwYXRoIGQ9Ik0zIDEwaDE4Ii8+PC9zdmc+" alt="Calendar" width="24" height="24" />
          </div>

          <input type="text" required data-calendar="true" class="nfpl_js_styles_input_field" id="nfpl_form_js_StartDateTime"
            placeholder="October 16 2024 08:00" readonly>

       
        </div>
      </div>

      <!-- Return Date/Time -->
      <div class="nfpl_styles_form-group">
        <div id="nfpl_js_styles_end_date_two_way_parent" class="nfpl_js_styles_d_none nfpl_styles_form-group">
          <label class="nfpl_styles_input-label">Return Date/Time</label>
          <div class="nfpl_styles_input-wrapper" style="position: relative !important;" >
            <div class="nfpl_styles_input-icon">
              <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGNsYXNzPSJsdWNpZGUgbHVjaWRlLWNhbGVuZGFyLWljb24gbHVjaWRlLWNhbGVuZGFyIj48cGF0aCBkPSJNOCAydjQiLz48cGF0aCBkPSJNMTYgMnY0Ii8+PHJlY3Qgd2lkdGg9IjE4IiBoZWlnaHQ9IjE4IiB4PSIzIiB5PSI0IiByeD0iMiIvPjxwYXRoIGQ9Ik0zIDEwaDE4Ii8+PC9zdmc+" alt="Calendar" width="24" height="24" />
            </div>

            <input type="text" required data-calendar="true" class="nfpl_js_styles_input_field" id="nfpl_form_js_EndDateTime"
              placeholder="October 16 2024 08:00" readonly  />


          </div>
        </div>
      </div>


    </div>


    <div class="nfpl_styles_form-grid">
      <div class="nfpl_styles_form-group">
          <div class="nfpl_styles_1_toggle-container">
          <label class="nfpl_styles_1_toggle">
            <span class="nfpl_styles_1_toggle-label">One way?</span>
            <input style="display: none;" type="checkbox" id="nfpl_js_styles_OneWayCheckBox" checked="checked" />
            <span class="nfpl_styles_1_toggle-slider"></span>
          </label>
        </div>
      </div>
    </div>

    <button id="nfpl_styles_1_add-return-btn" class="nfpl_js_styles_d_none nfpl_styles_1_add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Return Stop
    </button>

    <div id="nfpl_js_styles_iaRetrun_twoWay" class="nfpl_styles_form-grid nfpl_styles_1_via-stops"></div>

    <div class="">
      <button id="nfpl_js_styles_submit_btn_widget" class="nfpl-btn">Calculate Price</button>
    </div>
  </div>
</div>