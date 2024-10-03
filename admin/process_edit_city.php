<?php 
include '../config.php';

session_start();

if (isset($_POST['update'])) {
    $city_id = $_POST['city_id']; // Hidden input field
    $city_name = $connection->real_escape_string($_POST['city_name']);
    $pincode = $connection->real_escape_string($_POST['pincode']);
    $pick_drop_loc = $connection->real_escape_string($_POST['pick_drop_loc']); 
    
    // Update the bike details
    $update_city_query = "UPDATE cities 
              SET city_name = '$city_name', 
                  pincode = '$pincode', 
                  pick_drop_loc = '$pick_drop_loc' 
              WHERE city_id = '$city_id'";

    if ($connection->query($update_city_query)) {
        // Redirect back with success message
        $_SESSION['message'] = $city_name . " updated successfully🥳🥳🥳.";
        header("Location: edit_city.php?city_id=" . $city_id);
    } else {
        $_SESSION['message'] = "Error: " . $connection->error."😔😔😔";
        header("Location: edit_city.php?city_id=" . $city_id);
    }
} else {
    echo "Invalid request.";
}
?>