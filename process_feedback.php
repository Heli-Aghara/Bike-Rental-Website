<?php
session_start();
include 'config.php'; // Database connection

if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $subject = $_POST['subject'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    // Fetch user_id from the users table based on the username
    $user_query = "SELECT user_id FROM users WHERE user_name = ?";
    if ($stmt = $connection->prepare($user_query)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        if ($user_id) {
            // Prepare the insert query to store feedback
            $insert_query = "INSERT INTO feedbacks (user_id, subject, feedback, ratings, date_submitted) VALUES (?, ?, ?, ?, NOW())";
            if ($stmt = $connection->prepare($insert_query)) {
                $stmt->bind_param('issi', $user_id, $subject, $feedback, $rating);
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Feedback submitted successfully.😊😊";
                } else {
                    $_SESSION['message'] = "Error submitting feedback.";
                }
                $stmt->close();
            }
        } else {
            $_SESSION['message'] = "User not found.";
        }
    } else {
        $_SESSION['message'] = "Error fetching user information.";
    }
}

// Redirect back to the contact form page
header("Location: contact-form.php");
exit();
?>
