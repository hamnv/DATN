<a href="#"> <?php include 'header.php';
if (!isset($_SESSION['user'])) {
    header("Location: welcome.php");
}

?>

<head>
    <title> Bài giảng</title>
</head>

<body onload="startTime()">
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
            <li> <a href="#"></a></li>
        </ul>
        <?php
if (isset($_SESSION['user'])) {
    echo "<div class=\"logout\"> <a href=\"logout.php\"> <b> Đăng Xuất </b></a></div>";
} else {
    echo "<div class=\"logout\"> <a href=\"#\" id=\"myBtn\"> <b> Đăng Nhập </b></a></div>";
}

?>

    </div>

<div class="jumbotron">
dsf
</div>

<div class="container">
    <!--- TIM MIEM CO BAN --> 
  <h2>Danh mục buổi học</h2>
  <!--pannel group --> 
  <div class="panel-group"> 
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Tìm kiếm cơ bản</a>
        </h4>
      </div>

      <div id="collapse1" class="panel-collapse">
        <ul class="list-group">
          <li class="list-group-item"><a href="#"> Tìm kiếm theo chiều rộng (BFS)</a></li>
          <li class="list-group-item"><a href="#"> Tìm<a href="#">  kiếm theo chiều sâu (DFS)</a></li>
          <li class="list-group-item"><a href="#"> Tìm<a href="#">  kiếm sâu dần (IDS)</a></li>
          <li class="list-group-item"><a href="#"> Tìm<a href="#">  kiếm với chi phí cực tiểu (UCS)</a></li>
        </ul>
    </div>  
  </div>
  </div> <!---end <a href="#"> panel group -->
  <!--pannel group --> 
  <div class="panel-group"> 
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse2">Tìm kiếm với tri thức bổ sung</a>
        </h4>
      </div>

      <div id="collapse2" class="panel-collapse">
        <ul class="list-group">
          <li class="list-group-item"><a href="#"> Tìm kiếm A *</a></li>
          <li class="list-group-item"><a href="#"> Tìm kiếm có đối thủ</a></li>
        </ul>
    </div>  
  </div>
  </div> <!---end panel group -->
  <!--pannel group --> 
  <div class="panel-group"> 
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse3">Tìm kiếm thoả mãn ràng buộc</a>
        </h4>
      </div>

      <div id="collapse3" class="panel-collapse">
        <ul class="list-group">
          <li class="list-group-item"><a href="#"> Tìm kiếm quay lui</a></li>
          <li class="list-group-item"><a href="#"> Kiểm tra tiến</a></li>
          <li class="list-group-item"><a href="#"> Tìm kiếm cục bộ</a></li>
        </ul>
    </div>  
  </div>
  </div>
   <!---end panel group -->
</div>
   <!---END  TIM MIEM CO BAN --> 
</body>

</html>