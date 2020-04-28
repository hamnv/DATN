<?php
include 'admin-header.php';
include '../config/config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}
if (isset($_GET['uid'])) {
    $user_id = $_GET['uid'];
    $sql = "DELETE FROM user WHERE id=$user_id";

    if ($link->query($sql) === true) {
        header('Location: admin-user.php');
    } else {
        echo "Lỗi " . $link->error;
    }

    $link->close();
}
