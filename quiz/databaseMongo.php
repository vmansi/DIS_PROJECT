<?php
/*
$cn=mysql_connect("localhost","root","") or die("Could not Connect My Sql");
mysql_select_db("quiz_new",$cn)  or die("Could connect to Database");
*/
require __DIR__ . '/vendor/autoload.php';
//require 'vendor/autoload.php';//composer require "mongodb/mongodb=^1.0.0.0"
//require '../aws/aws-autoload.php';
//$cn= new MongoDB\Driver\Manager("mongodb://vmansi@seas.upenn.edu:Mansi123@ds129038.mlab.com:29038/questionset1") or die("Could not Connect MongoDB");
//$cn= new MongoClient( "mongodb://<vmansi@seas.upenn.edu>:<Mansi123>@ds129038.mlab.com:29038") or die("Could not Connect MongoDB");
//$cn= new MongoDB\Driver\Manager('mongodb://ds129038.mlab.com:29038') or die("Could not Connect MongoDB");
//$cn = new Mongo();
//$cn= new MongoDB\Driver\Manager('54.213.120.34');// or die("Could not Connect MongoDB");

$cn = new MongoDB\Driver\Manager('54.213.120.34:27017', array(
    'username' => '',
    'password' => ''
    
));




//var_dump($cn->getServers());
//$command = new MongoDB\Driver\Command(['ping' => 1]);
//$cn->executeCommand('db', $command);
//var_dump($cn->getServers()); 
//$db1 = $cn->'Olympics1';
//$db1->authenticate('vmansi@seas.upenn.edu', 'Mansi123');
//phpinfo();
//echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";
/*
$filter = ['Answers' => ['$gt' => 'A']];
//$bulk = new MongoDB\Driver\BulkWrite;s
$query = new MongoDB\Driver\Query($filter);
//$rows = $cn->executeQuery('questionset1.Olympics1', $query);
*/
echo "done"; 
?>
