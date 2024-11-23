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
	 $phyid = base64_decode($_GET['id']);
                                    
     $result = viewPhysicalDetails($phyid);
     $rw = mysqli_fetch_array($result);
				
                 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Physical Progress | e - NIRMAN</title>
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
					<h5>Enter Physical Progress:</h5>
				</div>
			</div>
		</div>
	<?php if($rw!= NULL){ ?>
	<div class="text-info ">
			
			<p style="color: orange;font-weight:bold">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw['lastupdate_on']));?></p>
			<a href="pms-physical-progress-view.php?id='.<?php echo base64_encode($rw['project_no'])?>.'"  rel="noopener noreferrer" >Click Here to View</a>
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
				  $result_p1 = viewPhysicalProgress($sid);
				  $row_p1 = mysqli_fetch_array($result_p1);
				  
                  $row = mysqli_fetch_array($result);
                    if($row== NULL){
					 //echo nl2br("PROJECT DETAILS HAVE NOT BEEN ENTERED YET !! \n Kindly Enter Project Details First."); 
					 echo('<lottie-player src="vendor/lottie/77703-no-data-found.json"
									background="transparent"  speed="1"  style="width: 300px; height: 250px; margin-left: 35%;"  loop  autoplay></lottie-player>
									
									<h6 class="m-t-20" >Project Details have not been entered yet, Kindly Enter Project Details First. !</h6>
									');
				  }
                  else{

					  if($row_p1!= NULL){ ?>
					  
					  <div class="form-row">
							<div class="col-md-2"><label for="project_name1" class=""><b>Project Name1:</b></label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row_p1['project_name']); ?></p>
										
									</div>
								</div>
								
							<div class="col-md-2"><label for="project_phase1" class=""><b>Phase:</b></label></div>
								<div class="col-md-2" >
									<div class="position-relative form-group" id = "col1">
									<?php if($row_p1['project_phase']!= "0"){ ?>
									<p><?php echo($row_p1['project_phase']); ?></p>
									<?php }
									else { ?>	
									<p><?php echo("NIL"); ?></p>	
									<?php }?>	
									</div>
								</div>	
								
								
				</div>
			    <div class="form-row">
							<div class="col-md-2"><label for="substation_progress1" class=""><b>Substation Progress:</b></label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col2">
										
										<textarea class="form-control" name="substation_progress1" id="substation_progress1" type="text" rows="6"   ><?php echo($row_p1['substation_progress']); ?></textarea>
									</div>
								</div>
							<div class="col-md-1.5"><label for="substation_progress_percent1" class=""><b>S/S Progress (In %):</b></label></div>
								<div class="col-md-1.5" >
									<div class="position-relative form-group" id = "col3">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="substation_progress_percent1" name="substation_progress_percent1"  >
											<option value="" >Select S/S Progress</option>
											
											<option value="<=90%"<?php echo ($row_p1['substation_progress_percent'] == "<=90%") ? "selected" : ""; ?>><=90%</option>
											
											<option value="<=80%"<?php echo ($row_p1['substation_progress_percent'] == "<=80%") ? "selected" : ""; ?>><=80%</option>
											
											<option value="<=70%"<?php echo ($row_p1['substation_progress_percent'] == "<=70%") ? "selected" : ""; ?>><=70%</option>
											
											<option value="<=60%"<?php echo ($row_p1['substation_progress_percent'] == "<=60%") ? "selected" : ""; ?>><=60%</option>
											
											<option value="<=50%"<?php echo ($row_p1['substation_progress_percent'] == "<=50%") ? "selected" : ""; ?>><=50%</option>
											
											<option value="<=40%"<?php echo ($row_p1['substation_progress_percent'] == "<=40%") ? "selected" : ""; ?>><=40%</option>
											
											<option value="<=30%"<?php echo ($row_p1['substation_progress_percent'] == "<=30%") ? "selected" : ""; ?>><=30%</option>
											
											<option value="<=20%"<?php echo ($row_p1['substation_progress_percent'] == "<=20%") ? "selected" : ""; ?>><=20%</option>
											
											<option value="<=10%"<?php echo ($row_p1['substation_progress_percent'] == "<=10%") ? "selected" : ""; ?>><=10%</option>
											
											
										</select>
										<!--<input name="progress_percent" id="progress_percent" type="text" class="form-control"  value="<?php echo($row['scheduled_date']);?>" readonly />-->
									</div>
								</div>	
								
				</div>
				 
			<?php if(($row_p1['project_line1']!= "") ||($row_p1['project_line1']!= NULL)){ ?>
				<div class="form-row">
							<div class="col-md-2"><label for="project_line11" class=""><b>Associated Line-I:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_line11" id="project_line11" type="text" class="form-control required" value="<?php echo($row_p1['project_line1']); ?>" readonly />
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="foundation_line11" class=""><b>Foundation:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="foundation_line11" id="foundation_line11" onkeypress="return isNumber(event)" onkeyup="this.value = minmax(this.value, 0)" value="<?php echo($row_p1['foundation_line1']); ?>">
											<!--<span id="foundation_line1_msg"  style="color:red" ></span>-->
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="foundation_total_line11" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="foundation_total_line11" id="foundation_total_line11" onkeypress="return isNumber(event)" value="<?php echo($row_p1['foundation_total_line1']); ?>" >
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="errection11" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="errection_line11" class=""><b >Errection:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="errection_line11" id="errection_line11"  onkeypress="return isNumber(event)" value="<?php echo($row_p1['errection_line1']); ?>">
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="errection_total_line11" class="" style="font-size:200%;"> /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="errection_total_line11" id="errection_total_line11" onkeypress="return isNumber(event)" value="<?php echo($row_p1['errection_total_line1']); ?>">
											
										 </div>
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="stringing11" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="stringing_line11" class=""><b>Stringing:</b></label></div>
								
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="stringing_line11" id="stringing_line11" onkeypress="return isNumber(event)" value="<?php echo($row_p1['stringing_line1']); ?>">
											
										 </div>kms
								
							
								<div class="col-md-0.5" ><label for="stringing_total_line11" class="" style="font-size:200%;"> /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="stringing_total_line11" id="stringing_total_line11" onkeypress="return isNumber(event)" value="<?php echo($row_p1['stringing_total_line1']); ?>" >
											
										 </div>kms
				</div>
				<span id="foundation_line1_msg"  style="color:red" ></span>
				<?php } ?><br>					
				<?php if(($row_p1['project_line2']!= "") ||($row_p1['project_line2']!= NULL)){ ?>
				<div class="form-row">
							<div class="col-md-2"><label for="project_line21" class=""><b>Associated Line-II:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_line21" id="project_line21" type="text" class="form-control required" value="<?php echo($row_p1['project_line2']); ?>" readonly />
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="foundation_line21" class=""><b>Foundation:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="foundation_line21" id="foundation_line21" onkeypress="return isNumber(event)" value="<?php echo($row_p1['foundation_line2']); ?>" >
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="foundation_total_line21" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="foundation_total_line21" id="foundation_total_line21" onkeypress="return isNumber(event)" value="<?php echo($row_p1['foundation_total_line2']); ?>">
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="errection21" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="errection_line21" class=""><b>Errection:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="errection_line21" id="errection_line21" onkeypress="return isNumber(event)" value="<?php echo($row_p1['errection_line2']); ?>">
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="errection_total_line21" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="errection_total_line21" id="errection_total_line21" onkeypress="return isNumber(event)" value="<?php echo($row_p1['errection_total_line2']); ?>">
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="stringing21" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="stringing_line21" class=""><b>Stringing:</b></label></div>
								
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="stringing_line21" id="stringing_line21" onkeypress="return isNumber(event)" value="<?php echo($row_p1['stringing_line2']); ?>">
											
										 </div>kms
								
								
								<div class="col-md-0.5" ><label for="stringing_total_line21" class="" style="font-size:200%;">  /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="stringing_total_line21" id="stringing_total_line21" onkeypress="return isNumber(event)" value="<?php echo($row_p1['stringing_total_line2']); ?>" >
											
										 </div>kms
				</div><?php } ?><br>					
				<?php if(($row_p1['project_line3']!= "") ||($row_p1['project_line3']!= NULL)){ ?>
				
				<div class="form-row">
							<div class="col-md-2"><label for="project_line31" class=""><b>Associated Line-III:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_line31" id="project_line31" type="text" class="form-control required" value="<?php echo($row_p1['project_line3']); ?>" readonly />
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="foundation_line31" class=""><b>Foundation:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="foundation_line31" id="foundation_line31" onkeypress="return isNumber(event)" value="<?php echo($row_p1['foundation_line3']); ?>" >
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="foundation_total_line31" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="foundation_total_line31" id="foundation_total_line31" onkeypress="return isNumber(event)" value="<?php echo($row_p1['foundation_total_line3']); ?>">
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="errection31" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
									</div>
								</div>
							<div class="col-md-2"><label for="errection_line31" class=""><b>Errection:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="errection_line31" id="errection_line31" onkeypress="return isNumber(event)" value="<?php echo($row_p1['errection_line3']); ?>" >
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="errection_total_line31" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="errection_total_line31" id="errection_total_line31" onkeypress="return isNumber(event)" value="<?php echo($row_p1['errection_total_line3']); ?>">
											
										 </div>
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="stringing31" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="stringing_line31" class=""><b>Stringing:</b></label></div>
								
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="stringing_line31" id="stringing_line31" onkeypress="return isNumber(event)" value="<?php echo($row_p1['stringing_line3']); ?>">
											
										 </div>kms
								
								
							
							<div class="col-md-0.5" ><label for="stringing_total_line31" class="" style="font-size:200%;"> /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="stringing_total_line31" id="stringing_total_line31" onkeypress="return isNumber(event)" value="<?php echo($row_p1['stringing_total_line3']); ?>" >
											
										 </div>kms
							
				</div>
				<?php } ?>
				<br>					
			
				<div class="form-row">
							
							<div class="col-md-2"><label for="scheduled_date1" class=""><b>Scheduled Date of Completion(as per WO):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col3">
										<input name="scheduled_date1" id="scheduled_date1" type="text" class="form-control"  value="<?php echo(date("d-m-Y ",strtotime($row_p1['scheduled_date'])));?>" readonly />
									</div>
								</div>
							<div class="col-md-2"><label for="tentative_date1" class=""><b>Date of Completion:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col4">
										<input name="tentative_date1" id="tentative_date1" type="text" class="form-control" value="<?php echo($row_p1['tentative_date']); ?>" required />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							
							<div class="col-md-2"><label for="progress_percent1" class=""><b>Overall Progress Percentage:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col3">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="progress_percent1" name="progress_percent1" required>
											<option value="" >Select Progress Percentage</option>
											
											<option value="<=90%"<?php echo ($row_p1['progress_percent'] == "<=90%") ? "selected" : ""; ?>><=90%</option>
											
											<option value="<=80%"<?php echo ($row_p1['progress_percent'] == "<=80%") ? "selected" : ""; ?>><=80%</option>
											
											<option value="<=70%"<?php echo ($row_p1['progress_percent'] == "<=70%") ? "selected" : ""; ?>><=70%</option>
											
											<option value="<=60%"<?php echo ($row_p1['progress_percent'] == "<=60%") ? "selected" : ""; ?>><=60%</option>
											
											<option value="<=50%"<?php echo ($row_p1['progress_percent'] == "<=50%") ? "selected" : ""; ?>><=50%</option>
											
											<option value="<=40%"<?php echo ($row_p1['progress_percent'] == "<=40%") ? "selected" : ""; ?>><=40%</option>
											
											<option value="<=30%"<?php echo ($row_p1['progress_percent'] == "<=30%") ? "selected" : ""; ?>><=30%</option>
											
											<option value="<=20%"<?php echo ($row_p1['progress_percent'] == "<=20%") ? "selected" : ""; ?>><=20%</option>
											
											<option value="<=10%"<?php echo ($row_p1['progress_percent'] == "<=10%") ? "selected" : ""; ?>><=10%</option>
											
											
										</select>
										
									</div>
								</div>
							<div class="col-md-2"><label for="work_stage1" class=""><b>Work Stage:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col4">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="work_stage1" name="work_stage1" required >
											<option value="" >Select Work Stage</option>
											<option value="IN PROGRESS"<?php echo ($row_p1['work_stage'] == "IN PROGRESS") ? "selected" : ""; ?>>IN PROGRESS</option>
											<option value="CHARGED" <?php echo ($row_p1['work_stage'] == "CHARGED") ? "selected" : ""; ?>>CHARGED</option>
											<option value="CHARGED & CLOSED"<?php echo ($row_p1['work_stage'] == "CHARGED & CLOSED") ? "selected" : ""; ?>>CHARGED & CLOSED</option>
											
										</select>
										
										
									</div>
								</div>
								
								
				</div>
			   <div class="form-row">
			   					<div class="col-md-2"><label for="remarks1" class=""><b>Remarks:</b></label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="remarks1" id="remarks1" type="text" rows="5"   ><?php echo($row_p1['remarks']); ?></textarea>
									</div>
								</div>
								
								
				</div>
				
								
				
				
				
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
										if($_POST['foundation_line11']==""){$_POST['foundation_line11']=NULL;}
										if($_POST['foundation_total_line11']==""){$_POST['foundation_total_line11']=NULL;}
										if($_POST['errection_line11']==""){$_POST['errection_line11']=NULL;}
										if($_POST['errection_total_line11']==""){$_POST['errection_total_line11']=NULL;}
										if($_POST['stringing_line11']==""){$_POST['stringing_line11']=NULL;}
										if($_POST['stringing_total_line11']==""){$_POST['stringing_total_line11']=NULL;}
										
										if($_POST['foundation_line21']==""){$_POST['foundation_line21']=NULL;}
										if($_POST['foundation_total_line21']==""){$_POST['foundation_total_line21']=NULL;}
										if($_POST['errection_line21']==""){$_POST['errection_line21']=NULL;}
										if($_POST['errection_total_line21']==""){$_POST['errection_total_line21']=NULL;}
										if($_POST['stringing_line21']==""){$_POST['stringing_line21']=NULL;}
										if($_POST['stringing_total_line21']==""){$_POST['stringing_total_line21']=NULL;}
										
										if($_POST['foundation_line31']==""){$_POST['foundation_line31']=NULL;}
										if($_POST['foundation_total_line31']==""){$_POST['foundation_total_line31']=NULL;}
										if($_POST['errection_line31']==""){$_POST['errection_line31']=NULL;}
										if($_POST['errection_total_line31']==""){$_POST['errection_total_line31']=NULL;}
										if($_POST['stringing_line31']==""){$_POST['stringing_line31']=NULL;}
										if($_POST['stringing_total_line31']==""){$_POST['stringing_total_line31']=NULL;}
										
                                        if($_POST['remarks1']==""){$_POST['remarks1']=NULL;}
										
                                        if(physicalProgress($row['project_no'],$_POST['substation_progress1'],$_POST['substation_progress_percent1'],$row['project_line1'],$_POST['foundation_line11'],$_POST['foundation_total_line11'],$_POST['errection_line11'],$_POST['errection_total_line11'],$_POST['stringing_line11'],$_POST['stringing_total_line11'],$row['project_line2'],$_POST['foundation_line21'],$_POST['foundation_total_line21'],$_POST['errection_line21'],$_POST['errection_total_line21'],$_POST['stringing_line21'],$_POST['stringing_total_line21'],$row['project_line3'],$_POST['foundation_line31'],$_POST['foundation_total_line31'],$_POST['errection_line31'],$_POST['errection_total_line31'],$_POST['stringing_line31'],$_POST['stringing_total_line31'], $_POST['tentative_date1'],$_POST['progress_percent1'],$_POST['work_stage1'],$_POST['remarks1'], $_SESSION['name'])){
                                           
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Physical Progress of the Project have been succesfully added!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                               window.location.replace('pms-physical-progress-entry.php?id=".base64_encode($row['project_no'])."');
											   
												 
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
													text: 'Physical Progress Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-physical-progress-entry.php?id=".base64_encode($row['project_no'])."');
												
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				</div>
					  
					  
					  
					 <?php } else{ ?>
			  </p>
				<div class="form-row">
							<div class="col-md-2"><label for="project_name" class=""><b>Project Name:</b></label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col1">
										<p><?php echo($row['project_name']); ?></p>
										
									</div>
								</div>
								
							<div class="col-md-2"><label for="project_phase" class=""><b>Phase:</b></label></div>
								<div class="col-md-2" >
									<div class="position-relative form-group" id = "col1">
									<?php if($row['project_phase']!= "0"){ ?>
									<p><?php echo($row['project_phase']); ?></p>
									<?php }
									else { ?>	
									<p><?php echo("NIL"); ?></p>	
									<?php }?>	
									</div>
								</div>	
								
								
				</div>
			    <div class="form-row">
							<div class="col-md-2"><label for="substation_progress" class=""><b>Substation Progress:</b></label></div>
								<div class="col-md-6" >
									<div class="position-relative form-group" id = "col2">
										
										<textarea class="form-control" name="substation_progress" id="substation_progress" type="text" rows="6"   ></textarea>
									</div>
								</div>
							<div class="col-md-1.5"><label for="substation_progress_percent" class=""><b>S/S Progress (In %):</b></label></div>
								<div class="col-md-1.5" >
									<div class="position-relative form-group" id = "col3">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="substation_progress_percent" name="substation_progress_percent"  >
											<option value="" >Select S/S Progress</option>
											
											<option value="<=90%"><=90%</option>
											
											<option value="<=80%"><=80%</option>
											
											<option value="<=70%"><=70%</option>
											
											<option value="<=60%"><=60%</option>
											
											<option value="<=50%"><=50%</option>
											
											<option value="<=40%"><=40%</option>
											
											<option value="<=30%"><=30%</option>
											
											<option value="<=20%"><=20%</option>
											
											<option value="<=10%"><=10%</option>
											
											
										</select>
										<!--<input name="progress_percent" id="progress_percent" type="text" class="form-control"  value="<?php echo($row['scheduled_date']);?>" readonly />-->
									</div>
								</div>	
								
				</div>
				 
			<?php if(($row['project_line1']!= "") ||($row['project_line1']!= NULL)){ ?>
				<div class="form-row">
							<div class="col-md-2"><label for="project_line1" class=""><b>Associated Line-I:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_line1" id="project_line1" type="text" class="form-control required" value="<?php echo($row['project_line1']); ?>" readonly />
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="foundation_line1" class=""><b>Foundation:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="foundation_line1" id="foundation_line1" onkeypress="return isNumber(event)" onkeyup="this.value = minmax(this.value, 0)">
											<!--<span id="foundation_line1_msg"  style="color:red" ></span>-->
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="foundation_total_line1" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="foundation_total_line1" id="foundation_total_line1" onkeypress="return isNumber(event)" >
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="errection1" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="errection_line1" class=""><b >Errection:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="errection_line1" id="errection_line1"  onkeypress="return isNumber(event)">
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="errection_total_line1" class="" style="font-size:200%;"> /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="errection_total_line1" id="errection_total_line1" onkeypress="return isNumber(event)">
											
										 </div>
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="stringing1" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="stringing_line1" class=""><b>Stringing:</b></label></div>
								
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="stringing_line1" id="stringing_line1" onkeypress="return isNumber(event)" >
											
										 </div>kms
								
							
								<div class="col-md-0.5" ><label for="stringing_total_line1" class="" style="font-size:200%;"> /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="stringing_total_line1" id="stringing_total_line1" onkeypress="return isNumber(event)" >
											
										 </div>kms
				</div>
				<span id="foundation_line1_msg"  style="color:red" ></span>
				<?php } ?><br>					
				<?php if(($row['project_line2']!= "") ||($row['project_line2']!= NULL)){ ?>
				<div class="form-row">
							<div class="col-md-2"><label for="project_line2" class=""><b>Associated Line-II:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_line2" id="project_line2" type="text" class="form-control required" value="<?php echo($row['project_line2']); ?>" readonly />
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="foundation_line2" class=""><b>Foundation:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="foundation_line2" id="foundation_line2" onkeypress="return isNumber(event)" >
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="foundation_total_line2" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="foundation_total_line2" id="foundation_total_line2" onkeypress="return isNumber(event)" >
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="errection2" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="errection_line2" class=""><b>Errection:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="errection_line2" id="errection_line2" onkeypress="return isNumber(event)">
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="errection_total_line2" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="errection_total_line2" id="errection_total_line2" onkeypress="return isNumber(event)" >
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="stringing2" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="stringing_line2" class=""><b>Stringing:</b></label></div>
								
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="stringing_line2" id="stringing_line2" onkeypress="return isNumber(event)">
											
										 </div>kms
								
								
								<div class="col-md-0.5" ><label for="stringing_total_line2" class="" style="font-size:200%;">  /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="stringing_total_line2" id="stringing_total_line2" onkeypress="return isNumber(event)" >
											
										 </div>kms
				</div><?php } ?><br>					
				<?php if(($row['project_line3']!= "") ||($row['project_line3']!= NULL)){ ?>
				
				<div class="form-row">
							<div class="col-md-2"><label for="project_line3" class=""><b>Associated Line-III:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										<input name="project_line3" id="project_line3" type="text" class="form-control required" value="<?php echo($row['project_line3']); ?>" readonly />
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="foundation_line3" class=""><b>Foundation:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="foundation_line3" id="foundation_line3" onkeypress="return isNumber(event)" >
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="foundation_total_line3" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="foundation_total_line3" id="foundation_total_line3" onkeypress="return isNumber(event)" >
											
										 </div>
				</div>
				
				<div class="form-row">
							<div class="col-md-2"><label for="errection3" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
									</div>
								</div>
							<div class="col-md-2"><label for="errection_line3" class=""><b>Errection:</b></label></div>
								<div class="col-md-2" >
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="errection_line3" id="errection_line3" onkeypress="return isNumber(event)" >
											
										 </div>
								
								</div>
							
								<div class="col-md-1.5" ><label for="errection_total_line3" class="" style="font-size:200%;">/</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="errection_total_line3" id="errection_total_line3" onkeypress="return isNumber(event)" >
											
										 </div>
				</div><br>
				<div class="form-row">
							<div class="col-md-2"><label for="stringing3" class=""></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col1">
										
										
									</div>
								</div>
							<div class="col-md-2"><label for="stringing_line3" class=""><b>Stringing:</b></label></div>
								
									
							
										<div class="col-sm">
											<input type="text" class="form-control"  name="stringing_line3" id="stringing_line3" onkeypress="return isNumber(event)" >
											
										 </div>kms
								
								
							
							<div class="col-md-0.5" ><label for="stringing_total_line3" class="" style="font-size:200%;"> /</label></div>
									
										<div class="col-sm">
										
											<input type="text" class="form-control"  name="stringing_total_line3" id="stringing_total_line3" onkeypress="return isNumber(event)" >
											
										 </div>kms
							
				</div>
				<?php } ?>
				<br>					
			
				<div class="form-row">
							
							<div class="col-md-2"><label for="scheduled_date" class=""><b>Scheduled Date of Completion(as per WO):</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col3">
										<input name="scheduled_date" id="scheduled_date" type="text" class="form-control"  value="<?php echo(date("d-m-Y ",strtotime($row['scheduled_date'])));?>" readonly />
									</div>
								</div>
							<div class="col-md-2"><label for="tentative_date" class=""><b>Date of Completion:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col4">
										<input name="tentative_date" id="tentative_date" type="text" class="form-control" required />
									</div>
								</div>
								
								
				</div>
				<div class="form-row">
							
							<div class="col-md-2"><label for="progress_percent" class=""><b>Overall Progress Percentage:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col3">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="progress_percent" name="progress_percent" required>
											<option value="" >Select Progress Percentage</option>
											
											<option value="<=90%"><=90%</option>
											
											<option value="<=80%"><=80%</option>
											
											<option value="<=70%"><=70%</option>
											
											<option value="<=60%"><=60%</option>
											
											<option value="<=50%"><=50%</option>
											
											<option value="<=40%"><=40%</option>
											
											<option value="<=30%"><=30%</option>
											
											<option value="<=20%"><=20%</option>
											
											<option value="<=10%"><=10%</option>
											
											
										</select>
										
									</div>
								</div>
							<div class="col-md-2"><label for="work_stage" class=""><b>Work Stage:</b></label></div>
								<div class="col-md-4" >
									<div class="position-relative form-group" id = "col4">
										<select class="form-control form-control-sm form-mandatory m-t-5" id="work_stage" name="work_stage" required >
											<option value="" >Select Work Stage</option>
											<option value="IN PROGRESS">IN PROGRESS</option>
											<option value="CHARGED">CHARGED</option>
											<option value="CHARGED & CLOSED">CHARGED & CLOSED</option>
											
										</select>
										
										
									</div>
								</div>
								
								
				</div>
			   <div class="form-row">
			   					<div class="col-md-2"><label for="remarks" class=""><b>Remarks:</b></label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="remarks" id="remarks" type="text" rows="5"   ></textarea>
									</div>
								</div>
								
								
				</div>
				
								
				
				
				
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
										if($_POST['foundation_line1']==""){$_POST['foundation_line1']=NULL;}
										if($_POST['foundation_total_line1']==""){$_POST['foundation_total_line1']=NULL;}
										if($_POST['errection_line1']==""){$_POST['errection_line1']=NULL;}
										if($_POST['errection_total_line1']==""){$_POST['errection_total_line1']=NULL;}
										if($_POST['stringing_line1']==""){$_POST['stringing_line1']=NULL;}
										if($_POST['stringing_total_line1']==""){$_POST['stringing_total_line1']=NULL;}
										
										if($_POST['foundation_line2']==""){$_POST['foundation_line2']=NULL;}
										if($_POST['foundation_total_line2']==""){$_POST['foundation_total_line2']=NULL;}
										if($_POST['errection_line2']==""){$_POST['errection_line2']=NULL;}
										if($_POST['errection_total_line2']==""){$_POST['errection_total_line2']=NULL;}
										if($_POST['stringing_line2']==""){$_POST['stringing_line2']=NULL;}
										if($_POST['stringing_total_line2']==""){$_POST['stringing_total_line2']=NULL;}
										
										if($_POST['foundation_line3']==""){$_POST['foundation_line3']=NULL;}
										if($_POST['foundation_total_line3']==""){$_POST['foundation_total_line3']=NULL;}
										if($_POST['errection_line3']==""){$_POST['errection_line3']=NULL;}
										if($_POST['errection_total_line3']==""){$_POST['errection_total_line3']=NULL;}
										if($_POST['stringing_line3']==""){$_POST['stringing_line3']=NULL;}
										if($_POST['stringing_total_line3']==""){$_POST['stringing_total_line3']=NULL;}
										
                                        if($_POST['remarks']==""){$_POST['remarks']=NULL;}
										
                                        if(physicalProgress($row['project_no'],$_POST['substation_progress'],$_POST['substation_progress_percent'],$row['project_line1'],$_POST['foundation_line1'],$_POST['foundation_total_line1'],$_POST['errection_line1'],$_POST['errection_total_line1'],$_POST['stringing_line1'],$_POST['stringing_total_line1'],$row['project_line2'],$_POST['foundation_line2'],$_POST['foundation_total_line2'],$_POST['errection_line2'],$_POST['errection_total_line2'],$_POST['stringing_line2'],$_POST['stringing_total_line2'],$row['project_line3'],$_POST['foundation_line3'],$_POST['foundation_total_line3'],$_POST['errection_line3'],$_POST['errection_total_line3'],$_POST['stringing_line3'],$_POST['stringing_total_line3'], $_POST['tentative_date'],$_POST['progress_percent'],$_POST['work_stage'],$_POST['remarks'], $_SESSION['name'])){
                                           
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Physical Progress of the Project have been succesfully added!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                               window.location.replace('pms-physical-progress-entry.php?id=".base64_encode($row['project_no'])."');
											   
												 
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
													text: 'Physical Progress Updation Failed!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                window.location.replace('pms-physical-progress-entry.php?id=".base64_encode($row['project_no'])."');
												
                                            });
											
                                        </script>");
                                        }
                                    }
                                ?>
				</div>
				
					 <?php }
					 } ?>
				
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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)&& !(charCode == 46 || charCode == 8)) {
        return false;
    }
    return true;
}
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
		$("#tentative_date,#tentative_date1").datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		yearRange: "-100:+10",
		changeYear: true
		});
		
		$("#scheduled_date,#tentative_date,#scheduled_date1,#tentative_date1").keydown(function(e){
        e.preventDefault();
    });	
        
	</script>
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
	<script >


$("#tdate").change(function () {
    var startDate = document.getElementById("fdate").value;
    var endDate = document.getElementById("tdate").value;
 
    if ((Date.parse(endDate) < Date.parse(startDate))) {
        alert("End date should be greater than Start date");
        document.getElementById("tdate").value = "";
    }
});

</script>
<!--<script>
	$(function() {

		//Put it on the parent element so new inputs have the binding too
		  $('table').on('keyup', '.advance', function() {
		  //Get the together belonging advance and fullpayment rows
			var $advance = $(this);
			var $fullPayment = $(this).parents('tr').find('.fullPayment');
			//Pars the values to numerics for a good comparison
			var advanceValue = parseFloat($advance.val());
			var fullValue = parseFloat($fullPayment.val());
			console.log(advanceValue, fullValue)
			if (advanceValue > fullValue) {
			  $advance.val(fullValue);
			}

		  });

		});
</script>
<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
<script>
$(document).on('change keyup blur', '#foundation_total_line1', function(e) {
  //id_arr = $(this).val();
  //id = id_arr.split("_");
  var foundation_line1 = $('#foundation_line1').val();
  var foundation_total_line1 = $('#foundation_total_line1'.val();
  if (foundation_total_line1 < foundation_line1) {
    e.preventDefault();
    //$(this).val(foundation_line1);
	alert("HI");
  }
});
</script>-->

<script >
$('#foundation_total_line1').change(function(){
               var value1 = parseFloat($('#foundation_total_line1').val()) || 0;
                var value2 = parseFloat($('#foundation_line1').val()) || 0;
				//var letterInput = document.getElementById("foundation_line1_msg");
				//alert("Hi");
				//var gradeInput = document.getElementById("grade9");
				//var letter = "";
				//var value11=(value1 + value2+value3+value4+value5+value6+value7+value8+value9+value10).toFixed(2);
               //$('#tscore1').val(value11);
			   //$('#ascore').val(value11);
			    
			 //var score = parseInt(document.getElementById("tscore1").value, 10);
			  
				 
				if (value1 < value2) {
					//alert("Hi11");
					document.getElementById("foundation_line1_msg").innerHTML= "Founndation Total count should be less the count given";
					//$('#foundation_line1_msg').innerHTML = "Founndation Total count should be less than Founndation";
					//letter = "Outstanding";
					e.preventDefault();
					//alert("Hi");
				  }else if (value1 >= value2) {
					document.getElementById("foundation_line1_msg").innerHTML= "";
				  }  
				  //letterInput.value = letter;
				 
				  
            });
        
		
</script>

</body>
</html>
