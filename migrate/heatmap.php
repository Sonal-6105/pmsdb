<?php
	session_start();
	error_reporting(2);
	require 'functions.php';
	if(!$_SESSION['logged_in']){
		session_destroy();
		header("Location:index.php");
		exit;
	}
	if($_SESSION['type'] == "G"){
		session_destroy();
		header("Location:index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pool Cost Management</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--==================================================================================FAV ICON=============-->
	<link rel="icon" type="image/png" href="images/favicon.ico"/>
<!--==================================================================================BOOT STRAP 4=============-->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<!--==================================================================================FONT AWESOME=============-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.css">
<!--==================================================================================ICONIC=============-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--==================================================================================DATA TABLE CSS=============-->
	<link rel="stylesheet" type="text/css" href="vendor/datatables/dataTables.bootstrap4.min.css">
<!--==================================================================================CUSTOM CSS FOR THIS WEBSITE=============-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body style="padding-top:80px; background:#f8f9fc;">
<!--====================================================================== TOP NAV BEGIN ==================================================-->
<nav class="navbar navbar-expand-sm bg-light fixed-top shadow-sm">
	<a class="navbar-brand p-l-20" href="dashboard.php">
		<img src="images/logo.jpg" width="40" height="40" alt="GRIDCO" loading="lazy">
		<span class="brand-title p-l-10">Pool Cost Management</span>
	</a>
    <div class="navbar-collapse justify-content-end">
		<ul class="navbar-nav hvr-underline-from-center p-r-5">
			<li class="nav-item">
			<a class="nav-link" href="dashboard.php">Dashboard</a>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="navbar-nav hvr-underline-from-center">
			<a class="nav-link" href="reports.php">Reports</a>
			</li>
		</ul>
		<?php
			if($_SESSION['type'] == "A"){
				echo('
					<ul class="navbar-nav">
						<li class="navbar-nav hvr-underline-from-center">
						<a class="nav-link" href="contribution.php">Contribute</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link current-page" href="heatmap.php">Heatmap</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center p-r-5">
						<li class="nav-item">
						<a class="nav-link" href="admin.php">Admin</a>
						</li>
					</ul>
				');
			}
			if($_SESSION['type'] == "C"){
				echo('
					<ul class="navbar-nav hvr-underline-from-center p-r-5">
						<li class="nav-item">
						<a class="nav-link current-page" href="contribution.php">Contribute</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="heatmap.php">Heatmap</a>
						</li>
					</ul>
				');
			}
		?>
		<i class="fas fa-user-circle fa-2x separator-left p-l-5 nav-profile"></i>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle nav-profile" href="#" role="button" data-toggle="dropdown"
					id="navbardrop" aria-haspopup="true" aria-expanded="false">
					<?php echo($_SESSION['name']); ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right shadow-sm">
					<span class="dropdown-item nav-drop-menu"><i class="fas fa-envelope"></i><?php echo("   ".$_SESSION['user']);?></span>
					<div class="dropdown-divider"></div>
					<span class="dropdown-item nav-drop-ip"><b>Last Log-in:</b> <?php echo(getLastLogin($_SESSION['user']));?> Hrs</span>
					<span class="dropdown-item nav-drop-ip"><b>IP Address:</b> <?php echo("   ".$_SERVER['REMOTE_ADDR']);?></span>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item nav-help" href="#"><i class="fab fa-hire-a-helper"></i>  Get Help</a>
					<a class="dropdown-item nav-help" href="#"><i class="fas fa-question-circle"></i>  Frequently Asked Questions</a>
					<a class="dropdown-item nav-help" href="#"><i class="fas fa-user-shield"></i>  Privacy Declaration</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item nav-logout" href="logout.php"><i class="fas fa-sign-out-alt"></i>  Log out</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
<!--===========================================================================TOP NAV END & CONTAINER BEGIN =============================================-->
<div class="container">
	<hr>
	<div class="row p-l-10 p-r-10">
		<div class="col-sm-2 cont-progress">
			Progress for <?php echo(date('F', strtotime(date('Y-m')." -1 month"))); ?>:
		</div>
		<div class="col-sm-10 p-t-4">
			<div class="progress" style="height:10px">
				<div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width:
				<?php
					if($_SESSION['type'] == "A"){
						echo(getProgress(0, date('m', strtotime(date('Y-m')." -1 month")), date('Y')));
					}
					else{
						echo(getProgress($_SESSION['user_id'], date('m', strtotime(date('Y-m')." -1 month")), date('Y')));
					}
				?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
				<span style="font-size:7px; color:red; padding-left:2px;">
											<?php
												if($_SESSION['type'] == "A"){
													echo(getProgress(0, date('m', strtotime(date('Y-m')." -1 month")), date('Y')).'%');
												}
												else{
													echo(getProgress($_SESSION['user_id'], date('m', strtotime(date('Y-m')." -1 month")), date('Y')).'%');
												}
											?>
				</span>
			</div>
		</div>
	</div>
	<hr>
	<div class="card">
		<div class="card-header">
			<div class="row no-gutters">
				<div class="col-sm-auto text-center">
					<lottie-player src="vendor/lottie/13635-stopwatch.json"
											background="transparent"  speed="1"  style="width: 25px; height: 25px;"  loop  autoplay></lottie-player>
				</div>
								<div class="col-sm-auto p-t-3 dash-card-head">
									<h6 class="p-l-7">Monthly Heatmap</h6>
								</div>
								<div class="col-sm-auto m-l-10">
									<span id="loader">
										<lottie-player src="vendor/lottie/28255-loading.json"
											background="transparent"  speed="1"  style="width: 30px; height: 25px;"  loop  autoplay></lottie-player>
									</span>
								</div>
								<div class="col text-right">
									<select id="vMonth" class="pcd-form m-r-10 hm">
										<?php
											for($i=1;$i<13;$i++){
												if($i+1 == date('m')){
													echo('<option value="'.$i.'" selected>'.date('F', mktime(0, 0, 0, $i, 10)).'</option>');
												}
												else{
													echo('<option value="'.$i.'">'.date('F', mktime(0, 0, 0, $i, 10)).'</option>');
												}
											}
										?>
									</select>

									<select id="vYear" class="pcd-form m-r-10 hm">
										<?php
											$year = date('Y');
											echo('<option value="'.$year.'" selected>'.$year.'</option>');
											for($i=1;$i<4;$i++){
												echo('<option value="'.($year-$i).'">'.($year-$i).'</option>');
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-sm table-striped text-sm-left">
								<thead class="role-heading" style="font-size:14px;">
									<tr>
										<th scope="col" style="width: 10%">#</th>
										<th scope="col" style="width: 30%">Contributor Name</th>
										<th scope="col" style="width: 60%">Contribution Status</th>
									</tr>
								</thead>
								<tbody class="table-data" id="tdata">
								<?php
									$heat_month = date('m')-1;

									$assignedUsers = assignedUsers();
									$rid=1;
									while($row = mysqli_fetch_assoc($assignedUsers)){
										echo('<tr>');
										echo('<td>'.$rid.'</td>');
										echo('<td>'.$row['name'].'</td>');
										echo('<td>');
											$source = sourceByUser($row['id']);
											while($s_row = mysqli_fetch_assoc($source)){
												if(ifContributed($s_row['sid'], $heat_month, $year)){
													echo('<span class="badge badge-pill badge-success m-b-5 m-r-5 hit">');
													echo($s_row['sname']);
													echo('</span>');
												}
												else{
													echo('<span class="badge badge-pill badge-danger m-b-5 m-r-5 miss">');
													echo($s_row['sname']);
													echo('</span>');
												}
											}
										echo('</td>');
										echo('</tr>');
										$rid++;
									}
								?>
								</tbody>
							</table>
						</div>
					</div>

</div>

<!-- ==========================================================================FOOTER=============================== -->
<br><br><br>
<div class="footer-style">
	<span>&#169;2020 Copyright: GRIDCO Ltd.</span><br>
	<span>Recommended Browsers: Chrome 80.0+ Firefox 80.0+</span>
</div>
<!--==================================================================================JQUERY JS=============-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--==================================================================================BOOT STRAP JS=============-->
	<script src="bootstrap/js/popper.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<!--==================================================================================FONT AWESOME JS=============-->
	<script src="vendor/font-awesome/js/all.js"></script
<!--==================================================================================TYPED JS=============-->
	<script src="vendor/typed/typed.min.js"></script
<!--==================================================================================DATA TABLES JS=============-->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!--==================================================================================COUNT DOWN=============-->
	<script src="vendor/countdown/jquery.countdown.min.js"></script
<!--==================================================================================LOTTIE PLAYER=============-->
	<script src="vendor/lottie/lottie-player.js"></script>
<!--==================================================================================SITE CUSTOM JS=============-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
	<script>
		$(document).ready(function() {
			$('#loader').hide();
			$('.hm').on('change', function(){
				var month = $.trim($('#vMonth').find(':selected').val());
				var year = $.trim($('#vYear').find(':selected').val());
				$('#loader').show();
				var url = 'api_get_hm.php';
				$.post(url, {month:month, year:year}, function(result, status){
					if(status == "success"){
						setTimeout(function(){
							$('#loader').hide();
							$('#tdata').html(result);
						}, 500);
					}
				});
			});
		});

	</script>
</body>
</html>
