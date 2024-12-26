<script>
  

// Be sure to have these functions in index.php file otherwise code UI and functionality will break!
const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
const nfpl_var_apiUrl = `${nfpl_var_apiUrlPrefixs}/api/public/google/autocomplete`;
const nfpl_var_quoteUrl = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-get-quotations`;
const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>'
const quotationPageUrlAndPageNumber = '<?php echo esc_url( nfpl_function_get_navigation_url(QUOTATIONS_WIDGET) ); ?>';



</script>

<div class="nfpl_styles_widget-container" style="position: relative;">
<div id="loadingOverlay" style="display: none;">
    <div style=" padding: 20px; border-radius: 1rem; display: flex; flex-direction: column; text-align: center; justify-content: center; align-items: center;">
      <div id="loadingSpinner-2" class="spinner-2"></div>
      <h2 id="overlay-message" class="loadingText" style="color: var(--var-primary-color); padding: 45px 0;">
        Submitting Your Details ...
      </h2>
    </div>
</div>
  <div class="">

    <div class="">
      <p class="nfp_styles_text_uppercase npfl_styles_online_booking_p">online booking</p>
      <h1 class="nfpl_styles_confirm_booking_h1">Confirm your booking now!</h1>

      <div class="">
        <!-- Input Field: From -->
        <div class="">
          <p style="font-size: large; font-weight:400;">From</p>
          <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
            <div class="nfpl_styles_input_label">

            </div>
            <input id="nfpl_form_style_js_from" name="nfpl_form_start-dest" type="text"
              class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="From" required
              autocomplete="off" />
            <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m"></div>
          </div>
        </div>



        <!-- Input Field: To -->
        <div class="">
          <p style="font-size: large; font-weight:400;">To</p>
          <div class="nfpl_js_styles_places nfpl_js_styles_input_container">
            <div class="nfpl_styles_input_label">

            </div>
            <input required id="nfpl_form_style_js_to" name="nfpl_form_end_dest" type="text"
              class="nfpl_js_styles_input_field nfpl_js_styles_place_input" placeholder="To" autocomplete="off" />
            <div class="nfpl_js_styles_dropdown_menu nfpl_js_styles_drop-set dropdown-m"></div>
          </div>
        </div>

      </div>

      <button id="nfpl_add_stop_btn" class="nfpl_styles_add_btn viaLocationPlus">
        stop
      </button>

      <div id="nfpl_js_styles_ViaStop_oneWay" class="">
        <!-- Input Field: via location -->
      </div>

      <div class="">
        <!-- Start Date/Time -->
        <div class="">
          <p style="font-size: large; font-weight:400;">Forward Date/Time</p>
          <div class="nfpl_js_styles_input_container ">
            <div class="nfpl_styles_input_label">

            </div>
            <input required id="nfpl_form_js_StartDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
              placeholder="Pickup Date/Time" />
          </div>
        </div>

        <!-- End Date/Time -->
        <div id="nfpl_js_styles_end_date_two_way_parent"
          class="nfpl_js_styles_d_none flex-column col-12 col-md-6 col-lg-6 my-2">
          <p style="font-size:medium; font-weight: 500;">Return Date/Time</p>
          <div id="end-date-two-way" class=" nfpl_js_styles_input_container ">
            <div class="nfpl_styles_input_label">

            </div>
            <input required id="nfpl_form_js_EndDateTime" type="datetime-local" class="nfpl_js_styles_input_field"
              placeholder="Return Pickup Date/Time" />
          </div>
        </div>
      </div>


      <div>
        One way?
        <input required type="checkbox" id="nfpl_js_styles_OneWayCheckBox" checked="checked" />
      </div>

      <button id="add-return-btn" class="nfpl_js_styles_d_none nfpl_styles_add_btn viaLocationPlus">

        via return
      </button>

      <div id="nfpl_js_styles_iaRetrun_twoWay" class="">
        <!-- Input Field: via return location -->
      </div>
    </div>

    <div style="width: 90%; padding: 5% 0; ">
      <div class="npfl_js_styles_d_flex justify-content-end  flex-nowrap">
        <button id="nfpl_js_styles_submit_btn_widget">Calculate Price</button>
      </div>
    </div>
  </div>
</div>



















































