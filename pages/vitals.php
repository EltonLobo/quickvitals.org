<?php
session_start();
include_once 'server.php';

$id = $_GET['id'];
$steps = $_GET['step'];
$temperature = $_GET['temp'];
$pulse = $_GET['pulse'];
$emergency = $_GET['emergency'];
$respiratory = $_GET['resp'];

$query=mysql_query("SELECT * FROM `patients` WHERE `patient`= '$id'");
$userRow=mysql_fetch_array($query); //get user data from the mySQL database

$hospital = $userRow['hospital'];


//set time to Australia/Melbourne
date_default_timezone_set('Australia/Melbourne');

$date = date("Y-m-d H:i:s");

mysql_query("INSERT INTO `vitals`(`user`, `temperature`, `pulse`, `steps`, `respiratory`, `datetime`) VALUES ('$id','$temperature','$pulse','$steps','$respiratory','$date')");

if($emergency == 1){
mysql_query("INSERT INTO `emergency`(`user`, `hospital`) VALUES ('$id','$hospital')");
}

?>