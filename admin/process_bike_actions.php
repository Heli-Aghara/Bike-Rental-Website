<?php
include '../config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the model_id from the form
    $model_id = $_POST['model_id'];

    // Check if delete button was clicked
    if (isset($_POST['delete'])) {
        // Delete the record from the database
        $delete_query = "DELETE FROM bike_models WHERE model_id = ?";
        $stmt = $connection->prepare($delete_query);
        $stmt->bind_param("i", $model_id);
        
        if ($stmt->execute()) {
            // Redirect back with success message
            $_SESSION['message'] = "Bike deleted successfully!🥳🥳";
            header("Location: view_bikes.php");
            exit();
        } else {
            // Redirect back with error message
            $_SESSION['message'] = "Error deleting bike!😔😔";
            header("Location: view_bikes.php");
            exit();
        }
    }

    // Check if edit button was clicked
    if (isset($_POST['edit'])) {
        // Redirect to the edit page with the model_id in the query string
        header("Location: edit_bike.php?model_id=" . $model_id);
        exit();
    }
} 
?>
