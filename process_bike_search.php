<?php
    include 'config.php';

    global $city;

    function get_bikes($city, $pickup_datetime, $dropoff_datetime){
        
        global $connection;
        

        /*$get_bikes_query = "SELECT bm.model_id,model_name,bike_img,fuel_type, rental_rate, late_fee_rate, quantity, pick_drop_loc
        FROM bike_models as bm
        INNER JOIN bike_stocks as stocks
        ON bm.model_id = stocks.model_id
        INNER JOIN (SELECT city_id,pick_drop_loc from cities where city_name = '$city') 
        as subquery
        ON stocks.city_id = subquery.city_id ;
        ";*/

//         $get_bikes_query = "SELECT bm.model_id, bm.model_name, bm.bike_img, bm.fuel_type, bm.rental_rate, bm.late_fee_rate, bs.quantity,
//            bs.quantity - IFNULL(SUM(r.quantity), 0) AS quantity_left, 
//            subquery.pick_drop_loc
//     FROM bike_models AS bm
//     INNER JOIN bike_stocks AS bs
//         ON bm.model_id = bs.model_id
//     INNER JOIN (
//         SELECT city_id, pick_drop_loc 
//         FROM cities 
//         WHERE city_name = '$city'
//     ) AS subquery
//         ON bs.city_id = subquery.city_id
//     LEFT JOIN rentals AS r
//         ON bm.model_id = r.model_id
//         AND bs.city_id = r.city_id
//         AND (
//             (r.rental_start_datetime BETWEEN '$pickup_datetime' AND '$dropoff_datetime') OR
//             (r.rental_end_datetime BETWEEN '$pickup_datetime' AND '$dropoff_datetime') OR
//             ('$pickup_datetime' BETWEEN r.rental_start_datetime AND r.rental_end_datetime) OR
//             ('$dropoff_datetime' BETWEEN r.rental_start_datetime AND r.rental_end_datetime)
//         )
//     GROUP BY bm.model_id, bm.model_name, bm.bike_img, bm.fuel_type, bm.rental_rate, bm.late_fee_rate, bs.quantity, subquery.pick_drop_loc;
// ";

$get_bikes_query = "
    SELECT bm.model_id, bm.model_name, bm.bike_img, bm.fuel_type, bm.rental_rate, bm.late_fee_rate, bs.quantity,
           bs.quantity - IFNULL(SUM(r.quantity), 0) AS quantity_left, 
           subquery.pick_drop_loc
    FROM bike_models AS bm
    INNER JOIN bike_stocks AS bs
        ON bm.model_id = bs.model_id
    INNER JOIN (
        SELECT city_id, pick_drop_loc 
        FROM cities 
        WHERE city_name = '$city'
    ) AS subquery
        ON bs.city_id = subquery.city_id
    LEFT JOIN rentals AS r
        ON bm.model_id = r.model_id
        AND bs.city_id = r.city_id
        AND (
            (r.rental_start_datetime BETWEEN '$pickup_datetime' AND '$dropoff_datetime') OR
            (r.rental_end_datetime BETWEEN '$pickup_datetime' AND '$dropoff_datetime') OR
            ('$pickup_datetime' BETWEEN r.rental_start_datetime AND r.rental_end_datetime) OR
            ('$dropoff_datetime' BETWEEN r.rental_start_datetime AND r.rental_end_datetime)
        )
        AND r.rental_status = 'Success'  -- Added condition to filter for successful rentals
    GROUP BY bm.model_id, bm.model_name, bm.bike_img, bm.fuel_type, bm.rental_rate, bm.late_fee_rate, bs.quantity, subquery.pick_drop_loc;
";

        $result = mysqli_query($connection, $get_bikes_query);
        $bikes = [];
        
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $bikes[] = $row;
            }
        }
        return $bikes;

    }

?>