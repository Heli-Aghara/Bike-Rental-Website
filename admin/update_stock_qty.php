<?php 
    include '../config.php';
    session_start();

    if(isset($_POST['update_qty'])){
        if(isset($_POST['stock_id'])){
            $stock_id = $_POST['stock_id'];
            $stock_qty = $_POST['stock_qty'];
        }
    
        $update_qty_query = "UPDATE bike_stocks SET quantity = '$stock_qty' WHERE stock_id = '$stock_id'";

        if ($connection->query($update_qty_query)) {
            // Redirect back with success message
            $_SESSION['message'] =  "Quantity updated to " .$stock_qty. " successfully🥳🥳🥳.";
            header("Location: view_stocks.php");
        } else {
            $_SESSION['message'] = "Error: " . $connection->error."😔😔😔";
            header("Location: view_stocks.php" );
        }

    }
    else{
        echo "Invalid request.";
    }
   
?>