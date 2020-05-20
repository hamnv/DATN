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
            <li> <a href="#"><i class="fas fa-home"></i>Trang Chính</a></li>
            <li> <a href="admin-content.php"><i class="fas fa-stream"></i>Quản Lý Nội Dung</a></li>
            <li> <a href="admin-user.php"><i class="fas fa-user"></i>Quản Lý User</a></li>
            <li> <a href="research.php"><i class="fas fa-comment"></i>Quản Lý Diễn Đàn</a></li>
            <li class="liactive"> <a href="admin-question.php"><i class="fas fa-question-circle"></i>Quản Lý Câu Hỏi</a>
            </li>
            <?php
if (isset($_SESSION['admin'])) {
    echo "<li> <a href=\"logout.php\"> <i class=\"fas fa-sign-out-alt\"></i><b> Đăng Xuất </b></a></li>";
}
?>
        </ul>
    </div>

    <!-- end side bar--->
    <div class="main-dashboard">
        <div class="nav-btn">
            <!-- Modal them bai hoc-->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId1">
                Thêm câu hỏi
            </button>

            <!-- themn bai hoc -->
            <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm câu hỏi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <!--- FORM --->
                            <form action="add-question-exe.php" method="POST">
                                <div class="form-group">
                                    <label for="">Câu hỏi</label>
                                    <input type="text" class="form-control" name="question" placeholder="">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct" value="1">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            name="ans1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct" value="2">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            name="ans2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct" value="3">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            name="ans3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct" value="4">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            name="ans4">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Bài học</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="lesson">
                                <?php
$sql = "SELECT * FROM lesson";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo                " <option type=\"radio\" class=\"form-check-input\" name=\"lesson\" value=\"" .$row['id']. "\">
                              ".$row['title']. "</option>"; ?>
                                <?php
    }
} else {
    echo "";
}
?>                                    </select>
</div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Thêm">
                            <button data-dismiss="modal" class="btn btn-secondary"> Đóng </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal them bai hoc -->
        </div> <!-- BTN MODAL NAV -->
        <!--- START table -->
        <div class="tbl col-md-10">
            <table>
                <tr>
                    <th>STT</th>
                    <th>Câu hỏi</th>
                    <th>Đáp án 1</th>
                    <th>Đáp án 2</th>
                    <th>Đáp án 3</th>
                    <th>Đáp án 4</th>
                    <th>Đáp án đúng</th>
                    <th>Thuộc bài học</th>
                </tr>
                <?php
$sql2 = "SELECT * FROM question INNER JOIN lesson ON question.lesson_id=lesson.id  ";
$result2 = mysqli_query($link, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['question']."</td>
        <td>".$row['ans1']."</td>
        <td>".$row['ans2']."</td>
        <td>".$row['ans3']."</td>
        <td>".$row['ans4']."</td>
        <td>".$row['correct_ans']."</td>
        <td>".$row['title']."</td>
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
    <script src="../assets/js/validForm.js"></script>
</body>

</html>