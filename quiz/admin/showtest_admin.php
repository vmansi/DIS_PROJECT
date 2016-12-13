<?php
session_start();
?>
<!DOCTYPE >
<html>
<head>
<title>Online Quiz - Test List</title>
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include("header.php");
include("../database.php");
extract($_GET);

/* $rs1=mysql_query("select * from mst_subject where sub_id=$subid");
$row1=mysql_fetch_array($rs1);
echo "<h1 align=center><font color=blue> $row1[1]</font></h1>"; */
$rs=mysql_query("select * from mst_test");
if(mysql_num_rows($rs)<1)
{
	echo "<br><br><h2 class=head1 align=center> <font color='red' size = '5'> No Quiz for this Subject </h2>";
	exit;
}
echo "<h2 class=head1 align=center> <font color='red' size = '5'> Select the Quiz to view result </h2>";
echo "<table align=center  height='60'>";

while($row=mysql_fetch_row($rs))
{	
	
	echo "<tr><td align=center ><a href=result_admin.php?testid=$row[0]&login_id=$loginid><font size=5>$row[2]</font></a>";

}
echo "</table>";
?>
</body>
</html>