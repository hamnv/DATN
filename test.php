<?php
error_reporting(0);
include "config/config.php";
$randomizequestions = "yes"; // cau hoi ngau nhien
$a = array();
$i = 1;

$sql = "SELECT * FROM question WHERE lesson_id=$lesson_id";
$result = mysqli_query($link,$sql);
$max = mysqli_num_rows($result);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
         $a[$i][0] = $row['question'];
         $a[$i][1] = $row['ans1'];
         $a[$i][2] = $row['ans2'];
         $a[$i][3] = $row['ans3'];
         $a[$i][4] = $row['ans4'];
         $a[$i][6] = $row['correct_ans'];
         $i++;
    }
}

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
    $sql_firsttest = "INSERT INTO first_test (user_id, lesson_id, result) VALUES (?,?,?)";

    if ($stmt = mysqli_prepare($link, $sql_firsttest)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $ft_uid, $ft_lid, $ft_result);

        // Set parameters
        $ft_uid = $_SESSION['user_id'];
        $ft_lid = $lesson_id;
        $ft_result = $percentaje;
        // Attempt to execute the prepared statement
       mysqli_stmt_execute($stmt);
        // Close statement
        mysqli_stmt_close($stmt);
    }
    ?>
<TR><TD ALIGN=Center>
Cám ơn bạn đã thực hiện bài test
<br/>Tỉ lệ trả lời đúng của bạn là: <?php print $percentaje;?> % <br/>
<?php if($percentaje > 70) {
    echo "Phần trả lời của bạn khá tốt. Bạn có thể bỏ qua bài học này đẻ học bài tiếp theo.<br/>";
    echo "<a class=\"btn btn-primary\" href=\"go-lesson.php?id=" .$lesson_id. "\"> Tiếp tục bài học</a>";
    echo "<a class=\"btn btn-danger\" href=\"go-lesson.php?id=" .++$lesson_id. "\"> Bài tiếp theo</a>";
}
else {
    echo "<a href=\"go-lesson.php?id=" .$lesson_id. "\"> Tiếp tục bài học</a>";
}
}?>
<p><A HREF="index.php">Về Trang Chủ</a>



</TD></TR>
</TABLE>
</div>
</CENTER>
</BODY>
</HTML>
