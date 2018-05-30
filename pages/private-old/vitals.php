<?php
session_start();

//connect to the mysql
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","lobotple_admin","admin1"))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("lobotple_quick"))
{
	die('oops database selection problem ! --> '.mysql_error());
}

$id=$_SESSION['user']; //acquire user id from the session variable
$userid=$_SESSION['patient']; //acquire user id from the session variable

//database query
$sql = mysql_query("SELECT `temperature`,`pulse`,`steps`,`respiratory` FROM `vitals` WHERE `user`='$userid' ORDER BY datetime DESC LIMIT 1");

$rows = array();
while($r = mysql_fetch_assoc($sql)) {
  $rows[] = $r;
}

//echo result as json
echo json_encode($rows);
?>