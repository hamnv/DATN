<a href="#"> <?php include 'header.php';
include 'config/config.php';
if (!isset($_SESSION['user'])) {
    header("Location: welcome.php");
}

?>

    <head>
        <title> Bài giảng</title>
    </head>

    <body>
        <div class="sidebar">
            <header>
                <?php
if (isset($_SESSION['user'])) {
    echo $_SESSION['user'];
} else {
    echo "Hello !";
}
?>
            </header>


            <ul>
                <li> <a href="index.php"><i class="fas fa-home"></i>Trang Chính</a></li>
                <li class="liactive"> <a href="lesson.php"><i class="fas fa-stream"></i>Bài Giảng</a></li>
                <li> <a href="research.php"><i class="fas fa-cube"></i>Thí Nghiệm</a></li>
                <li> <a href="excercise.php"><i class="fas fa-table"></i>Bài Tập</a></li>
                <li> <a href="result.php"><i class="fas fa-tasks"></i>Kết quả </a></li>
                <li> <a href="resources.php"><i class="fas fa-download"></i>Tài Nguyên</a></li>
                <li> <a href="bugs.php"><i class="fas fa-bug"></i>Báo lỗi</a></li>
                <li> <a href="logout.php"><i class="fas fa-sign-out-alt"> </i> Đăng Xuất</a></li>
            </ul>
        </div>
        <!---edn side bar-->
        <div class="main">
            <!--- TIM MIEM CO BAN -->
            <h2>Danh mục buổi học</h2>
            <div class="row col-md-10">
                <div class="table table-striped table-bordered">
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Chủ đề</th>
                            <th>Tên bài học</th>
                            <th>Link</th>
                        </tr>
                        <?php
$sql2 = "SELECT lesson.id as id, lesson.title as title, category.name as name
FROM lesson
INNER JOIN category ON lesson.category_id=category.id;";
$result2 = mysqli_query($link, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['title']."</td>
        <td><a href=\"go-lesson.php?id=" .$row['id']. "\">".$row['title']."</a></td>
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
        </div>
        <!---END  TIM MIEM CO BAN -->
    </body>

    </html>