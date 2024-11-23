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
	$bgid = base64_decode($_GET['id']);
                                    
     $result = viewBGDetails($bgid);
     $rw = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BG Details |  e - NIRMAN</title>
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
					<h5> Enter BG Details:</h5>
				</div>
			</div>
		</div>
		<?php if($rw!= NULL){ ?>
		<div class="text-info ">
			
			<p style="color: orange;font-weight:bold">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw['lastupdate_on']));?></p>
			<a href="pms-bg-info-view.php?id='.<?php echo base64_encode($rw['project_no'])?>.'"  rel="noopener noreferrer" >Click Here to View All BGs</a>
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
				
                  //$bgid = base64_decode($_GET['id']);                 
                  $result1 = viewProjectDetails($bgid);
                  $row = mysqli_fetch_array($result1);
				  if($row== NULL){
					 //echo nl2br("PROJECT DETAILS HAVE NOT BEEN ENTERED YET !! \n Kindly Enter Project Details First."); 
					 echo('<lottie-player src="vendor/lottie/77703-no-data-found.json"
									background="transparent"  speed="1"  style="width: 300px; height: 250px; margin-left: 35%;"  loop  autoplay></lottie-player>
									
									<h6 class="m-t-20" >Project Details have not been entered yet, Kindly Enter Project Details First. !</h6>
									');
				  }
                  else{
                  ?>
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
							<div class="col-md-3"><label for="fund_type" class=""><b>Agency Name:</b></label></div>
								<div class="col-md-9" >
									<div class="position-relative form-group" id = "col2">
										<p><?php echo($row['agency_name']); ?></p>
										<!--<input name="fund_type" id="fund_type" type="text" class="form-control" value="<?php echo($row['fund_type']); ?>" readonly  />-->
										
									</div>
								</div>
							
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="fund_type" class=""><b>Work Order Details:</b></label></div>
								<div class="col-md-9" >
									<div class="position-relative form-group" id = "col2">
										<p><?php echo($row['woDetails']); ?></p>
										<!--<input name="fund_type" id="fund_type" type="text" class="form-control" value="<?php echo($row['fund_type']); ?>" readonly  />-->
										
									</div>
								</div>
							
								
				</div>
				
				<div class="form-row">
							<div class="col-md-3"><label for="bg_name" class=""><b>BG Name:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="bg_name" name="bg_name" >
											<option value="0" selected>Select BG Name</option>
											<option value="CPBG">CPBG</option>
											<option value="SUPPLY BG">SUPPLY BG</option>
											<option value="ERECTION BG">ERECTION BG</option>
											<option value="AMC BG">AMC BG</option>
											<option value="Amended-CPBG">Amended-CPBG</option>
											<option value="Amended-SUPPLY BG">Amended-SUPPLY BG</option>
											<option value="Amended-ERECTION BG">Amended-ERECTION BG</option>
											<option value="Amended-AMC BG">Amended-AMC BG</option>
											
										</select>
										
										
								</div>	
								</div>
							<div class="col-md-3"><label for="bg_number" class=""><b>BG Number:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="bg_number" id="bg_number" type="text" class="form-control"  />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="issued_bank" class=""><b> Issued Bank:</b></label></div>
								<div class="col-md-3">
									<div class="position-relative form-group" id = "col2">								
										<input name="issued_bank" id="issued_bank" type="text" class="form-control" onkeypress="return lettersOnly(event)" title="Characters Only"  />
											
									</div>
								</div>	
							<div class="col-md-3"><label for="bg_amount" class=""><b>BG Amount:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="bg_amount" id="bg_amount" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only"  />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-3"><label for="issued_date" class=""><b> Issued Date:</b></label></div>
								<div class="col-md-3">
									<div class="position-relative form-group" id = "col2">								
										<input name="issued_date" id="issued_date" type="text" class="form-control"   />
											
									</div>
								</div>	
							<div class="col-md-3"><label for="expiry_date" class=""><b>Expiry Date:</b></label></div>
								<div class="col-md-3" >
									<div class="position-relative form-group" id = "col1">
										<input name="expiry_date" id="expiry_date" type="text" class="form-control"   />
									</div>
								</div>
								
								
				</div>
				
			
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
                                        if($_POST['cleared_amount']==""){$_POST['cleared_amount']=NULL;}
										if($_POST['outstanding_amount']==""){$_POST['outstanding_amount']=NULL;}
                                        if($_POST['remarks']==""){$_POST['remarks']=NULL;}
										$active="Y";
                                        if(bgDetails($row['project_no'],$_POST['bg_name'], $_POST['bg_number'],$_POST['issued_bank'],$_POST['bg_amount'],$_POST['issued_date'],$_POST['expiry_date'],$active, $_SESSION['name'])){
                                            
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'BG Details of the Project have been succesfully added!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                               window.location.replace('pms-bg-info-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                            exit;
                                        }else{
                                            
											
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'BG Details Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-bg-info-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				</div>
				<?php } ?>
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

<script src="plug/ui/jquery-ui.js"></script>   
	<script>
		$("#issued_date,#expiry_date").datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		yearRange: "-100:+10",
		changeYear: true,
			
		});
		
		$("#issued_date,#expiry_date").keydown(function(e){
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
<script>
function lettersOnly(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 31 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)&& (charCode == 46 || charCode == 8)) {
          //alert("Enter letters only.");
          return false;
       }
       return true;
     }
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
	
	<script src="plug/ui/jquery-ui.js"></script>   
	<script>
		$("#scheduled_date,#scheduled_date1,#license_validity,#license_validity1").datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		yearRange: "-100:+0",
		changeYear: true,		});
		
		$("#scheduled_date,#scheduled_date1,#license_validity,#license_validity1").keydown(function(e){
        e.preventDefault();
    });	
      
	</script>
	
</body>
</html>
