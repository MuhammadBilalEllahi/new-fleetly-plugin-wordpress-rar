<script>

// Be sure to have these functions in index.php file otherwise code UI and functionality will break!
const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
const nfpl_var_apiUrl = `${nfpl_var_apiUrlPrefixs}/api/public/google/autocomplete`;
const nfpl_var_quoteUrl = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-get-quotations`;
const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>'
const quotationPageUrlAndPageNumber = '<?php echo esc_url( nfpl_function_get_navigation_url(QUOTATIONS_WIDGET) ); ?>';

</script>





<!-- HTML -->
<div class="nfpl_styles_widget-container">
  <div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="loading-content">
      <div id="loadingSpinner-2" class="spinner-2"></div>
      <h2 id="overlay-message" class="loading-text">Submitting Your Details ...</h2>
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
            <i class="fa-solid fa-location-dot"></i>
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
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <input required id="nfpl_form_style_js_to" name="nfpl_form_end_dest" type="text"
            class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="Enter drop-off location"
            autocomplete="off" />
          <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-menu"></div>
        </div>
      </div>
    </div>

    <button id="nfpl_add_stop_btn" class="add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Stop
    </button>

    <div id="nfpl_js_styles_ViaStop_oneWay" class="via-stops"></div>

    <div class="form-grid">
      <!-- Forward Date/Time -->
      <div class="form-group">
        <label class="input-label">Forward Date/Time</label>
        <div class="input-wrapper">
          <div class="input-icon">
            <i class="fa-regular fa-calendar"></i>
          </div>
          <input required id="nfpl_form_js_StartDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
            placeholder="Pickup Date/Time" />
        </div>
      </div>

      <!-- Return Date/Time -->
      <div id="nfpl_js_styles_end_date_two_way_parent" class="nfpl_js_styles_d_none form-group">
        <label class="input-label">Return Date/Time</label>
        <div class="input-wrapper">
          <div class="input-icon">
            <i class="fa-regular fa-calendar"></i>
          </div>
          <input required id="nfpl_form_js_EndDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
            placeholder="Return Pickup Date/Time" />
        </div>
      </div>
    </div>

    <div class="toggle-container">
      <label class="toggle">
        <span class="toggle-label">One way?</span>
        <input type="checkbox" id="nfpl_js_styles_OneWayCheckBox" checked="checked" />
        <span class="toggle-slider"></span>
      </label>
    </div>

    <button id="add-return-btn" class="nfpl_js_styles_d_none add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Return Stop
    </button>

    <div id="nfpl_js_styles_iaRetrun_twoWay" class="via-stops"></div>

    <div class="submit-container">
      <button id="nfpl_js_styles_submit_btn_widget" class="submit-btn">Calculate Price</button>
    </div>
  </div>
</div>

<style>
/* Base Styles */
:root {
  --primary-color: #2563eb;
  --primary-hover: #1d4ed8;
  --background: #ffffff;
  --text-primary: #1f2937;
  --text-secondary: #6b7280;
  --border-color: #e5e7eb;
  --border-radius: 8px;
  --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
  --transition: all 0.3s ease;
}

.nfpl_styles_widget-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem;
  background: var(--background);
  border-radius: var(--border-radius);
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
}

/* Header Styles */
.booking-header {
  margin-bottom: 2rem;
  text-align: center;
}

.booking-label {
  color: var(--primary-color);
  text-transform: uppercase;
  font-size: 0.875rem;
  font-weight: 600;
  letter-spacing: 0.05em;
  margin-bottom: 0.5rem;
}

.booking-title {
  color: var(--text-primary);
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
}

/* Form Layout */
.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

/* Input Styles */
.input-label {
  color: var(--text-primary);
  font-size: 0.875rem;
  font-weight: 500;
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.input-icon {
  position: absolute;
  left: 1rem;
  color: var(--text-secondary);
}

.nfpl_js_styles_input_field {
  width: 100%;
  padding: 0.75rem 1rem 0.75rem 2.5rem;
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius);
  font-size: 1rem;
  color: var(--text-primary);
  transition: var(--transition);
}

.nfpl_js_styles_input_field:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Dropdown Menu */
.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: var(--background);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  z-index: 10;
  max-height: 200px;
  overflow-y: auto;
  display: none;
}

.nfpl_js_styles_dropdown_item {
  display: flex;
  align-items: flex-start;
  padding: 0.75rem 1rem;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  transition: var(--transition);
}

.nfpl_js_styles_dropdown_item:hover {
  background-color: #f3f4f6;
}

/* Button Styles */
.add-stop-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: transparent;
  border: 1px solid var(--primary-color);
  color: var(--primary-color);
  border-radius: var(--border-radius);
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition);
  margin-bottom: 1rem;
}

.add-stop-btn:hover {
  background: rgba(37, 99, 235, 0.1);
}

.submit-btn {
  width: 100%;
  padding: 1rem;
  background: var(--primary-color);
  color: white;
  border: none;
  border-radius: var(--border-radius);
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition);
}

.submit-btn:hover {
  background: var(--primary-hover);
}

/* Toggle Switch */
.toggle-container {
  margin: 1.5rem 0;
}

.toggle {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  cursor: pointer;
}

.toggle-label {
  color: var(--text-primary);
  font-size: 0.875rem;
  font-weight: 500;
}

.toggle-slider {
  position: relative;
  width: 3rem;
  height: 1.5rem;
  background: #e5e7eb;
  border-radius: 9999px;
  transition: var(--transition);
}

.toggle-slider:before {
  content: "";
  position: absolute;
  height: 1.25rem;
  width: 1.25rem;
  left: 0.125rem;
  bottom: 0.125rem;
  background: white;
  border-radius: 50%;
  transition: var(--transition);
}

.toggle input:checked + .toggle-slider {
  background: var(--primary-color);
}

.toggle input:checked + .toggle-slider:before {
  transform: translateX(1.5rem);
}

/* Loading Overlay */
.loading-overlay {
  position: fixed;
  
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(255, 255, 255, 0.9);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.loading-content {
  background: white;
  padding: 2rem;
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  text-align: center;
}

.loading-text {
  color: var(--primary-color);
  margin-top: 1rem;
}

/* Spinner */
.spinner-2 {
  width: 2.5rem;
  height: 2.5rem;
  border: 3px solid #f3f3f3;
  border-top: 3px solid var(--primary-color);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Utility Classes */
.nfpl_js_styles_d_none {
  display: none;
}

/* Responsive Adjustments */
@media (max-width: 640px) {
  .nfpl_styles_widget-container {
    padding: 1rem;
  }

  .booking-title {
    font-size: 1.5rem;
  }
}
</style>






































































































