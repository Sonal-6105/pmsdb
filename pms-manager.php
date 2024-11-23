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
    if(($_SESSION['type'] != "M")&&($_SESSION['type'] != "U")&&($_SESSION['type'] != "Z")){
		
        header("Location:logout.php");
		exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard| e - NIRMAN</title>
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
.notif-surround{
  overflow:hidden;
  display: inline-block;
}
</style>
</head>


<body style="padding-top:80px; background:#f8f9fc;">
<nav class="navbar navbar-expand-sm bg-light fixed-top shadow-sm">
	<a class="navbar-brand p-l-20" href="#">
		<img src="images/logo.jpg" width="40" height="40" alt="OPTCL" loading="lazy">
		<span class="brand-title p-l-10">e - <b style="font-size: 26px;">N</b>IRMAN</span>
	</a>
    <div class="navbar-collapse justify-content-end">
		<ul class="navbar-nav hvr-underline-from-center p-r-5">
			<li class="nav-item">
			<a class="nav-link current-page" href="pms-manager.php">Dashboard</a>
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
					<!--<ul class="navbar-nav hvr-underline-from-center ">
						<li class="nav-item">
						<a class="nav-link" href="pms-published-document.php">Published Documents</a>
						</li>
					</ul>
					<ul class="navbar-nav hvr-underline-from-center">
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
                    <p class="dropdown-item nav-drop-ip"><b>email-id:</b> <?php echo($_SESSION['name']); ?></p>
					<p class="dropdown-item nav-drop-ip"><b>Last Log-in Info:</b> <?php echo($_SESSION['last_login']); ?></p>
					<!--<p class="dropdown-item nav-drop-ip"><b>IP address:</b> <?php echo($_SESSION['ip']); ?></p>-->
           
            </div>
			</div>
			</li>
		</ul>
		
		
	</div>
</nav>

			
<div class="container-fluid p-l-50 p-r-50">
	<div class="row " >
		  <div class="col-auto mr-auto " style="width:600px">
		 
			<span class="welcome-heading">Welcome, User !!
			
		  </div>
		<!--<div class="p-2 dash-info">
			
			<a href="pms-create-project.php" class="btn btn-info" role="button">ADD NEW PROJECT</a>
			
	</div>-->
	</div>
	
<!--========================================================= HEADING END ======================================================-->
	<div class="row m-t-30 m-b-20">
		
		
		<div class="col-sm-12" id="mtable" >
			<div class="card text-center">
				<h5 class="card-header card-heading">Project List</h5>
				<!--<?php echo($_SESSION['parent_id']); ?>-->
				<div class="card-body" id="Grid">
					<?php
					
					$id=sourceCount();
					
					
						if($id ==0){
							echo('
							<lottie-player src="vendor/lottie/70332-no-data-animation.json" background="transparent"  speed="1"  style="width: 300px; height: 230px; margin-left: 35%;"  loop  autoplay></lottie-player>
							
							<h6 class="m-t-20" >No Projects added in the system yet!</h6>
							');
						}
						else{
							
					if($_SESSION['type'] == "Z"){ 
					$table_data = fetchAllZoneManager($_SESSION['parent_id'],$_SESSION['wing_id']);		
					//$table_data = fetchAllDepartmentManager($_SESSION['wing_id']);	
					
					}	
					if($_SESSION['type'] == "U"){ 
					$table_data = fetchAllDepartmentManager($_SESSION['wing_id']);								
					
					}
					if($_SESSION['type'] == "M"){
					
					$table_data = fetchAllSourceManager($_SESSION['name']);
					}
		
							//$table_data = fetchAllSourceManager($_SESSION['name']);
							echo('
							<table class="table table-sm table-bordered table-striped" id="dataTable">
								<thead class="table-primary">
									<tr>
										<th scope="col" width="5%">#</th>
										<th scope="col" width="55%">Project Name</th>
										<th scope="col">Action</th>
										
									</tr>
								</thead>
							');
							echo('<tbody class="table-data">');
							$row_id=1;
							while($row = mysqli_fetch_assoc($table_data)){
								$unreadNotiCount=getUnreadNotiCount($row['project_no'],$_SESSION['name']);
								//echo($row['project_no']);
								//echo($unreadNotiCount);
								//echo($_SESSION['name']);
								echo('<tr>');
								
								echo('<td>'.$row_id.'</td>');
								echo('<td id="stdname" style="text-align:left;vertical-align:middle">'.$row['project_name'].'</td>');
								echo('<td  data-toggle="tooltip" >
								<a href="pms-project-details-entry.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="Enter Project details"><span class="action-history"><i class="fa fa-eye" style="color:black"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="pms-physical-progress-entry.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="Enter Physical Proress"><span class="action-history"><i class="fas fa-stream" style="color:green"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="pms-financial-progress-entry.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="Enter Financial Proress"><span class="action-history"><i class="fa fa-university"  style="color:#0099ff"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="pms-bg-info-entry.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="Enter BG details"><span class="action-history"><i class="fas fa-money-check-alt"  style="color:#800080"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="pms-constraints-entry.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="Enter Hindrances"><span class="action-history"><i class="fa fa-exclamation-triangle" style="color:red"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="pms-documents-entry.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="Enter Documents"><span class="action-history"><i class="fas fa-folder-open" style="color: #dde01d"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="pms-view-chat.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="View Notification"><span class="action-history"><i class="fas fa-bell" style="color:black;font-size:18px;"></i></span></a>
								
						 <?php if('.$unreadNotiCount.'){?>
							<p class="notif-surround" style="color:red";><b>'.$unreadNotiCount.'</b></p>
						<?php	} ?>
  
								</td>');
								
								
								echo('</tr>');
								$row_id++;
							}
							echo('</tbody>');
							echo('</table>');
						}
					?>
				</div><!--grid
			
				-->
				
			</div>
		</div>

	</div>
	
</div>
					


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
<!--===============================================================================================-->




	<script>
  
        /* Initialization of datatable */
        $(document).ready(function() {
            $('#dataTable').DataTable({ 
			//$("#stdname").addClass("highlighted");
			
			});
        });
    </script>
	
	<!--<script>
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
                    window.location.replace("pms-mainpage.php");
                } else if (result.isDenied) {
                    return false;
                }
            })
            return false;
        }
    </script>
	<script>
                function clearForm(form) {
                    var $f = $(form);
                    var $f = $f.find(':input').not(':button, :submit, :reset, :hidden');
                    $f.val('').attr('value','').removeAttr('checked').removeAttr('selected');
                }
	</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
	
	<!--==================================================================================JQUERY JS=============-->
	<script src="vendor/jquery/jquery-3.5.1.js"></script>
<!--==================================================================================BOOT STRAP JS=============-->
	<script src="bootstrap/js/popper.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<!--==================================================================================FONT AWESOME JS=============-->
	<script src="vendor/font-awesome/js/all.js"></script>
<!--==================================================================================SITE CUSTOM JS=============-->
	<script src="js/main.js"></script>
<!--==================================================================================DATA TABLES JS=============-->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!--==================================================================================DATA TOGGLE JS=============-->
	<script src="vendor/toggle/bootstrap4-toggle.min.js"></script>
<!--===============================================================================================-->
	
	
<script>

    $('#register').submit(function(e){
    e.preventDefault(); // Prevent Default Submission

            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var email = $("#email").val();
            var dataString = 'fname='+ fname + '&lname='+ lname + '&email='+ email;
            $.ajax(
            {
                url:'process.php',
                type:'POST',
                data:dataString,
                success:function(data)
                {
                    // $("#table-container").html(data);
                    $("#register")[0].reset();
                },
            });
        });
</script>
	<!--<script>
		$(document).ready(function() {
		$('#dataTable').DataTable();
		$('#dataTable').on("change", ".toggle_ad", function(){

			var param_id = $(this).attr('id');
			var param_status = $(this).prop('checked');
			var url = 'api_ad_source.php';
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
	</script>-->
	</script>
		
	
</body>
</html>


