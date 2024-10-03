<?php
$page_title = "Riding Tales - View Bikes";
include 'includes/header.inc.php';
include 'retrieve_bikes.php';

$bikes = retrieve_bikes();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

    // displaying message for deleting a bike.....
    if(isset($_SESSION['message'])){
      echo "<script>alert('".htmlspecialchars($_SESSION['message'])."');</script>";
      unset($_SESSION['message']);
    }
?>

<div class="container-fluid p-2">
  <table class="table table-dark table-striped table-bordered table-sm table-responsive-lg">
    <thead>
      <tr>
        <th scope="col">Model ID</th>
        <th scope="col">Model Name</th>
        <th scope="col">Vehicle Type</th>
        <th scope="col">Transmission Type</th>
        <th scope="col">Fuel Type</th>
        <th scope="col">Rental Rate</th>
        <th scope="col">Late Fee Rate</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php if (!empty($bikes)): ?>
          <?php foreach ($bikes as $bike):?>  
            <tr>
                <th><?php echo $bike['model_id']; ?></th>
                <td><?php echo $bike['model_name']; ?></td>
                <td><?php echo $bike['vehicle_type']; ?></td>
                <td><?php echo $bike['transmission_type']; ?></td>
                <td><?php echo $bike['fuel_type']; ?></td>
                <td><?php echo $bike['rental_rate']; ?></td>
                <td><?php echo $bike['late_fee_rate']; ?></td>
                <!-- <td><button value="delete" class="bg-danger text-light px-2   border-0 rounded rounded-2">Delete</button></td> -->
                <td>
                    <!-- Delete Button -->
                    <form method="POST" action="process_bike_actions.php" >
                      <input type="hidden" name="model_id" value="<?php echo $bike['model_id']; ?>">
                      <button type="submit" name="delete" class="btn text-danger p-0 px-1"><i class='bx bxs-trash' onclick="return confirm('Are you sure you want to delete this bike?');"></i></button>
                      <button type="submit" name="edit" class="btn p-0 px-1" style="color: 	#0096FF;"><i class='bx bxs-edit'></i></button>
                    </form>
                </td>
            </tr>
          <?php endforeach; ?>
        <?php else:?>  
          <tr>
            <td colspan="10">No users Found!!</td>
          </tr>
        <?php endif; ?>  
      </table>
</div>

<?php
include 'includes/footer.inc.php';
?>
