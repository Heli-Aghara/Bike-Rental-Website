
let sixMonthsFromToday = new Date();
sixMonthsFromToday.setMonth(sixMonthsFromToday.getMonth() + 6);

let pickupTime = null;

config = {
    enableTime : true,
    minuteIncrement: 30,
    altInput: true,
    altFormat: "d M, Y  G:i K ",
    minDate: "today",
    maxDate: sixMonthsFromToday,
    onChange: function(selectedDates, dateStr, instance) {
        const now = new Date();
        
        // Add 2 hours to the current time
        now.setHours(now.getHours() + 2);

        // If the selected date is today
        if (selectedDates.length > 0) {
            const selectedDate = selectedDates[0];
            const isToday = selectedDate.toDateString() === now.toDateString();
            
            if (isToday) {
                // Set minTime to 2 hours from the current time for today
                instance.set("minTime", now.getHours() + ":" + now.getMinutes());
            } else {
                // Reset minTime for future dates
                instance.set("minTime", "00:00");
            }

            
        }
    }
}
flatpickr("input[type=datetime-local]",config)



