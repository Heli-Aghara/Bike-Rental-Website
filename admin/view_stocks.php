<?php
$page_title = "Riding Tales - Bike Stocks";
include 'includes/header.inc.php';
include 'retrieve_stocks.php';

$stocks = retrieve_stocks();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<div class="container-fluid">
  <table class="table table-dark table-striped table-bordered table-sm table-responsive-lg">
    <thead>
      <tr>
        <th scope="col">Stock ID</th>
        <th scope="col">City Name</th>
        <th scope="col">Model Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($stocks)): ?>
        <?php foreach ($stocks as $stock): ?>
          <tr>
            <th><?php echo $stock['stock_id']; ?></th>
            <td><?php echo $stock['city_name']; ?></td>
            <td><?php echo $stock['model_name']; ?></td>
            <td><?php echo $stock['quantity']; ?></td>
            <td>
              <button type="submit" class="update_btn btn btn-primary px-2 p-0">Update Qty.</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="10">No stocks Found!!</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <dialog class="qty_popup">
    <form action="update_stock_qty.php" method="post">
      <span>Update Qty. :</span>
      <input type="hidden" name="stock_id" value="">
      <input type="number" name="stock_qty" id="stock_qty" value="5" class="form-input-sm">
      <button type="submit"
      name="update_qty" class="update_qty_btn btn btn-primary px-1 p-1" >Update</button>
      
      <button type="button" class="close_btn btn btn-danger px-1 p-1">Close</button> 
    </form>
  </dialog>

</div>


<?php

if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
  echo "<script type='text/javascript' defer >alert('" . $_SESSION['message'] . "');</script>";
  unset($_SESSION['message']); // Clear session variable after showing the alert
}


include 'includes/footer.inc.php';
?>