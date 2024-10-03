<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'riding_tales';

//Creating a connection object
$connection = new mysqli($host,$username,$password,$db_name);

//Check connection
if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);
}
else{
    //echo '<script>alert("Connected to database successfully!!!")</script>';
}


?>
