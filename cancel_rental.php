<?php
session_start();
include 'config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rental_id'])) {
    $rental_id = $_POST['rental_id'];
    $current_datetime = date('Y-m-d H:i:s'); // Get current date and time

    // Query to fetch rental_start_datetime for comparison
    $query = "SELECT rental_start_datetime FROM rentals WHERE rental_id = ?";
    
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param('i', $rental_id);
        $stmt->execute();
        $stmt->bind_result($rental_start_datetime);
        $stmt->fetch();
        $stmt->close();

        // Check if the current date is past the rental start date
        if ($current_datetime < $rental_start_datetime) {
            // Update rental_status to "Cancelled"
            $update_query = "UPDATE rentals SET rental_status = 'Cancelled' WHERE rental_id = ?";
            if ($update_stmt = $connection->prepare($update_query)) {
                $update_stmt->bind_param('i', $rental_id);
                if ($update_stmt->execute()) {
                    $_SESSION['message'] = "Rental cancelled successfully.";
                } else {
                    $_SESSION['message'] = "Error cancelling rental.";
                }
                $update_stmt->close();
            }
        } else {
            $_SESSION['message'] = "Cannot cancel rental after the start date.";
        }
    } else {
        $_SESSION['message'] = "Error fetching rental details.";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}

// Redirect back to the rentals page (e.g., rentals.php)
header("Location: view_orders.php");
exit(); 
?>
