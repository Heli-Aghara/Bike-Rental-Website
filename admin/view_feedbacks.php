<?php
include '../config.php';

$page_title = "Riding Tales - Feedbacks";
include 'includes/header.inc.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    if(isset($_SESSION['message'])){
        echo "<script>alert('".htmlspecialchars($_SESSION['message'])."');</script>";
        unset($_SESSION['message']);
      }

// Query to fetch feedbacks from the feedbacks table
$query = "SELECT f.feedback_id, u.user_name, f.subject, f.feedback, f.ratings, f.date_submitted 
          FROM feedbacks f 
          INNER JOIN users u ON f.user_id= u.user_id
          ORDER BY f.date_submitted DESC";

$result = $connection->query($query);
?>
<div class="container">
<?php
if ($result->num_rows > 0) {
    // Loop through the feedback records and display each as a card
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">' . htmlspecialchars($row['subject']) . '</h5>
                <!-- Delete Button -->
                <form action="delete_feedback.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this feedback?\');">
                    <input type="hidden" name="feedback_id" value="' . $row['feedback_id'] . '">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <strong>Feedback ID: </strong>' . htmlspecialchars($row['feedback_id']) . '<br>
                    <strong>User: </strong>' . htmlspecialchars($row['user_name']) . '<br>
                    <strong>Rating: </strong>' . htmlspecialchars($row['ratings']) . '/5<br>
                    <strong>Feedback: </strong>' . nl2br(htmlspecialchars($row['feedback'])) . '<br>
                    <strong>Submitted on: </strong>' . htmlspecialchars($row['date_submitted']) . '
                </p>
            </div>
        </div>';
    }
} else {
    echo '<p>No feedback available.</p>';
}
?>
</div>
<?php
include 'includes/footer.inc.php';
?>
