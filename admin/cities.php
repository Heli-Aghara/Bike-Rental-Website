<?php
$page_title = "Riding Tales - Cities";
include 'includes/header.inc.php';
include 'retrieve_cities.php';

$cities = retrieve_cities();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<div class="container-fluid">
  <h1>Cities</h1>
  <div class="d-flex justify-content-start">
    <button class="btn btn-primary mb-2"><a href="add_city.php" class="text-light">Add New City</a></button>
  </div>
  <table class="table table-dark table-striped table-bordered table-sm table-responsive-lg">
    <thead>
      <tr>
        <th scope="col">City ID</th>
        <th scope="col">City</th>
        <th scope="col">Pincode</th>
        <th scope="col">RT Hub</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($cities)): ?>
        <?php foreach ($cities as $city): ?>
          <tr>
            <th><?php echo $city['city_id']; ?></th>
            <td><?php echo $city['city_name']; ?></td>
            <td><?php echo $city['pincode']; ?></td>
            <td><?php echo $city['pick_drop_loc']; ?></td>
            <!-- <td><button value="delete" class="bg-danger text-light px-2   border-0 rounded rounded-2">Delete</button></td> -->
            <td>

              <form method="POST" action="process_city_actions.php">
                <input type="hidden" name="city_id" value="<?php echo $city['city_id']; ?>">
                <button type="submit" name="delete" class="btn text-danger p-0 px-1"><i class='bx bxs-trash' onclick="return confirm('Are you sure you want to delete this city?');"></i></button>
                <button type="submit" name="edit" class="btn p-0 px-1" style="color: 	#0096FF;"><i class='bx bxs-edit'></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="10">No cities Found!!</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php

// displaying message for deleting a bike.....
if(isset($_SESSION['message'])){
  echo "<script>alert('".htmlspecialchars($_SESSION['message'])."');</script>";
  unset($_SESSION['message']);
}

include 'includes/footer.inc.php'
?>