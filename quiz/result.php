<?php
session_start();
?>
<!DOCTYPE >
<html>
<head>
<title>Online Quiz  - Result </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
include("database.php");
//include("includes/fusioncharts.php");
require_once 'phplot.php';

extract($_SESSION);
extract($_POST);
extract($_GET);
//$test_id = $testid;

$rs=mysql_query("select t.test_name,t.total_que,r.test_date,r.score from mst_test t, mst_result r where
t.test_id=r.test_id and r.login='$login' and t.test_id = $testid",$cn) or die(mysql_error());

echo "<h1 class=head1> Result </h1>";
if(mysql_num_rows($rs)<1)
{
	echo "<br><br><h1 class=head1> You have not given any quiz of this type</h1>";
	exit;
}
echo "<table border=1 align=center><tr class=style2><td align=center> Quiz Number <td width=200 align=center> Test Name <td  width=100 align=center> Date <td align=center> Total<br> Question <td align=center> Score";

$data2 = array(array('','a',1),array('','b',2),array('','c',3));
$i = 0;
$data = array();
while($row=mysql_fetch_row($rs))
{
	//echo testid;		
	echo "<tr class=style8> <td align=center> $i <td align=center>$row[0] <td align=center> $row[2] <td align=center> $row[1] <td align=center> $row[3]";
	$data[$i] = array('',$i,$row[3]/$row[1]);
	$i = $i +1;
}
echo "</table>";

$plot = new PHPlot(600,400,"./performance.png");
$plot->SetIsInline(1);
$plot->SetPlotType('lines');
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetTitle("Plot of Performance");
$plot->SetXTitle('Quiz Number');
$plot->SetYTitle('Percentage Correct');
$plot->SetXTickIncrement(1);
$plot->SetPlotAreaWorld(NULL, 0, NULL, NULL);
$plot->DrawGraph();
echo "<br><br><center><img src=\"" . $plot->EncodeImage() . "\"></center>\n";

?>


</body>
</html>

