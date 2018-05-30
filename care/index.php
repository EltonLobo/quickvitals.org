<?php
session_start();
include_once 'dbpublic.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['login-submit']))
{
	$name = mysql_real_escape_string($_POST['name']);
	$password = mysql_real_escape_string($_POST['password']);
	
	$name = trim($name);
	$password = trim($password);
	
	$query=mysql_query("SELECT * FROM `doctors` WHERE `name` = '$name'");
	$row=mysql_fetch_array($query);
	
	$success = mysql_num_rows($query); // if name/pass correct it returns must be 1 row
	
	if($success == 1 && $row['password']==md5($password))
	{
		$_SESSION['user'] = $row['id'];
		header("Location: home.php");
	}
	else
	{
		?>
        <script>alert('Name / Password Seems Wrong !');</script>
        <?php
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../../img/favicon/favicon.ico" type="image/ico" />

    <title>QuickVitals Private Dashboard </title>

	<!------ Bootstrap ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<style>
	body{
    background-color:#f5f5f5;
	}
	.form-signin
	{
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
	}
	.form-signin .form-control
	{
		position: relative;
		font-size: 16px;
		height: auto;
		padding: 10px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.form-signin .form-control:focus
	{
		z-index: 2;
	}
	.form-signin input[type="text"]
	{
		margin-bottom: -1px;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
	}
	.form-signin input[type="password"]
	{
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.account-wall
	{
		margin-top: 80px;
		padding: 40px 0px 20px 0px;
		background-color: #ffffff;
		box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16);
	}
	.login-title
	{
		color: #555;
		font-size: 22px;
		font-weight: 400;
		display: block;
	}
	.profile-img
	{
		width: 96px;
		height: 96px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
	.select-img
	{
		border-radius: 50%;
		display: block;
		height: 75px;
		margin: 0 30px 10px;
		width: 75px;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
	.select-name
	{
		display: block;
		margin: 30px 10px 10px;
	}

	.logo-img
	{
		width: 96px;
		height: 96px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
	</style>
	
	<!------ Login Files ---------->
	<link rel="stylesheet" href="../assets/login.css">
</head>
<body>
<div class="container">
    <div class="row">
	    <?php
        echo '<div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
					<div class="tab-pane active" id="login">
               		    <img class="profile-img" src="images/logo_only.png" alt="">
						<h2 style="text-align:center; color:#3ba7ce;">QuickVitals</h2>
               			<form class="form-signin" action="" method="post">
               				<input type="text" name="name" class="form-control" placeholder="Name" required autofocus>
               				<input type="password" name="password" class="form-control" placeholder="Password" required>
               				<input type="submit" name="login-submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
               			</form>
					</div>
                </div>
            </div>
		</div>';
		?>
	</div>
</div>
</body>
</html>