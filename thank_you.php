<?php
    include 'config.php';
    $page_title = 'Riding Tales - Thank You!';
    include 'includes/header.inc.php' 
?>

<div class="h-75 d-flex justify-content-center align-items-center">
    <div>
        <div class="mb-4 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <div class="text-center">
            <h1>Thank You !</h1>
            <p>Payment Successful!!</p>
            <button class="btn btn-primary" onclick="redirectToHome()">Back Home</button>
        </div>
    </div>
</div>
<?php
$user_id = $_SESSION['user_id'];
$city_name = $_SESSION['city'];

$fetch_city_id = "SELECT city_id FROM cities WHERE city_name = ?";

if ($stmt = $connection->prepare($fetch_city_id)) {
    $stmt->bind_param("s", $city_name);
    $stmt->execute();
    $stmt->bind_result($city_id);
    if ($stmt->fetch()) {
        $_SESSION['city_id'] = $city_id;
    }
    $stmt->close();
} else {
    echo "Error in query preparation/execution: " . $conn->error;
}

$city_id = $_SESSION['city_id']; //fetch
$model_id = $_SESSION['rental_model_id'];
$rental_start_datetime = $_SESSION['pickup_datetime'];
$rental_end_datetime = $_SESSION['dropff_datetime'];
$rental_quantity = $_SESSION['rental_quantity'];
$rental_amount = $_SESSION['rental_amount'];


//insert record into rentals table
$insert_rental_query = "INSERT INTO rentals (user_id, city_id, model_id, rental_start_datetime, rental_end_datetime, quantity, amount)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $connection->prepare($insert_rental_query)) {
    // Bind the parameters (integers for user_id, city_id, model_id, and quantity; strings for datetimes; double for amount)
    $stmt->bind_param("iiissid", $user_id, $city_id, $model_id, $rental_start_datetime, $rental_end_datetime, $rental_quantity, $rental_amount);

    // Execute the query
    if ($stmt->execute()) {
        //echo "Rental record inserted successfully!";
    } else {
        //echo "Error inserting rental: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    //echo "Error preparing query: " . $connection->error;
}

// Close the database connection
$connection->close();
?>
<script>
    function redirectToHome(){
        window.location.href = 'index.php';
    }
</script>