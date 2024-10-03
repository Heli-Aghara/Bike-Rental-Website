<?php 
$page_title = 'Riding Tales - Your Orders';
include 'includes/header.inc.php'; 
?>

<?php
include 'config.php';

$username = $_SESSION['username'];

$user_query = "SELECT user_id FROM users WHERE user_name = ?";
$user_stmt = $connection->prepare($user_query);
$user_stmt->bind_param('s', $username);
$user_stmt->execute();
$user_stmt->bind_result($user_id);
$user_stmt->fetch();
$user_stmt->close();

// Query to fetch rental details with JOINs
$query = "
    SELECT r.rental_id, c.city_name, b.model_name, r.rental_start_datetime, r.rental_end_datetime, r.quantity, r.amount, r.rental_status 
    FROM rentals r 
    INNER JOIN bike_models b ON r.model_id = b.model_id 
    INNER JOIN cities c ON r.city_id = c.city_id 
    WHERE r.user_id = ? 
    ORDER BY r.rental_start_datetime DESC
";

$result = $connection->prepare($query);
$result->bind_param('i', $user_id);
$result->execute();
$result = $result->get_result();

if (isset($_SESSION['message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['message']) . "');</script>";
    unset($_SESSION['message']);
}

?>

<div class="container" style="z-index:0;">
    <?php
    if ($result->num_rows > 0) {
        // Loop through the rental records and display each as a card
        while ($row = $result->fetch_assoc()) {
            $status = htmlspecialchars($row['rental_status']);
            $badgeClass = 'bg-success'; // Default badge class

            // Determine badge class based on rental status
            switch ($status) {
                case 'Returned':
                    $badgeClass = 'bg-success';
                    break;
                case 'Cancelled':
                    $badgeClass = 'bg-danger';
                    break;
            }

            echo '
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Rental ID: ' . htmlspecialchars($row['rental_id']) . '</h5>
                <span class="badge ' . $badgeClass . '">' . htmlspecialchars($row['rental_status']) . '</span>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <strong>City: </strong>' . htmlspecialchars($row['city_name']) . '<br>
                    <strong>Model: </strong>' . htmlspecialchars($row['model_name']) . '<br>
                    <strong>Rental Start: </strong>' . htmlspecialchars($row['rental_start_datetime']) . '<br>
                    <strong>Rental End: </strong>' . htmlspecialchars($row['rental_end_datetime']) . '<br>
                    <strong>Quantity: </strong>' . htmlspecialchars($row['quantity']) . '<br>
                    <strong>Amount: </strong>₹' . htmlspecialchars(number_format($row['amount'], 2)) . '
                </p>
                <!-- Cancel Button -->
                <form action="cancel_rental.php" method="POST" onsubmit="return confirm(\'Are you sure you want to cancel this rental?\');">
                    <input type="hidden" name="rental_id" value="' . $row['rental_id'] . '">
                    <button type="submit" class="btn btn-danger">Cancel Rental</button>
                </form>
            </div>
        </div>';
        }
    } else {
        echo '<p>No rentals found.</p>';
    }
    ?>
</div>

<?php include 'includes/footer.inc.php'; ?>