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
            <li class="liactive"> <a href="admin-content.php"><i class="fas fa-stream"></i>Quản Lý Nội Dung</a></li>
            <li> <a href="admin-user.php"><i class="fas fa-user"></i>Quản Lý User</a></li>
            <li> <a href="research.php"><i class="fas fa-comment"></i>Quản Lý Diễn Đàn</a></li>
            <li> <a href="admin-question.php"><i class="fas fa-question-circle"></i>Quản Lý Câu Hỏi</a></li>
            <?php
if (isset($_SESSION['admin'])) {
    echo "<li> <a href=\"logout.php\"> <i class=\"fas fa-sign-out-alt\"></i> Đăng Xuất </a></li>";
}

?>
        </ul>
    </div> <!-- end side bar--->

    <div class="main-dashboard">
        <div class="nav-btn">
            <!-- Modal them bai hoc-->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId1">
                Thêm bài học
            </button>

            <!-- themn bai hoc -->
            <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm bài học</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="adm-content-exe.php" method="POST" onsubmit="return validAddLesson();" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Tên bài học</label>
                                    <input type="text" class="form-control" name="lname" id="lname" 
                                        placeholder="">
                                    <small id="lnameHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input type="file" class="form-control" name="zip_file" accept=".zip"/>
                                    <small id="llinkHelp" class="form-text text-muted"></small>
                                </div>
                                <?php
$sql = "SELECT * FROM category";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo                "<div class=\"form-check\">
                               <label class=\"form-check-label\">
                               <input type=\"radio\" class=\"form-check-input\" name=\"cate\" value=\"" .$row['id']. "\"checked>
                              ".$row['name']."
                             </label>
                           </div> "; ?>
                                <?php
    }
} else {
    echo "";
}
?>
                        </div>
                        <div class="modal-footer">
                            <input type="reset" class="btn btn-secondary" value="Reset">
                            <input type="submit" class="btn btn-primary" value="Thêm">
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal them bai hoc -->
            <!-- Modal  them chu de-->
            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modelId2">
                Thêm chủ đề
            </button>


            <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm chủ đề</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="adm-content-exe.php" method="POST" onsubmit="return validAddCategory();">
                                    <label for="">Tên chủ đề</label>
                                    <input type="text" class="form-control" name="category" id="category"
                                        placeholder="">
                                    <small id="helpCate" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="reset" class="btn btn-secondary" value="Xoá">
                            <input type="submit" class="btn btn-primary" value="Thêm">
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
                    <th>Tên bài học</th>
                    <th>Chủ đề</th>
                    <th>Ngày tạo</th>
                </tr>
                <?php
$sql2 = "SELECT * FROM lesson INNER JOIN category on category.id=lesson.category_id;";
$result2 = mysqli_query($link, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['title']."</td>
        <td>".$row['name']."</td>
        <td>".$row['created_at']."</td>
    </tr> "; ?>
                <?php
    }
} else {
    echo "";
}

mysqli_close($link);
?>

            </table>
        </div>
    </div>

    <!--- END DASHBOARD -->
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/validForm.js"></script>
</body>

</html>