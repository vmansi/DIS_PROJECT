<?php
session_start();
error_reporting(1);
include("database.php");
extract($_POST);
extract($_GET);
extract($_SESSION);
include("databaseMongo.php");
//echo $subid;
if(isset($testid))
{
//$_SESSION[sid]=$subid;
$_SESSION[tid]=$testid;
header("location:quiz.php");
}
//if(!isset($_SESSION[sid]))
if(!isset($_SESSION[tid]))
{	
	header("location: index.php");
}
?>
<!DOCTYPE>
<html>
<head>
<title>Online Quiz</title>
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");


if ($_SESSION[tid] == 1){
	$table = mt_rand(0,9);
}
else if ($_SESSION[tid] == 2){
	$table = 11;
}
else if ($_SESSION[tid] == 3){
	$table = 12;
}
else if ($_SESSION[tid] == 4){
	$table = 10;
}
else if ($_SESSION[tid] == 5){
	$table = 13;
}

if ($table == 0){ // Host
	$rs= mysql_query("select * from YEAR",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Host_Country from YEAR",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);	
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 1){ // Ques6
	$rs = mysql_query("select * from QUES6",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Host_Country from YEAR",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 2){ // Ques1
	$rs = mysql_query("select * from QUES1",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Discipline from QUES1",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 3){ // Ques2
	$rs = mysql_query("select * from QUES2",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Fname Lname from QUES1",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 4){ // Ques7
	$rs = mysql_query("select * from QUES7",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Host_Country from YEAR",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 5){ // Ques3
	$rs = mysql_query("SELECT PA.FNAME, PA.LNAME, Q.SPORT FROM POPULARATHLETES PA INNER JOIN QUES3 Q ON PA.AID = Q.AID;",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select FNAME, LNAME from POPULARATHLETES",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 6){ // Ques4
	$rs = mysql_query("SELECT PA.FNAME, PA.LNAME, Q.SPORT FROM POPULARATHLETES PA INNER JOIN QUES4 Q ON PA.AID = Q.AID;",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select FNAME, LNAME from POPULARATHLETES",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 7){ // Ques5
	$rs = mysql_query("SELECT PS.SPORT, Q.COUNTRY, Q.YEAR FROM POPULARSPORTS PS INNER JOIN QUES5 Q ON PS.SPORT = Q.SPORT WHERE Q.YEAR > 1990 OR Q.YEAR = 1896;",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Country from QUES5;",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 8){ // New Question
	$rs = mysql_query("SELECT PA.FNAME, PA.LNAME, C.NAME FROM POPULARATHLETES PA INNER JOIN ATHLETE A ON PA.AID = A.AID INNER JOIN COUNTRIES C ON C.COUNTRY_CODE = A.COUNTRY_CODE;",$cn) or die(mysql_error());
	$rs_opt = mysql_query("select distinct Country from QUES5;",$cn) or die(mysql_error());
	$num_r = mysql_num_rows($rs);
	$num_r_opt = mysql_num_rows($rs_opt);
}

if ($table == 9){ // MainQuizQuestion
	$collection=$db->MainQuizQuestion;
	$num_r = $collection->count();	
}

if ($table == 10){ // Olympics History
	$collection=$db->OlympicHistory;
	$num_r = $collection->count();	
}

if ($table == 11){ // Paralympics
	$collection=$db->Paralympics;
	$num_r = $collection->count();	
}

if ($table == 12){ // RioOlympics
	$collection=$db->RioOlympics;
	$num_r = $collection->count();	
}

if ($table == 13){ // Image Questions
	$collection=$db->ImageQuestions;
	$num_r = $collection->count();	
}


if(!isset($_SESSION[qn]))
{		
	$_SESSION[qn]=0;
	$_SESSION[trueans]=0;
	
	mysql_query("delete from mst_useranswer") or die(mysql_error());
	mysql_query("delete from mst_question") or die(mysql_error());	
	$_SESSION[cnt] = 0;	
}

	
if($submit=='Next Question' && isset($ans))
{			
		$rs_new = mysql_query("select * from mst_question where que_id=$cnt-1",$cn) or die(mysql_error());
		mysql_data_seek($rs_new,0);
		$row = mysql_fetch_row($rs_new);
		mysql_query("insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans,url,notes,tags) values ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans','$row[8]','$row[9]','$row[10]')") or die(mysql_error());
		if($ans==$row[7])
		{
				$_SESSION[trueans]=$_SESSION[trueans]+1;
		}
				
		$_SESSION[qn]=$_SESSION[qn]+1;
		
}
else if($submit=='Get Result' && isset($ans))
{
				
		$rs_new = mysql_query("select * from mst_question where que_id=$cnt-1",$cn) or die(mysql_error());
		mysql_data_seek($rs_new,0);
		$row = mysql_fetch_row($rs_new);
		mysql_query("insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans,url,notes,tags) values ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans','$row[8]','$row[9]','$row[10]')") or die(mysql_error());
		if($ans==$row[7])
		{
			$_SESSION[trueans]=$_SESSION[trueans]+1;
		}
		echo "<h1 class=head1> Result</h1>";
		$_SESSION[qn]=$_SESSION[qn]+1;
		echo "<Table align=center><tr class=tot><td>Total Question<td> $_SESSION[qn]";
		echo "<tr class=tans><td>True Answer<td>".$_SESSION[trueans];
		$wa=$_SESSION[qn]-$_SESSION[trueans];
		echo "<tr class=fans><td>Wrong Answer<td> ". $wa;
		echo "</table>";
		date_default_timezone_set('America/New_York');
		//$today = getdate();	
		//$date = date($today["mday"]."-".$today["mday"]."-".$today["year"]);	
		$date = date("m-d-Y");
		//echo $date;	
		mysql_query("insert into mst_result(login,test_id,test_date,score) values('$login',$tid,'$date',$_SESSION[trueans])") or die(mysql_error());
		echo "<h1 align=center><a href=review.php> Review Question</a> </h1>";
		unset($_SESSION[qn]);
		//unset($_SESSION[sid]);
		unset($_SESSION[tid]);
		unset($_SESSION[trueans]);
		unset($_SESSION[cnt]);
		exit;
}

if($_SESSION[qn]>$num_r-1)
{	
unset($_SESSION[qn]);
echo "<h1 class=head1>Some Error  Occured</h1>";
session_destroy();
echo "Please <a href=index.php> Start Again</a>";

exit;
}
$_SESSION[cnt] = $_SESSION[cnt] +1;
$array = array();

$randrow = mt_rand(0,$num_r-1);				



if ($table== 0){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[1];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0];
		}			
	} 
	$ques = "Which country hosted the Olympics in ".$r[0]."?";
	$tags = $r[0];
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);	
	$row = mysql_fetch_row($rs_new);
}

if ($table == 1){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[1];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0];
		}			
	} 	
	$ques = "Which country won the maximum number of gold medals in ".$r[0]."?";
	$tags = $r[0];
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}

if ($table== 2){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);
	$options = array();
	$options[$true_ans_pos] = $r[3];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0];
		}			
	} 	
	
	$ques = "Name the sport to which ".$r[1]." ".$r[2]." is related.";
	$tags = $r[1]." ".$r[2];
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);	
	$row = mysql_fetch_row($rs_new);
}

if ($table== 3){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);
	$options = array();
	$options[$true_ans_pos] = $r[1]." ".$r[2];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0]." ".$w[1], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0]." ".$w[1];
		}			
	} 	
	
	$ques = "Which athlete has won medals in more than one sport?";
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1)") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);	
	$row = mysql_fetch_row($rs_new);
}

if ($table == 4){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[1];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0];
		}			
	} 	
	$ques = "Which country won the maximum number of gold medals in ".$r[0]."?";
	$tags = $r[0];
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}


if ($table == 5){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[0]." ".$r[1];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0]." ".$w[1], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0]." ".$w[1];
		}			
	} 	
	$ques = "Name the player with maximum number of gold medals in ".$r[2].".";
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1)") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}

if ($table == 6){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[0]." ".$r[1];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0]." ".$w[1], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0]." ".$w[1];
		}			
	} 	
	$ques = "Name the player with maximum number of medals in ".$r[2].".";
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1)") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);
}

if ($table == 7){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[1];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0];
		}			
	} 	
	$ques = "Which country won the maximum number of medals in ".$r[0]." in ".$r[2]."?";
	$tags = $r[0]." ".$r[2];
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);
}

if ($table == 8){
	$true_ans_pos = mt_rand(0,3);
	mysql_data_seek($rs,$randrow);
	$r= mysql_fetch_row($rs);	
	$options = array();
	$options[$true_ans_pos] = $r[2];

	for($i = 0; $i <= 3; $i++) {
		if ($i != $true_ans_pos){
			$wrong = mt_rand(0,$num_r_opt-1);						
			mysql_data_seek($rs_opt,$wrong);
			$w= mysql_fetch_row($rs_opt);
			
			while(in_array($w[0], $options)){
				$wrong = mt_rand(0,$num_r_opt-1);						
				mysql_data_seek($rs_opt,$wrong);
				$w= mysql_fetch_row($rs_opt);
			}
			
			$options[$i] = $w[0];
		}			
	} 	
	$ques = "Which country does ".$r[0]." ".$r[1]." belong to?";
	$tags = $r[0]." ".$r[1];
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);
}


if ($table == 9){
	
	$cursor=$collection->find(['ID'=>$randrow]);
	$options = array();
	foreach($cursor as $document)
	{
		$ques =  $document['Question'];
		$options =  $document['Options'];
		$true_ans_pos = ord($document['Answers'])-65;
	}	
	$tags = $ques;		
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes,tags) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1,null,null,'$tags')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}

if ($table == 10){
	
	$cursor=$collection->find(['ID'=>$randrow]);
	$options = array();
	foreach($cursor as $document)
	{
		$ques =  $document['Question'];
		$options =  $document['Options'];
		$true_ans_pos = ord($document['Answers'])-65;
	}
		
	if (sizeof($options)==2){
		$options[2] = null;
		$options[3] = null;
	}	
	
		
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1)") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}


if ($table == 11){
	
	$cursor=$collection->find(['ID'=>$randrow]);
	$options = array();
	foreach($cursor as $document)
	{
		$ques =  $document['Question'];
		$options =  $document['Options'];
		$true_ans_pos = ord($document['Answers'])-65;
		if (isset($document['Notes'])){
			$notes = $document['Notes'];
		}
		else{
			$notes = null;
		}
	}
		
	if (sizeof($options)==2){
		$options[2] = null;
		$options[3] = null;
	}	
	
		
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1, null, '$notes')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}	

if ($table == 12){
	
	$cursor=$collection->find(['ID'=>$randrow]);
	$options = array();
	foreach($cursor as $document)
	{
		$ques =  $document['Question'];
		$options =  $document['Options'];
		$true_ans_pos = ord($document['Answers'])-65;
		if (isset($document['Notes'])){
			$notes = $document['Notes'];
		}
		else{
			$notes = null;
		}
	}
		
	if (sizeof($options)==2){
		$options[2] = null;
		$options[3] = null;
	}	
	
		
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1, null, '$notes')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}

if ($table == 13){
	
	$cursor=$collection->find(['ID'=>$randrow]);
	$options = array();
	foreach($cursor as $document)
	{
		$url =  $document['URL'];
		$options =  $document['Options'];
		$true_ans_pos = ord($document['Answers'])-65;
		$mascot = $document['Mascot'];
		if (isset($document['Notes'])){
			$notes = $document['Notes'];
		}
		else{
			$notes = null;
		}
	}
	
	if ($mascot == 'False'){
		$ques = "Identify the person";
	}
	else{
		$ques = "Which olympics does the above mascot belong to?";
	}	
	if (sizeof($options)==2){
		$options[2] = null;
		$options[3] = null;
	}	
	
		
	mysql_query("insert into mst_question(que_id, test_id, que_desc, ans1,ans2,ans3,ans4,true_ans,url,notes) values ($cnt, $tid,'$ques','$options[0]','$options[1]','$options[2]', '$options[3]',$true_ans_pos+1, '$url', '$notes')") or die(mysql_error());
	$rs_new = mysql_query("select * from mst_question where que_id=$cnt",$cn) or die(mysql_error());
	mysql_data_seek($rs_new,0);
	$row = mysql_fetch_row($rs_new);	
}

echo "<form name=myfm method=post action=quiz.php>";
echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
$n=$_SESSION[qn]+1;
echo "<tR><td><span class=style2>Que ".  $n .": $row[2]</style>";
if ($table==13){
	echo  "<tr><img src=$row[8] height='300' width='300'>\n" ;
}
echo "<tr><td class=style8><input type=radio name=ans value=1>$row[3]";
echo "<tr><td class=style8> <input type=radio name=ans value=2>$row[4]";
if ($row[5]!=null){
	echo "<tr><td class=style8><input type=radio name=ans value=3>$row[5]";
	echo "<tr><td class=style8><input type=radio name=ans value=4>$row[6]";
}

if($_SESSION[qn]<4)
echo "<tr><td><input type=submit name=submit value='Next Question'></form>";
else
echo "<tr><td><input type=submit name=submit value='Get Result'></form>";
echo "</table></table>";




?>
</body>
</html>