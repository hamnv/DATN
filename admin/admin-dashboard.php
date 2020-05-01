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
            <li class="liactive"> <a href="#"><i class="fas fa-home"></i>Trang Chính</a></li>
            <li> <a href="admin-content.php"><i class="fas fa-stream"></i>Quản Lý Nội Dung</a></li>
            <li> <a href="admin-user.php"><i class="fas fa-user"></i>Quản Lý User</a></li>
            <li> <a href="research.php"><i class="fas fa-comment"></i>Quản Lý Diễn Đàn</a></li>
            <li> <a href="admin-question.php"><i class="fas fa-question-circle"></i>Quản Lý Câu Hỏi</a></li>
            <?php
if (isset($_SESSION['admin']))
    echo "<li> <a href=\"logout.php\"> <i class=\"fas fa-sign-out-alt\"></i><b> Đăng Xuất </b></a></li>";
?>
        </ul>
    </div>

    <!-- end side bar--->
    <div class="main-dashboard">
        <!--- start add admin -->
        <div class="add-adm">
            <p> Thêm Adminstrator</p>
            <p id="notify"></p>
            <form action="add-adm.php" method="POST" name="add-adm" onsubmit="return validAddAdmin();">
                <label for="account">Tài khoản</label>
                <input type="text" name="account" placeholder="Nhập tài khoản" id="acc" class="input-add-adm"
                    value="" />
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu" id="psw" class="input-add-adm">
                <input class="add-adm-btn" type="submit" value="Thêm">
            </form>
        </div>
        <!--- end add adm--->
        <!--- start Admin log -->
        <div class="admin-log">
            <span> Log </span>
            <div class="column">
                <h4>Người dùng mới</h4>
                <p>Some text..</p>
            </div>
            <div class="column">
                <h4>Bài học mới thêm.</h4>
                <p>Some text..</p>
            </div>
            <div class="column">
                <h4>Câu hỏi mới thêm.</h4>
                <p>Some text..</p>
            </div>
        </div>
        <!--- end admin log -->
        <!--- START ADMIN STAT -->
        <div class="adm-stat">
            <div class="stat-item col-md-3">
                <div class="stat-header" style="background-color: #4CAF50;">
                    <span class="count">2</span>
                    <i class="fa fa-user-tie"></i>
                </div>
                <div class="stat-caption">
                    <p> QUẢN TRỊ VIÊN</p>
                </div>
            </div>
            <div class="stat-item col-md-3">
                <div class="stat-header" style="background-color: Tomato;">
                    <span class="count">266</span>
                    <i class="fa fa-user"></i>
                </div>
                <div class="stat-caption">
                    <p> NGƯỜI DÙNG</p>
                </div>
            </div>
            <div class="stat-item col-md-3">
                <div class="stat-header" style="background-color: DodgerBlue;">
                    <span class="count">552</span>
                    <i class="fa fa-question-circle"></i>
                </div>
                <div class="stat-caption">
                    <p> CÂU HỎI</p>
                </div>
            </div>
            <div class="stat-item col-md-3">
                <div class="stat-header" style="background-color: SlateBlue;">
                    <span class="count">82</span>
                    <i class="fa fa-book-open"></i>
                </div>
                <div class="stat-caption">
                    <p> BÀI GIẢNG</p>
                </div>
            </div>
            <div class="stat-item col-md-3">
                <div class="stat-header" style="background-color: #DC143C;">
                    <span class="count">82</span>
                    <i class="fa fa-comments"></i>
                </div>
                <div class="stat-caption">
                    <p> THẢO LUẬN</p>
                </div>
            </div>
            <div class="stat-item col-md-3">
                <div class="stat-header" style="background-color: #DA70D6;">
                    <span class="count">82</span>
                    <i class="fa fa-cube"></i>
                </div>
                <div class="stat-caption">
                    <p> THÍ NGHIỆM</p>
                </div>
            </div>
        </div> <!--- end admin stat -->
    </div>
    <!--- END DASHBOARD -->
    <script src="../assets/js/validForm.js"></script>
</body>

</html>