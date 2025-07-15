document.addEventListener('DOMContentLoaded', () => {
    const dateTimeInputs = document.querySelectorAll('.nfpl_js_styles_input_field[data-calendar="true"]');

    const today = new Date();
    const weekdays = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

    /**
     * Helper function to get datetime value from custom calendar input
     */
    window.getDateTimeValue = function(inputId) {
        const input = document.getElementById(inputId);
        if (input) {
            return input.getAttribute('data-datetime-value') || '';
        }
        return '';
    };

    /**
     * Helper function to set datetime value to custom calendar input
     */
    window.setDateTimeValue = function(inputId, isoDateTime) {
        const input = document.getElementById(inputId);
        if (input && isoDateTime) {
            try {
                const date = new Date(isoDateTime);
                const options = {
                    year: "numeric",
                    month: "long",
                    day: "numeric"
                };
                const formattedDate = new Intl.DateTimeFormat("en-US", options).format(date);
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                
                input.setAttribute('data-datetime-value', isoDateTime);
                input.value = `${formattedDate} ${hours}:${minutes}`;
            } catch (error) {
                console.error('Invalid datetime format:', error);
            }
        }
    };

    /**
     * Creates a unique calendar for each input field.
     */
    function createCalendar(inputField) {
        // Set initial placeholder
        inputField.placeholder = "October 16 2024 08:00";
        inputField.value = "";
        
        // Create calendar container dynamically
        const calendarContainer = document.createElement('div');
        calendarContainer.className = '_calendar_c_calendarContainer';
        calendarContainer.style.display = 'none';

        calendarContainer.innerHTML = `
            <div class="_calendar_c_header">
                <button id="${inputField.id}_prevMonth" class="_calendar_c_nav">&lt;</button>
                <span id="${inputField.id}_currentMonth" class="_calendar_c_currentMonth"></span>
                <button id="${inputField.id}_nextMonth" class="_calendar_c_nav">&gt;</button>
            </div>
            <div class="_calendar_c_weekdays" id="${inputField.id}_weekdays"></div>
            <div class="_calendar_c_days" id="${inputField.id}_calendarDays"></div>
            <div class="_calendar_c_time-section">
                <div class="_calendar_c_time-label">
                    <span class="_calendar_c_time-icon">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGNsYXNzPSJsdWNpZGUgbHVjaWRlLWNhbGVuZGFyLWljb24gbHVjaWRlLWNhbGVuZGFyIj48cGF0aCBkPSJNOCAydjQiLz48cGF0aCBkPSJNMTYgMnY0Ii8+PHJlY3Qgd2lkdGg9IjE4IiBoZWlnaHQ9IjE4IiB4PSIzIiB5PSI0IiByeD0iMiIvPjxwYXRoIGQ9Ik0zIDEwaDE4Ii8+PC9zdmc+" alt="Calendar" />
                    </span>
                    Enter time
                </div>
                <div class="_calendar_c_time-input-container">
                    <input type="time" id="${inputField.id}_time" class="_calendar_c_time">
                </div>
            </div>
            <button id="${inputField.id}_submit" class="_calendar_c_submit">Submit</button>
        `;

        // Find the input wrapper (closest parent with position: relative)
        const inputWrapper = inputField.closest('.nfpl_styles_input-wrapper');
        if (inputWrapper) {
            inputWrapper.appendChild(calendarContainer);
        } else {
            // Fallback to original behavior if wrapper not found
            inputField.parentNode.appendChild(calendarContainer);
        }

        let selectedDate = null;
        let currentYear = today.getFullYear();
        let currentMonthIndex = today.getMonth();

        const calendarDays = calendarContainer.querySelector(`#${inputField.id}_calendarDays`);
        const currentMonthLabel = calendarContainer.querySelector(`#${inputField.id}_currentMonth`);
        const weekdaysContainer = calendarContainer.querySelector(`#${inputField.id}_weekdays`);
        const timeInput = calendarContainer.querySelector(`#${inputField.id}_time`);

        /**
         * Set default time (+2 hours, +3 minutes).
         */
        function setDefaultTime() {
            const now = new Date();
            now.setHours(now.getHours() + 2);
            now.setMinutes(now.getMinutes() + 3);
            timeInput.value = now.toTimeString().slice(0, 5);
        }

        /**
         * Formats date to YYYY-MM-DD for datetime-local input
         */
        function formatDateToISO(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        /**
         * Formats date to backend format for display (e.g., "October 16 2024")
         */
        function formatDateForDisplay(date) {
            const options = {
                year: "numeric",
                month: "long",
                day: "numeric"
            };
            return new Intl.DateTimeFormat("en-US", options).format(date);
        }

        /**
         * Formats time to HH:MM for display
         */
        function formatTimeForDisplay(time) {
            return time || "00:00";
        }

        /**
         * Renders weekday headers
         */
        function renderWeekdays() {
            weekdaysContainer.innerHTML = '';
            weekdays.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.className = '_calendar_c_weekday';
                dayElement.textContent = day;
                weekdaysContainer.appendChild(dayElement);
            });
        }

        /**
         * Renders the calendar UI
         */
        function renderCalendar(year, month) {
            calendarDays.innerHTML = '';
            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
            const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

            currentMonthLabel.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

            // Previous month's trailing days
            for (let i = firstDayOfMonth - 1; i >= 0; i--) {
                const dayElement = document.createElement('div');
                dayElement.textContent = lastDateOfPrevMonth - i;
                dayElement.className = '_calendar_c_day _calendar_c_other-month _calendar_c_disabled';
                calendarDays.appendChild(dayElement);
            }

            // Current month's days
            for (let day = 1; day <= lastDateOfMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                dayElement.className = '_calendar_c_day';

                const date = new Date(year, month, day);
                const dateStr = formatDateToISO(date);
                const todayStr = formatDateToISO(today);

                // Check if it's today
                if (dateStr === todayStr) {
                    dayElement.classList.add('_calendar_c_today');
                }

                // Prevent selection of past dates
                if (date < today.setHours(0, 0, 0, 0)) {
                    dayElement.classList.add('_calendar_c_disabled');
                } else {
                    dayElement.addEventListener('click', () => {
                        selectedDate = date;
                        calendarDays.querySelectorAll('._calendar_c_day').forEach(el => el.classList.remove('_calendar_c_selected-date'));
                        dayElement.classList.add('_calendar_c_selected-date');
                    });
                }

                calendarDays.appendChild(dayElement);
            }

            // Next month's leading days
            const totalCells = calendarDays.children.length;
            const remainingCells = 42 - totalCells; // 6 weeks * 7 days = 42 cells
            for (let day = 1; day <= remainingCells && totalCells < 42; day++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                dayElement.className = '_calendar_c_day _calendar_c_other-month _calendar_c_disabled';
                calendarDays.appendChild(dayElement);
            }
        }

        // Previous month navigation
        calendarContainer.querySelector(`#${inputField.id}_prevMonth`).addEventListener('click', () => {
            const prevMonth = new Date(currentYear, currentMonthIndex - 1);
            const currentMonth = new Date(today.getFullYear(), today.getMonth());
            
            if (prevMonth >= currentMonth) {
                currentMonthIndex--;
                if (currentMonthIndex < 0) {
                    currentMonthIndex = 11;
                    currentYear--;
                }
                renderCalendar(currentYear, currentMonthIndex);
            }
        });

        // Next month navigation
        calendarContainer.querySelector(`#${inputField.id}_nextMonth`).addEventListener('click', () => {
            currentMonthIndex++;
            if (currentMonthIndex > 11) {
                currentMonthIndex = 0;
                currentYear++;
            }
            renderCalendar(currentYear, currentMonthIndex);
        });

        // Submit button event
        calendarContainer.querySelector(`#${inputField.id}_submit`).addEventListener('click', () => {
            if (!selectedDate) {
                showToast({ message: 'Please select a date.', type: "info", duration: 2000 });
                return;
            }
            const selectedTime = timeInput.value;
            if (!selectedTime) {
                showToast({ message: 'Please select a time.', type: "info", duration: 2000 });
                return;
            }

            // Set the actual datetime-local value for form submission
            const isoDateTime = `${formatDateToISO(selectedDate)}T${selectedTime}`;
            inputField.setAttribute('data-datetime-value', isoDateTime);
            
            // Display the formatted date and time
            const displayValue = `${formatDateForDisplay(selectedDate)} ${formatTimeForDisplay(selectedTime)}`;
            inputField.value = displayValue;
            
            // Trigger change event for form validation
            inputField.dispatchEvent(new Event('change'));
            
            calendarContainer.style.display = 'none';
        });

        // Show calendar on input click
        inputField.addEventListener('click', (e) => {
            e.stopPropagation();
            
            // Hide all other calendars
            document.querySelectorAll('._calendar_c_calendarContainer').forEach(cal => {
                if (cal !== calendarContainer) {
                    cal.style.display = 'none';
                }
            });
            
            // Show this calendar
            calendarContainer.style.display = 'block';
            
            // Check if calendar would extend beyond viewport and position above if needed
            setTimeout(() => {
                const inputRect = inputField.getBoundingClientRect();
                const calendarRect = calendarContainer.getBoundingClientRect();
                
                // If calendar extends beyond viewport bottom, position it above
                if (calendarRect.bottom > window.innerHeight) {
                    calendarContainer.classList.add('_calendar_c_position-above');
                } else {
                    calendarContainer.classList.remove('_calendar_c_position-above');
                }
            }, 0);
            
            renderWeekdays();
            renderCalendar(currentYear, currentMonthIndex);
        });

        // Handle focus to show placeholder
        inputField.addEventListener('focus', (e) => {
            if (!inputField.value) {
                inputField.placeholder = "October 16 2024 08:00";
            }
        });

        // Handle blur to hide placeholder if empty
        inputField.addEventListener('blur', (e) => {
            if (!inputField.value) {
                inputField.placeholder = "October 16 2024 08:00";
            }
        });

        // Hide calendar when clicking outside
        document.addEventListener('click', (event) => {
            if (!calendarContainer.contains(event.target) && event.target !== inputField) {
                calendarContainer.style.display = 'none';
            }
        });

        // Handle escape key to close calendar
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && calendarContainer.style.display === 'block') {
                calendarContainer.style.display = 'none';
            }
        });

        setDefaultTime();
    }

    // Create a separate calendar for each input field
    dateTimeInputs.forEach(inputField => createCalendar(inputField));
});
