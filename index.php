<?php

$page_title = 'Riding Tales - Home page';
$disable_bootstrap = true;
include 'includes/header.inc.php';
include 'config.php';

$select_cities_query = "SELECT city_name FROM cities";
$cities = mysqli_query($connection, $select_cities_query);
?>

<!-- <?php
if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
} else {
    echo "You are not logged in.";
}
?> -->

<!-- hero section -->
<div class="hero-img-wrapper">
    <div class="bg-effect">
        <div class="hero-content wh-100 flex">
            <div class="hero-text-form-wrapper">
                <div class="hero-text-wrapper flex">
                    <h1 class="hero-heading">Create Your Own Riding Tales With Us</h1>
                    <p class="hero-subheading">
                        Unlock the ultimate riding experience with our two-wheeler rental services.
                    </p>
                </div>
                <form class="search-ride-form flex" action="bike_listings.php" method="post">
                    <div class="cities-section form-section flex">
                        <label for="city" class="sr-only">Select City:</label>
                        <div class="icon-wrapper flex"><i class='bx bx-current-location'></i></div>
                        <input list="cities" name="city" id="city" placeholder="Select City" required>
                        <datalist id="cities">

                            <!-- Fetching cities from database -->
                            <?php
                            if (mysqli_num_rows($cities) > 0) {
                                while ($row = mysqli_fetch_assoc($cities)) {
                                    echo '<option value="' . htmlspecialchars($row['city_name'], ENT_QUOTES, 'UTF-8') . '"</option>';
                                }
                            } else {
                                echo '<option value="No cities available"></option>';
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class=" pickup-section form-section flex">
                        <label for="pickup-datetime" class="sr-only">Pickup Date-Time</label>
                        <div class="icon-wrapper flex"><i class='bx bx-calendar'></i></div>
                        <input type="datetime-local" name="pickup-datetime" id="pickup-datetime" placeholder="Pickup DateTime" class="pickup-datetime" required>
                    </div>


                    <div class="dropoff-section form-section flex">
                        <label for="dropoff-datetime" class="sr-only">Pickup Date-Time</label>
                        <div class="icon-wrapper flex"><i class='bx bx-calendar'></i></div>
                        <input type="datetime-local" name="dropoff-datetime" id="dropoff-datetime" placeholder="Dropoff DateTime" class="dropoff-datetime" required>
                    </div>

                    <button type="submit" id="search-btn">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.inc.php";
?>