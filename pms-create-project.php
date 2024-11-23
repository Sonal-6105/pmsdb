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
    if(($_SESSION['type'] != "D")&&($_SESSION['type'] != "M")&&($_SESSION['type'] != "Z")&&($_SESSION['type'] != "U")){
        header("Location:logout.php");
		exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> New Project  |  e - NIRMAN</title>
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

            $("#zone").change(function(){
                var zoneid = $(this).val();
				var deptid = document.getElementById("department").value;
				if(zoneid) {
                $.ajax({
                    url: "getDivision.php",
                    type: "post",
                    data: {zone:zoneid,
						   dept:deptid
						   },
                    dataType: "json",
                    success:function(response){

                        var len = response.length;
						
                       $("#division").empty();
						
						//alert(response);
						$("#division").prepend("<option value=''>Select-Division</option>");
						//$("#division").append("<option value='7'>All Division</option>");
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
														
                            $("#division").append("<option value='"+id+"'>"+name+"</option>");

                        }
						
                    }
                });
				
			}
			else{
				//$("#work_category").empty();
				$('select[name="division"]').empty();
				}
            });

        });
    </script>
	
	
	
<script >
        $(document).ready(function(){

            $("#department").change(function(){
                var deptid = $(this).val();
				//var workid = $(this).val();
				 if(deptid) {
                $.ajax({
                    url: "getWork.php",
                    type: "post",
                    data: {dept:deptid},
                    dataType: "json",
					cache: false,
                    success:function(response){

                        var len = response.length;
						//alert(zoneid);
						//alert(workid);
						//alert(response);
                        $("#work_category").empty();
						
						//$("#work_category").html(response);
						$("#work_category").prepend("<option value=''>Select Work Category</option>");
						//$("#division").append("<option value='7'>All Division</option>");
                      for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
														
                            $("#work_category").append("<option value='"+id+"'>"+name+"</option>");

                        }
						//$('#city-dropdown').html('<option value="">Select State First</option>'); 
                    }
                });
				
				 }
				 else{
				//$("#work_category").empty();
				$('select[name="work_category"]').empty();
				}
				
            });

        });
    </script>
<style>
.control-label:after {
  content:"*";
  color:red;
  font-weight: bold
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
							<div class=" col-md-2"><label for="project_name" class="control-label"><b>Project Name:</b></label></div>
								<div class="col-md-8" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_name" id="project_name" type="text" class="form-control input-lg" required  />
										<!--<textarea class="form-control" name="project_name" id="project_name" type="text" rows="5" required  ></textarea>-->
									</div>
								</div>
							<div class="col-md-1"><label for="project_phase" class=""><b>Phase:</b></label></div>
								<div class="col-md-0.5" >
									<div class="position-relative form-group" id = "col1">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="project_phase" name="project_phase" >
											<option value="0" selected>NIL</option>
											<option value="I">I</option>
											<option value="II">II</option>
											<option value="III">III</option>
											<option value="IV">IV</option>
											<option value="V">V</option>
											<option value="VI">VI</option>
											<option value="VII">VII</option>
											
										</select>
										
										<!--<input name="project_name" id="project_name" type="text" class="form-control"   />
										<textarea class="form-control" name="project_name" id="project_name" type="text" rows="5" required  ></textarea>-->
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="project_description" class="control-label"><b>Project Description:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="project_description" id="project_description" type="text" rows="5" required  ></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="project_site" class="control-label"><b>Substation/Site:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_site" id="project_site" type="text" class="form-control required"   />
										<div class="form-helper">Eg. Pratapsasan S/S or HQRS Office </div>
										<!--<textarea class="form-control" name="project_description" id="project_description" type="text" rows="5" required  ></textarea>-->
									</div>
								</div>
							<div class="col-md-2"><label for="project_line" class=""><b>Associated Lines:</b></label></div>
								<div class="col-md-4" >
									<div class="row-cols-3" id = "col1">
										<div class="col-sm">
											<input type="text" class="form-control"  name="project_line1" id="project_line1">
											<div class="form-helper">Eg. 50kms  X KV Line</div>
										 </div><br>
										 <div class="col-sm">
											<input type="text" class="form-control"  name="project_line2" id="project_line2">
											<!--<div class="form-helper">Eg. 100kms 220KV Line</div>-->
										 </div><br>
										  <div class="col-sm">
											<input type="text" class="form-control"  name="project_line3" id="project_line3">
											<!--<div class="form-helper">Eg. 20kms 132/33KV Line</div>-->
										 </div>
									</div>
								</div>	
								
				</div><br>
				
				<div class="form-row">
							<div class="col-md-2"><label for="department" class="control-label"><b>Department:</b></label></div>
								<div class="col-md-4" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="department" name="department" required>
                                    <option value="" >--Select Department--</option>
                                    <?php
										
										
                                        $typeList = getDepartment();
										
										//echo('<option value="4">All Work</option>');
                                        while($row = mysqli_fetch_assoc($typeList)){
											//echo('<option value="4">'.$row['typeid'].'</option>');
                                            echo('<option value="'.$row['id'].'">'.$row['name'].'</option>');
											
                                        }

                                    ?>
                                </select>
								
								
								</div>
							<div class="col-md-2"><label for="work_category" class=""><b>Type of Work:</b></label></div>
								<div class="col-md-4" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="work_category" name="work_category" required>
                                    <option value="" >--Select Department First--</option>
                                    <?php
										
										
                                        //$typeList = getWorkTypes1();
										
										
                                        /*while($row1 = mysqli_fetch_assoc($typeList)){
											//echo('<option value="4">'.$row['typeid'].'</option>');
                                            echo('<option value="'.$row1['typeid'].'">'.$row1['work_details'].'</option>');
                                        }*/

                                    ?>
                                </select>
								
								</div>
							
				</div>
				<br>
				
				
				<div class="form-row">
							<div class="col-md-2"><label for="zone" class="control-label"><b>Zone:</b></label></div>
								<div class="col-md-4"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" required >
                                    <option value="" >--Select Zone--</option>
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
								
								
								
							<div class="col-md-2"><label for="division" class=""><b>Division:</b></label></div>
							
								<div class="col-md-4"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division"  >
                                    <option value="" >--Select Zone First--</option>
                                    
									</select>
								</div>	
								
				</div><br><br>
				
				<div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
				
				<?php 
                                    if(isset($_POST['submit'])){
                                        if($_POST['project_line1']==""){$_POST['project_line1']=NULL;}
										if($_POST['project_line2']==""){$_POST['project_line2']=NULL;}
                                        if($_POST['project_line3']==""){$_POST['project_line3']=NULL;}
										
                                        if(createNewProject($_POST['project_name'],$_POST['project_phase'],$_POST['project_description'],$_POST['project_site'],$_POST['project_line1'],$_POST['project_line2'],$_POST['project_line3'],$_POST['department'], $_POST['work_category'], $_POST['zone'],$_POST['division'], $_SESSION['name'])){
                                            
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
                                              window.location.replace('pms-create-project.php');
												
                                            });
											
                                        </script>");
                                            exit;
                                        }else{
                                           
											
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
                                                window.location.replace('pms-create-project.php');
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				
				
				
				
				</div>
				<br>
				
				
				 
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
		$(document).ready(function() {
			//$('#loader').hide();
			//$('#loader1').hide();
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
	
</body>
</html>
