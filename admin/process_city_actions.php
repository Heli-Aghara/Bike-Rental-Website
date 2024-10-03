<?php
include '../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the model_id from the form
    $city_id = $_POST['city_id'];

    // Check if delete button was clicked
    if (isset($_POST['delete'])) {
        // Delete the record from the database
        $delete_query = "DELETE FROM cities WHERE city_id = ?";
        $stmt = $connection->prepare($delete_query);
        $stmt->bind_param("i", $city_id);
        
        if ($stmt->execute()) {
            // Redirect back with success message
            $_SESSION['message'] = "City deleted successfully!🥳🥳";
            header("Location: cities.php");
            exit();
        } else {
            // Redirect back with error message
            $_SESSION['message'] = "Error deleting city!😔😔";
            header("Location: cities.php");
            exit();
        }
    }

    // Check if edit button was clicked
    if (isset($_POST['edit'])) {
        // Redirect to the edit page with the model_id in the query string
        header("Location: edit_city.php?city_id=" . $city_id);
        exit();
    }
} 
?>
