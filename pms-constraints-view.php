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
	<title>Hindrances | e - NIRMAN</title>
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
<link rel="stylesheet" type="text/css" href="plug/ui/jquery-ui.css">


<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
<script src="plug/bs4.5/js/jquery-3.5.1.min.js"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border:  #dddddd;
  text-align: left;
  padding: 6px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
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
					<h5> All Hindrances View:</h5>
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
               
			   <p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                                    
                  //$result = viewHindrances($sid);
				  $result1 = viewProjectDetails($sid);
				  $result2 = viewHindrancesonly($sid);
                  $row1 = mysqli_fetch_array($result1);
				  
				  //$row2 = mysqli_fetch_array($result2);
                  //$row = mysqli_fetch_array($result);
                  
                  ?>
			  </p>
			    
				<p><b style="color:brown;">Project Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row1['project_name']); ?></p>
				<!--<p id="proj_id" name="proj_id"><b style="color:brown;">Project Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row1['project_no']); ?></p>--><br><br>
				
				
				 <table id="dataTable" class="table  table-hover">
						 
						
						   <tr style="color:blue;" class="table-primary">
							<th width="3%"><b>#</b></th>
							
							<th width="17%"><b>Hindrance Nature </b></th>
							<th width="15%"><b>Occurence Date </b></th>
							<th width="40%"><b>Hindrance Details</b></th>
							<th width="20%"><b>Action Taken</b></th>
							<th width="5%"><b>Active</b></th>
						  </tr>
						  <tr class="table-secondary">
						 <?php
						 $row_id=1;
						
						
						  while($row2 = mysqli_fetch_array($result2)){	
						    ?>
							
							<td ><?php echo ($row_id); ?></td>
							
							<td><?php  echo ($row2['hindrance_nature']); ?></td>
							<?php if(($row2['occurence_date']!= "") || ($row2['occurence_date']!= NULL)){ ?>
							<td><?php echo(date("d-m-Y ",strtotime($row2['occurence_date']))); ?></td>
							<?php }
							else { ?>
							<td><?php echo("Not Entered"); ?></td>
							<?php } ?>
							
							<!--<td><?php echo(date("d-m-Y ",strtotime($row2['occurence_date']))); ?></td>-->
							<td><?php echo ($row2['hindrance_details']); ?></td>
							<td><?php echo ($row2['action_taken']); ?></td>
							<!--<td><?php echo ($row2['active']); ?></td>-->
							<?php if($row2['active']=="Y"){echo('
										<td>
										<input type="checkbox" class="toggle_ad" id="sid-'.$row2['id'].'-'.$row1['project_no'].'" checked data-toggle="toggle"
										data-on="Y" data-off="N" data-onstyle="success"
										data-offstyle="danger" data-size="mini">
										</td>
									');
									}
									else{
									echo('
										<td>
										<input type="checkbox" class="toggle_ad" id="sid-'.$row2['id'].'-'.$row1['project_no'].'" data-toggle="toggle"
										data-on="Y" data-off="N" data-onstyle="success"
										data-offstyle="danger" data-size="mini">
										</td>
									');
									}?>
									
							
							
							<?php $row_id++;?>
							
						  </tr>
						 <?php  } ?>
						  
						 
						  
				</table>
					
			</div>
</div><!--//col12-->

</div><!--//row-->
		
	
</div><!--// container-->
<button id="goTop" class="go-top" title="Scroll To Top"><i class="fas fa-arrow-up"></i></button>
<br><br>
<!--======================================================================== Alert Modal ===========================================================-->
<div class="modal fade border" id="alertModal">
  <div class="modal-dialog modal-sm alert-position">
    <div class="modal-content alert-border">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
			<div class="col-sm-2 text-center">
				<img src="images/alert.svg" alt="alert icon" width="30" height="30">
			</div>
			<div class="col-sm-10 p-t-6">
				<h6 class="alert-text" id="alert-message">Alert Message</h6>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
<!--========================================================================= Alert Modal End ======================================================-->
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

<!--===============================================================================================-->
	<script>
		$(document).ready(function() {
		//$('#dataTable').DataTable();
		$('#dataTable').on("change", ".toggle_ad", function(){

			var param_id = $(this).attr('id');
			var param_status = $(this).prop('checked');
			//var project_id=document.getElementById("proj_id").value;
			var project_id=<?php echo ($row1['project_no']); ?>;
			var url = 'api_ad_source.php';
			//var str='param_id,project_id';
			//call to url for activation/deactivation of user
			$.post(url, {key: param_id, action: param_status}, function(result, status){
				if(status == "success"){
					//location.reload(true);
					$('#alert-message').text(result);
					$('#alertModal').modal('show');
					setTimeout(function(){
						$('#alertModal').modal('hide');
					}, 2000);
				}
			});
		});
		});
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
	<script>
		$('.dropdown-toggle').click(function () {
			$(this).next('.dropdown-menu').slideToggle(400);
		});

		$('.dropdown-toggle').focusout(function () {
			$(this).next('.dropdown-menu').slideUp(400);
		});
	</script>
<script src="plug/ui/jquery-ui.js"></script>   
	<script>
		$("#occurence_date").datepicker({ dateFormat: 'yy-mm-dd' });
		
		$("#occurence_date").keydown(function(e){
        e.preventDefault();
    });	
        
	</script>

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
		$("#tentative_date").datepicker({ dateFormat: 'yy-mm-dd' });
		
		$("#tentative_date").keydown(function(e){
        e.preventDefault();
    });	
        
	</script>
</body>
</html>