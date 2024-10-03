<?php
require '../config.php';

$page_title = "Riding Tales - Admin Dashboard";
include 'includes/header.inc.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch total users
$total_users_query = "SELECT COUNT(*) AS total_users FROM users";
$total_users_result = $connection->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total_users'];

// Fetch total feedbacks
$total_feedbacks_query = "SELECT COUNT(*) AS total_feedbacks FROM feedbacks";
$total_feedbacks_result = $connection->query($total_feedbacks_query);
$total_feedbacks = $total_feedbacks_result->fetch_assoc()['total_feedbacks'];

// Fetch total rentals
$total_rentals_query = "SELECT COUNT(*) AS total_rentals FROM rentals";
$total_rentals_result = $connection->query($total_rentals_query);
$total_rentals = $total_rentals_result->fetch_assoc()['total_rentals'];

// Fetch total cities
$total_cities_query = "SELECT COUNT(*) AS total_cities FROM cities";
$total_cities_result = $connection->query($total_cities_query);
$total_cities = $total_cities_result->fetch_assoc()['total_cities'];


?>

<div class="container-fluid p-2">
    <h1>Hello <?php if (isset($_SESSION['username_admin'])) echo $_SESSION['username_admin']; ?>!! </h1>
    <div class="container mt-4">
    <div class="row">
        <!-- Total Users Card -->
        <div class="col-md-3">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2 class="card-text"><?php echo $total_users; ?></h2>
                </div>
            </div>
        </div>

        <!-- Total Feedbacks Card -->
        <div class="col-md-3">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Feedbacks</h5>
                    <h2 class="card-text"><?php echo $total_feedbacks; ?></h2>
                </div>
            </div>
        </div>

        <!-- Total Rentals Card -->
        <div class="col-md-3">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Rentals</h5>
                    <h2 class="card-text"><?php echo $total_rentals; ?></h2>
                </div>
            </div>
        </div>

        <!-- Total Cities Card -->
        <div class="col-md-3">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Cities</h5>
                    <h2 class="card-text"><?php echo $total_cities; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include 'includes/footer.inc.php';
?>