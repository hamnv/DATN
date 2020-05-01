<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION['user'])){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config/config.php";
 
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
        $sql = "SELECT id, user_email, user_password FROM user WHERE user_email = ?";
        
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
                    mysqli_stmt_bind_result($stmt, $user_id, $user_email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                       
                        
                        if($hashed_password==md5($password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["user"] = $user_email;  
                            $_SESSION["user_id"] = $user_id;                           
                            
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style type="text/css">
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        position: absolute;
        width: 350px;
        padding: 20px;
        margin-top: 12%;
        padding-top: 15px;
        left: 40%;
        border: 1px solid #4d79ff;
        background-color: white;
        box-shadow: 10px 10px 5px #aaaaaa;
    }
    </style>
</head>
<body> 
<div class="headerbar">
        <a href="index.php"><img src="assets/Logo.png" alt="Logo" /> </a>
    </div>
<div class="register"> 
    <div class="wrapper">
        <h2>Đăng nhập</h2>
        <p>Xin hãy điền thông tin đăng nhập.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($user_email_err)) ? 'has-error' : ''; ?>">
                <label>Email hoặc MSSV</label>
                <input type="text" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
                <span class="help-block"><?php echo $user_email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Đăng nhập">
            </div>
            <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>.</p>
        </form>
    </div>    
    </div>
</body>
</html>