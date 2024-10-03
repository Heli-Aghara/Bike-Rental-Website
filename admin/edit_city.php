<?php
$page_title = "Riding Tales - Update City";
include 'includes/header.inc.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<?php
// Include database configuration file
include '../config.php';

// Get the bike's model_id from the query string
if (isset($_GET['city_id'])) {
    $city_id = $_GET['city_id'];

    // Fetch bike details from the database
    $query = "SELECT * FROM cities WHERE city_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $city_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $city = $result->fetch_assoc();
}
?>

<div class="container-fluid">
<form class="col-4 p-3 border border-dark-subtle rounded rounded-3" action="process_edit_city.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="city_id" value="<?php echo $city['city_id']; ?>">
    <div class="mb-3">
      <label for="city_name" class="form-label">City Name:</label>
      <input type="text" class="form-control" id="city_name" name="city_name" value="<?php echo $city['city_name']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="pincode" class="form-label">Pincode:</label>
      <input type="text" class="form-control" id="pincode" name="pincode" pattern="^\d{6}$" minlength="6" maxlength="6" value="<?php echo $city['pincode']; ?>"required>
    </div>
    <div class="mb-3">
      <label for="pick_drop_loc" class="form-label">RT Hub:</label>
      <input type="text" class="form-control" id="pick_drop_loc" name="pick_drop_loc" value="<?php echo $city['pick_drop_loc']; ?>"required>
    </div>

    
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>

</div>

<?php

if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<script type='text/javascript' defer >alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear session variable after showing the alert
  }

include 'includes/footer.inc.php';
?>