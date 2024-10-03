<?php 
include '../config.php';

function retrieve_users(){
    global $connection;
    $get_users_query = "SELECT user_id,first_name,last_name,user_name,gender,dob,email_id,phone_no,created_at FROM users";
    $result = mysqli_query($connection, $get_users_query);

    $users = [];
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
    }
    return $users;
}

?>