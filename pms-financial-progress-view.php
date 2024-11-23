<?php
	
	error_reporting(0);
	require 'connection.php';
	require 'functions.php';
	session_name('pmsdb');
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	
	if(!$_SESSION['logged_in']){
        header("Location:index.php");
		exit;
    }
   if(($_SESSION['type'] != "D")&&($_SESSION['type'] != "M")&&($_SESSION['type'] != "U")&&($_SESSION['type'] != "Z")){
        header("Location:logout.php");
		exit;
    }
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Financial Progress | e - NIRMAN</title>
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
<style>
#goTop {
bottom: 80px; /* Place the button at the bottom of the page */
background-color: orange;
font-size: 23px;
}
#goTop:hover {
  background-color: darkviolet; /* Add a dark-grey background on hover */
}

</style>
</head>


<body style="padding-top:80px; background:#f8f9fc;">
<nav class="navbar navbar-expand-sm bg-light fixed-top shadow-sm">
	<a class="navbar-brand p-l-20" href="#">
		<img src="images/logo.jpg" width="40" height="40" alt="GRIDCO" loading="lazy">
		<span class="brand-title p-l-10">e - <b style="font-size: 26px;">N</b>IRMAN</span>
	</a>
    <div class="navbar-collapse justify-content-end">
		<ul class="navbar-nav hvr-underline-from-center p-r-5">
			<li class="nav-item">
			<?php	
			if($_SESSION['type'] == "D"){ 
				echo('<a class="nav-link current-page" href="pms-dashboard.php">Dashboard</a>');									
				
				}
				if(($_SESSION['type'] == "M")||($_SESSION['type'] == "U")||($_SESSION['type'] == "Z")){
				
				echo('<a class="nav-link current-page" href="pms-manager.php">Dashboard</a>');
				}
			?>
			</li>
		</ul>
		<ul class="navbar-nav hvr-underline-from-center ">
						<li class="nav-item">
						<a class="nav-link" href="pms-published_documents.php">Published Documents</a>
						</li>
		</ul>

		<!--<?php
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
			if($_SESSION['type'] == "D"){
				echo('
					<ul class="navbar-nav hvr-underline-from-center ">
						<li class="nav-item">
						<a class="nav-link" href="pms-published-document.php">Published Documents</a>
						</li>
					</ul>
					<!--<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="contribution.php">Contribute</a>
						</li>
					</ul>
				');
			}
		?>
		-->
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
					<h5> View Financial Progress:</h5>
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
			   <p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                                    
                  $result = viewFinancialProgress($sid);
                  $row = mysqli_fetch_array($result);
                  
                  ?>
			  </p>
			    <div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="project_name" class="">Project Name:</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['project_name']); ?></p>
										<!--<textarea class="form-control" name="project_name" id="project_name" type="text" rows="5"  readonly><?php echo($row['project_name']); ?></textarea>-->
									</div>
								</div>
								
								
				</div>
			    <div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="fund_type" class="">Fund Type/ Mode:</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col2">
										<p><?php echo($row['fund_type']); ?></p>
										<!--<input name="fund_type" id="fund_type" type="text" class="form-control" value="<?php echo($row['fund_type']); ?>" readonly  />-->
										
									</div>
								</div>
								
				</div>				
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="budget_head" class="">Budget Head:</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col2">
										<p><?php echo($row['budget_head']); ?></p>
										<!--<input name="budget_head" id="budget_head" type="text" class="form-control" value="<?php echo($row['budget_head']);?>" readonly  />-->
										
									</div>
								</div>	
								
				</div>
				
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="estimated_cost" class="">Estimated Cost(in Cr.):</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['estimated_cost']); ?></p>
										<!--<input name="estimated_cost" id="estimated_cost" type="text" class="form-control" value="<?php echo($row['estimated_cost']); ?>" readonly  />-->
								</div>	
								</div>
								
								
				</div>				
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="awarded_cost" class="">Awarded Cost(in Cr.):</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['awarded_cost']); ?></p>
										<!--<input name="awarded_cost" id="awarded_cost" type="text" class="form-control" value="<?php echo($row['awarded_cost']); ?>" readonly />-->
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="amended_cost" class="">Amended Cost(in Cr.):</label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col2">								
										<p><?php echo($row['amended_cost']); ?></p>
										<!--<input name="cleared_amount" id="cleared_amount" type="text" class="form-control"   />-->
											
									</div>
								</div>	
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="expenditure_done" class="">Expenditure Done(in Cr.):</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['expenditure_done']); ?></p>
										<!--<input name="outstanding_amount" id="outstanding_amount" type="text" class="form-control"   />-->
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="invoices_raised" class="">Invoices Raised(in Cr.):</label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['invoices_raised']); ?></p>
										<!--<input name="outstanding_amount" id="outstanding_amount" type="text" class="form-control"   />-->
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2" style="color:brown;"><label for="remarks" class="">Remarks:</label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['remarks']); ?></p>
										<!--<textarea class="form-control" name="remarks" id="remarks" type="text" rows="5" ></textarea>-->
									</div>
								</div>
							
					
				</div>
				
				
				
				
				 
                </div>
                </form >
            </div> <!-- //card--> 
			</div>
</div><!--//col12-->

</div><!--//row-->
		
	
</div><!--// container-->
<button id="goTop" class="go-top" title="Scroll To Top"><i class="fas fa-arrow-up"></i></button>
<br><br>
<footer class="page-footer font-small blue pt-4">
<div class="footer-style footer-copyright text-center py-3" style="height: 65px;">
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
                    window.location.replace("pms-dashboard.php");
                } else if (result.isDenied) {
                    return false;
                }
            })
            return false;
        }
    </script>
	<script>
		$(document).ready(function() {
			
			mybutton = document.getElementById("goTop");
			window.onscroll = function() {scrollFunction()};
			function scrollFunction() {
  			if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    			mybutton.style.display = "block";
  			} else {
    			mybutton.style.display = "none";
  			}
			}
			$('#goTop').click(function(){
				$("html, body").animate({ scrollTop: 0 }, "slow");
			});
		});
	</script>
</body>
</html>
