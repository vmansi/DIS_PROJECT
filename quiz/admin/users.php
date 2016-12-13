<?php
session_start();
?>
<!DOCTYPE >
<html>
<head>
<title> Users List </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
include("../database.php"); 

//$test_id = $testid;

$rs=mysql_query("select username, login from mst_user",$cn) or die(mysql_error());
$num = mysql_num_rows($rs);

echo "<h1 class=head1 align=center> <font color='red' size = '5'> Users List </h1>";

echo "<table border=1 align=center><tr class=style2><td align=center> S.No <td align=center> User";



$randnum = array();
for ($i=1; $i<$num+1; $i++)
{	
	mysql_data_seek($rs,$i-1);
	$row = mysql_fetch_row($rs);
	$u = $row[0]." (".$row[1].")";	
	echo "<tr class=style8> <td align=center> $i <td><a href=showtest_admin.php?loginid=$row[1]>$u</a>";	
}
echo "</table>";



?>


</body>
</html>