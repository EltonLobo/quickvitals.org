<?php 
session_start();
include_once 'dbpublic.php';

$id=$_SESSION['user']; //acquire user id from the session variable

$sql="SELECT * FROM `vitals` WHERE `user` = '$id'";
$resultset = mysql_query($sql);
$num_row = mysql_num_rows($resultset);
if($num_row) {
while($row = mysql_fetch_array($resultset)) { 
   $temperature = $row['temperature'];
   $pulse = $row['pulse'];
   $oxygen = $row['oxygen'];
   $steps = $row['steps'];
}
}
?>
