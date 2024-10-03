document.querySelectorAll('.bike-card').forEach(bikeCard => {
    bookNowBtn = bikeCard.querySelector('.book-btn');
    bookNowBtn.addEventListener('click',function(){
        const bookingData = {
            modelName: bikeCard.querySelector('.model-name').textContent,
            city: bikeCard.querySelector('.city_name').value,
            pickDropLocation: bikeCard.querySelector('.location-name').textContent,
            startTime: bikeCard.querySelector('.start-time').textContent,
            startDate: bikeCard.querySelector('.start-date').textContent,
            endTime: bikeCard.querySelector('.end-time').textContent,
            endDate: bikeCard.querySelector('.end-date').textContent,
            quantity: bikeCard.querySelector('.quantity').value,
            amount: bikeCard.querySelector('.rupees .bold').textContent
        };

        // Store the object as a JSON string in localStorage
        localStorage.setItem('bookingData', JSON.stringify(bookingData));

        //window.location.href = 'check-login-status.php';
    });
});