<?php
$page_title = "Riding Tales - Add City";
include 'includes/header.inc.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

?>
<div class="container-fluid">
<form class="col-4 p-3 border border-dark-subtle rounded rounded-3" action="process_add_city.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="city_name" class="form-label">City Name:</label>
      <input type="text" class="form-control" id="city_name" name="city_name" required>
    </div>
    <div class="mb-3">
      <label for="pincode" class="form-label">Pincode:</label>
      <input type="text" class="form-control" id="pincode" name="pincode" pattern="^\d{6}$" minlength="6" maxlength="6" required>
    </div>
    <div class="mb-3">
      <label for="pick_drop_loc" class="form-label">RT Hub:</label>
      <input type="text" class="form-control" id="pick_drop_loc" name="pick_drop_loc" required>
    </div>

    
    <button type="submit" class="btn btn-primary">Add City</button>
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