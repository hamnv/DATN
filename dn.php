<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["user"]) && $_SESSION["user"] === true){
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
        $user_email_err = "Please enter user_email.";
    } else{
        $user_email = trim($_POST["user_email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($user_email_err)) ? 'has-error' : ''; ?>">
                <label>user_email</label>
                <input type="text" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
                <span class="help-block"><?php echo $user_email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>