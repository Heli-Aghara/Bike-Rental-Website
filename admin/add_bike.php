<?php
$page_title = "Riding Tales - Add Bike";
include 'includes/header.inc.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<div class="container-fluid">
  <h1>Add Bike</h1>
  <form class="col-4 p-3 border border-dark-subtle rounded rounded-3" action="process_add_bike.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="bike_model" class="form-label">Bike Model:</label>
      <input type="text" class="form-control" id="bike_model" name="bike_model" required>
    </div>
    <div class="mb-3">
      <label for="bike_img" class="form-label">Bike Image:</label>
      <input type="file" class="form-control" id="bike_img" name="bike_img" accept=".png" required>
    </div>
    <div class="mb-3">
      <label for="vehicle_type" class="form-label">Vehicle Type:</label>
      <select name="vehicle_type" id="vehicle_type" class="form-control" required>
        <option value="Scooter">Scooter</option>
        <option value="Motorcycle">Motorcycle</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="transmission_type" class="form-label">Transmission Type:</label>
      <select name="transmission_type" id="transmission_type" class="form-control" required>
        <option value="Gear">Gear</option>
        <option value="Gearless">Gearless</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="fuel_type" class="form-label">Fuel Type:</label>
      <select name="fuel_type" id="fuel_type" class="form-control" required>
        <option value="Petrol">Petrol</option>
        <option value="E-bike">E-bike</option>
        <option value="Diesel">Diesel</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="rental_rate" class="form-label">Rental Rate(Per Hour):</label>
      <div class="input-group">
        <div class="input-group-text">&#8377;</div>
        <input type="number" class="form-control" id="rental_rate" name="rental_rate" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="late_fee_rate" class="form-label">Late Fee Rate(Per Hour):</label>
      <div class="input-group">
        <div class="input-group-text">&#8377;</div>
        <input type="number" class="form-control" id="late_fee_rate" name="late_fee_rate" required>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Add</button>
  </form>
</div>

<?php


// Displaying the 'Inserted record successfully' alert message
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
  echo "<script type='text/javascript' defer >alert('" . $_SESSION['message'] . "');</script>";
  unset($_SESSION['message']); // Clear session variable after showing the alert
}

include 'includes/footer.inc.php';
?>