<?php
session_start();
require_once "../config/config.php";

if (isset($_SESSION['admin'])) {
    //Chu de
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if(isset($_POST['question'])&&isset($_POST['lesson'])&&isset($_POST['ans4'])) {
            $title = $_POST['question'];
            $lesson = $_POST['lesson'];
            $ans1 = $_POST['ans1'];
            $ans2 = $_POST['ans2'];
            $ans3 = $_POST['ans3'];
            $ans4 = $_POST['ans4'];
            $correct = $_POST['correct'];
            $sql = "INSERT INTO question (question ,ans1, ans2, ans3, ans4, correct_ans, lesson_id) VALUES (?,?,?,?,?,?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssss", $param_title, $param_ans1, $param_ans2,$param_ans3, $param_ans4, $param_correct, $param_lesson);

                // Set parameters
                $param_title = $_POST['question'];
                $param_lesson = $_POST['lesson'];
                $param_ans1 = $_POST['ans1'];
                $param_ans2 = $_POST['ans2'];
                $param_ans3 = $_POST['ans3'];
                $param_ans4 = $_POST['ans4'];
                $param_correct = $_POST['correct'];
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                   header("location: admin-question.php");
                   echo "thanh cong";
                } else {
                    echo "Có lỗi xảy ra.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        else header("Location: admin-dashboard.php"); 
        // ket thuc ket noi
        mysqli_close($link);
    }

} else {
    header("Location: ../stop.php");
}