<?php 

ob_start();
include '../config.php';
   
    // | get form data from registration-form.html |
    $username = $_POST['username'];


    //response
    $response = array('status'=>'error');

    // prepared statement to check if the username exists
    $statement = $connection->prepare("SELECT * FROM users WHERE user_name=?");
    $statement->bind_param("s",$username);
    $statement->execute();
    $statement->store_result();

    if($statement->num_rows() > 0){
        $status = 'unavailable';
    }else{
        $status = 'available';
    }

    $response['status'] = $status;
    $statement->close();


    //clean buffer
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);


?>