<?php
    include '../config.php';

    function retrieve_stocks(){
        global $connection;
        $get_stocks_query = "SELECT stock_id, bm.model_id, model_name, c.city_id, city_name, quantity FROM bike_models as bm
        INNER JOIN bike_stocks as bs ON bm.model_id = bs.model_id
        INNER JOIN cities as c ON bs.city_id = c.city_id;
        ";
        $result = mysqli_query($connection, $get_stocks_query);
    
        $stocks = [];
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $stocks[] = $row;
            }
        }
        return $stocks;
    }
?>