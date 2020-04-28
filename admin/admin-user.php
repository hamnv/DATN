<?php include 'admin-header.php';
require_once "../config/config.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
}

?>

<head>
    <title> Bảng Điều Khiển ADMIN</title>
</head>

<body onload="startTime()">
    <div class="sidebar">
        <header>
            <?php
if (isset($_SESSION['admin'])) {
    echo $_SESSION['admin'];
} else {
    echo "Adminstrator";
}
?>
        </header>


        <ul>
            <li> <a href="admin-dashboard.php"><i class="fas fa-home"></i>Trang Chính</a></li>
            <li> <a href="admin-content.php"><i class="fas fa-stream"></i>Quản Lý Nội Dung</a></li>
            <li class="liactive"> <a href="admin-user.php"><i class="fas fa-user"></i>Quản Lý User</a></li>
            <li> <a href="research.php"><i class="fas fa-comment"></i>Quản Lý Diễn Đàn</a></li>
            <li> <a href="research.php"><i class="fas fa-question-circle"></i>Quản Lý Câu Hỏi</a></li>
            <?php
if (isset($_SESSION['admin'])) {
    echo "<li> <a href=\"logout.php\"> <i class=\"fas fa-sign-out-alt\"></i><b> Đăng Xuất </b></a></li>";
}

?>
        </ul>
    </div> <!-- end side bar--->

    <div class="main-dashboard">
        <div class="nav-btn">
            <!-- Modal  them chu de-->
            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modelId2">
                Import User
            </button>


            <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Import User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="adm-import-user.php" method="POST">
                                    <label for="">Chọn file excel</label>
                                    <input type="file" class="form-control" name="file" accept=".xlsx,.csv,.xls">
                                    <small id="helpCate" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Thêm">
                            <button data-dismiss="modal" class="btn btn-secondary"> Đóng </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- BTN MODAL NAV -->
        <!--- START table -->
        <div class="tbl col-md-10">
            <table>
                <tr>
                    <th>STT</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
$sql2 = "SELECT * FROM user";
$result2 = mysqli_query($link, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['user_email']."</td>
        <td> 
        <button onclick=\"deleteUser(".$row['id'].")\" class=\"btn btn-danger\" > XOÁ </button></td>
    </tr> "; 
                           ?>
                <?php     }
} else {
    echo "";
}

mysqli_close($link);
?>

            </table>
        </div>
    </div>

    <!--- END DASHBOARD -->
    <script>
    function deleteUser(id) {
        var r = confirm("Xác nhận xoá");
        if (r == true) {
            window.location.href = "admin-delete-user.php?uid=" +id;
        }
    }
    </script>
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/validForm.js"></script>
</body>

</html>
