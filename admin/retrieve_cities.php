<?php 
include '../config.php';

function retrieve_cities(){
    global $connection;
    $get_cities_query = "SELECT city_id,city_name,pincode,pick_drop_loc FROM cities";
    $result = mysqli_query($connection, $get_cities_query);

    $cities = [];
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $cities[] = $row;
        }
    }
    return $cities;
}


?>