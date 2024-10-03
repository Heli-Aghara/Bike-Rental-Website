<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $_SESSION['rental_quantity'] = $_POST['hidden_rental_quantity'];
   $_SESSION['rental_model_id'] = $_POST['hidden_model_id'];
   $_SESSION['rental_amount'] = $_POST['hidden_rental_amount'];
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, proceed to payment page
    header("Location: checkout.php");
    exit();
} else {
    // User is not logged in, redirect to login page
    header("Location: login-form/login-form.php");
    exit();
}
?>
