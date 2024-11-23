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
   // if($_SESSION['type'] != "M"){
	if(($_SESSION['type'] != "M")&&($_SESSION['type'] != "U")&&($_SESSION['type'] != "Z")){
        header("Location:logout.php");
		exit;
    }
	
	$pid = base64_decode($_GET['id']);
	setStatus($pid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Talking Points | e - NIRMAN</title>
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
<style>
body {font-family: Arial;}



/* Style the tab content */
.tabcontent {
  
  padding: 6px 6px;
  border: 1px solid #ccc;
  
  border-top: none;
  border-bottom: 50000px;
}
.main_content{
	
}


</style>
<style>

main .triangle1{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 0 8px 8px 8px;
	border-color: transparent
	transparent #6fbced transparent;
	margin-right:20px;
	float:right;
	clear:both;
}
main .message1{
	padding:10px;
	color:#000;
	margin-right:15px;
	background-color:#6fbced;
	line-height:20px;
	max-width:90%;
	display:inline-block;
	text-align:left;
	border-radius:5px;
	float:right;
	clear:both;
}


</style>


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
			if($_SESSION['type'] == "M"){
				echo('
					<!--<ul class="navbar-nav hvr-underline-from-center">
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
			
		?>-->
		
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

			
<div class="container-fluid">
	<div class="row " >
		  <div class="col-auto mr-auto " style="width:600px">
		  
			<span class="welcome-heading">Welcome, User !!
		  </div>
		
	</div>
<br>
<!--========================================================= HEADING END ======================================================-->
<div class="row">
<div class="col-md-12">
			<div class="col-sm-auto text-left small text-muted">
			<div class="card">
			<div class="main_content">
				<h5 class="card-header card-heading text-center">Talking Points</h5>
				<div id="Talking Points" class="tabcontent ">
				<main >
					
					<?php
				
						  $timestamp = date("Y-m-d H:i:s");				
						  $result4 = viewChats($pid);
						  $result = viewProjectDetails($pid);
						  $row = mysqli_fetch_array($result);
						  while($row4 = mysqli_fetch_array($result4)){
							  
						  ?>
					
					<div class="inner_div" id="chathist">
					
								<div id="triangle1" class="triangle1"></div>
								<div id="message1" class="message1">
								<span style="color:black;float:right;font-size:15px;">
								<?php echo ($row4['message']); ?>
								</span> <br/>
								<div>
								<span style="color:white;float:left;
								font-size:10px;clear:both;">
								<?php echo ($row4['sent_by']); ?>, <?php echo date("d-m-Y H:i:s ",strtotime($row4['sent_time'])); ?>
								</span>
								</div>
								</div>
								<br/><br/>
								
									
									
									
					</div>
							<?php 
						
							}
						 
						  ?>
						
					<p>
                 <?php
				
				 // echo($row);
				 /*if($row== NULL){
					 echo("PROJECT DETAILS HAVE NOT BEEN ENTERED YET !!"); 
				  }
                  else{*/
				
                  ?>
					</p>
					<form class="" method="post" enctype="multipart/form-data" action="" autocomplete="off"> 
					  <div class="form-row">
							<div class="col-md-2"><label for="talking_point" class="">Talking Point(if any):</label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="talking_point" id="talking_point" type="text" rows="5" required ></textarea>
									</div>
								</div>
				<?php 
				$res = viewChats($pid);
				$row5 = mysqli_fetch_array($res);
				
					?>
					 </div>
					
						 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
                                       
										$status="unread";
                                        if(insertChat($row['project_no'],$_SESSION['name'],$_POST['talking_point'],$timestamp,$row5['sent_by'],$status)){
                                       
                                            
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Message sent succesfully !',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-manager.php');
                                            });
											
                                        </script>");
                                            exit;
                                        }else{
                                            
											
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'Message not sent!!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-manager.php');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
					</div>
					</form >
					
						
						
					</main>			
				</div>
				
				</div><br><br>
				</div> 
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
                    window.location.replace("pms-manager.php");
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


