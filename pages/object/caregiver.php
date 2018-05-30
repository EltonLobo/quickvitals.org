<?php 
session_start();
include_once 'dbpublic.php';

$query="SELECT * FROM `doctors`"; 
$result=mysql_query($query) or die ($mysqli->error);
//store the entire response
$response = array();
//the array that will hold the titles and links
$posts = array();
while($row = mysql_fetch_array($result)) //mysql_fetch_array($sql)
{ 
$name=$row['name']; 
$password=$row['password']; 
//each item from the rows go in their respective vars and into the posts array
$posts[] = array('name'=> $name, 'password'=> $password); 
} 
//the posts array goes into the response
$response['posts'] = $posts;
//creates the file
$fp = fopen('caregiver.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);

$array = json_decode($response, true);
print_r($response, true);
?> 