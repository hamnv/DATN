<?php
session_start();
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$account = $_POST['account'];
$password = $_POST['password'];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "INSERT INTO admin (account, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_account, $param_password);
            
            // Set parameters
            $param_account = $account;
            $param_password = md5($password); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "<script> alert(\"Thêm thành công\");</script>";
                header("location: admin_dashboard.php");

            } else{
                echo "Có lỗi xảy ra.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);

?>