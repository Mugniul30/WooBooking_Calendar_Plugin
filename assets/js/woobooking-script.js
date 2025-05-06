jQuery(document).ready(function ($) {
    flatpickr('#calendar', {
        inline: true,
        dateFormat: 'Y-m-d',
        disable: [
            function (date) {
                // Disable custom off days
                const offDays = woobookingData.customOffDays;
                if (offDays.includes(date.toISOString().slice(0, 10))) {
                    return true;
                }

                // Disable the weekly off day
                return date.getDay() === woobookingData.offDay;
            }
        ],
        onDayCreate: function (dObj, dStr, fp, dayElem) {
            const date = dayElem.dateObj.toISOString().slice(0, 10);
            if (woobookingData.bookedDates.includes(date)) {
                dayElem.classList.add('booked');
            } else if (woobookingData.customOffDays.includes(date) || dayElem.dateObj.getDay() === woobookingData.offDay) {
                dayElem.classList.add('booked');
            } else {
                dayElem.classList.add('available');
            }
        },
        onChange: function (selectedDates, dateStr) {
            let times = woobookingData.defaultTimes;
            let fixed = woobookingData.fixedSlots;
            let pricing = woobookingData.pricing;

            // Override default times if there are fixed slots for the selected date
            times = fixed[dateStr] || times;

            // Populate the time slot buttons dynamically
            $('#slots').html(
                '<div class="schedule-heading">Schedule At</div>' +
                times.map(function (t) {
                    return `<button class="slot" data-date="${dateStr}" data-time="${t}" data-price="${pricing[t] || 0}">
                        <input type="radio" class="slot-radio" name="time_slot" />
                        <span class="slot-time">${dateStr} ${t}</span>
                        <span class="slot-price">+ $${pricing[t] || 0}</span>
                    </button>`;
                }).join('')
            );
        }
    });

    $('#slots').on('click', '.slot', function () {
        $('#slots .slot').removeClass('selected-time');
        $('#slots .slot input[type="radio"]').prop('checked', false);
        $(this).addClass('selected-time');
        $(this).find('input[type="radio"]').prop('checked', true);

        // Send booking data to the server via AJAX
        $.post(woobookingData.ajaxUrl, {
            action: 'set_booking',
            date: $(this).data('date'),
            time: $(this).data('time'),
            price: $(this).data('price'),
            nonce: woobookingData.nonce
        }, function () {
            $(document.body).trigger('update_checkout');
        });
    });
});
