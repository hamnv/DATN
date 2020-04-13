<?php include'header.php'; 
if(isset($_SESSION['user']))
    header("Location: index.php");
?>
<?php

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
        $user_email_err = "Xin mời nhập email.";
        echo "<script> alert('');</script>";
    } else{
        $user_email = trim($_POST["user_email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Xin hãy nhập vào mật khẩu.";
        echo "<script> alert('Mật khẩu không được để trống');</script>";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($user_email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, user_email, user_password FROM user WHERE user_email = ?";
        
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
                    mysqli_stmt_bind_result($stmt, $id, $user_email, $hashed_password);
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
                            echo "<script>
                            alert('Mật khẩu của bạn không chính xác');
                       </script>";
                        }
                    }
                } else{
                    // Display an error message if user_email doesn't exist
                    $user_email_err = "Email không tồn tại!!";
                    echo "<script> alert('Email không tồn tại trên hệ thống!');</script>";
                }
            } else{
                echo "Có lỗi xảy ra, xin vui lòng thử lại sau";
                echo "<script>
                            alert('Có lỗi xảy ra, xin vui lòng thử lại sau');
                       </script>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<head>
    <title> Hệ thống đào tạo trực tuyến môn Trí tuệ nhân tạo
    </title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style type="text/css">
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 350px;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="headerbar">
        <img src="assets/Logo.png" alt="Logo" />
        <div class="login">
            <a href=""> <b> Đăng ký</b></a> |
            <a href="#" id="myBtn" > <b> Đăng Nhập </b></a>
        </div>
    </div>
    <!-- Trigger/Open The Modal -->

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="login-form">
            <span class="close"> &times; </span>
            <div class="wrapper">
                <h2>Đăng nhập</h2>
                <p>Xin hãy điền vào thông tin.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($user_email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
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
                    <p>Quên mật khẩu? <a href="forgot.php">Reset</a>.</p>
                </form>
            </div>
            <!-- End modal partial -->
        </div>

    </div>


    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
        modal.modal({'backdrop': 'static'});
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    /*window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }*/
    </script>
    <script src='assets/js/TweenMax.min.js'></script>
    <script src="assets/js/loginscript.js"></script>
</body>