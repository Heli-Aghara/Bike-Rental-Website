<?php
session_start();
include '../config.php'; // Database connection



if (isset($_POST['rental_id'])) {
    $rental_id = $_POST['rental_id'];

    // Handle the return action
    if (isset($_POST['return'])) {
        // Update the rental status to 'Returned'
        $update_query = "UPDATE rentals SET rental_status = 'Returned' WHERE rental_id = ?";
        if ($stmt = $connection->prepare($update_query)) {
            $stmt->bind_param('i', $rental_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Rental returned successfully.🥳🥳";
            } else {
                $_SESSION['message'] = "Error returning the rental.😔😔";
            }
            $stmt->close();
        }
    } 

    // Handle the delete action
    if (isset($_POST['delete'])) {
        // Delete the rental from the rentals table
        $delete_query = "DELETE FROM rentals WHERE rental_id = ?";
        if ($stmt = $connection->prepare($delete_query)) {
            $stmt->bind_param('i', $rental_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Rental deleted successfully.🥳🥳";
            } else {
                $_SESSION['message'] = "Error deleting the rental.😔😔";
            }
            $stmt->close();
        }
    }
} else {
    $_SESSION['message'] = "Invalid rental ID.";
}

// Redirect back to the rentals view page
header("Location: view_rentals.php");
exit();
?>
