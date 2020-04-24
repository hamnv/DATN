<style>

</style>

<?php
error_reporting(0);

// #########################################
// In this page you will find the code required to create multiple choice exams
// Copy this code and save it to a file name "whatever.php"
// The file name must finish with ".php"
// Save the file to a PHP unable server.
// Please consider adding a link to this service:
//      http://www.phptutorial.info/scripts/multiple_choice/
//
// A website was created based in this script at which allows
//   to create and maintain the test online at:
//      http://www.testak.org
//
// #########################################
//      CONFIGURATION
$title = "Bài test đầu vào";
$address = "index.php";
$randomizequestions = "yes"; // set up as "no" to show questions without randomization
//    END CONFIGURATION
// #########################################

$a = array(
    1 => array(
        0 => "Cho bài toán: Thiết kế hệ thống chẩn đoán y tế, thì tác tử ở đây là?",
        1 => "Người sử dụng.",
        2 => "Phần mềm.",
        3 => "Người sử dụng và phần mềm.",
        4 => "Cả 3 đáp án trên đều sa.i",
        6 => 3,
    ),
    2 => array(
        0 => "Trong những bài toán tác tử sau, bài toán nào môi trường không xác định?",
        1 => "Đánh cờ tính giờ.",
        2 => "Robot lái xe taxi.",
        3 => "Chẩn đoán y tế.",
        4 => "Tìm đường mê cung.",
        6 => 2,
    ),
    3 => array(
        0 => "Những tác tử nào dưới đây có điểm chung với tác tử phản xạ cơ bản ?",
        1 => "Tác tử phản xạ dựa trên mô hìn.h",
        2 => "Tác tử phản xạ dựa trên mục tiêu.",
        3 => "Tác tử phản xạ dựa trên lợi ích.",
        4 => "Tác tử phản xạ có khả năng học.",
        6 => 1,
    ),
    4 => array(
        0 => "Giải thuật kết hợp giữa BFS và DFS là?",
        1 => "BFS plus DFS",
        2 => "UCS",
        3 => "DLS",
        4 => "IDS",
        6 => 4,
    ),
    5 => array(
        0 => "Phat biểu nào dưới đây là sai?",
        1 => "Giải thuật tìm kiếm theo chiều rộng không tối ưu.",
        2 => "Giải thuật tìm kiếm theo chiều sâu có tính tối ưu. ",
        3 => "Giải thuật tìm kiếm theo chiều rộng không có tính hoàn chỉnh.",
        4 => "Giải thuật tìm kiếm theo chiều sâu không có tính hoàn chỉnh.",
        6 => 4,
    ),
    6 => array(
        0 => "Giải thuật tìm kiếm nào dưới đây có thể bị \"chết tắc\" trong vòng lặp vô hạn?",
        1 => "Giải thuật Greedy best-first.",
        2 => "Tìm kiếm A*.",
        3 => "Tìm kiếm leo đồi.",
        4 => "Giải thuật di truyền.",
        6 => 1,
    ),
    7 => array(
        0 => "Trong cây tìm kiếm có đối thủ Minimax, Giải thuật alpha-beta prunning có tác dụng?",
        1 => "Tỉa nhánh.",
        2 => "Tỉa rễ.",
        3 => "Tỉa lá.",
        4 => "Tỉa ngọn.",
        6 => 1,
    ),
    8 => array(
        0 => "Trong giải thuật Kiểm tra tiến, nếu không có lựa chọn nào phù hợp cho các ràng buộc ở bước tiếp theo, thì ta thực hiện...",
        1 => "Vét cạn",
        2 => "Quay lui",
        3 => "Lan truyền ràng buộc",
        4 => "Kết luận không tìm được lời giải",
        6 => 2,
    ),
    9 => array(
        0 => "Hàm ước lượng h(n) tốt nhất cho bài toán N-queen là?",
        1 => "h(n): tổng số các cặp hậu ăn nhau.",
        2 => "h(n): tổng số các cặp hậu không ăn nhau.",
        3 => "h(n): hiệu các cặp hậu ăn nhau. ",
        4 => "h(n): hiệu các cặp hậu không ăn nhau.",
        6 => 4,
    ),
    10 => array(
        0 => "Để chứng minh một biểu thức logic ta dùng...",
        1 => "Bảng chân lý.",
        2 => "Các luật dẫn.",
        3 => "Dạng chuẩn CNF.",
        4 => "Cả 4 đáp án đều đúng.",
        6 => 1,
    ),
    11 => array(
        0 => "Để chứng minh biểu thức bằng phương pháp suy diễn tiến ta phải....",
        1 => "sử dụng thêm các luật sản xuất.",
        2 => "chuyển đổi về dạng chuẩn Horn.",
        3 => "quay lui giải thuật suy diễn lùi.",
        4 => "biến đổi biểu thức sang logic vị từ.",
        6 => 2,
    ),
    12 => array(
        0 => "Cấu trúc của một hệ chuyên gia gồm:",
        1 => "bộ diễn dịch - tập luật - bộ nhớ.",
        2 => "tập luật - giao diện - bộ diễn dịch.",
        3 => "bộ nhớ - bộ diễn dịch - giao diện.",
        4 => "giao diện - tập luật - bộ nhớ.",
        6 => 1,
    ),
    13 => array(
        0 => "Bài toán nào dưới đây là bài toán học máy?",
        1 => "Tìm đường mê cung thông minh.",
        2 => "Hệ chuyên gia tư vấn tuyển sinh.",
        3 => "Bộ lọc email spam.",
        4 => "Giải thế cờ trong cờ vua.",
        6 => 3,
    ),
    14 => array(
        0 => "Phát biểu nào dưới đây là sai?",
        1 => "Bài toán dự báo giá nhà là học máy có giám sát.",
        2 => "Khi training dữ liệu cần phải có tập validatio.n",
        3 => "Overfitting trạng thái khi ta có được tập dữ liệu chính xác như mong muốn.",
        4 => "Bài toán gợi ý sở thích mua sắm là bài toán phân cụm.",
        6 => 3,
    ),
    15 => array(
        0 => "Phân lớp Naive Bayes dựa trên?",
        1 => "Hàm xác xuất và định lý Bayes.",
        2 => "Logic mờ và xác xuất có điều kiện.",
        3 => "Cây quyết định và định lý Bayes.",
        4 => "Mô hình xác xuất.",
        6 => 1,
    )
);

$max = 15;

$question = $_POST["question"];

if ($_POST["Randon"] == 0) {
    if ($randomizequestions == "yes") {$randval = mt_rand(1, $max);} else { $randval = 1;}
    $randval2 = $randval;
} else {
    $randval = $_POST["Randon"];
    $randval2 = $_POST["Randon"] + $question;
    if ($randval2 > $max) {
        $randval2 = $randval2 - $max;
    }
}

$ok = $_POST["ok"];

if ($question == 0) {
    $question = 0;
    $ok = 0;
    $percentaje = 0;
} else {
    $percentaje = Round(100 * $ok / $question);
}
?>

<HTML><HEAD><TITLE>Multiple Choice Questions:  <?php print $title;?></TITLE>

<SCRIPT LANGUAGE='JavaScript'>
<!--
function Goahead (number){
        if (document.percentaje.response.value==0){
                if (number==<?php print $a[$randval2][6];?>){
                        document.percentaje.response.value=1
                        document.percentaje.question.value++
                        document.percentaje.ok.value++
                }else{
                        document.percentaje.response.value=1
                        document.percentaje.question.value++
                }
        }
        if (number==<?php print $a[$randval2][6];?>){
                document.question.response.value="Chính xác";
                document.getElementById("question").style.color = "blue";
        }else{
                document.question.response.value="Không chính xác";
                document.getElementById("question").style.color = "red";
        }
}
// -->
</SCRIPT>
<link rel="stylesheet" href="assets/css/style.css">
</HEAD>
<BODY BGCOLOR=FFFFFF>

<CENTER>
<div class="wrap">
<H1><?php print "$title";?></H1>
<TABLE BORDER=0 CELLSPACING=5 WIDTH=500>

<?php if ($question < $max) {?>

<TR><TD ALIGN=RIGHT>
<FORM METHOD=POST NAME="percentaje" ACTION="<?php print $URL;?>">

<BR>Tỉ lệ trả lời đúng: <?php print $percentaje;?> %
<BR><input type=submit value="Tiếp theo >>">
<input type=hidden name=response value=0>
<input type=hidden name=question value=<?php print $question;?>>
<input type=hidden name=ok value=<?php print $ok;?>>
<input type=hidden name=Randon value=<?php print $randval;?>>
<br><?php print $question + 1;?> / <?php print $max;?>
</FORM>
<HR>
</TD></TR>

<TR><TD>
<FORM METHOD=POST NAME="question" ACTION="">
<?php print "<b>" . $a[$randval2][0] . "</b>";?>

<BR>     <INPUT TYPE=radio NAME="option" VALUE="1"  onClick=" Goahead (1);"><?php print $a[$randval2][1];?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="2"  onClick=" Goahead (2);"><?php print $a[$randval2][2];?>
<?php if ($a[$randval2][3] != "") {?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="3"  onClick=" Goahead (3);"><?php print $a[$randval2][3];}?>
<?php if ($a[$randval2][4] != "") {?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="4"  onClick=" Goahead (4);"><?php print $a[$randval2][4];}?>
<BR>     <input id="question" type=text name=response size=8 disabled>


</FORM>

<?php
} else {
    ?>
<TR><TD ALIGN=Center>
Cám ơn bạn đã thực hiện bài test
<BR>Tỉ lệ trả lời đúng của bạn là: <?php print $percentaje;?> %
<p><A HREF="<?php print $address;?>">Về Trang Chủ</a>

<?php }?>

</TD></TR>
</TABLE>
</div>
</CENTER>
</BODY>
</HTML>
