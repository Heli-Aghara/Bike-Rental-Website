<?php
include 'config.php';
include 'includes/header.inc.php';
?>

<div class="container">
    <h2 class="mb-2 mt-2">Booking Details:</h2>
    <table class="table table-bordered table-sm w-50">
        <tbody>
            <tr>
                <th scope="row">Model :</th>
                <td class="modelName"></td>

            </tr>
            <tr>
                <th scope="row">City</th>
                <td class="cityName"></td>
            </tr>
            <tr>
                <th scope="row">Pickup/Drop Location:</th>
                <td class="pickDropLoc"></td>

            </tr>
            <tr>
                <th scope="row">Rental Start Date & Time:</th>
                <td class="rentalStartDateTime"></td>

            </tr>
            <tr>
                <th scope="row">Rental End Date & Time:</th>
                <td class="rentalEndDateTime"></td>
            </tr>
            <tr>
                <th scope="row">Total Rented Bikes : </th>
                <td class="rentedQuantity"></td>
            </tr>
            <tr>
                <th scope="row">Total Amount: </th>
                <td class="amount"></td>
            </tr>
        </tbody>
    </table>

    <?php
    global $connection;
    $username = $_SESSION['username'];
    $fetch_user_query = "SELECT user_id,user_name,first_name,last_name,user_name,email_id,phone_no FROM users WHERE user_name = '$username'";

    $result = mysqli_query($connection, $fetch_user_query);

    // Check if the query was successful and if we have results
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "No user found.";
    }

    $_SESSION['user_id'] = $user['user_id'];
    
    ?>

    <h2 class="mt-3">Personal Details:</h2>
    <table class="table table-bordered table-sm w-50">
        <tbody>
            <tr>
                <th scope="row">Username :</th>
                <td class="userName"><?php echo $user['user_name']; ?></td>
            </tr>
            <tr>
                <th scope="row">Full Name:</th>
                <td class="fullName"><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
            </tr>
            <tr>
                <th scope="row">Email:</th>
                <td class="emailID"><?php echo $user['email_id']; ?></td>

            </tr>
            <tr>
                <th scope="row">Phone No.:</th>
                <td class="phoneNo"><?php echo $user['phone_no']; ?></td>

            </tr>

        </tbody>
    </table>

    <h2 class="mt-3">Payment Details:</h2>
    <div class="card px-4 p-3 mb-3">
        <div class="row gx-3">
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Card Number</p>
                    <input class="form-control mb-3" type="text" placeholder="1234 5678 4356 2078" required>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Expiry</p>
                    <input class="form-control mb-3" type="text" placeholder="MM/YYYY" required>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">CVV/CVC</p>
                    <input class="form-control mb-3 pt-2 " type="password" placeholder="***" required>
                </div>
            </div>

        </div>
    </div>

    <form method="post" action="thank_you.php">
        <input type="hidden" value="" id="hidden_rental_amount" name="rental_amount">
        <button class="pay-btn btn btn-primary"> Pay </button>
    </form>

</div>

<script>
    const bookingData = JSON.parse(localStorage.getItem('bookingData'));

    document.querySelector('.modelName').textContent = bookingData.modelName;
    document.querySelector('.cityName').textContent = bookingData.city;
    document.querySelector('.pickDropLoc').textContent = bookingData.pickDropLocation;
    document.querySelector('.rentalStartDateTime').textContent = bookingData.startDate + ' (' + bookingData.startTime + ')';
    document.querySelector('.rentalEndDateTime').textContent = bookingData.endDate + ' (' + bookingData.endTime + ')';
    document.querySelector('.rentedQuantity').textContent = bookingData.quantity;
    document.querySelector('.amount').textContent = bookingData.amount;
    document.querySelector('.pay-btn').textContent += bookingData.amount + "/-";
    document.querySelector('#hidden_rental_amount').value = parseFloat(bookingData.amount).toFixed(2);

    // Optionally, clear localStorage after use
    // localStorage.clear();    
</script>

<?php
include 'includes/footer.inc.php';
?>