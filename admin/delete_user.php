<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config.php';

if (isset($_POST['user_id'])) {
    // Get the user_id from the form
    $user_id = intval($_POST['user_id']);

    // Prepare the DELETE query
    $delete_user_query = "DELETE FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($connection, $delete_user_query);
    
    // Bind the parameter and execute the query
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    $result = mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if ($result) {
        $_SESSION['message'] = 'User deleted successfully!!🥳';
    } else {
        $_SESSION['message'] = 'Error deleting user!!😔';
    }
} else {
    header("Location: view_users.php");
    exit();
}

header("Location: view_users.php");

?>