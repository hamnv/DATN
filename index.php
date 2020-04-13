<?php include'header.php';
if(!isset($_SESSION['user']))
header("Location: index2.php");
?>

<head>
    <title> TRANG CHỦ</title>
</head>
<body>
<div class="sidebar">
    <header>
	 <?php 
	 if(isset($_SESSION['user']))
			echo "<h1>".$_SESSION['user']."</h1>"; 
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
    dfdsfgfgfgdfdsfsdfddsfjdsjfhdsjfhjd hjkh jdskhfjkdshfjdshfjkdf <br>fhdsjfhjd hjkh jdskhfjkdshfjdshfjkdf
    <br>fhdsjfhjd hjkh jdskhfjkdshfjdshfjkdf <br>fhdsjfhjd hjkh jdskhfjkdshfjdshfjkdf <br>fhdsjfhjd hjkh
    jdskhfjkdshfjdshfjkdf <br>fhdsjfhjd hjkh jdskhfjkdshfjdshfjkdf <br>fhdsjfhjd hjkh jdskhfjkdshfjdshfjkdf <br>

</div>



</body>

</html>