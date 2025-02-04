// document.addEventListener('DOMContentLoaded', () => {
//     const calendarContainer = document.getElementById('_calendar_c_calendarContainer');
//     const calendarDays = document.getElementById('_calendar_c_calendarDays');
//     const currentMonth = document.getElementById('_calendar_c_currentMonth');
//     const timeInput = document.getElementById('_calendar_c_time');
//     const dateTimeInputs = document.querySelectorAll('.nfpl_js_styles_input_field[data-calendar="true"]');



//     let selectedDate = null;
//     const today = new Date();
//     let currentYear = today.getFullYear();
//     let currentMonthIndex = today.getMonth();

//     /**
//      * Set the time input value to the current time +2 hours and +3 minutes.
//      */
//     function setDefaultTime() {
//         const now = new Date();
//         now.setHours(now.getHours() + 2);
//         now.setMinutes(now.getMinutes() + 3);

//         const formattedTime = now.toTimeString().slice(0, 5); // Format as HH:MM
//         timeInput.value = formattedTime;
//     }

//     /**
//      * Format date to YYYY-MM-DD
//      */
//     function formatDateToISO(date) {
//         return date.toISOString().split('T')[0]; // Extract YYYY-MM-DD
//     }

//     dateTimeInputs.forEach(dateTimeInput => {
//         dateTimeInput.addEventListener('click', (e) => {
//             e.stopPropagation();
//             calendarContainer.style.display = 'block';
//             renderCalendar(currentYear, currentMonthIndex);
//             calendarContainer.dataset.targetInputId = dateTimeInput.id;
//         });
//     });

//     document.addEventListener('click', (event) => {
//         if (!calendarContainer.contains(event.target) && !Array.from(dateTimeInputs).includes(event.target)) {
//             calendarContainer.style.display = 'none';
//         }
//     });

//     function renderCalendar(year, month) {
//         calendarDays.innerHTML = '';
//         const firstDayOfMonth = new Date(year, month, 1).getDay();
//         const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

//         currentMonth.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

//         // Empty days at the beginning of the month
//         for (let i = 0; i < firstDayOfMonth; i++) {
//             calendarDays.innerHTML += '<div></div>';
//         }

//         // Add days of the month
//         for (let day = 1; day <= lastDateOfMonth; day++) {
//             const dayElement = document.createElement('div');
//             dayElement.textContent = day;
//             dayElement.className = '_calendar_c_day';

//             const date = new Date(year, month, day);

//             // Prevent selection of past dates
//             if (date < today.setHours(0, 0, 0, 0)) {
//                 dayElement.classList.add('_calendar_c_disabled');
//             } else {
//                 dayElement.addEventListener('click', () => {
//                     selectedDate = date;
//                     document.querySelectorAll('._calendar_c_day').forEach(el => el.classList.remove('_calendar_c_selected-date'));
//                     dayElement.classList.add('_calendar_c_selected-date');
//                 });
//             }

//             calendarDays.appendChild(dayElement);
//         }
//     }

//     document.getElementById('_calendar_c_prevMonth').addEventListener('click', () => {
//         if (currentYear > today.getFullYear() || (currentYear === today.getFullYear() && currentMonthIndex > today.getMonth())) {
//             currentMonthIndex--;
//             if (currentMonthIndex < 0) {
//                 currentMonthIndex = 11;
//                 currentYear--;
//             }
//             renderCalendar(currentYear, currentMonthIndex);
//         }
//     });

//     document.getElementById('_calendar_c_nextMonth').addEventListener('click', () => {
//         currentMonthIndex++;
//         if (currentMonthIndex > 11) {
//             currentMonthIndex = 0;
//             currentYear++;
//         }
//         renderCalendar(currentYear, currentMonthIndex);
//     });

//     document.getElementById('_calendar_c_submit').addEventListener('click', () => {
//         if (!selectedDate) {
//             showToast({
//                 message: 'Please select a date.', type: "info",
//                 duration: 2000,
//             });
//             return;
//         }
//         const selectedTime = timeInput.value;
//         if (!selectedTime) {
//             showToast({
//                 message: 'Please select a time.', type: "info",
//                 duration: 2000,
//             });
//             return;
//         }

//         const formattedDateTime = `${formatDateToISO(selectedDate)}T${selectedTime}`;
//         const targetInput = document.getElementById(calendarContainer.dataset.targetInputId);
//         if (targetInput) {
//             targetInput.value = formattedDateTime;
//         }
//         calendarContainer.style.display = 'none';
//     });

//     setDefaultTime();
//     renderCalendar(currentYear, currentMonthIndex);
// });










document.addEventListener('DOMContentLoaded', () => {
    const dateTimeInputs = document.querySelectorAll('.nfpl_js_styles_input_field[data-calendar="true"]');

    const today = new Date();

    /**
     * Creates a unique calendar for each input field.
     */
    function createCalendar(inputField) {
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
            <div class="_calendar_c_days" id="${inputField.id}_calendarDays"></div>
            <input type="time" id="${inputField.id}_time" class="_calendar_c_time">
            <button id="${inputField.id}_submit" class="_calendar_c_submit">Submit</button>
        `;

        inputField.parentNode.appendChild(calendarContainer); // Append near input field

        let selectedDate = null;
        let currentYear = today.getFullYear();
        let currentMonthIndex = today.getMonth();

        const calendarDays = calendarContainer.querySelector(`#${inputField.id}_calendarDays`);
        const currentMonthLabel = calendarContainer.querySelector(`#${inputField.id}_currentMonth`);
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
         * Formats date to YYYY-MM-DD
         */
        function formatDateToISO(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Ensure two-digit format
            const day = String(date.getDate()).padStart(2, '0'); // Ensure two-digit format
            return `${year}-${month}-${day}`;
        }


        /**
         * Renders the calendar UI
         */
        function renderCalendar(year, month) {
            calendarDays.innerHTML = '';
            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

            currentMonthLabel.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

            // Empty days at the beginning of the month
            for (let i = 0; i < firstDayOfMonth; i++) {
                calendarDays.innerHTML += '<div></div>';
            }

            // Days of the month
            for (let day = 1; day <= lastDateOfMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                dayElement.className = '_calendar_c_day';

                const date = new Date(year, month, day);

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
        }

        // Previous month navigation
        calendarContainer.querySelector(`#${inputField.id}_prevMonth`).addEventListener('click', () => {
            if (currentYear > today.getFullYear() || (currentYear === today.getFullYear() && currentMonthIndex > today.getMonth())) {
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

            inputField.value = `${formatDateToISO(selectedDate)}T${selectedTime}`;
            calendarContainer.style.display = 'none';
        });

        // Show calendar on input click
        inputField.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('._calendar_c_calendarContainer').forEach(cal => cal.style.display = 'none'); // Hide others
            calendarContainer.style.display = 'block';
            calendarContainer.style.position = 'absolute';
            calendarContainer.style.top = '100%';
            renderCalendar(currentYear, currentMonthIndex);
        });

        // Hide calendar when clicking outside
        document.addEventListener('click', (event) => {
            if (!calendarContainer.contains(event.target) && event.target !== inputField) {
                calendarContainer.style.display = 'none';
            }
        });

        setDefaultTime();
        renderCalendar(currentYear, currentMonthIndex);
    }

    // Create a separate calendar for each input field
    dateTimeInputs.forEach(inputField => createCalendar(inputField));
});
