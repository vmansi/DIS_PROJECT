<?php

require __DIR__ . '/vendor/autoload.php';

$cn2= new MongoClient( "mongodb://tempuser:tempuser@ds129038.mlab.com:29038/questionset1?authSource=questionset1");// or die("Could not Connect MongoDB");
$db=$cn2->selectDB("questionset1");

?>
