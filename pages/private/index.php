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
	
	$query=mysql_query("SELECT * FROM `hospital` WHERE `name` = '$name'");
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

if(isset($_POST['register-submit']))
{
	$name = mysql_real_escape_string($_POST['name']);
	$password = mysql_real_escape_string($_POST['password']);
	$confirmpassword = mysql_real_escape_string($_POST['confirm-password']);
	
	$name = trim($name);
	$password = trim($password);
	$confirmpassword = trim($confirmpassword);
	
	if($password == $confirmpassword){
		$query = "SELECT `name` FROM `hospital` WHERE `name` = '$name'";
		$result = mysql_query($query);
		
		$success = mysql_num_rows($result); // if name not found then register
		$password = md5($password);
		
		if($success == 0){
		    if(mysql_query("INSERT INTO `hospital` (`name`, `email`, `password`, `contact`) VALUES ('$name', '', '$password', '');"))
			{
				header('Location: home.php');
			}
			else
			{
				?>
				<script>alert('Unable to register you please check all fields');</script>
				<?php
			}		
		}
		else{
				?>
				<script>alert('Sorry Name already in use');</script>
				<?php
		}
	}
	else{
		?>
        <script>alert('Password does not match the confirm password!');</script>
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
	
	<!------ Login Files ---------->
	<link rel="stylesheet" href="../assets/login.css">
</head>
<body>
<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" action="#" method="post" role="form" style="display: block;">
                <h2>LOGIN</h2>
                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="col-sm-6 col-sm-offset-3">     
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                  </div>
              </form>
              <form id="register-form" action="#" method="post" role="form" style="display: none;">
                <h2>REGISTER</h2>
                  <div class="form-group">
                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script>
$(function() {
    $('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});
</script>
</html>