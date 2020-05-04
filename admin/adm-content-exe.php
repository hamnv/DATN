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
        } else if (isset($_POST['lname']) && isset($_POST['cate'])) {
            $result = mysqli_query($link, "SELECT id from lesson ORDER BY id DESC");
            $row = mysqli_fetch_assoc($result);
            $foldername = $row['id'] + 1;

            $lname = $_POST['lname'];
            $lcate = $_POST['cate'];
            $sql = "INSERT INTO lesson (category_id,title) VALUES (?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_cate, $param_title);

                // Set parameters
                $param_cate = $_POST['cate'];
                $param_title = $_POST['lname'];
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    header("location: admin-content.php");
                } else {
                    echo "Có lỗi xảy ra.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
            if (!is_dir($foldername)) {

                mkdir("../lesson/" . $foldername);
                if ($_FILES["zip_file"]["name"]) {
                    $filename = $_FILES["zip_file"]["name"];
                    $source = $_FILES["zip_file"]["tmp_name"];
                    $type = $_FILES["zip_file"]["type"];

                    $name = explode(".", $filename);
                    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
                    foreach ($accepted_types as $mime_type) {
                        if ($mime_type == $type) {
                            $okay = true;
                            break;
                        }
                    }

                    $continue = strtolower($name[1]) == 'zip' ? true : false;
                    if (!$continue) {
                        $message = "The file you are trying to upload is not a .zip file. Please try again.";
                    }

                    $target_path = "../lesson/" . $foldername . "/" . $filename; // change this to the correct site path
                    if (move_uploaded_file($source, $target_path)) {
                        $zip = new ZipArchive();
                        $x = $zip->open($target_path);
                        if ($x === true) {
                            $zip->extractTo("../lesson/" . $foldername . "/"); // change this to the correct site path
                            $zip->close();

                            unlink($target_path);
                        }
                        $message = "Your .zip file was uploaded and unpacked.";
                    } else {
                        $message = "There was a problem with the upload. Please try again.";
                    }
                }
            }
            // echo "Folder is successfully uploaded";

        } else {
            header("Location: admin-content.php");
        }

        // ket thuc ket noi
        mysqli_close($link);
    }

} else {
    header("Location: ../stop.php");
}
