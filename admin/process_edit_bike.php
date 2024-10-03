<?php
include '../config.php'; // Database connection

session_start();

if (isset($_POST['update'])) {
    $model_id = $_POST['model_id']; // Hidden input field
    $bike_model = $connection->real_escape_string($_POST['bike_model']);
    $vehicle_type = $connection->real_escape_string(ucfirst($_POST['vehicle_type']));
    $transmission_type = $connection->real_escape_string(ucfirst($_POST['transmission_type']));
    $fuel_type = $connection->real_escape_string(ucfirst($_POST['fuel_type']));
    $rental_rate = $connection->real_escape_string($_POST['rental_rate']);
    $late_fee_rate = $connection->real_escape_string($_POST['late_fee_rate']);
    
    // Handle bike image update if a new image is uploaded
    if (isset($_FILES['bike_img']) && $_FILES['bike_img']['error'] == 0) {
        $bike_img = $_FILES['bike_img']['name'];
        $target_dir = "../images/uploads/bike_model_images/";
        $target_file = $target_dir . basename($bike_img);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['bike_img']['tmp_name'], $target_file)) {
            // If the image upload is successful, update with new image
            $image_sql = ", bike_img = '$target_file'";
        } else {
            echo "Error uploading image.";
        }
    } else {
        $image_sql = ""; // No image update
    }



    // Update the bike details
    $query = "UPDATE bike_models 
              SET model_name = '$bike_model', 
                  vehicle_type = '$vehicle_type', 
                  transmission_type = '$transmission_type', 
                  fuel_type = '$fuel_type', 
                  rental_rate = '$rental_rate', 
                  late_fee_rate = '$late_fee_rate' 
                  $image_sql 
              WHERE model_id = '$model_id'";

    if ($connection->query($query)) {
        // Redirect back with success message
        $_SESSION['message'] = $bike_model . " updated successfully🥳🥳🥳.";
        header("Location: edit_bike.php?model_id=" . $model_id);
    } else {
        $_SESSION['message'] = "Error: " . $connection->error."😔😔😔";
        header("Location: edit_bike.php?model_id=" . $model_id);
    }
} else {
    echo "Invalid request.";
}
$connection -> close();
exit();
?>
