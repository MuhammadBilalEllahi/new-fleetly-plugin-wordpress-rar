<script>

  // Be sure to have these functions in index.php file otherwise code UI and functionality will break!
  const nfpl_var_apiUrlPrefixs = '<?php echo nfpl_function_get_api_url_prefix(); ?>';
  const nfpl_var_apiUrl = `${nfpl_var_apiUrlPrefixs}/api/public/google/autocomplete`;
  const nfpl_var_quoteUrl = `${nfpl_var_apiUrlPrefixs}/plugin/dispatcher/widget-get-quotations`;
  const nfpl_var_apikey = '<?php echo nfpl_function_get_api_key(); ?>'
  const quotationPageUrlAndPageNumber = '<?php echo esc_url(nfpl_function_get_navigation_url(QUOTATIONS_WIDGET)); ?>';

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
            <button id="_calendar_c_submit">Submit</button>
          </div>
        </div>
      </div>

      <!-- Return Date/Time -->
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
    </div>

    <div class="toggle-container">
      <label class="toggle">
        <span class="toggle-label">One way?</span>
        <input style="display: none;" type="checkbox" id="nfpl_js_styles_OneWayCheckBox" checked="checked" />
        <span class="toggle-slider"></span>
      </label>
    </div>

    <button id="add-return-btn" class="nfpl_js_styles_d_none add-stop-btn">
      <i class="fa-solid fa-plus"></i> Add Return Stop
    </button>

    <div id="nfpl_js_styles_iaRetrun_twoWay" class="form-grid via-stops"></div>

    <div class="submit-container">
      <button id="nfpl_js_styles_submit_btn_widget" class="submit-btn">Calculate Price</button>
    </div>
  </div>
</div>


























<script defer>


  document.addEventListener('DOMContentLoaded', () => {
    
    const calendarContainer = document.getElementById('_calendar_c_calendarContainer');
    const calendarDays = document.getElementById('_calendar_c_calendarDays');
        const currentMonth = document.getElementById('_calendar_c_currentMonth');
    const timeInput = document.getElementById('_calendar_c_time');
    // const dateTimeInput = document.getElementById('nfpl_form_js_StartDateTime');
    // const dateTimeInput2 = document.getElementById('_calendar_c_dateTimeInput');
    const dateTimeInputs = document.querySelectorAll('.nfpl_js_styles_input_field[data-calendar="true"]');


    let selectedDate = null;
        const today = new Date();
    let currentYear = today.getFullYear();
    let currentMonthIndex = today.getMonth();

    
    // dateTimeInput.addEventListener('click', (e) => {
    //   event.stopPropagation();
    //         calendarContainer.style.display = 'block';
    //   renderCalendar(currentYear, currentMonthIndex);
    // });

    dateTimeInputs.forEach(dateTimeInput => {
      dateTimeInput.addEventListener('click', (e) => {
        e.stopPropagation();
        calendarContainer.style.display = 'block';
        renderCalendar(currentYear, currentMonthIndex);
        calendarContainer.dataset.targetInputId = dateTimeInput.id;
      });
    });

    

    document.addEventListener('click', (event) => {
      if (!calendarContainer.contains(event.target) && !Array.from(dateTimeInputs).includes(event.target)) {
        calendarContainer.style.display = 'none';
      }
    });

    function renderCalendar(year, month) {
      calendarDays.innerHTML = '';
      const firstDayOfMonth = new Date(year, month, 1).getDay();
      const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

      currentMonth.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

      // Empty days at the beginning of the month
      for (let i = 0; i < firstDayOfMonth; i++) {
        calendarDays.innerHTML += '<div></div>';
      }

      // Add days of the month
      for (let day = 1; day <= lastDateOfMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        dayElement.className = '_calendar_c_day';

        // Highlight today's date
        if (year === today.getFullYear() ) {
          if( month === today.getMonth()){

            if(day === today.getDate()){
              dayElement.classList.add('_calendar_c_selected-date');

            }
          }
        }

        dayElement.addEventListener('click', () => {
          selectedDate = new Date(year, month, day);
          document.querySelectorAll('._calendar_c_day').forEach(el => el.classList.remove('_calendar_c_selected-date'));
          dayElement.classList.add('_calendar_c_selected-date');
        });

        calendarDays.appendChild(dayElement);
      }
    }

    document.getElementById('_calendar_c_prevMonth').addEventListener('click', () => {
      currentMonthIndex--;
      if (currentMonthIndex < 0) {
        currentMonthIndex = 11;
        currentYear--;
      }
      renderCalendar(currentYear, currentMonthIndex);
    });

    document.getElementById('_calendar_c_nextMonth').addEventListener('click', () => {
      currentMonthIndex++;
      if (currentMonthIndex > 11) {
        currentMonthIndex = 0;
        currentYear++;
      }
      renderCalendar(currentYear, currentMonthIndex);
    });

    document.getElementById('_calendar_c_submit').addEventListener('click', () => {
      if (!selectedDate) {
        alert('Please select a date.');
        return;
      }
      const selectedTime = timeInput.value;
      if (!selectedTime) {
        alert('Please select a time.');
        return;
      }
      const formattedDate = `${selectedDate.toLocaleDateString()} ${selectedTime}`;
      // dateTimeInput.value = formattedDate;
      const targetInput = document.getElementById(calendarContainer.dataset.targetInputId);
      if (targetInput) {
        targetInput.value = formattedDate;
      }
      calendarContainer.style.display = 'none';
    });


    renderCalendar(currentYear, currentMonthIndex);

  })
</script>





<style>
  ._calendar_c_container {
    /* max-width: 300px; */
    border: 1px solid #ccc;
    border-radius: 8px;
    background: #fff;
    padding: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: absolute;
    top:100%;
    left:0;
    display: none;
    z-index: 10;
    font-size: small;
  }

  ._calendar_c_header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  ._calendar_c_header button {
    background: #007bff;
    color: white;
    border: none;
    padding: 4px 8px;
    border-radius: 4px;
    cursor: pointer;
  }

  ._calendar_c_header button:hover {
    background: #0056b3;
  }

  ._calendar_c_days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    margin-bottom: 8px;
  }

  ._calendar_c_day {
    text-align: center;
    padding: 8px;
    margin: 2px;
    cursor: pointer;
    border-radius: 4px;
  }

  ._calendar_c_day:hover {
    background-color: #007bff;
    color: white;
  }

  ._calendar_c_selected-date {
    background-color: #007bff;
    color: white;
  }

  ._calendar_c_time-picker {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 8px;
  }

  ._calendar_c_time-picker input {
    padding: 4px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
</style>

