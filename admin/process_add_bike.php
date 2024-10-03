<?php
// Include database configuration
include '../config.php';

session_start();
$_SESSION['message'] = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bike_model = $connection->real_escape_string($_POST['bike_model']);
    $vehicle_type = $connection->real_escape_string(ucfirst($_POST['vehicle_type']));
   
    $transmission_type = $connection->real_escape_string(ucfirst($_POST['transmission_type']));

    $fuel_type = $connection->real_escape_string(ucfirst($_POST['fuel_type']));

    $rental_rate = $_POST['rental_rate'];
    $late_fee_rate = $_POST['late_fee_rate'];

    // Handle file upload
    if (isset($_FILES['bike_img']) && $_FILES['bike_img']['error'] == UPLOAD_ERR_OK) {
        $bike_img_tmp = $_FILES['bike_img']['tmp_name'];
        $bike_img_name = $_FILES['bike_img']['name'];
        $bike_img_size = $_FILES['bike_img']['size'];
        $bike_img_error = $_FILES['bike_img']['error'];
        $bike_img_type = $_FILES['bike_img']['type'];

        // Validate file type
        //$allowed_types = ['image/png'];
        // if (!in_array($bike_img_type, $allowed_types)) {
        //    $_SESSION['message'] = "Invalid file type. Only PNG images are allowed.";
        //    header('Location: add_bike.php');
        //    exit();
        // }

        // Move file to uploads directory
        $upload_dir = '../images/uploads/bike_model_images/';
        $bike_img_path = $upload_dir . basename($bike_img_name);
        if (!move_uploaded_file($bike_img_tmp, $bike_img_path)) {
            $_SESSION['message'] = "Failed to upload file😔😔😔.";
            header('Location: add_bike.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "File upload error😔😔😔.";
        header('Location: add_bike.php');
        exit();
    }

    // Prepare and bind SQL statement
    $stmt = $connection->prepare("INSERT INTO bike_models (model_name, bike_img, vehicle_type, transmission_type, fuel_type, rental_rate, late_fee_rate) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdd", $bike_model, $bike_img_path, $vehicle_type, $transmission_type, $fuel_type, $rental_rate, $late_fee_rate);

    // Execute the statement
    if ($stmt->execute()) {
        $new_model_id = $connection->insert_id;  // Get the new model_id

        // Prepare another statement to insert into bike_stocks
        $stmt_stock = $connection->prepare("INSERT INTO bike_stocks (model_id, city_id, quantity) VALUES (?, ?, ?)");
        $default_quantity = 0;

        // Fetch all cities
        $sql_cities = "SELECT city_id FROM cities";
        $result_cities = $connection->query($sql_cities);

        // Insert into bike_stocks for each city
        while ($row_city = $result_cities->fetch_assoc()) {
            $city_id = $row_city['city_id'];
            $stmt_stock->bind_param("iii", $new_model_id, $city_id, $default_quantity);
            $stmt_stock->execute();  // Insert the stock data
        }
        
        $_SESSION['message'] = "New bike added successfully🥳🥳🥳.";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error."😔😔😔";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();

    header('Location: add_bike.php');
    exit();
}
?>
