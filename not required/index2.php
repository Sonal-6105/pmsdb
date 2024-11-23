<?php
	error_reporting(1);
	require 'connection.php';
	require 'functions.php';
	session_name('pmsdb');
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	
	
	if($_SESSION['logged_in']){
		/*if($_SESSION['type'] == "A"){
			header("Location:admin.php");
			exit;
		}*/
		if($_SESSION['type'] == "O"){
			header("Location:pms-mainpage.php");
			exit;
		}
		if($_SESSION['type'] == "D"){
			header("Location:pms-dashboard.php");
			exit;
		}
		if($_SESSION['type'] == "M"){
			header("Location:pms-manager.php");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login| Project Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--==================================================================================FAV ICON=============-->
	<link rel="icon" type="image/png" href="images/favicon.ico"/>
<!--==================================================================================BOOT STRAP 4=============
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<!--==================================================================================FONT AWESOME=============
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.css">-->
<!--==================================================================================PLUG=============-->	
	<link rel="stylesheet" type="text/css" href="plug/bs4.5/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plug/font-awesome/css/all.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plug/animate/animate.min.css">	
<!--==================================================================================ICONIC=============-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--==================================================================================CUSTOM CSS FOR THIS WEBSITE=============-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
<style>
#grad1{
	background-image: linear-gradient( #7b68ee,#ffb347,#dcd0ff);
}
</style>
</head>
<body>
	<div class="limiter" >
		<div class="container-login100" id="grad1" >
			<div class="wrap-login100" >
				<form class="login100-form validate-form" method="post" action="index.php">

					<span class="login100-form-title p-b-20">
						<img src="images/logo.jpg" alt="IMG" width="75" height="100">
					</span>
					<span class="login100-form-title p-b-20" style="font-size: 20px;">
						<!--<b>e -</b><b style="font-size: 35px;">S</b>amik<b style="font-size: 35px;">S</b>ha-->
						<b style="font-size: 25px;">P</b>roject  <b style="font-size: 25px;">M</b>anagement  <b style="font-size: 25px;">S</b>ystem
					</span>
					<span class="login100-form-title p-b-20" style="font-size: 10px;color: blue;">
						"Monitoring,Follow-up,Action on the Decisions Taken in the Meetings"
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username"   autocomplete="off" required>
						<span class="focus-input100" data-placeholder="Webmail ID"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass"  required>
						<span class="focus-input100" data-placeholder="Webmail Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="submit">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-2">
						<span class="txt2" style="font-size:10px;">
						Note: Use your webmail id (without domain) and password to sign in. Only authorised officers designated to use PMS portal will be able to sign in.
							
						</span>
					</div>
					</form>
						<?php
							if(isset($_POST["submit"])){
								//print_r($_POST);
							$user_details = getUserDetails($_POST['username']);
							$connection = openDBConnection();               //open connection
							$query = 'select * from `project_details` where project_manager ="'.$_POST['username'].'"';                    //prepare the query
							$result = mysqli_query($connection, $query);    //get result in associative array
							//$result = mysqli_query($connection, $countQuery);
							//$row = mysqli_fetch_assoc($result);
							
							
							$data = array();                                //capture data in array
							foreach ($result as $row){
							$data[] = $row;
							}
							//$projectOwner_details = getProjectOwnerDetails($_POST['username']);
							//print_r(count($data));
							//echo($result);
							if(count($user_details) == 1){
								if(isValidUser($_POST['username'], $_POST['pass'])){
									$_SESSION['logged_in'] = true;
									$_SESSION['id'] = $_POST['username'];
									$_SESSION['name'] = $user_details[0]['name'];
									$_SESSION['uid'] = $user_details[0]['uid'];
									$_SESSION['type'] = $user_details[0]['type'];
									$_SESSION['wing'] = $user_details[0]['wing'];
									$_SESSION['wing_id'] = $user_details[0]['wing_id'];
									$_SESSION['abbr'] = $user_details[0]['abbr'];
									$_SESSION['last_login'] = $user_details[0]['last_login'];
									$_SESSION['ip'] = $user_details[0]['ip'];
									$_SESSION['browser'] = $user_details[0]['browser'];
									$_SESSION['nodes'] = '-';

									//Parameters for loggig
									$timestamp = date("Y-m-d H:i:s");
									$ip = $_SERVER['REMOTE_ADDR'];
									$browser = $_SERVER['HTTP_USER_AGENT'];

									//push login details to database to capture last login
									markLogin($_POST['username'], $timestamp, $ip, $browser);
									echo("hello");
									if($user_details[0]['type'] == "A"){
										header("Location:admin.php");
										exit;
									}
									if($user_details[0]['type'] == "O"){
										echo("sona");
										header("Location:pms-mainpage.php");
										exit;
									}
									if($user_details[0]['type'] == "D"){
										echo("Mona");
										header("Location:pms-dashboard.php");
										exit;
									}
								}
								
								else{
                                        echo ("<script>
                                            Swal.fire(
                                                'Error!',
                                                'Incorrect Password. Authentication Failed!',
                                                'error'
                                            );
                                        </script>");
                                    }
								
							}else if(count($data)!= 0){
								if(isValidUser($_POST['username'], $_POST['pass'])){
								echo("hello");	
								$_SESSION['logged_in'] = true;
								//$_SESSION['id'] = $_POST['username'];
								$_SESSION['name']=$data[0]['project_manager'];
								$_SESSION['type'] = "M";
								$_SESSION['last_login']=$data[0]['lastupdate_time'];
								//$_SESSION['wing']=$data[0]['last_login'];
								//$_SESSION['ip']=$data[0]['last_login'];
								//echo($_SESSION['type']);
								header("Location:pms-manager.php");
								exit;
							}
							//echo("hi");
							}
							else{
								//echo('<div class="text-center login-error"><i class="fas fa-exclamation-circle"></i> You are not authorised to use this application.</div>');
								echo("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'You are not authorised to use this application !!!',
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												)

											
                                        </script>");
							}
							}
						?>

			</div>
			
		</div>
		<!--<footer>
        <span class="claimer">v1.0, Copyright &#169;2021 OPTCL All Rights Reserved</span>
        <span class="links">Info | Help | Contact | About</span>
    </footer>-->
	</div>
<!--==================================================================================JQUERY JS=============-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--==================================================================================BOOT STRAP JS=============-->
	<script src="bootstrap/js/popper.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<!--==================================================================================FONT AWESOME JS=============-->
	<script src="vendor/font-awesome/js/all.js"></script>
<!--==================================================================================SITE CUSTOM JS=============-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->

</body>
</html>
