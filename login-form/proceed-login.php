<?php
session_start();
require '../config.php'; // Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']);

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_admin = isset($_POST['is_admin']);
    
        if ($is_admin) {
            // Check in Admins table (plain text password comparison)
            $stmt = $connection->prepare("SELECT admin_id FROM admins WHERE admin_name = ? AND password_hash = ?");
            $stmt->bind_param("ss", $username, $password);
        } else {
            // Check in Users table (hashed password comparison)
            $stmt = $connection->prepare("SELECT user_id, password_hash FROM users WHERE user_name = ?");
            $stmt->bind_param("s", $username);
        }
    
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            if ($is_admin) {
                // Admin login: Check plain text password
                if ($stmt->num_rows > 0) {
                    $_SESSION['username_admin'] = $username;
                    $_SESSION['password_admin'] = $password;

                    // Admin found, redirect to admin dashboard
                    header("Location: ../admin/admin-dashboard.php");
                    exit;
                } else {
                    
                    // echo "Invalid username or password.";
                    
                    $_SESSION['login_message'] = '<div class="alert alert-danger" role="alert">Wrong admin name or password!</div>';
                    echo $_SESSION['login_message'];
                    header("Location: login-form.php");
                    exit;
                }
            } else {
                // User login: Check hashed password
                $stmt->bind_result($id, $password_hash);
                $stmt->fetch();
    
                // Verify the entered password against the hashed password
                if (password_verify($password, $password_hash)) {
                    
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['logged_in'] = true;

                
                    // Password is correct, redirect to homepage
                    header("Location: ../index.php");
                    exit;
                } else {
                    // Incorrect password
                    
                    // echo "Invalid username or password.";

                    $_SESSION['login_message'] = '<div class="alert alert-danger" role="alert">Wrong password!</div>';
                    echo $_SESSION['login_message'];
                    header("Location: login-form.php");
                    exit;
                }
            }
        } else {
            // No user/admin found with that username/email
            // echo "Invalid username or password.";

            $_SESSION['login_message'] = '<div class="alert alert-danger" role="alert">No account found with that username/admin-name.</div>';
                header("Location: login-form.php");
                exit;
        }
        $stmt->close();
        $connection->close();
    }
    

    /*
    // Fetch user from database
    $query = "SELECT user_id, user_name, password_hash FROM users WHERE user_name = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $username, $hashed_password);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, start a new session
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    //header("Location: ../index.html"); 
                    exit;
                } else {
                    $_SESSION['login_message'] = '<div class="alert alert-danger" role="alert">Wrong password!</div>';
                    echo $_SESSION['login_message'];
                    header("Location: login-form.php");
                    exit;
                }
            } else {
                $_SESSION['login_message'] = '<div class="alert alert-danger" role="alert">No account found with that username.</div>';
                header("Location: login-form.php");
                exit;
            }
        } else {
            $_SESSION['login_message'] = '<div class="alert alert-danger" role="alert">Something went wrong. Please try again later.</div>';
            header("Location: login-form.php");
            exit;
        }
        $stmt->close();
    }
    $conn->close();*/
}
