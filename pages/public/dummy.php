<?php
include_once 'dbpublic.php';
$temperature = 37.5;
	$steps = 1000;
	$pulse = 99;
	$respiratory = 98;
	
	
while(1){
$date=date("Y-m-d h:i:s");
if(mysql_query("INSERT INTO `vitals`(`user`, `temperature`, `pulse`, `steps`, `respiratory`, `datetime`) VALUES ('1','$temperature','$pulse','$steps','$respiratory','$date')")){
		if($temperature < 34.5){
			$temperature = $temperature+0.11;
		}
		else{
			$temperature = $temperature-0.13;
		}
		if($pulse < 60 && $pulse >80{
			$pulse = $pulse+3;
		}
		else{
			$pulse = $pulse-2;
		}
	}
}

?>