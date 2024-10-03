<?php
$page_title = "Riding Tales - Update Bike";
include 'includes/header.inc.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<?php
// Include database configuration file
include '../config.php';

// Get the bike's model_id from the query string
if (isset($_GET['model_id'])) {
    $model_id = $_GET['model_id'];

    // Fetch bike details from the database
    $query = "SELECT * FROM bike_models WHERE model_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $model_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bike = $result->fetch_assoc();
}
?>

<div class="container-fluid">
  <h1>Update Bike</h1>
  <!-- HTML form to display bike details for editing -->
  <form method="POST" action="process_edit_bike.php" class="col-4 p-3 border border-dark-subtle rounded rounded-3" enctype="multipart/form-data">
      <input type="hidden" name="model_id" value="<?php echo $bike['model_id']; ?>">
  
      <div class="mb-3">
        <label for="bike_model" class="form-label">Bike Model:</label>
        <input type="text" class="form-control" id="bike_model" name="bike_model" value="<?php echo $bike['model_name']; ?>" required>
      </div>
  
      <div class="mb-3">
        <label for="bike_img" class="form-label">Update Bike Image:</label>
        <input type="file" class="form-control" id="bike_img" name="bike_img" accept=".png">
      </div>
  
      <div class="mb-3">
        <label for="vehicle_type" class="form-label">Vehicle Type:</label>
        <select name="vehicle_type" id="vehicle_type" class="form-control" required>
          <option value="Scooter" <?php if($bike['vehicle_type'] == 'Scooter') echo 'selected'; ?> >Scooter</option>
          <option value="Motorcycle" <?php if($bike['vehicle_type'] == 'Motorcycle') echo 'selected'; ?> >Motorcycle</option>
        </select>
      </div>
  
      <div class="mb-3">
        <label for="transmission_type" class="form-label">Transmission Type:</label>
        <select name="transmission_type" id="transmission_type" class="form-control" required>
          <option value="Gear" <?php if($bike['transmission_type'] == 'Gear') echo 'selected' ?> >Gear</option>
          <option value="Gearless" <?php if($bike['transmission_type'] == 'Gearless') echo 'selected' ?> >Gearless</option>
        </select>
      </div>
  
      <div class="mb-3">
        <label for="fuel_type" class="form-label">Fuel Type:</label>
        <select name="fuel_type" id="fuel_type" class="form-control" required>
          <option value="Petrol" <?php if($bike['fuel_type'] == 'Petrol') echo 'selected' ?> >Petrol</option>
          <option value="E-bike" <?php if($bike['fuel_type'] == 'E-bike') echo 'selected' ?>>E-bike</option>
          <option value="Diesel" <?php if($bike['fuel_type'] == 'Diesel') echo 'selected' ?> >Diesel</option>
        </select>
      </div>
  
      <div class="mb-3">
        <label for="rental_rate" class="form-label">Rental Rate(Per Hour):</label>
        <div class="input-group">
          <div class="input-group-text">&#8377;</div>
          <input type="number" class="form-control" id="rental_rate" name="rental_rate" value="<?php echo $bike["rental_rate"]?>" required>
        </div>
      </div>
  
      <div class="mb-3">
        <label for="late_fee_rate" class="form-label">Late Fee Rate(Per Hour):</label>
        <div class="input-group">
          <div class="input-group-text">&#8377;</div>
          <input type="number" class="form-control" id="late_fee_rate" name="late_fee_rate" value="<?php echo $bike["late_fee_rate"]?>" required>
        </div>
      </div>
  
      <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
</div>

<?php

//Displaying 'Updated successfully' message
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
  echo "<script type='text/javascript' defer >alert('" . $_SESSION['message'] . "');</script>";
  unset($_SESSION['message']); // Clear session variable after showing the alert
}

include 'includes/footer.inc.php';

?>