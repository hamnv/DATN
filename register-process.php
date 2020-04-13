<?php
require_once 'config/config.php';

if($_POST)
{
    $user_email 	= $_POST['user_email'];
    $user_password 	= $_POST['password'];
	
	//password_hash see : http://www.php.net/manual/en/function.password-hash.php
	$password 	= password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 11));
	
    try
    {
        $stmt = $db_con->prepare("SELECT * FROM user WHERE user_email=:email");
        $stmt->execute(array(":email"=>$user_email));
        $count = $stmt->rowCount();
		
        if($count==0){
            $stmt = $db_con->prepare("INSERT INTO user(user_email,user_password) VALUES(:email, :pass)");
            $stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":pass",$password);

            if($stmt->execute())
            {
                echo "registered";
            }
            else
            {
                echo "Query could not execute !";
            }

        }
        else{

            echo "1"; //  not available
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>