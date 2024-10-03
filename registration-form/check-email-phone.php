<?php

ob_start();

include '../config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

var_dump($_POST);

$email = $_POST['email_id'];
$phone = $_POST['phone_no'];

var_dump($email);

// Initialize response array
$response = array('email_exists' => false, 'phone_exists' => false);

// Check email availability
if (!empty($email)) {
    $query = $connection->prepare("SELECT * FROM users WHERE email_id = ?");
    $query->bind_param("s", $email);
    $query->execute();
    if ($query->get_result()->num_rows > 0) {
        $response['email_exists'] = true;
        echo "Hello";
    }
    $query->close();
}

// Check phone availability
if (!empty($phone)) {
    $query = $connection->prepare("SELECT * FROM users WHERE phone_no = ?");
    $query->bind_param("s", $phone);
    $query->execute();
    if ($query->get_result()->num_rows > 0) {
        $response['phone_exists'] = true;
    }
    $query->close();
}

ob_clean();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$connection->close();

?>