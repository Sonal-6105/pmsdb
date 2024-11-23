<?php
	
	error_reporting(1);
	require 'connection.php';
	require 'functions.php';
	session_name('pmsdb');
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	
	if(!$_SESSION['logged_in']){
        header("Location:index.php");
		exit;
    }
    if($_SESSION['type'] != "D"){
        header("Location:logout.php");
		exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> New Project  | Project Management System</title>
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
	<!--==================================================================================DATA TABLE CSS=============-->
<link rel="stylesheet" type="text/css" href="vendor/datatables/dataTables.bootstrap4.min.css">
<!--==================================================================================DATA TOGGLE=============-->
	<link rel="stylesheet" type="text/css" href="vendor/toggle/bootstrap4-toggle.min.css">



<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
<script src="plug/bs4.5/js/jquery-3.5.1.min.js"></script>

<script >
        $(document).ready(function(){

            $("#zone,#work_category").change(function(){
                var zoneid = $(this).val();
				var workid = $(this).val();
                $.ajax({
                    url: "getDivision.php",
                    type: "post",
                    data: {zone:zoneid},
                    dataType: "json",
                    success:function(response){

                        var len = response.length;
						//alert(zoneid);
						//alert(workid);
						//alert(response);
                        $("#division").empty();
						
						
						$("#division").prepend("<option value=''>Select Division</option>");
						//$("#division").append("<option value='7'>All Division</option>");
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
														
                            $("#division").append("<option value='"+id+"'>"+name+"</option>");

                        }
						
                    }
                });
            });

        });
    </script>

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
		<ul class="navbar-nav hvr-underline-from-center ">
						<li class="nav-item">
						<a class="nav-link" href="pms-published_documents.php">Published Documents</a>
						</li>
		</ul>

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
                    <p class="dropdown-item nav-drop-ip"><b>Wing:</b> <?php echo($_SESSION['wing']); ?></p>
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
					<h5>Enter New Project:</h5>
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
               <form class="" method="post" enctype="multipart/form-data" action="" autocomplete="off"> 
			   
			    <div class="form-row">
							<div class="col-md-3"><label for="project_name" class="">Project Name:</label></div>
								<div class="col-md-9" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="project_name" id="project_name" type="text" rows="5" required  ></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="work_category" class="">Type of Work:</label></div>
								<div class="col-md-3" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="work_category" name="work_category" required>
                                    <option value="0" selected>Select Work Category</option>
                                    <?php
										
										
                                        $typeList = getWorkTypes();
										
										//echo('<option value="4">All Work</option>');
                                        while($row = mysqli_fetch_assoc($typeList)){
											//echo('<option value="4">'.$row['typeid'].'</option>');
                                            echo('<option value="'.$row['typeid'].'">'.$row['work_details'].'</option>');
                                        }

                                    ?>
                                </select>
								
								</div>
							
								
				</div>
				<br>
				<div class="form-row">
							<div class="col-md-3"><label for="zone" class="">Zone:</label></div>
								<div class="col-md-3"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" required >
                                    <option value="0" selected>Select Zone</option>
                                    <?php
										
                                        $typeList = getZoneTypes();
										//echo('<option value="3">All Zone</option>');
                                        while($row = mysqli_fetch_assoc($typeList)){
											//echo('<option value="">'.$row['zone-id'].'</option>');
                                            echo('<option value="'.$row['zone-id'].'">'.$row['zone-name'].'</option>');
                                        }

                                    ?>
                                </select>
								</div>
								
								
								
							<div class="col-md-3"><label for="division" class="">Division:</label></div>
							
								<div class="col-md-3"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division" required >
                                    <option value="0" selected>Select Division</option>
                                    
									</select>
								</div>	
								
				</div>
				<div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return clearForm(this.form);">Clear</button>
				
				<?php 
                                    if(isset($_POST['submit'])){
                                        
										//echo('hello');
                                        if(createNewProject($_POST['project_name'],$_SESSION['wing_id'], $_POST['work_category'], $_POST['zone'],$_POST['division'], $_SESSION['name'])){
                                            
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'New Project has been succesfully created !',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-dashboard.php');
                                            });
											
                                        </script>");
                                            exit;
                                        }else{
                                            //echo('<span class="insert-error"><i class="fas fa-exclamation-circle"></i> Project Creation Failed!</span>');
											
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'Project Creation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-dashboard.php');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				
				
				
				
				</div>
				<br>
				
				
				<!--<?php echo($_SESSION['wing_id']);
				echo('<br>');
				echo($row['id']);
				echo('<br>');
				echo($_SESSION['name']);
				
				
				?>-->
				
				 
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

<script src="vendor/jquery/jquery-3.5.1.js"></script>
<!--==================================================================================BOOT STRAP JS=============-->
	<script src="bootstrap/js/popper.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

<!--==================================================================================DATA TABLES JS=============-->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!--==================================================================================DATA TOGGLE JS=============-->
	<script src="vendor/toggle/bootstrap4-toggle.min.js"></script>
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
	
</body>
</html>
