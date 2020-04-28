<?php
session_start();
require_once "../config/config.php";

if (isset($_SESSION['admin'])) {
    //Chu de
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['category'])) {
            $cate = $_POST['category'];
            $sql = "INSERT INTO category (name) VALUES (?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_cate);

                // Set parameters
                $param_cate = $cate;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    header("location: admin-content.php");
                } else {
                    echo "Có lỗi xảy ra.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        else if(isset($_POST['lname'])&&isset($_POST['cate'])&&isset($_POST['link'])) {
            $lname = $_POST['lname'];
            $lcate = $_POST['cate'];
            $llink = $_POST['link'];
            $sql = "INSERT INTO lesson (category_id,title, link) VALUES (?,?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_cate, $param_title, $param_link);

                // Set parameters
                 $param_cate = $_POST['cate'];
                 $param_title = $_POST['lname'] ;
                 $param_link = $_POST['link'];
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    header("location: admin-content.php");
                } else {
                    echo "Có lỗi xảy ra.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        else header("Location: admin-content.php");
        // ket thuc ket noi
        mysqli_close($link);
    }

} else {
    header("Location: ../stop.php");
}
