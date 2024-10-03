<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include '../config.php';

    // | get form data from registration-form.html |
    $f_name = htmlspecialchars($_POST['f_name'],ENT_QUOTES);
    $l_name = htmlspecialchars($_POST['l_name'],ENT_QUOTES);
    $username = htmlspecialchars($_POST['username'],ENT_QUOTES);
    $email_id = htmlspecialchars($_POST['email_id'],ENT_QUOTES);
    $phone_no = htmlspecialchars($_POST['phone_no'],ENT_QUOTES);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender'],ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'],ENT_QUOTES);
    $confirm_password = htmlspecialchars($_POST['confirm_password'],ENT_QUOTES);
    $created_at = date('Y-m-d H:i:s');

    // | getting driving_lic image from registration form. |
    if (isset($_FILES['driving_lic'])) {
        $drivingLicenseFile = $_FILES['driving_lic'];
    
        // Get the file name
        $drivingLicenseFileName = $drivingLicenseFile['name'];
    
        // Get the temporary file path
        $drivingLicenseTempFilePath = $drivingLicenseFile['tmp_name'];
    
        // Get the file type
        $drivingLicenseFileType = $drivingLicenseFile['type'];
    
        // Get the file size
        $drivingLicenseFileSize = $drivingLicenseFile['size'];
    
        // Check for errors
        if ($drivingLicenseFile['error']!== UPLOAD_ERR_OK) {
          echo "Error uploading file: ". $drivingLicenseFile['error'];
          exit;
        }
    
        //moving file to a permenent location
        $upload_dir = 'uploads/driving_lics/';
        $driving_lic_permenent_path = $upload_dir . basename($drivingLicenseFileName);
        move_uploaded_file($drivingLicenseTempFilePath, $driving_lic_permenent_path);

      } else {
        echo "No file uploaded";
  }

    // | hashed password for security |
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // | form validation | 

    // | 1. checking if the passwords match |
    if ($password!= $confirm_password) {
        echo "Passwords do not match. Please correct the passwords and re-submit the form.";
          exit;
    }

    // | 2. checking if all the fields are filled. |
    foreach ($_POST as $field => $value) {
        if (empty($value)) {
          echo "Please fill in all fields.";
          exit;
        }
    }

    // | Sending data to the database |
    $statement = $connection -> prepare("INSERT INTO users(first_name,last_name,user_name,gender,dob,email_id,phone_no,password_hash,created_at,driving_lic_img) values(?,?,?,?,?,?,?,?,?,?)");
    $statement -> bind_param("ssssssssss",$f_name,$l_name,$username,$gender,$dob,$email_id,$phone_no,$password_hash,$created_ats,$driving_lic_permenent_path);

    if($statement->execute()){

        if($statement->affected_rows > 0){
            echo "<script>alert('Record inserted successfully.')</script>";
            header ("location: ../login-form/login-form.php");
        }else{
            echo("record not inserted...");
        }
    }
    else{
        echo("Error : ".$statement->error);
    }

    // | closing connection |
    $connection -> close();
}



?>