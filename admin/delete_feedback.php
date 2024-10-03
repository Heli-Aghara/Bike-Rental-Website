<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedback_id'])) {
    $feedback_id = $_POST['feedback_id'];

    // Prepare the SQL query to delete the feedback
    $query = "DELETE FROM feedbacks WHERE feedback_id = ?";

    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param('i', $feedback_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Feedback deleted successfully.";
        } else {
            $_SESSION['message'] = "Error deleting feedback.";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Error preparing delete statement.";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}

// Redirect back to the feedback display page (e.g., feedback_list.php)
header("Location: view_feedbacks.php");
exit();
?>
