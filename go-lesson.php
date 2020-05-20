<?php
include 'header.php';
include 'config/config.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $lesson_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // check first test
    $sql = "SELECT id FROM first_test WHERE user_id=$user_id AND lesson_id=$lesson_id";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        $sql2 = "SELECT id FROM lesson_progess WHERE user_id=$user_id AND lesson_id=$lesson_id";
        $result2 = mysqli_query($link, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            echo "Chuan bi hoc";
            header("Location: lesson/".$lesson_id."/index.html");
            $link->close();
        } else {
            $sql3 = "INSERT INTO lesson_progess (user_id, lesson_id) VALUES (?, ?)";
            if ($stmt = mysqli_prepare($link, $sql3)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_uid, $param_lid);
                    
                // Set parameters
                $param_uid = $user_id;
                $param_lid = $lesson_id;
                    
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "Them thanh cong";
                    header("Location: lesson/".$lesson_id."/index.html");
                } else {
                    echo "Có lỗi xảy ra.";
                }
        
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        include_once('test.php');
    }
}
