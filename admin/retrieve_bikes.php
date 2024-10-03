<?php 
include '../config.php';

function retrieve_bikes(){
    global $connection;
    $get_bikes_query = "SELECT model_id,model_name,vehicle_type,transmission_type,fuel_type,rental_rate,late_fee_rate FROM bike_models";
    $result = mysqli_query($connection, $get_bikes_query);

    $models = [];
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $models[] = $row;
        }
    }
    return $models;
}

?>