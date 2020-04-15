<?php include'header.php';
if(!isset($_SESSION['user']))
header("Location: welcome.php");
?>

<head>
    <title> TRANG CHỦ</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css"> 
</head>
<body>
<div class="sidebar">
    <header>
	 <?php 
	 if(isset($_SESSION['user']))
			echo $_SESSION['user']; 
	 else
			echo "Hello !"; ?> 
	</header>
    

    <ul>
        <li class="liactive"> <a href="#"><i class="fas fa-home"></i>Trang Chính</a></li>
        <li> <a href="#"><i class="fas fa-stream"></i>Bài Giảng</a></li>
        <li> <a href="#"><i class="fas fa-cube"></i>Thí Nghiệm</a></li>
        <li> <a href="#"><i class="fas fa-table"></i>Bài Tập</a></li>
        <li> <a href="#"><i class="fas fa-tasks"></i>Tiến Trình Học</a></li>
		<li> <a href="#"><i class="fas fa-download"></i>Tài Nguyên</a></li>
        <li> <a href="#"><i class="fas fa-bug"></i>Báo lỗi</a></li>
        <li> <a href="#"></a></li>
    </ul>
    <?php 
    if(isset($_SESSION['user'])) {
    echo "<div class=\"logout\"> <a href=\"logout.php\"> <b> Đăng Xuất </b></a></div>";
    }
    else 
    echo "<div class=\"logout\"> <a href=\"#\" id=\"myBtn\"> <b> Đăng Nhập </b></a></div>";
    ?>

</div>



<div class="main">
    <div class="alert alert-info">
    <strong>Thông tin: </strong> Bạn mới tham gia hệ thống, hãy làm bài test <a href="test.php" class="alert-link">tại đây</a> để chúng tôi gợi ý các bài học cho bạn.
  </div>
    <input type="hidden" id="progessvalue" value="<?php $a=62; print $a; ?>">
  <div class="wrap_progess"> <div id="progessbar"> <p id="progess_info"> </p></div> </div>

</div>


<script src="assets/js/progess.js"></script>
</body>

</html>