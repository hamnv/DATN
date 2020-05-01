<?php
//file thu nghiem
error_reporting(0);
include "config/config.php";
$randomizequestions = "yes"; // cau hoi ngau nhien
$a = array();
$i = 1;

$sql = "SELECT * FROM question";
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
print_r($a);
?>
<FORM METHOD=POST NAME="question" ACTION="">
<?php print "<b>" . $a[1][0] . "</b>";?>

<BR>     <INPUT TYPE=radio NAME="option" VALUE="1"  onClick=" Goahead (1);"><?php print $a[1][1];?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="2"  onClick=" Goahead (2);"><?php print $a[1][2];?>
<?php if ($a[1][3] != "") {?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="3"  onClick=" Goahead (3);"><?php print $a[1][3];}?>
<?php if ($a[1][4] != "") {?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="4"  onClick=" Goahead (4);"><?php print $a[1][4];}?>
<BR>     <input id="question" type=text name=response size=8 disabled>


</FORM>