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
   if(($_SESSION['type'] != "D")&&($_SESSION['type'] != "M")&&($_SESSION['type'] != "U")&&($_SESSION['type'] != "Z")){
        header("Location:logout.php");
		exit;
    }
	$detailid = base64_decode($_GET['id']);
                                    
     $result = viewDetails($detailid);
     $rw = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Project Details | e - NIRMAN</title>
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
<link rel="stylesheet" type="text/css" href="plug/select2/select2.min.css">

<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
<script src="plug/bs4.5/js/jquery-3.5.1.min.js"></script>
<script >
        $(document).ready(function(){

            $("#zone,#department").change(function(){
                var zoneid = $(this).val();
				var deptid = document.getElementById("department").value;
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
            });

        });
    </script>
	
	
	
<script >
        $(document).ready(function(){

            $("#department").change(function(){
                var deptid = $(this).val();
				//var workid = $(this).val();
                $.ajax({
                    url: "getWork.php",
                    type: "post",
                    data: {dept:deptid},
                    dataType: "json",
                    success:function(response){

                        var len = response.length;
						
                        $("#work_category").empty();
						
						
						$("#work_category").prepend("<option value=''>Select Work Category</option>");
						//$("#division").append("<option value='7'>All Division</option>");
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
														
                            $("#work_category").append("<option value='"+id+"'>"+name+"</option>");

                        }
						
                    }
                });
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
					<h5>Enter Project Details:</h5>
				</div>
			</div>
			
		</div>
		<?php if($rw!= NULL){ ?>
		<div class="text-info ">
			
			<p style="color: orange;font-weight:bold">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw['lastupdate_time']));?></p>
			
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
                                    
                  $result = viewProject($sid);
				  $output = viewProjectDetails($sid);
				  
                  $row = mysqli_fetch_array($result);
				  $line = mysqli_fetch_array($output);
                   if($line!= NULL){ ?>
					 
					 <div class="form-row">
							<div class="col-md-2"><label for="project_name" class=""><b>Project Name:</b></label></div>
								<div class="col-md-8" >
									<div class="position-relative form-group" id = "col1">
										
										<input name="project_name" id="project_name" type="text" class="form-control" value="<?php echo($line['project_name']); ?>">
										
									</div>
								</div>
							<div class="col-md-1"><label for="project_phase" class=""><b>Phase:</b></label></div>
								<div class="col-md-0.5" >
									<div class="position-relative form-group" id = "col1">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="project_phase" name="project_phase" >
											<option value="0"<?php echo ($line['project_phase'] == "0") ? "selected" : ""; ?>>NIL</option>
											<option value="I"<?php echo ($line['project_phase'] == "I") ? "selected" : ""; ?>>I</option>
											<option value="II" <?php echo ($line['project_phase'] == "II") ? "selected" : ""; ?>>II</option>
											<option value="III"<?php echo ($line['project_phase'] == "III") ? "selected" : ""; ?>>III</option>
											<option value="IV"<?php echo ($line['project_phase'] == "IV") ? "selected" : ""; ?>>IV</option>
											<option value="V" <?php echo ($line['project_phase'] == "V") ? "selected" : ""; ?>>V</option>
											<option value="VI"<?php echo ($line['project_phase'] == "VI") ? "selected" : ""; ?>>VI</option>
											<option value="VII"<?php echo ($line['project_phase'] == "VII") ? "selected" : ""; ?>>VII</option>
											
										</select>
										
										
									</div>
								</div>	
							
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="project_description" class=""><b>Project Description:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="project_description" id="project_description" type="text" rows="5"  ><?php echo($line['project_description']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="project_site" class=""><b>Substation/Site:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_site" id="project_site" type="text" class="form-control required" value="<?php echo($line['project_site']); ?>"  />
										<!--<div class="form-helper">Eg. Pratapsasan S/S or HQRS Office </div>-->
										
									</div>
								</div>
								
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="project_line" class=""><b>Associated Lines:</b></label></div>
								<div class="col-md-10" >
									
										<div class="col-sm">
											<input type="text" class="form-control"  name="project_line1" id="project_line1" value="<?php echo($line['project_line1']); ?>">
											<div class="form-helper">Eg. 50kms  X KV Line</div>
										 </div><br>
										 <div class="col-sm">
											<input type="text" class="form-control"  name="project_line2" id="project_line2" value="<?php echo($line['project_line2']); ?>">
											<!--<div class="form-helper">Eg. 100kms 220KV Line</div>-->
										 </div><br>
										  <div class="col-sm">
											<input type="text" class="form-control"  name="project_line3" id="project_line3" value="<?php echo($line['project_line3']); ?>">
											<!--<div class="form-helper">Eg. 20kms 132/33KV Line</div>-->
										 </div>
									
								</div>	
								
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="department" class="control-label"><b>Department:</b></label></div>
								<div class="col-md-4" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="department" name="department" required>
                                     <!--<option value="0" >Select Department</option>-->
                                    <?php
										
										
                                        $typeList = getDepartment();
										
										
                                        while($rw1 = mysqli_fetch_assoc($typeList)){ ?>
											
                                            
											<option value="<?php echo $rw1['id']; ?>"<?php if($line['department_id']==$rw1['id']) {echo 'selected="selected"'; }?>><?php echo $rw1['name']; ?></option>
											
										<?php }

                                    ?>
                                </select>
								
								</div>
							<div class="col-md-2"><label for="work_category" class=""><b>Type of Work:</b></label></div>
								<div class="col-md-4" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="work_category" name="work_category" required>
                                    <!--<option value="0" selected>Select Work Category</option>-->
                                    <?php
										
										
                                        $typeList = getWorkTypes($line['department_id']);
										
										//echo('<option value="4">All Work</option>');
                                        while($rw = mysqli_fetch_assoc($typeList)){ ?>
											
                                           
											<option value="<?php echo $rw['typeid']; ?>"<?php if($line['work_typeid']==$rw['typeid']) echo 'selected="selected"'; ?>><?php echo $rw['work_details']; ?></option>
                                      <?php  }

                                    ?>
                                </select>
								
								</div>
								
				</div>
				<br>
				<div class="form-row">
							<div class="col-md-2"><label for="zone" class="control-label"><b>Zone:</b></label></div>
								<div class="col-md-4"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" required >
                                    <!--<option value="0" selected>Select Zone</option>-->
                                    <?php
										
                                        $typeList = getZoneTypes();
										
                                        while($rw = mysqli_fetch_assoc($typeList)){ ?>
											
                                            
                                            
											<option value="<?php echo $rw['zone-id']; ?>"<?php if($line['zone_id']==$rw['zone-id']) echo 'selected="selected"'; ?>><?php echo $rw['zone-name']; ?></option>
                                        <?php }

                                    ?>
                                </select>
								</div>
								
								
								
							<div class="col-md-2"><label for="division" class=""><b>Division:</b></label></div>
							<?php 
							$response = viewDiv($line['div_id']);
				            $col = mysqli_fetch_array($response);?>
								<div class="col-md-4"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division"  >
                                    <option value="<?php echo $col['div_id']; ?>" selected><?php echo $col['div_name']; ?></option>
									
                                    
									</select>
								</div>	
								
				</div><br><br>
				<div class="form-row">
							<div class="col-md-2"><label for="scope_of_work1" class=""><b>Scope of Work:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="scope_of_work1" id="scope_of_work1" type="text" rows="5"  ><?php echo($line['scope_of_work']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="fund_type1" class=""><b>Fund Type/ Mode:</b></label></div>
								<div class="col-md-4" >
								<div class="position-relative form-group" id = "col2">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="fund_type1" name="fund_type1" value="<?php echo($line['fund_type']); ?>">
											<option value="0" selected>Select Fund Type</option>
											<option value="OPTCL OWN" <?php echo ($line['fund_type'] == "OPTCL OWN") ? "selected" : ""; ?>>OPTCL OWN</option>
											<option value="JICA" <?php echo ($line['fund_type'] == "JICA") ? "selected" : ""; ?>>JICA</option>
											<option value="SCRIPS EHV" <?php echo ($line['fund_type'] == "SCRIPS EHV") ? "selected" : ""; ?>>SCRIPS EHV</option>
											<option value="SCRIPS HV" <?php echo ($line['fund_type'] == "SCRIPS HV") ? "selected" : ""; ?>>SCRIPS HV</option>
											<option value="IPDS" <?php echo ($line['fund_type'] == "IPDS") ? "selected" : ""; ?>>IPDS</option>
											<option value="DRPS" <?php echo ($line['fund_type'] == "DRPS") ? "selected" : ""; ?>>DRPS</option>
											<option value="RRCP" <?php echo ($line['fund_type'] == "RRCP") ? "selected" : ""; ?>>RRCP</option>
											<option value="40% GOVT" <?php echo ($line['fund_type'] == "40% GOVT") ? "selected" : ""; ?>>40% GOVT</option>
											<option value="300 Cr. EQUITY FUNDING"<?php echo ($line['fund_type'] == "300 Cr. EQUITY FUNDING") ? "selected" : ""; ?>>300 Cr. EQUITY FUNDING</option>
											<option value="DEPOSITE WORK" <?php echo ($line['fund_type'] == "DEPOSITE WORK") ? "selected" : ""; ?>>DEPOSITE WORK</option>
											<option value="RAILWAY FUNDING" <?php echo ($line['fund_type'] == "RAILWAY FUNDING") ? "selected" : ""; ?>>RAILWAY FUNDING</option>
											<option value="STATE GOVT FUNDING" <?php echo ($line['fund_type'] == "STATE GOVT FUNDING") ? "selected" : ""; ?>>STATE GOVT FUNDING</option>
											<option value="CENTRAL GOVT FUNDING" <?php echo ($line['fund_type'] == "CENTRAL GOVT FUNDING") ? "selected" : ""; ?>>CENTRAL GOVT FUNDING</option>
										
										
											
										</select>
										
										
								</div>
								
								</div>
							<div class="col-md-2"><label for="budget_head1" class=""><b>Budget Head:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col2">
										<input name="budget_head1" id="budget_head1" type="text" class="form-control" value="<?php echo($line['budget_head']); ?>"   />
										
									</div>
								</div>	
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="agency_name1" class=""><b>Agency Name :</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="agency_name1" id="agency_name1" type="text" rows="1"  ><?php echo($line['agency_name']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="woDetails1" class=""><b>Work Order Details:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="woDetails1" id="woDetails1" type="text" rows="2"  ><?php echo($line['woDetails']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="loaDate1" class=""><b>LoA Date:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										<input name="loaDate1" id="loaDate1" type="text" class="form-control" value="<?php echo($line['loaDate']); ?>" />
										
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="estimated_cost1" class=""><b>Estimated Cost(in Cr):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="estimated_cost1" id="estimated_cost1" type="text" class="form-control" value="<?php echo($line['estimated_cost']); ?>"   />
									</div>
								</div>
							<div class="col-md-2"><label for="awarded_cost1" class=""><b>Awarded Cost(in Cr):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="awarded_cost1" id="awarded_cost1" type="text" class="form-control"  value="<?php echo($line['awarded_cost']); ?>" />
									</div>
								</div>
								
								
				</div>
			   <div class="form-row">
							
							<div class="col-md-2"><label for="scheduled_date1" class=""><b>Scheduled Date of Completion(as per WO):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col3">
										<input name="scheduled_date1" id="scheduled_date1" type="text" class="form-control" value="<?php echo($line['scheduled_date']); ?>"   />
									</div>
								</div>
							<div class="col-md-2"><label for="license_validity1" class=""><b>Project Licence Validity:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col4">
										<input class="form-control" name="license_validity1" id="license_validity1" type="text" value="<?php echo($line['license_validity']); ?>"   />
									</div>
								</div>
								
								
				</div>
				
				
				<div class="form-row">
							<div class="col-md-2"><label for="project_manager1" class=""><b>Project Manager:</b></label></div>
								<div class="col-md-4" >
								<div class="position-relative form-group" id = "col1">
										 <select class="form-control form-control-sm form-mandatory m-t-5" id="project_manager1" name="project_manager1" >
											<option value="0" selected>Select Project Manager</option>
											<?php
											
												$userList1 = getUsers();
												while($rw1 = mysqli_fetch_assoc($userList1)){
													echo('<option value="'.$rw1['email_id'].'"  >'.$rw1['name'].'</option>');
												}
											?>
										</select>
										
									</div>
								
								</div>
							
							<div class="col-md-2"><label for="contact_no1" class=""><b>Contact No of Project Manager:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="contact_no1" id="contact_no1" type="text"  pattern=".{10,10}" maxlength= "10" onkeypress="return isNumber(event)" class="form-control" value="<?php echo($line['contact_no']); ?>" title="10 characters minimum & maximum"  />
									</div>
								</div>	
								
				</div>
				<div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit1" id="submit1" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
				
				<?php 
                                    if(isset($_POST['submit1'])){
										 if($_POST['license_validity1']==""){$_POST['license_validity1']=NULL;}
										$timestamp = date("Y-m-d H:i:s");
                                        if(updateProjectDetails($row['project_no'], $_POST['scope_of_work1'], $_POST['fund_type1'],$_POST['budget_head1'],$_POST['agency_name1'],$_POST['woDetails1'],$_POST['loaDate1'],$_POST['estimated_cost1'],$_POST['awarded_cost1'],$_POST['scheduled_date1'],$_POST['license_validity1'],$_SESSION['name'],$timestamp)){
                                       if(updateManagerDetails($line['project_no'],$_POST['project_name'],$_POST['project_phase'],$_POST['project_description'],$_POST['project_site'],$_POST['project_line1'],$_POST['project_line2'],$_POST['project_line3'],$_POST['department'],$_POST['work_category'],$_POST['zone'],$_POST['division'],$_POST['project_manager1'],$_POST['contact_no1']))  {
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Project Details have been succesfully updated !',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-project-details-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                            exit;
										}
										}else{
                                            //echo('<span class="insert-error"><i class="fas fa-exclamation-circle"></i> Project Creation Failed!</span>');
											
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'Project Details Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                               window.location.replace('pms-project-details-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                        }
                                    }
                        ?>
				
				
				
				
				</div>
				
				
				
				
				
				
				 <?php }
                  else{
                  ?>
			  </p>
			    <div class="form-row">
							<div class="col-md-2"><label for="project_name" class=""><b>Project Name:</b></label></div>
								<div class="col-md-8" >
									<div class="position-relative form-group" id = "col1">
										<!--<p><?php echo($row['project_name']); ?></p>	-->
										<input name="project_name" id="project_name" type="text" class="form-control" value="<?php echo($row['project_name']); ?>"  />										
									</div>
								</div>
							<div class="col-md-1"><label for="project_phase" class=""><b>Phase:</b></label></div>
								<div class="col-md-0.5" >
									<div class="position-relative form-group" id = "col1">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="project_phase" name="project_phase" >
											<option value="0"<?php echo ($row['project_phase'] == "0") ? "selected" : ""; ?>>NIL</option>
											<option value="I"<?php echo ($row['project_phase'] == "I") ? "selected" : ""; ?>>I</option>
											<option value="II" <?php echo ($row['project_phase'] == "II") ? "selected" : ""; ?>>II</option>
											<option value="III"<?php echo ($row['project_phase'] == "III") ? "selected" : ""; ?>>III</option>
											<option value="IV"<?php echo ($row['project_phase'] == "IV") ? "selected" : ""; ?>>IV</option>
											<option value="V" <?php echo ($row['project_phase'] == "V") ? "selected" : ""; ?>>V</option>
											<option value="VI"<?php echo ($row['project_phase'] == "VI") ? "selected" : ""; ?>>VI</option>
											<option value="VII"<?php echo ($row['project_phase'] == "VII") ? "selected" : ""; ?>>VII</option>
											
										</select>
										
										
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="project_description" class=""><b>Project Description:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="project_description" id="project_description" type="text" rows="5"  ><?php echo($row['project_description']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="project_site" class=""><b>Substation/Site:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_site" id="project_site" type="text" class="form-control required" value="<?php echo($row['project_site']); ?>"  />
										<div class="form-helper">Eg. Pratapsasan S/S or HQRS Office </div>
										
									</div>
								</div>
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="project_line" class=""><b>Associated Lines:</b></label></div>
								<div class="col-md-10" >
									<div class="row-cols-3" id = "col1">
										<div class="col-sm">
											<input type="text" class="form-control"  name="project_line1" id="project_line1" value="<?php echo($row['project_line1']); ?>">
											<div class="form-helper">Eg. 50kms X KV Line</div>
										 </div><br>
										 <div class="col-sm">
											<input type="text" class="form-control"  name="project_line2" id="project_line2" value="<?php echo($row['project_line2']); ?>">
											<!--<div class="form-helper">Eg. 100kms 220KV Line</div>-->
										 </div><br>
										  <div class="col-sm">
											<input type="text" class="form-control"  name="project_line3" id="project_line3" value="<?php echo($row['project_line3']); ?>">
											<!--<div class="form-helper">Eg. 20kms 132/33KV Line</div>-->
										 </div>
									</div>
								</div>	
								
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="department" class=""><b>Department:</b></label></div>
								<div class="col-md-4" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="department" name="department" required>
                                    <!--<option value="0" >Select Department</option>-->
                                    <?php
										
										
                                        $typeList = getDepartment();
										
										
                                        while($rw = mysqli_fetch_assoc($typeList)){ ?>
											
                                            
											<option value="<?php echo $rw['id']; ?>"<?php if($row['department_id']==$rw['id']) echo 'selected="selected"'; ?>><?php echo $rw['name']; ?></option>
											
										<?php }

                                    ?>
                                </select>
								
								</div>
							<div class="col-md-2"><label for="work_category" class=""><b>Type of Work:</b></label></div>
								<div class="col-md-4" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="work_category" name="work_category" required>
                                    <!--<option value="0" >Select Work Category</option>-->
                                    <?php
										
										
                                        $typeList = getWorkTypes($row['department_id']);
										
										//echo('<option value="4">All Work</option>');
                                        while($rw = mysqli_fetch_assoc($typeList)){ ?>
											
                                           
											<option value="<?php echo $rw['typeid']; ?>"<?php if($row['work_typeid']==$rw['typeid']) echo 'selected="selected"'; ?>><?php echo $rw['work_details']; ?></option>
                                      <?php  }

                                    ?>
                                </select>
								
								</div>
								
				</div>
				<br>
				<div class="form-row">
							<div class="col-md-2"><label for="zone" class=""><b>Zone:</b></label></div>
								<div class="col-md-4"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" required >
                                    <!--<option value="0" >Select Zone</option>-->
                                    <?php
										
                                        $typeList = getZoneTypes();
										
                                        while($rw = mysqli_fetch_assoc($typeList)){ ?>
											
                                            
                                            
											<option value="<?php echo $rw['zone-id']; ?>"<?php if($row['zone_id']==$rw['zone-id']) echo 'selected="selected"'; ?>><?php echo $rw['zone-name']; ?></option>
                                        <?php }

                                    ?>
                                </select>
								</div>
								
								
								
							<div class="col-md-2"><label for="division" class=""><b>Division:</b></label></div>
							<?php 
							$response = viewDiv($row['div_id']);
				            $col = mysqli_fetch_array($response);?>
								<div class="col-md-4"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division"  >
                                    <option value="<?php echo $col['div_id']; ?>" selected><?php echo $col['div_name']; ?></option>
									
                                    
									</select>
								</div>	
								
				</div><br><br>
				<div class="form-row">
							<div class="col-md-2"><label for="scope_of_work" class=""><b>Scope of Work:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="scope_of_work" id="scope_of_work" type="text" rows="5"  ></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="fund_type" class=""><b>Fund Type/ Mode:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col2">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="fund_type" name="fund_type" >
											<option value="0" selected>Select Fund Type</option>
											<option value="OPTCL OWN">OPTCL OWN</option>
											<option value="JICA">JICA</option>
											<option value="SCRIPS EHV">SCRIPS EHV</option>
											<option value="SCRIPS HV">SCRIPS HV</option>
											<option value="IPDS">IPDS</option>
											<option value="DRPS">DRPS</option>
											<option value="RRCP">RRCP</option>
											<option value="40% GOVT">40% GOVT</option>
											<option value="300 Cr. EQUITY FUNDING">300 Cr. EQUITY FUNDING</option>
											<option value="DEPOSITE WORK">DEPOSITE WORK</option>
											<option value="RAILWAY FUNDING">RAILWAY FUNDING</option>
											<option value="STATE GOVT FUNDING">STATE GOVT FUNDING</option>
											<option value="CENTRAL GOVT FUNDING">CENTRAL GOVT FUNDING</option>
										</select>
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="budget_head" class=""><b>Budget Head:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col2">
										<input name="budget_head" id="budget_head" type="text" class="form-control"  onkeypress="return isNumber1(event)" />
										
									</div>
								</div>	
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="agency_name" class=""><b>Agency Name :</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="agency_name" id="agency_name" type="text" rows="1"  ></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="woDetails" class=""><b>Work Order Details:</b></label></div>
								<div class="col-md-10" >
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="woDetails" id="woDetails" type="text" rows="2"  ></textarea>
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="loaDate" class=""><b>LoA Date:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="loaDate" id="loaDate" type="text" class="form-control"  />
										
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							<div class="col-md-2"><label for="estimated_cost" class=""><b>Estimated Cost(in Cr):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="estimated_cost" id="estimated_cost" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only" />
									</div>
								</div>
							<div class="col-md-2"><label for="awarded_cost" class=""><b>Awarded Cost(in Cr):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="awarded_cost" id="awarded_cost" type="text" class="form-control" onkeypress="return isNumber1(event)" title="Numbers Only" / >
									</div>
								</div>
								
								
				</div>
			   <div class="form-row">
							
							<div class="col-md-2"><label for="scheduled_date" class=""><b>Scheduled Date of Completion(as per WO):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col3">
										<input name="scheduled_date" id="scheduled_date" type="text" class="form-control"  />
									</div>
								</div>
							<div class="col-md-2"><label for="license_validity" class=""><b>Project Licence Validity:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col4">
										<!--<textarea class="form-control" name="license_validity" id="license_validity" type="text" rows="5"  ></textarea>-->
										<input class="form-control" name="license_validity" id="license_validity" type="text"  />
									</div>
								</div>
								
								
				</div>
				
				
				<div class="form-row">
							<div class="col-md-2"><label for="project_manager" class=""><b>Project Manager:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										 <select class="form-control form-control-sm form-mandatory m-t-5" id="project_manager" name="project_manager" >
											<option value="" >Select Project Manager</option>
											<?php
												$userList = getUsers();
												while($rw = mysqli_fetch_assoc($userList)){
													echo('<option value="'.$rw['email_id'].'">'.$rw['name'].'</option>');
												}
											?>
										</select>
										
									</div>
								</div>
							
							<div class="col-md-2"><label for="contact_no" class=""><b>Contact No of Project Manager:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="contact_no" id="contact_no" type="text" class="form-control"  pattern=".{10,10}" maxlength= "10" onkeypress="return isNumber(event)" title="10 characters minimum & maximum"/>
									</div>
								</div>	
								
				</div>
				<div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
				
				<?php 
                                    if(isset($_POST['submit'])){
										 if($_POST['license_validity']==""){$_POST['license_validity']=NULL;}
										 
                                        if(insertProjectDetails($row['project_no'], $_POST['scope_of_work'], $_POST['fund_type'],$_POST['budget_head'],$_POST['agency_name'],$_POST['woDetails'],$_POST['loaDate'],$_POST['estimated_cost'],$_POST['awarded_cost'],$_POST['scheduled_date'],$_POST['license_validity'],$_SESSION['name'])){
                                       if(updateManagerDetails($row['project_no'],$_POST['project_name'],$_POST['project_phase'],$_POST['project_description'],$_POST['project_site'],$_POST['project_line1'],$_POST['project_line2'],$_POST['project_line3'],$_POST['department'],$_POST['work_category'],$_POST['zone'],$_POST['division'],$_POST['project_manager'],$_POST['contact_no']))  {
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Project Details have been succesfully added !',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                               
												 window.location.replace('pms-project-details-entry.php?id=".base64_encode($row['project_no'])."'); 
                                            });
											
                                        </script>");
                                            exit;
										}
										}else{
                                            //echo('<span class="insert-error"><i class="fas fa-exclamation-circle"></i> Project Creation Failed!</span>');
											
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'error',
													title: 'Error!',
													text: 'Project Details Insertion Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                               
												 window.location.replace('pms-project-details-entry.php?id=".base64_encode($row['project_no'])."'); 
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
   
<!--===============================================================================================-->
      

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
 <script src="plug/select2/select2.min.js"></script>   

	<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
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
		$("#scheduled_date,#scheduled_date1,#license_validity,#license_validity1,#loaDate,#loaDate1").datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		yearRange: "-100:+10",
		changeYear: true,		});
		
		$("#scheduled_date,#scheduled_date1,#license_validity,#license_validity1").keydown(function(e){
        e.preventDefault();
    });	
      
	</script>
	
	<script>
	 $('#project_manager').select2();  
	
	</script>
	<script>
	
	//$('#project_manager1').find(':selected');
	$('#project_manager1').select2();
	$('#project_manager1').val('<?php echo($line['project_manager']); ?>');
	$('#project_manager1').trigger('change');
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
