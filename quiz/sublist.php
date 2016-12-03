<?php
session_start();
?>
<html>
<head>
<title>Online Quiz - Quiz List</title>
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include("header.php");
include("database.php");
echo "<h1 class=head1> Select Subject to Give Quiz </h2>";
$rs=mysql_query("select * from mst_subject");
echo "<table align=center height='60%'>";
while($row=mysql_fetch_row($rs))
{
	echo "<tr><td align=center ><a href=showtest.php?subid=$row[0]><font size=5>$row[1]</font></a>";
}
echo "</table>";
?>
</body>
</html>
