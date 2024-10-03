<?php
include 'includes/header.inc.php';
?>

<div class="bike-card">
    <div class="top-stickers flex">
        <span class="fuel-wrapper">
            <i class='bx bxs-gas-pump'></i>
            <span class="fuel-type">Petrol</span>
        </span>
        <span class="quantity_left">2 left</span>
    </div>
    <span class="model-name">Suzuki Access 125</span>
    <div class="bike-img-wrapper flex">
        <img src="images/bike-listings-imgs/Access-125.png" alt="Access 125" height="150" width="250">
    </div>
    <!-- <hr> -->
    <div class="location-section">
        <span class="available_at">Available at</span>
        <span class="location-name">Umiya Circle</span>
    </div>
    <!-- <hr class="after-location-hr"> -->
    <div class="time-section flex">
        <div class="start-section flex">
            <span class="start-time bold">8:30 am</span>
            <span class="start-date">07 Sep 2024</span>
        </div>
        <div class="to-section">
            <span class="to_text">to</span>
        </div>
        <div class="end-section flex">
            <span class="end-time bold">10:30 am</span>
            <span class="end-date">08 Sep 2024</span>
        </div>
    </div>

    <div class="quantity-wrapper flex">
        <button class="minus">-</button>
        <input type="number" name="quantity" id="quantity" min="1" max="5" value="1">
        <button class="plus">+</button>
    </div>
    <div class="bottom-section flex">
        <div class="amount flex">
            <p class="rupees">
                <span>&#8377;</span>
                <span class="bold">599</span>
            </p>
            <p class="extra_charge">
                (
                <span>&#8377;</span>
                <span>200</span>
                <span>/extra hr.</span>
                )
            </p>
        </div>
        <button class="book-btn">Book Now</button>
    </div>
</div>



<?php

    include 'includes/footer.inc.php';

?>