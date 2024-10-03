<?php
$page_title = 'Riding Tales - Bike Search';
include 'includes/header.inc.php';
?>

<?php
include 'process_bike_search.php'; // This file contains your function to get bikes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Call the function to get bike data
    $city = $_POST['city'];  // City selected by the user
    $pickup_datetime = $_POST['pickup-datetime'];  // Pickup datetime from the form
    $dropoff_datetime = $_POST['dropoff-datetime'];  // Dropoff datetime from the form

    $_SESSION['city'] = $city;
    $_SESSION['pickup_datetime'] = $pickup_datetime;
    $_SESSION['dropff_datetime'] = $dropoff_datetime;

    $bikes = get_bikes($city, $pickup_datetime, $dropoff_datetime); // Pass the connection and city name   
?>
    <div class="container-fluid d-flex">
        <?php
        // Loop through the bike data and display each card
        foreach ($bikes as $bike) {
        ?>
            <div class="bike-card">
                <div class="top-stickers flex">
                    <span class="fuel-wrapper">
                        <i class='bx bxs-gas-pump'></i>
                        <span class="fuel-type"><?php echo $bike['fuel_type']; ?></span>
                    </span>
                    <span class="quantity_left"><?php echo $bike['quantity_left']; ?> left</span>
                </div>
                <span class="model-name"><?php echo $bike['model_name']; ?></span>
                <div class="bike-img-wrapper flex">
                    <img src="images/uploads/bike_model_images/<?php echo $bike['bike_img']; ?>" alt="<?php echo $bike['model_name']; ?>" height="150" width="250">
                </div>
                <div class="location-section">
                    <span class="available_at">Available at</span>
                    <span class="location-name"><?php echo $bike['pick_drop_loc']; ?></span>
                </div>
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
                    <button class="minus" type="button">-</button>
                    <input type="number" name="rental_quantity" class="quantity" id="quantity" min="1" max="<?php echo $bike['quantity_left'] ?>" value="1">
                    <button class="plus" type="button">+</button>
                </div>
                <div class="bottom-section flex">
                    <div class="amount flex">
                        <p class="rupees">
                            <span>&#8377;</span>
                            <!-- <span class="bold"><?php echo $bike['rental_rate']; ?></span> -->
                            <span class="bold"></span>
                        </p>
                        <p class="extra_charge">
                            (<span>&#8377;</span>
                            <span><?php echo $bike['late_fee_rate']; ?></span>
                            <span>/extra hr.</span>)
                        </p>
                    </div>
                    <form class="hidden_form" action="check-login-status.php" method="post">
                        <input type="hidden" name="rental_rate" class="rental_rate" value="<?php echo $bike['rental_rate']; ?>">
                        <input type="hidden" name="city_name" class="city_name" value="<?php echo $city; ?>">
                        <input type="hidden" name="hidden_rental_quantity" class="hidden_rental_quantity" value="">
                        <input type="hidden" name="hidden_model_id" class="hidden_model_id" value="<?php echo $bike['model_id'] ?>">
                        <input type="hidden" name="hidden_rental_amount" class="hidden_rental_amount">
                        <button class="book-btn" type="submit">Book Now</button>
                    </form>
                </div>
                
            </div>

    <?php
        }
    }
    ?>
    </div>
    <?php
    include 'includes/footer.inc.php';
    ?>