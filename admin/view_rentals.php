<?php
$page_title = "Riding Tales - Rentals";
include 'includes/header.inc.php';
include '../config.php';
?>

<?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
    if(isset($_SESSION['message'])){
        echo "<script>alert('".htmlspecialchars($_SESSION['message'])."');</script>";
        unset($_SESSION['message']);
      }
?>


<div class="container-fluid px-3">
<!-- <table class="table">
  <thead>
    <tr>
      <th scope="col">Rental ID</th>
      <th scope="col">User Name</th>
      <th scope="col">City Name</th>
      <th scope="col">Model Name</th>
      <th scope="col">Rental Start</th>
      <th scope="col">Rental End</th>
      <th scope="col">User Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>ś
  </tbody>
</table> -->
<?php
$query = "SELECT 
            r.rental_id, 
            u.user_name, 
            c.city_name, 
            bm.model_name, 
            r.rental_start_datetime, 
            r.rental_end_datetime, 
            r.quantity, 
            r.amount, 
            r.rental_status
          FROM 
            rentals r
          JOIN 
            users u ON r.user_id = u.user_id
          JOIN 
            cities c ON r.city_id = c.city_id
          JOIN 
            bike_models bm ON r.model_id = bm.model_id";
            
$result = $connection->query($query);

if ($result->num_rows > 0) {
    echo '<table class="table table-sm table-dark">';
    echo '<thead>
            <tr>
              <th scope="col">Rental ID</th>
              <th scope="col">User Name</th>
              <th scope="col">City Name</th>
              <th scope="col">Model Name</th>
              <th scope="col">Rental Start</th>
              <th scope="col">Rental End</th>
              <th scope="col">Quantity</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>';
    echo '<tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['rental_id'] . '</td>';
        echo '<td>' . $row['user_name'] . '</td>';
        echo '<td>' . $row['city_name'] . '</td>';
        echo '<td>' . $row['model_name'] . '</td>';
        echo '<td>' . $row['rental_start_datetime'] . '</td>';
        echo '<td>' . $row['rental_end_datetime'] . '</td>';
        echo '<td>' . $row['quantity'] . '</td>';
        echo '<td>' . $row['amount'] . '</td>';
        echo '<td>' . $row['rental_status'] . '</td>';
        echo '
        <td>
            <form action="process_rental_actions.php" method="post">
                <input type="hidden" name="rental_id" value="'. $row['rental_id']. '">
                <button type="submit" name="return" class="btn btn-primary p-1 px-2">Return</button>
                <button type="submit" name="delete" class="btn text-danger p-0 px-1"><i class="bx bxs-trash" onclick="return confirm(\'Are you sure you want to delete this rental?\');"></i></button>
            </form>
        </td>
        ';  // Actions can be added here
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo "No rentals found.";
}

$connection->close();
?>
</div>
<?php
include 'includes/footer.inc.php';
?>