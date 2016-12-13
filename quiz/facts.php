<?php
session_start();
?>
<!DOCTYPE >
<html>
<head>
<title>Olympics Facts</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
include("databaseMongo.php"); 

//$test_id = $testid;

$collection=$db->OlympicsFacts;
$num_r = $collection->count();	


echo "<h1 class=head1> Olympics Facts </h1>";

echo "<table border=1 align=center><tr class=style2><td align=center> S.No <td align=center> Fact";



$randnum = array();
for ($i=1; $i<6; $i++)
{	
	$randrow = mt_rand(0,$num_r-1);	
	while(in_array($randrow,$randnum)){
		$randrow = mt_rand(0,$num_r-1);
	}
	$randnum[$i-1] = $randrow;
	$cursor=$collection->find(['ID'=>$randrow]);
	foreach($cursor as $document)
	{
		$fact =  $document['Fact'];		
	}	
	echo "<tr class=style8> <td align=center> $i <td>$fact";	
}
echo "</table>";



?>


</body>
</html>
