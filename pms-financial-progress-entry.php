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
	$finid = base64_decode($_GET['id']);
                                    
     $result = viewFinancialDetails($finid);
     $rw = mysqli_fetch_array($result);
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
					<h5> Enter Financial Progress:</h5>
				</div>
			</div>
		</div>
		<?php if($rw!= NULL){ ?>
		<div class="text-info ">
			
			<p style="color: orange;font-weight:bold">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw['lastupdate_on']));?></p>
			<a href="pms-financial-progress-view.php?id='.<?php echo base64_encode($rw['project_no'])?>.'"  rel="noopener noreferrer" >Click Here to View</a>
		</div>
		<?php } ?>
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
                                    
                  $result = viewProjectDetails($sid);
				  $result_f1 = viewFinancialProgress($sid);
				  $row_f1 = mysqli_fetch_array($result_f1);
				  
                  $row = mysqli_fetch_array($result);
                  if($row== NULL){
					 //echo nl2br("PROJECT DETAILS HAVE NOT BEEN ENTERED YET !! \n Kindly Enter Project Details First."); 
					 echo('<lottie-player src="vendor/lottie/72311-no-data-found.json"
									background="transparent"  speed="1"  style="width: 300px; height: 250px; margin-left: 35%;"  loop  autoplay></lottie-player>
									
									<h6 class="m-t-20" >Project Details have not been entered yet, Kindly Enter Project Details First. !</h6>
									');
				  }
                  else{
					  
					   if($row_f1!= NULL){ ?>
                 
				 <div class="form-row">
							<div class="col-md-3"><label for="project_name1" class=""><b>Project Name:</b></label></div>
								<div class="col-md-9" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['project_name']); ?></p>
										<!--<textarea class="form-control" name="project_name" id="project_name" type="text" rows="5"  readonly><?php echo($row['project_name']); ?></textarea>-->
									</div>
								</div>
								
								
				</div>
			    <div class="form-row">
							<div class="col-md-3"><label for="fund_type1" class=""><b>Fund Type/ Mode:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col2">
									
										<input name="fund_type1" id="fund_type1" type="text" class="form-control" value="<?php echo($row['fund_type']); ?>" readonly  />
										
									</div>
								</div>
							<div class="col-md-3"><label for="budget_head1" class=""><b>Budget Head:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col2">
										<input name="budget_head1" id="budget_head1" type="text" class="form-control" value="<?php echo($row['budget_head']);?>" readonly  />
										
									</div>
								</div>	
								
				</div>
				
				<div class="form-row">
							<div class="col-md-3"><label for="estimated_cost1" class=""><b>Estimated Cost(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="estimated_cost1" id="estimated_cost1" type="text" class="form-control" value="<?php echo($row['estimated_cost']); ?>" readonly  />
								</div>	
								</div>
							<div class="col-md-3"><label for="awarded_cost1" class=""><b>Awarded Cost(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="awarded_cost1" id="awarded_cost1" type="text" class="form-control" value="<?php echo($row['awarded_cost']); ?>" readonly />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="amended_cost1" class=""><b>Amended Cost(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="amended_cost1" id="amended_cost1" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only" value="<?php echo($row_f1['amended_cost']); ?>" />
									</div>
								</div>
				
				
				
							<div class="col-md-3"><label for="expenditure_done1" class=""><b>Expenditure Done(in Cr.):</b></label></div>
								<div class="col-md-3">
									<div class="position-relative form-group" id = "col2">								
										<input name="expenditure_done1" id="expenditure_done1" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only" value="<?php echo($row_f1['expenditure_done']); ?>" />
											
									</div>
								</div>	
							
								
								
				</div>
				<div class="form-row">
				<div class="col-md-3"><label for="invoices_raised1" class=""><b>Invoices Raised(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="invoices_raised1" id="invoices_raised1" type="text" class="form-control"  onkeypress="return isNumber1(event)" title="Numbers Only" value="<?php echo($row_f1['invoices_raised']); ?>"/>
									</div>
								</div>
				
				
				
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="remarks1" class=""><b>Remarks:</b></label></div>
								<div class="col-md-9">
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="remarks1" id="remarks1" type="text" rows="5" ><?php echo($row_f1['remarks']); ?></textarea>
									</div>
								</div>
							
					
				</div>
				
				
				
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
                                        if($_POST['amended_cost1']==""){$_POST['amended_cost1']=NULL;}
										if($_POST['expenditure_done1']==""){$_POST['expenditure_done1']=NULL;}
                                        if($_POST['remarks1']==""){$_POST['remarks1']=NULL;}
										
                                        if(financialProgress($row['project_no'],$_POST['amended_cost1'], $_POST['expenditure_done1'],$_POST['invoices_raised1'],$_POST['remarks1'], $_SESSION['name'])){
                                            
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Financial Progress of the Project have been succesfully added!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-financial-progress-entry.php?id=".base64_encode($row['project_no'])."');
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
													text: 'Financial Progress Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-financial-progress-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				</div>
				 
				 
				  <?php } else{ ?>
			  </p>
			    <div class="form-row">
							<div class="col-md-3"><label for="project_name" class=""><b>Project Name:</b></label></div>
								<div class="col-md-9" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['project_name']); ?></p>
										<!--<textarea class="form-control" name="project_name" id="project_name" type="text" rows="5"  readonly><?php echo($row['project_name']); ?></textarea>-->
									</div>
								</div>
								
								
				</div>
			    <div class="form-row">
							<div class="col-md-3"><label for="fund_type" class=""><b>Fund Type/ Mode:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col2">
									
										<input name="fund_type" id="fund_type" type="text" class="form-control" value="<?php echo($row['fund_type']); ?>" readonly  />
										
									</div>
								</div>
							<div class="col-md-3"><label for="budget_head" class=""><b>Budget Head:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col2">
										<input name="budget_head" id="budget_head" type="text" class="form-control" value="<?php echo($row['budget_head']);?>" readonly  />
										
									</div>
								</div>	
								
				</div>
				
				<div class="form-row">
							<div class="col-md-3"><label for="estimated_cost" class=""><b>Estimated Cost(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="estimated_cost" id="estimated_cost" type="text" class="form-control" value="<?php echo($row['estimated_cost']); ?>" readonly  />
								</div>	
								</div>
							<div class="col-md-3"><label for="awarded_cost" class=""><b>Awarded Cost(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="awarded_cost" id="awarded_cost" type="text" class="form-control" value="<?php echo($row['awarded_cost']); ?>" readonly />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="amended_cost" class=""><b>Amended Cost(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="amended_cost" id="amended_cost" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only" />
									</div>
								</div>
				
				
				
							<div class="col-md-3"><label for="expenditure_done" class=""><b>Expenditure Done(in Cr.):</b></label></div>
								<div class="col-md-3">
									<div class="position-relative form-group" id = "col2">								
										<input name="expenditure_done" id="expenditure_done" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only" />
											
									</div>
								</div>	
							
								
								
				</div>
				<div class="form-row">
				<div class="col-md-3"><label for="invoices_raised" class=""><b>Invoices Raised(in Cr.):</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="invoices_raised" id="invoices_raised" type="text" class="form-control"  onkeypress="return isNumber1(event)" title="Numbers Only"/>
									</div>
								</div>
				
				
				
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="remarks" class=""><b>Remarks:</b></label></div>
								<div class="col-md-9">
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="remarks" id="remarks" type="text" rows="5" ></textarea>
									</div>
								</div>
							
					
				</div>
				
				
				
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
                                        if($_POST['amended_cost']==""){$_POST['amended_cost']=NULL;}
										if($_POST['expenditure_done']==""){$_POST['expenditure_done']=NULL;}
                                        if($_POST['remarks']==""){$_POST['remarks']=NULL;}
										
                                        if(financialProgress($row['project_no'],$_POST['amended_cost'], $_POST['expenditure_done'],$_POST['invoices_raised'],$_POST['remarks'], $_SESSION['name'])){
                                            
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Financial Progress of the Project have been succesfully added!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-financial-progress-entry.php?id=".base64_encode($row['project_no'])."');
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
													text: 'Financial Progress Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-financial-progress-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				</div>
				<?php } 
				  }?>
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
function isNumber1(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)&& !(charCode == 46 || charCode == 8)) {
        return false;
    }
    return true;
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
