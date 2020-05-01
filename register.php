<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["user"])){
    header("location: index.php");
    exit;
}
// Include config file
require_once "config/config.php";
 
// Define variables and initialize with empty values
$user_email = $password = $confirm_password = "";
$user_email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate user_email
    if(empty(trim($_POST["user_email"]))){
        $user_email_err = "Xin hãy nhập email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE user_email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_email);

            // Set parameters
            $param_user_email = trim($_POST["user_email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $user_email_err = "Email đã tồn ại.";
                } else{
                    $user_email = trim($_POST["user_email"]);
                }
            } else{
                echo "Có lỗi xảy ra xin thử lại sau.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Xin hãy nhập mật khẩu.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Mật khẩu ít nhất 6 ký tự.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Xác nhận mật khẩu.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Mật khẩu không trùng khớp.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($user_email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (user_email, user_password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_user_email, $param_password);
            
            // Set parameters
            $param_user_email = $user_email;
            $param_password = md5($password); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");

            } else{
                echo "Có lỗi xảy ra.";
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
    <title> Hệ thống đào tạo trực tuyến môn Trí tuệ nhân tạo
    </title>
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
            <h2>Đăng ký tài khoản</h2>
            <p>Xin mời nhập thông tin.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($user_email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="text" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
                    <span class="help-block"><?php echo $user_email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="confirm_password" class="form-control"
                        value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Xác nhận">
                    <input type="reset" class="btn btn-default" value="Đặt lại">
                </div>
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>