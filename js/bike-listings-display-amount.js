document.addEventListener("DOMContentLoaded", function () {

    // Get the full path of the current document
const fullPath = window.location.pathname;

// Extract the document's name (last part of the path)
const documentName = fullPath.substring(fullPath.lastIndexOf('/') + 1);

console.log(documentName);

    let rental_quantity = 0;
    let city = localStorage.getItem("city");
    let pickupdatetime = new Date(localStorage.getItem("pickupdatetime"));
    let dropoffdatetime = new Date(localStorage.getItem("dropoffdatetime"));

    document.querySelectorAll('.quantity-wrapper').forEach(wrapper => {
        const minusBtn = wrapper.querySelector('.minus');
        const plusBtn = wrapper.querySelector('.plus');
        const quantityInput = wrapper.querySelector('.quantity');
        
        const displayInitialQuantity = () => {
            const rental_quantity = quantityInput.value;
            const bottomSection = wrapper.closest('.bike-card').querySelector('.bottom-section');
            const rentalRateInput = bottomSection.querySelector('.rental_rate');
            const rentalRate = parseFloat(rentalRateInput.value).toFixed(2);

            const hiddenQtyInput = bottomSection.querySelector('.hidden_rental_quantity');
            hiddenQtyInput.value = rental_quantity;
            console.log(hiddenQtyInput.value);

            const amountElm = bottomSection.querySelector('.rupees > span:nth-child(2)');
            const amount = calculateAmount(calculateDuration(pickupdatetime, dropoffdatetime), rental_quantity, rentalRate);

            amountElm.textContent = parseFloat(amount).toFixed(2);
            const hiddenAmountInput = bottomSection.querySelector('.hidden_rental_amount');
            hiddenAmountInput.value = parseFloat(amount).toFixed(2);
        };

        displayInitialQuantity();
        
        // Handle the plus button click
        plusBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.max);



            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
                rental_quantity = quantityInput.value;

                const bottomSection = wrapper.closest('.bike-card').querySelector('.bottom-section');
                const rentalRateInput = bottomSection.querySelector('.rental_rate');
                const rentalRate = parseFloat(rentalRateInput.value).toFixed(2);

                const hiddenQtyInput = bottomSection.querySelector('.hidden_rental_quantity');
                hiddenQtyInput.value = rental_quantity;
                console.log(hiddenQtyInput.value);


                const amountElm = bottomSection.querySelector('.rupees > span:nth-child(2)');
                const amount = calculateAmount(calculateDuration(pickupdatetime, dropoffdatetime), rental_quantity, rentalRate);

                amountElm.textContent = parseFloat(amount).toFixed(2);
                const hiddenAmountInput = bottomSection.querySelector('.hidden_rental_amount');
                hiddenAmountInput.value = parseFloat(amount).toFixed(2);
            }
        });

        // Handle the minus button click
        minusBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            const minValue = parseInt(quantityInput.min);

            if (currentValue > minValue) {
                quantityInput.value = currentValue - 1;
                rental_quantity = quantityInput.value;

                const bottomSection = wrapper.closest('.bike-card').querySelector('.bottom-section');
                const rentalRateInput = bottomSection.querySelector('.rental_rate');
                const rentalRate = parseFloat(rentalRateInput.value).toFixed(2);

                const hiddenQtyInput = bottomSection.querySelector('.hidden_rental_quantity');
                hiddenQtyInput.value = rental_quantity;
                console.log(hiddenQtyInput.value);

                const amountElm = bottomSection.querySelector('.rupees > span:nth-child(2)');
                const amount = calculateAmount(calculateDuration(pickupdatetime, dropoffdatetime), rental_quantity, rentalRate);

                amountElm.textContent = parseFloat(amount).toFixed(2);
                const hiddenAmountInput = bottomSection.querySelector('.hidden_rental_amount');
                hiddenAmountInput.value = parseFloat(amount).toFixed(2);

            }
        });
    });


    function saveFormDataAndValidate() {
        // Save form values in local storage
        localStorage.setItem("city", document.getElementById("city").value);
        localStorage.setItem("pickupdatetime", document.getElementById("pickup-datetime").value);
        localStorage.setItem("dropoffdatetime", document.getElementById("dropoff-datetime").value);

        const pickupValue = document.querySelector('.pickup-datetime').value;
        const dropoffValue = document.querySelector('.dropoff-datetime').value;

        if (!pickupValue || !dropoffValue) {
            // Prevent form submission
            event.preventDefault();
            
            // Display an alert
            alert("Both pickup and dropoff times must be selected.");
            return; // Exit the function to prevent further checks
        }

        // Convert the datetime values to Date objects
        const pickupTime = new Date(pickupValue);
        const dropoffTime = new Date(dropoffValue);

        // Calculate the time difference in hours
        const timeDifference = (dropoffTime - pickupTime) / (1000 * 60 * 60); // Convert milliseconds to hours

        // Check if the difference is less than 2 hours
        if (timeDifference < 2) {
            // Prevent form submission
            event.preventDefault();

            // Display an alert
            alert("Drop-off time must be at least 2 hours after the pickup time.");
        }
        // Redirect to the second page
        //window.location.href = "second_page.html";
    }

    if(documentName === "index.php"){
        document.querySelector('#search-btn').addEventListener("click", saveFormDataAndValidate);
    }
    console.log(city, pickupdatetime, dropoffdatetime);
    console.log(typeof city, typeof pickupdatetime, typeof dropoffdatetime);

    function formatDateTime(dateObj) {
        // Format the date (e.g., 26 Sep 2024)
        const optionsDate = { day: 'numeric', month: 'short', year: 'numeric' };
        const formattedDate = dateObj.toLocaleDateString('en-GB', optionsDate);

        // Format the time (e.g., 2:00 pm)
        const optionsTime = { hour: 'numeric', minute: 'numeric', hour12: true };
        const formattedTime = dateObj.toLocaleTimeString('en-US', optionsTime);

        return {
            date: formattedDate,
            time: formattedTime
        };
    }

    const pickupDateFormatted = formatDateTime(new Date(localStorage.getItem("pickupdatetime")));;
    const dropoffDateFormatted = formatDateTime(new Date(localStorage.getItem("dropoffdatetime")));

    console.log("Pickup - Date:", pickupDateFormatted.date, "Time:", pickupDateFormatted.time);
    console.log("Dropoff - Date:", dropoffDateFormatted.date, "Time:", dropoffDateFormatted.time);

    document.querySelectorAll('.time-section').forEach(timeSection => {
        pickupTime = timeSection.querySelector('.start-time');
        pickupDate = timeSection.querySelector('.start-date');
        dropoffTime = timeSection.querySelector('.end-time');
        dropoffDate = timeSection.querySelector('.end-date');

        pickupTime.textContent = pickupDateFormatted.time;
        pickupDate.textContent = pickupDateFormatted.date;
        dropoffTime.textContent = dropoffDateFormatted.time;
        dropoffDate.textContent = dropoffDateFormatted.date;
    });

    function calculateDuration(pickupdatetime, dropoffdatetime) {
        let diffMs = dropoffdatetime - pickupdatetime;
        let diffHours = diffMs / (1000 * 60 * 60);
        return diffHours;
    }


    function calculateAmount(duration, quantity, rental_rate) {

        return (duration * quantity * rental_rate);
    }

});
