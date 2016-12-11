<?php
session_start();
extract($_POST);
extract($_SESSION);
include("database.php");

?>
<!DOCTYPE >
<html>
<head>
<title>Online Quiz - Review Quiz </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
echo "<h1 class=head1> Review Test Question</h1>";

if(!isset($_SESSION[qn]))
{
		$_SESSION[qn]=0;
}
else if($submit=='Next Question' )
{
	$_SESSION[qn]=$_SESSION[qn]+1;
	
}

if($submit=='Finish')
{
	mysql_query("delete from mst_useranswer where sess_id='" . session_id() ."'") or die(mysql_error());
	unset($_SESSION[qn]);
	header("Location: index.php");
	exit;
}
if($submit=='Learn More...')
{
	$rs=mysql_query("select * from mst_useranswer where sess_id='" . session_id() ."'",$cn) or die(mysql_error());
	mysql_data_seek($rs,$_SESSION[qn]);
	$row= mysql_fetch_row($rs);	
	if ($row[1]==1 || $row[1]==5){
		$pos = $row[7]+2;	
		$link = "<script>window.open('https://www.bing.com/search?q=olympics+$row[$pos]+$row[11]')</script>";
		echo $link;
	}
	else{
		$q = $row[2];
		$link = "<script>window.open('https://www.bing.com/search?q=$q')</script>";
		echo $link;
	}
	
}

$rs=mysql_query("select * from mst_useranswer where sess_id='" . session_id() ."'",$cn) or die(mysql_error());
mysql_data_seek($rs,$_SESSION[qn]);
$row= mysql_fetch_row($rs);
echo "<form name=myfm method=post action=review.php>";
echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
$n=$_SESSION[qn]+1;
echo "<tR><td><span class=style2>Que ".  $n .": $row[2]</style>";
if ($row[9]!=null){
	echo  "<tr><img src=$row[9] height='300' width='300'>\n" ;
}
echo "<tr><td class=".($row[7]==1?'tans':'style8').">$row[3]";
echo "<tr><td class=".($row[7]==2?'tans':'style8').">$row[4]";
echo "<tr><td class=".($row[7]==3?'tans':'style8').">$row[5]";
echo "<tr><td class=".($row[7]==4?'tans':'style8').">$row[6]";
if($_SESSION[qn]<mysql_num_rows($rs)-1){
	echo "<tr><td><input type=submit name=submit value='Next Question'></form>";
	
}
else{
	echo "<tr><td><input type=submit name=submit value='Finish'></form>";	
}
if ($row[5]!=null){
	echo "<tr><td><input type=submit name=submit value='Learn More...'></form>";
}
if ($row[10]!=null){
	echo "<br><br>Note: $row[10]\n";
}
echo "</table></table>";
?>
