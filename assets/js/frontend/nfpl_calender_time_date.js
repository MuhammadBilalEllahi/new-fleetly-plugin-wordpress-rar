

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
            if (year === today.getFullYear()) {
                if (month === today.getMonth()) {

                    if (day === today.getDate()) {
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
            showToast({
                message: 'Please select a date.', type: "info",
                duration: 2000,
            });
            return;
        }
        const selectedTime = timeInput.value;
        if (!selectedTime) {
            showToast({
                message: 'Please select a time.', type: "info",
                duration: 2000,
            });
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