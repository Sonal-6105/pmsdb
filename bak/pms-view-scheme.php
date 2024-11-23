<?php
	
	error_reporting(1);
	require 'connection.php';
	require 'functions.php';
	session_name('pms');
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	
	if(!$_SESSION['logged_in']){
        header("Location:index.php");
		exit;
    }
    if($_SESSION['type'] != "O"){
        header("Location:logout.php");
		exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Scheme | Project Management System </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--==================================================================================FAV ICON=============-->
	<link rel="icon" type="image/png" href="images/favicon.ico"/>
	
<!--==================================================================================BOOT STRAP 4=============-->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<!--==================================================================================FONT AWESOME=============
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.css">
	
<!--==================================================================================ICONIC=============-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="plug/datatables/dataTables.bootstrap4.min.css">	
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
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<!--===============================================================================================-->

<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>

</head>


<body style="padding-top:80px; background:#f8f9fc;">
<nav class="navbar navbar-expand-sm bg-light fixed-top shadow-sm">
	<a class="navbar-brand p-l-20" href="dashboard.php">
		<img src="images/logo.jpg" width="40" height="40" alt="GRIDCO" loading="lazy">
		<span class="brand-title p-l-10">Project Management System</span>
	</a>
    <div class="navbar-collapse justify-content-end">
		<ul class="navbar-nav hvr-underline-from-center p-r-5">
			<li class="nav-item">
			<a class="nav-link current-page" href="dashboard.php">Dashboard</a>
			</li>
		</ul>
		<!--<ul class="navbar-nav hvr-underline-from-center">
			<li class="nav-item">
			<a class="nav-link" href="#">Reports</a>
			</li>
		</ul>-->

		<?php
			if($_SESSION['type'] == "O"){
				echo('
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="#">yy</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="#">xx</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center p-r-5">
						<li class="nav-item">
						<a class="nav-link" href="#">Admin</a>
						</li>
					</ul>
				');
			}
			/*if($_SESSION['type'] == ""){
				echo('
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="heatmap.php">Heatmap</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="contribution.php">Contribute</a>
						</li>
					</ul>
				');
			}*/
		?>
		<!--<i class="fas fa-user-circle fa-2x separator-left p-l-5 nav-profile"></i>-->
		<ul class="navbar-nav">
		
			<li class="nav-item dropdown">
			<div class="dropdown">
            <span class="nav-profile" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="images/businessman.svg" class="rounded-circle" width="40px" height="40px" />
            </span>
            <div class="dropdown-menu dropdown-menu-right shadow-sm nimate__animated animate__bounceIn alert alert-primary" >
				<a class="dropdown-item nav-logout" href="logout.php"><i class="fas fa-sign-out-alt"></i>  Log out</a>
				<div class="dropdown-divider"></div>
                    <!--<p class="drop-profile"><b>Last Log-in:</b><?php echo($_SESSION['name']); ?></p>-->
                    <p class="dropdown-item nav-drop-ip"><b>Wing:</b> <?php echo($_SESSION['abbr']); ?></p>
					<p class="dropdown-item nav-drop-ip"><b>Last Log-in Info:</b> <?php echo($_SESSION['last_login']); ?></p>
					<p class="dropdown-item nav-drop-ip"><b>IP address:</b> <?php echo($_SESSION['ip']); ?></p>
           
            </div>
			</div>
			</li>
		</ul>
		
		
	</div>
</nav>

<div class="container-fluid" style="padding-left:7%; padding-right:7%;">
<!--=============================================== ROW-1 ==========================================-->
	<div class="d-flex justify-content-between" style="border-bottom: 1px #d9d9d9 solid;">
		<div class="p-2">
			<div class="wrapper">
				<div class="text-info font-weight-bold" >
					<h5>Edit Scheme Details:</h5>
				</div>
			</div>
		</div>
		
	</div>
<br>

<div class="row">
<div class="col-md-12">
			<div class="col-sm-auto text-left small text-muted">
			<div class="card">
				
				<div class="card-body ">
               <form class="" method="post" enctype="multipart/form-data" action=""> 
			  <p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                                    
                  $result = viewScheme($sid);
                  $row = mysqli_fetch_array($result);
                  
                  ?>
			  </p>
			   <div class="form-row">
							<div class="col-md-3"><label for="scheme_name" class="">Scheme Name:</label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col1">
										<input name="scheme_name" id="scheme_name" type="text" class="form-control required control-label" value="<?php echo($row['scheme_name']); ?>" autocomplete="off" />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="objective" class="">Brief-Objective(Scope and Funding):</label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col12">
										
										<textarea class="form-control" name="objective" id="objective" type="text" rows="6" autocomplete="off"><?php echo($row['objective']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="wing" class="">Wing/Department:</label></div>
								<div class="col-md-3">
									<div class="position-relative form-group " id = "col2">								
										<input name="wing" id="wing" type="text" class="form-control" value="<?php echo($_SESSION['wing']); ?>" readonly  />
											
									</div>
								</div>
							<div class="col-md-3"><label for="scheme_head" class="">Executive Head:</label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col3">
										<input name="scheme_head" id="scheme_head" type="text" class="form-control" value="<?php echo($row['executive_head']); ?>" autocomplete="off"/>
									</div>
								</div>
							
							
								
				</div>
				<div class="form-row">
							
							<div class="col-md-3"><label for="estimated_cost" class="">Estimated Cost(In Cr.):</label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col8">
										<input name="estimated_cost" id="estimated_cost" type="text" class="form-control" value="<?php echo($row['estimated_cost']); ?>" autocomplete="off" />
									</div>
								</div>	
							<div class="col-md-3"><label for="sanctioned_cost" class="">Sanctioned Cost(In Cr.):</label></div>
								<div class="col-md-3">
									<div class="position-relative form-group" id = "col9">								
										<input name="sanctioned_cost" id="sanctioned_cost" type="text" class="form-control" value="<?php echo($row['sanctioned_cost']); ?>" autocomplete="off" />
											
									</div>
								</div>	
				</div>
				
				<div class="form-row">
							
								<div class="col-md-3"><label for="funding_mechanism" class="">Funding Mechanism:</label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col12">
										
										<textarea class="form-control" name="funding_mechanism" id="funding_mechanism" type="text" rows="5"   autocomplete="off"><?php echo($row['funding_mechanism']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							
							<div class="col-md-3"><label for="target_date" class="">Target Date of Completion:</label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col11">
										<input name="target_date" id="target_date" type="text" class="form-control " value="<?php echo($row['target_completion']); ?>" autocomplete="off" />
									</div>
								</div>
							<div class="col-md-3"><label for="expd_till_date" class="">Expenditure Till Date(In Cr.):</label></div>
								<div class="col-md-3">
									<div class="position-relative form-group" id = "col9">								
										<input name="expd_till_date" id="expd_till_date" type="text" class="form-control" value="<?php echo($row['expenditure_till_date']); ?>" autocomplete="off" />
											
									</div>
								</div>	
				</div>
				
				
				
				<div class="form-row">
							<div class="col-md-3"><label for="progress" class="">Status:</label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col12">
										
										<textarea class="form-control" name="progress" id="progress" type="text" rows="5"  autocomplete="off"><?php echo($row['progress']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				
				<div class="form-row">
							<div class="col-md-3"><label for="remarks" class="">Remarks:</label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col14">
										<!--<input name="constraints" id="constraints" type="text" class="form-control" />-->
										<textarea class="form-control" name="remarks" id="remarks" type="text" rows="3"  autocomplete="off"><?php echo($row['remarks']); ?></textarea>
									</div>
								</div>
					
								
								
				</div>
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
                                        //if($_POST['implementing_agengy']==""){$_POST['implementing_agengy']=NULL;}
                                        //if($_POST['schedule_date']==""){$_POST['schedule_date']=NULL;}
                                        //if($_POST['target_date']==""){$_POST['target_date']=NULL;}
                                        if($_POST['progress']==""){$_POST['progress']=NULL;}
										
                                        if($_POST['remarks']==""){$_POST['remarks']=NULL;}
										
                                        if(submitScheme($_POST['scheme_name'], $_POST['objective'],$_SESSION['wing_id'], $_POST['scheme_head'], $_POST['estimated_cost'], 
                                        $_POST['sanctioned_cost'], $_POST['funding_mechanism'], $_POST['target_date'], $_POST['expd_till_date'], $_POST['progress'], 
                                        $_POST['remarks'], $_SESSION['name'],$row['id'])){
                                            //header("Location:dashboard.php");
											//echo '<script>window.location.replace("dashboard.php") </script>';
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Scheme details have been succesfully updated!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('dashboard.php');
                                            });
											
                                        </script>");
                                            exit;
                                        }else{
                                            //echo('<span class="insert-error"><i class="fas fa-exclamation-circle"></i> Project Creation Failed!</span>');
											//echo('hi');
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'Scheme Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('dashboard.php');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				
				</div>
                </div>
                </form >
            </div> <!-- //card--> 
			</div>
</div><!--//col12-->

</div><!--//row-->
		
	
</div><!--// container-->

<br><br>
<footer class="page-footer font-small blue pt-4">
<div class="footer-style footer-copyright text-center py-3">
	<span>&#169;2020 Copyright: OPTCL Ltd.</span><br>
	<span>Recommended Browsers: Chrome 80.0+ Firefox 80.0+</span>
</div>
</footer>

	   

<!--==================================================================================JQUERY JS=============-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--==================================================================================BOOT STRAP JS=============-->
	<script src="bootstrap/js/popper.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<!--==================================================================================FONT AWESOME JS=============-->
	<script src="vendor/font-awesome/js/all.js"></script>
<!--==================================================================================CHART JS =============-->
	<script src="vendor/chart.js/Chart.min.js"></script>
<!--==================================================================================LOTTIE PLAYER=============-->
	<script src="vendor/lottie/lottie-player.js"></script>
<!--==================================================================================SITE CUSTOM JS=============-->
	<script src="js/main.js"></script>
	<script src="js/charts.js"></script>
	<script src="js/chart-bar.js"></script>
	   
<!--===============================================================================================-->
    <script src="plug/bs4.5/js/jquery-3.5.1.min.js"></script>
<!--===============================================================================================-->
	<script src="plug/bs4.5/js/bootstrap.bundle.min.js"></script>
<!--===============================================================================================-->
    <script src="plug/ui/jquery-ui.js"></script>   
<!--===============================================================================================-->
    <script src="plug/select2/select2.min.js"></script>   
<!--===============================================================================================-->

	<script>
		$('.dropdown-toggle').click(function () {
			$(this).next('.dropdown-menu').slideToggle(400);
		});

		$('.dropdown-toggle').focusout(function () {
			$(this).next('.dropdown-menu').slideUp(400);
		});
	</script>
	<script>
		$(document).ready(function () {
			showAreaChartPurchase();
			showStackBar();
			showPieChart();
		});
	</script>
	<script>
        function cancelClick() {
            //window.location.replace("home.php");
            Swal.fire({
                title: 'Are you sure to cancel the operation and go back',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.replace("dashboard.php");
                } else if (result.isDenied) {
                    return false;
                }
            })
            return false;
        }
    </script>

    <script>
		$("#schedule_date").datepicker({ dateFormat: 'yy-mm-dd' });
		$("#target_date").datepicker({ dateFormat: 'yy-mm-dd' });
		$("#schedule_date, #target_date").keydown(function(e){
        e.preventDefault();
    });	
        
	</script>
</body>
</html>
