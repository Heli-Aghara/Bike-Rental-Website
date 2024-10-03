<?php
// Include database configuration
include '../config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $city_name = $connection->real_escape_string(trim($_POST['city_name']));
    $pincode = $connection->real_escape_string(trim($_POST['pincode']));
    $pick_drop_loc = $connection->real_escape_string(trim($_POST['pick_drop_loc']));

    // Prepare SQL statement to insert data into the cities table
    $sql = "INSERT INTO cities (city_name, pincode, pick_drop_loc) VALUES (?, ?, ?)";

    // Initialize statement
    if ($stmt = $connection->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sss", $city_name, $pincode, $pick_drop_loc);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $new_city_id = $connection->insert_id;  // Get the new city_id

            // Prepare another statement to insert into bike_stocks
            $stmt_stock = $connection->prepare("INSERT INTO bike_stocks (model_id, city_id, quantity) VALUES (?, ?, ?)");
            $default_quantity = 0;

            // Fetch all cities
            $sql_models = "SELECT model_id FROM bike_models";
            $result_models = $connection->query($sql_models);

            // Insert into bike_stocks for each model
            while ($row_model = $result_models->fetch_assoc()) {
                $model_id = $row_model['model_id'];
                $stmt_stock->bind_param("iii", $model_id, $new_city_id, $default_quantity);
                $stmt_stock->execute();  // Insert the stock data
            }
            // Success, redirect back to the form page with success message
            $_SESSION['message'] = "City added successfully😊😊!";
            header("Location: add_city.php");
            exit();
        } else {
            // Error in executing the statement
            $_SESSION['message'] = "Error: Could not execute query.😔😔";
            header("Location: add_city.php");
            exit();
        }
    } else {
        // Error in preparing the SQL statement
        $_SESSION['message'] = "Error: Could not prepare query.😔😔";
        header("Location: add_city.php");
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$connection->close();
