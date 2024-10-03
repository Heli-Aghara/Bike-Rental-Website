// validation.js
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const submitButton = form.querySelector("#login-btn");


    form.addEventListener("submit", function (event) {
        console.log("Validation script is running"); // Add this line

        let valid = true;
        let message = "";

        // Clear previous alerts
        document.querySelectorAll(".alert").forEach(function (alert) {
            alert.remove();
        });

        //check if username and password both are empty
        if (usernameInput.value.trim() === "" && passwordInput.value.trim() === "") {
            message += '<div class="alert alert-danger" role="alert">Username Or Password is Empty.</div>';
            valid = false;
        }

        else {

            // Check if username is empty
            if (usernameInput.value.trim() === "") {
                message += '<div class="alert alert-danger" role="alert">Username is required.</div>';
                valid = false;
            }

            // Check if password is empty
            if (passwordInput.value.trim() === "") {
                message += '<div class="alert alert-danger" role="alert">Password is required.</div>';
                valid = false;
            }

        }

        // If not valid, prevent form submission and show alerts
        if (!valid) {
            event.preventDefault();
            form.insertAdjacentHTML('beforebegin', message);
        }
    });
});