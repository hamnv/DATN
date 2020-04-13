 <?php
 
require_once 'config/config.php';
session_start();
if($_POST)
{
    $user_email 	= $_POST['email'];
    $user_password 	= $_POST['password'];

    try
    {
        $stmt = $db_con->prepare("SELECT user_email FROM user WHERE user_email=$user_email and user_password=$user_password");
        $count = $stmt->rowCount();
		
        if($count==0){
			$_SESSION['user'] = $user_email;
			echo "<script> alert(\"Đăng nhập thành công\"); </script>";
			header("Location: index.php");
			exit;

        }
        else{

			echo "<script> alert(\"Đăng nhập thất bại\"); </script>";
			header("Location: index.php");
			exit;
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
} 
?> 
