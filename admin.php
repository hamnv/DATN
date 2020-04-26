<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION['admin'])){
    header("location: admin/admin_dashboard.php");
    exit;
}
else {
    header("location: admin/admin_login.php");
    exit;
}
 
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$user_email = $password = "";
$user_email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if user_email is empty
    if(empty(trim($_POST["user_email"]))){
        $user_email_err = "Xin hãy nhập email.";
    } else{
        $user_email = trim($_POST["user_email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Xin hãy nhập mật khẩu.";
    } else{
        $password = $_POST["password"];
    }
    
    // Validate credentials
    if(empty($user_email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_email, user_password FROM user WHERE user_email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_email);
            
            // Set parameters
            $param_user_email = $user_email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user_email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                       
                        
                        if($hashed_password==md5($password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["user"] = $user_email;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Mật khẩu của bạn không chính xác";
                        }
                    }
                } else{
                    // Display an error message if user_email doesn't exist
                    $user_email_err = "Email không tồn tại!!";
                }
            } else{
                echo "Có lỗi xảy ra, xin vui lòng thử lại sau";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Trang Đăng Nhập Quản trị Viênz`</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="../assets/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="../assets/img/bg.svg">
        </div>
        <div class="login-content">
            <form action="admin.html">
                <img src="../assets/img/avatar.svg">
                <h2 class="title">ADMIN</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Tài khoản </h5>
                        <input type="text" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Mật khẩu</h5>
                        <input type="password" class="input">
                    </div>
                </div>
                <input type="submit" class="btn" value="Đăng nhập">
            </form>
        </div>
    </div>
    <script>
    const inputs = document.querySelectorAll(".input");


    function addcl() {
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    }

    function remcl() {
        let parent = this.parentNode.parentNode;
        if (this.value == "") {
            parent.classList.remove("focus");
        }
    }


    inputs.forEach(input => {
        input.addEventListener("focus", addcl);
        input.addEventListener("blur", remcl);
    });
    </script>
</body>

</html>

</body>

</html>