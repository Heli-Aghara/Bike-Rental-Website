<?php 
    $page_title = "Riding Tales - View Users";
    include 'includes/header.inc.php';
    include 'retrieve_users.php';

    $users = retrieve_users();

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

    // displaying message for deleting user.....
    if(isset($_SESSION['message'])){
      echo "<script>alert('".htmlspecialchars($_SESSION['message'])."');</script>";
      unset($_SESSION['message']);
    }
?>



<div class="container-fluid p-2">
  <table class="table table-dark table-striped table-bordered table-sm table-responsive-lg">
    <thead>
      <tr >
        <th scope="col">User ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Username</th>
        <th scope="col">Gender</th>
        <th scope="col">DOB</th>
        <th scope="col">Email</th>
        <th scope="col">Phone no.</th>
        <th scope="col">Created at</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)): ?>
          <?php foreach ($users as $user):?>  
            <tr>
                <th><?php echo $user['user_id']; ?></th>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td><?php echo $user['user_name']; ?></td>
                <td><?php echo $user['gender']; ?></td>
                <td><?php echo $user['dob']; ?></td>
                <td><?php echo $user['email_id']; ?></td>
                <td><?php echo $user['phone_no']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <!-- <td><button value="delete" class="bg-danger text-light px-2   border-0 rounded rounded-2">Delete</button></td> -->
                <td>
                    <!-- Delete Button -->
                    <form method="POST" action="delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                      <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                      <button type="submit" class="btn btn-danger p-0 px-2">Delete</button>
                    </form>
                </td>
            </tr>
          <?php endforeach; ?>
        <?php else:?>  
          <tr>
            <td colspan="10">No users Found!!</td>
          </tr>
        <?php endif; ?>
        
    </tbody>
  </table>
</div>


<?php 
    include 'includes/footer.inc.php';
?>

