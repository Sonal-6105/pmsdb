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
    if($_SESSION['type'] != "O"){
        header("Location:logout.php");
		exit;
    }
	$pid = base64_decode($_GET['id']);
	setStatus($pid);
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
	<link rel="stylesheet" type="text/css" href="plug/select2/select2.min.css">
	<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  
  border-top: none;
}


</style>
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

main .triangle{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 0 8px 8px 8px;
	border-color: transparent transparent
	#58b666 transparent;
	margin-left:20px;
	clear:both;
}
main .message{
	padding:10px;
	color:#000;
	margin-left:15px;
	background-color:#58b666;
	line-height:20px;
	max-width:90%;
	display:inline-block;
	text-align:left;
	border-radius:5px;
	clear:both;
}
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
main .triangle2{
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 8px 8px 8px;
    border-color: transparent
    transparent #58b666 transparent;
    margin-left:20px;
    clear:both
}
main .message2{
    padding:10px;
    color:#000;
    margin-left:15px;
    background-color:#58b666;
    line-height:20px;
    max-width:90%;
    display:inline-block;
    text-align:left;
    border-radius:5px;
    clear:both
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


<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
<script src="plug/bs4.5/js/jquery-3.5.1.min.js"></script>
<script>
 function change_tab(id)
 {
   document.getElementById("page_content").innerHTML=document.getElementById(id+"_desc").innerHTML;
   document.getElementById("page1").className="notselected";
   document.getElementById("page2").className="notselected";
   document.getElementById("page3").className="notselected";
   document.getElementById(id).className="selected";
 }
</script>
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
			<a class="nav-link current-page" href="pms-mainpage.php">Dashboard</a>
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
                    <p class="dropdown-item nav-drop-ip"><b>Wing:</b> <?php echo($_SESSION['wing']); ?></p>
					<p class="dropdown-item nav-drop-ip"><b>Last Log-in Info:</b> <?php echo($_SESSION['last_login']); ?></p>
					<p class="dropdown-item nav-drop-ip"><b>IP address:</b> <?php echo($_SESSION['ip']); ?></p>
           
            </div>
			</div>
			</li>
		</ul>
		
		
	</div>
</nav>

<div class="container-fluid" style="padding-left:4%; padding-right:4%;">

<!--=============================================== ROW-1 ==========================================-->
	<div class="d-flex justify-content-between" >
		<div class="p-2">
			<div class="wrapper">
				<div class="text-info font-weight-bold" >
					<h5>Project Information:</h5>
				</div>
			</div>
		</div>
		
	</div>

<div class="row">
<div class="col-md-12">
			<div class="col-sm-auto text-left small text-muted">
			
				<!--<?php echo ($_SESSION['id']); ?>-->
				<div class="main_content">
				
				<p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                                    
                  $result = viewProjectDetails($sid);
				  $row = mysqli_fetch_array($result);
				  
				  $result_pd1 = viewProjectDetailsMD($sid);
				  $rw_pd1 = mysqli_fetch_array($result_pd1);
				
				 
                  
                  ?>
			  </p>
					<div class="tab">
					  <button class="tablinks" onclick="openCity(event, 'Project details')" id="defaultOpen" >Project details</button>
					  <button class="tablinks" onclick="openCity(event, 'Physical Progress')">Substation Progress</button>
					  <button class="tablinks" onclick="openCity(event, 'Associated Line Progress')">Line Progress</button>
					  <button class="tablinks" onclick="openCity(event, 'Financial Progress')">Financial Progress</button>
					  <button class="tablinks" onclick="openCity(event, 'Hindrances')">Hindrances</button>
					  <button class="tablinks" onclick="openCity(event, 'BG Details')">BG Details</button>
					  <button class="tablinks" onclick="openCity(event, 'Documents')">Documents</button>
					  <button class="tablinks" onclick="openCity(event, 'Talking Points')">Talking Points</button>
					 
					</div>

					<div id="Project details" class="tabcontent">
					  <table>
						  <tr >
						  <?php 	if($row== NULL){
					 echo nl2br("\n <p><font color=blue>PROJECT DETAILS HAVE NOT BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else{
					 if($rw_pd1['lastupdate_time']== NULL){?>
			   
						<p class="text-info"  style="color: orange;padding-left:75%;"><?php echo "Not updated Yet";?></p>
			   
			   
					<?php } 
				else{ ?>
						<p class="text-info"  style="color: orange;padding-left:75%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_pd1['lastupdate_time']));?></p>
				<?php }?>
						</tr>
						
					
                  
						  <tr>
							<td width="30%" style="color:blue;"><b>Project Name:</b></td>
							<td><?php echo ($row['project_name']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Phase:</b></td>
							<?php if($row['project_phase']!= "0"){ ?>
							<td><?php echo ($row['project_phase']); ?></td>
							<?php }
									else { ?>
							<td><?php echo("NIL"); ?></td>
							<?php }?>	
							
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Project Description:</b></td>
							<td><?php echo ($row['project_description']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Substation/Site::</b></td>
							<td><?php echo ($row['project_site']); ?></td>
							
						  </tr>
						  <?php if(($row['project_line1']!= "") ||($row['project_line1']!= NULL)){ ?>
						  <tr>
						  
							<td style="color:blue;"><b>Associated Line-I:</b></td>
							<td><?php echo ($row['project_line1']); ?></td>
							
						  </tr>
						  <?php } ?>
						  <?php if(($row['project_line2']!= "") ||($row['project_line2']!= NULL)){ ?>
						  <tr>
							<td style="color:blue;"><b>Associated Line-II:</b></td>
							<td><?php echo ($row['project_line2']); ?></td>
							
						  </tr>
						  <?php } ?>
						  <?php if(($row['project_line3']!= "") ||($row['project_line3']!= NULL)){ ?>
						  <tr>
							<td style="color:blue;"><b>Associated Line-III:</b></td>
							<td><?php echo ($row['project_line3']); ?></td>
							
						  </tr>
						  <?php } ?>
						  <tr>
							<td style="color:blue;"><b>Scope of Work:</b></td>
							<td><?php echo ($row['scope_of_work']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Fund Type/ Mode:</b></td>
							<td><?php echo ($row['fund_type']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Budget Head:</b></td>
							<?php if(($row['budget_head']!= "") || ($row['budget_head']!= NULL)){ ?>
							<td><?php echo ($row['budget_head']); ?></td>
							<?php }
									else { ?>
							<td><?php echo("Not Entered"); ?></td>
							<?php }?>	
							
							
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Agency Name :</b></td>
							<td><?php echo ($row['agency_name']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Work Order Details :</b></td>
							<td><?php echo ($row['woDetails']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>LoA Date :</b></td>
							<td><?php echo(date("d-m-Y ",strtotime($row['loaDate']))); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Estimated Cost(in Cr):</b></td>
							<td><?php echo ($row['estimated_cost']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Awarded Cost(in Cr):</b></td>
							<td><?php echo ($row['awarded_cost']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Scheduled Date of Completion(as per WO):</b></td>
							<td><?php echo(date("d-m-Y ",strtotime($row['scheduled_date']))); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Project Licence Validity:</b></td>
							<?php if(($row['license_validity']!= "") || ($row['license_validity']!= NULL)){ ?>
							<td><?php echo(date("d-m-Y ",strtotime($row['license_validity']))); ?></td>
							<?php }
									else { ?>
							<td><?php echo("Not Entered"); ?></td>
							<?php }?>
														
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Project Manager:</b></td>
							<td><?php echo ($row['project_manager']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Contact No of Project Manager:</b></td>
							<td><?php echo ($row['contact_no']); ?></td>
							
						  </tr>
						  
				   <?php } ?> 
						</table>
					 
					</div>

					<div id="Physical Progress" class="tabcontent">
					  	
					  <table>
						  <?php
				
						  $sid = base64_decode($_GET['id']);
											
						  $result1 = viewPhysicalProgress($sid);
						  $row1 = mysqli_fetch_array($result1);
						  
						  $result_q1 = viewPhysicalDetails($sid);
						  $rw_q1 = mysqli_fetch_array($result_q1);
						  
						  
						  /*if($row1== NULL){
							 echo("NO PHYSICAL PROGRESS HAVE BEEN ENTERED YET !!"); 
						  }
						  else{*/
						  ?>
						  <tr >
						  <?php 	if($row1== NULL){
					 echo nl2br("\n<p><font color=blue>SUBSTATION DETAILS HAVE NOT BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else{
			 if($rw_q1['lastupdate_on']== NULL){?>
			   
			   <p class="text-info"  style="color: orange;padding-left:77%;"><?php echo "Not updated yet";?></p>
			   
			   
				<?php } 
				else{ ?>
						<p class="text-info"  style="color: orange;padding-left:77%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_q1['lastupdate_on']));?></p>
				<?php }?>
						</tr>
						  <tr>
							<td width="30%" style="color:blue;"><b>Project Name:</b></td>
							<td><?php echo ($row1['project_name']); ?></td>
							
						  </tr>
						   <tr>
							<td style="color:blue;"><b>Phase:</b></td>
							<?php if($row1['project_phase']!= "0"){ ?>
							<td><?php echo ($row1['project_phase']); ?></td>
							<?php }
									else { ?>
							<td><?php echo("NIL"); ?></td>
							<?php }?>	
							
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Substation Progress:</b></td>
							
							<?php if(($row1['substation_progress']!= "") || ($row1['substation_progress']!= NULL)){ ?>
							<td><?php echo($row1['substation_progress']); ?></td>
							<?php }
									else { ?>
							<td><?php echo("Not Entered"); ?></td>
							<?php }?>
							
							
							<!--<td><?php echo ($row1['substation_progress']); ?></td>-->
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>S/S Progress (In %):</b></td>
							<?php if(($row1['substation_progress_percent']!= "") || ($row1['substation_progress_percent']!= NULL)){ ?>
							<td><?php echo($row1['substation_progress_percent']); ?></td>
							<?php }
									else { ?>
							<td><?php echo("Not Entered"); ?></td>
							<?php }?>
							
							<!--<td><?php echo ($row1['substation_progress_percent']); ?></td>-->
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Scheduled Date of Completion(as per WO):</b></td>
							<td><?php echo(date("d-m-Y ",strtotime($row1['scheduled_date']))); ?></td>
							
						  </tr>
						
						  
						  <tr>
							<td style="color:blue;"><b>Date of Completion:</b></td>
							<td><?php echo(date("d-m-Y ",strtotime($row1['tentative_date']))); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Overall Progress Percentage:</b></td>
							<td><?php echo ($row1['progress_percent']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Work Stage:</b></td>
							<td><?php echo ($row1['work_stage']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Remarks:</b></td>
							<td><?php echo ($row1['remarks']); ?></td>
							
						  </tr>
						 <?php } ?>  
						</table>
					</div>
					
					
					<div id="Associated Line Progress" class="tabcontent">
					  
					  <table>
						  <?php
				
						  $sid = base64_decode($_GET['id']);
											
						  $result1 = viewPhysicalProgress($sid);
						  $row1 = mysqli_fetch_array($result1);
						  
						  
						  $result_q2 = viewPhysicalDetails($sid);
						  $rw_q2 = mysqli_fetch_array($result_q2);
						  
						  ?>
						   <tr >
						   <?php 	if($row1== NULL){
					 echo nl2br("\n <p><font color=blue>LINE DETAILS HAVE NOT BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else{
			if($rw_q2['lastupdate_on']== NULL){?>
			   
			   <p class="text-info"  style="color: orange;padding-left:77%;"><?php echo "Not updated yet";?></p>
			   
			   
				<?php } 
				else{ ?>
						<p class="text-info"  style="color: orange;padding-left:77%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_q2['lastupdate_on']));?></p>
				<?php }?>
						</tr>
						  <tr>
							<td width="30%" style="color:blue;"><b>Project Name:</b></td>
							<td><?php echo ($row1['project_name']); ?></td>
							
						  </tr>
						  <tr>
							<td width="30%" style="color:blue;"><b>Phase:</b></td>
							<td><?php echo ($row1['project_name']); ?></td>
							
						  </tr>
						  
						  
						<?php if(($row1['project_line1']!= "") ||($row1['project_line1']!= NULL)){ ?>
						  <tr>
							<td style="color:blue;"><b>Associated Line-I:</b></td>
							<td><?php echo ($row1['scheduled_date']); ?></td>
							
								  
								  <tr>
									<th width="40%" style="color:brown;">Foundation:</th>
									
									<td width="60%"><?php echo($row1['foundation_line1']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['foundation_total_line1']); ?></td>
								  </tr>
								  <tr>
									<th width="40%" style="color:brown;">Errection:</th>
									<td width="60%"><?php echo($row1['errection_line1']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['errection_total_line1']); ?></td>
								  </tr>
								  <tr>
									<th width="40%" style="color:brown;">Stringing:</th>
									<td width="60%"><?php echo($row1['stringing_line1']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['stringing_total_line1']); ?></td>
								  </tr>
								  
								 
								
						  </tr>
						  <?php } ?>
						  <?php if(($row1['project_line2']!= "") ||($row1['project_line2']!= NULL)){ ?>
						  <tr>
							<td style="color:blue;"><b>Associated Line-II:</b></td>
							<td><?php echo ($row1['scheduled_date']); ?></td>
							
								  
								  <tr>
									<th width="40%" style="color:brown;">Foundation:</th>
									
									<td width="60%"><?php echo($row1['foundation_line2']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['foundation_total_line2']); ?></td>
								  </tr>
								  <tr>
									<th width="40%" style="color:brown;">Errection:</th>
									<td width="60%"><?php echo($row1['errection_line2']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['errection_total_line2']); ?></td>
								  </tr>
								  <tr>
									<th width="40%" style="color:brown;">Stringing:</th>
									<td width="60%"><?php echo($row1['stringing_line2']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['stringing_total_line2']); ?></td>
								  </tr>
								  
								 
								
						  </tr>
						  <?php } ?>
						  <?php if(($row1['project_line3']!= "") ||($row1['project_line3']!= NULL)){ ?>
						  <tr>
							<td style="color:blue;"><b>Associated Line-III:</b></td>
							<td><?php echo ($row1['project_line3']); ?></td>
							
								  
								  <tr>
									<th width="40%" style="color:brown;">Foundation:</th>
									
									<td width="60%"><?php echo($row1['foundation_line3']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['foundation_total_line3']); ?></td>
								  </tr>
								  <tr>
									<th width="40%" style="color:brown;">Errection:</th>
									<td width="60%"><?php echo($row1['errection_line3']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['errection_total_line3']); ?></td>
								  </tr>
								  <tr>
									<th width="40%" style="color:brown;">Stringing:</th>
									<td width="60%"><?php echo($row1['stringing_line3']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($row1['stringing_total_line3']); ?></td>
								  </tr>
								  
								 
								
						  </tr>
						  <?php } ?>
						<?php } ?>  
						  
						</table>
					</div>
					<div id="Financial Progress" class="tabcontent">
					  <table>
						  <?php
				
						 
											
						  $result2 = viewFinancialProgress($sid);
						  $row2 = mysqli_fetch_array($result2);
						  
						  
						  $result_q3 = viewFinancialDetails($sid);
						  $rw_q3 = mysqli_fetch_array($result_q3);
						  /*if($row1== NULL){
							 echo("NO PHYSICAL PROGRESS HAVE BEEN ENTERED YET !!"); 
						  }
						  else{*/
						  ?>
						   <tr >
						    <?php 	if($row2== NULL){
					 echo nl2br("\n <p><font color=blue>FINANCIAL DETAILS HAVE NOT BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else{
			if($rw_q3['lastupdate_on']== NULL){?>
			   
			   <p class="text-info"  style="color: orange;padding-left:77%;"><?php echo "Not updated yet";?></p>
			   
			   
				<?php } 
				else{ ?>
							<p class="text-info"  style="color: orange;padding-left:77%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_q3['lastupdate_on']));?></p>
				<?php }?>
							</tr>
						  <tr>
							<td width="30%" style="color:blue;"><b>Project Name:</b></td>
							<td><?php echo ($row2['project_name']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Fund Type/ Mode:</b></td>
							<td><?php echo ($row2['fund_type']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Budget Head:</b></td>
							<?php if(($row2['budget_head']!= "") || ($row2['budget_head']!= NULL)){ ?>
							<td><?php echo ($row2['budget_head']); ?></td>
							<?php }
									else { ?>
							<td><?php echo("Not Entered"); ?></td>
							<?php }?>
							
							
							<!--<td><?php echo ($row2['budget_head']); ?></td>-->
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Estimated Cost(in Cr.):</b></td>
							<td><?php echo ($row2['estimated_cost']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Awarded Cost(in Cr.):</b></td>
							<td><?php echo ($row2['awarded_cost']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Amended Cost(in Cr.):</b></td>
							<td><?php echo ($row2['amended_cost']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Expenditure Done(in Cr.):</b></td>
							<td><?php echo ($row2['expenditure_done']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Invoices Raised(in Cr.):</b></td>
							<td><?php echo ($row2['invoices_raised']); ?></td>
							
						  </tr>
						  <tr>
							<td style="color:blue;"><b>Remarks:</b></td>
							<td><?php echo ($row2['remarks']); ?></td>
							
						  </tr>
						 
							<?php }?>
						</table>
					</div>
					<div id="Hindrances" class="tabcontent">
					<p>
                 <?php
				
                  //$sid = base64_decode($_GET['id']);
                                    
                  $result = viewHindrances($sid);
				  $result1 = viewProjectDetails($sid);
                  $row1 = mysqli_fetch_array($result1);
				  
				   $result_q4 = viewHindrancesDetails($sid);
				   $rw_q4 = mysqli_fetch_array($result_q4);
                  //$row = mysqli_fetch_array($result);
				  
				  
				  //$result2 = viewHindrances($sid);
				 //$row2 = mysqli_fetch_array($result2);
                  
                  ?>
			  </p>
			     <?php 	if($row1== NULL){
					 echo nl2br("\n<p><font color=blue>HINDRANCE DETAILS HAVE NOT BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else{?>
				<p><b style="color:brown;">Project Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row1['project_name']); ?></p>
				<?php if($rw_q4['lastupdate_on']== NULL){?>
			   
			   <p class="text-info"  style="color: orange;padding-left:77%;"><?php echo "Not updated yet";?></p>
			   
			   
				<?php } 
				else{ ?>
				
				<p class="text-info"  style="color: orange;padding-left:77%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_q4['lastupdate_on']));?></p>
				<?php }?>
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
						 while($row8 = mysqli_fetch_array($result)){
						    ?>
							
							<td ><?php echo ($row_id); ?></td>
							
							<td><?php echo ($row8['hindrance_nature']); ?></td>
							<td><?php echo(date("d-m-Y ",strtotime($row8['occurence_date']))); ?></td>
							<td><?php echo ($row8['hindrance_details']); ?></td>
							<td><?php echo ($row8['action_taken']); ?></td>
							<td><b><?php echo ($row8['active']); ?></b></td>
							<!--<?php if($row8['active']=="Y"){echo('
										<td>
										<input type="checkbox" class="toggle_ad" id="sid-'.$row_id.'" checked data-toggle="toggle"
										data-on="Y" data-off="N" data-onstyle="success"
										data-offstyle="danger" data-size="mini">
										</td>
									');
									}
									else{
									echo('
										<td>
										<input type="checkbox" class="toggle_ad" id="sid-'.$row_id.'" data-toggle="toggle"
										data-on="Y" data-off="N" data-onstyle="success"
										data-offstyle="danger" data-size="mini">
										</td>
									');
									}?>-->
									
							
							
							<?php $row_id++;?>
							
						  </tr>
						 <?php  } ?>
						  
				<?php  } ?>		 
						  
				</table>
					  
					</div>
					
					<div id="BG Details" class="tabcontent">
					<p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                                    
                  $result = viewBGreport($sid);
				  $result1 = viewProjectDetails($sid);
                  $row1 = mysqli_fetch_array($result1);
                  $result_q5 = viewBGDetails($sid);
				  $rw_q5 = mysqli_fetch_array($result_q5);
                  
                  ?>
			  </p>
			   <?php 	if($row1== NULL){
					 echo nl2br("\n <p><font color=blue>NO BGS HAVE BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else { ?>
			  <p><b style="color:brown;">Project Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row1['project_name']); ?></p>
			 <?php if($rw_q5['lastupdate_on']== NULL){?>
			   
			   <p class="text-info"  style="color: orange;padding-left:77%;"><?php echo "Not updated yet";?></p>
			   
			   
				<?php } 
				else{ ?>
				
				<p class="text-info"  style="color: orange;padding-left:77%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_q5['lastupdate_on']));?></p>
				<?php  } ?> 	
				 <table id="dataTable" class="table  table-hover">
						  
						
						   <tr style="color:blue;" class="table-primary">
							<th width="3%"><b>#</b></th>
							
							<th width="15%">BG Name</th>
							<th width="10%">BG Number</th>
							<th width="25%">Issued Bank</th>
							<th width="15%">BG Amount</th>
							<th width="10%">Issued Date</th>
							<th width="10%">Expiry Date</th>
							<th width="15%">Active</th>
						  </tr>
						  <tr class="table-secondary">
						 <?php
						 $row_id=1;
						 while($row7 = mysqli_fetch_array($result)){
							 
						    ?>
							
							<td ><?php echo ($row_id); ?></td>
							
							<td><?php echo ($row7['bg_name']); ?></td>
							<td><?php echo($row7['bg_number']); ?></td>
							<td><?php echo ($row7['issued_bank']); ?></td>
							<td><?php echo ($row7['bg_amount']); ?></td>
							<td><?php echo(date("d-m-Y ",strtotime($row7['issued_date']))); ?></td>
							<td><?php echo(date("d-m-Y ",strtotime($row7['expiry_date']))); ?></td>
							<td><?php echo ($row7['active']); ?></td>
							
							
							
							<?php $row_id++;?>
							
						  </tr>
							<?php } ?>
						  
					<?php  } ?> 
						  
				</table>
				
					</div>
					
					
					
					
					<div id="Documents" class="tabcontent">
					
					<p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                                    
                  $result3 = viewDocuments($sid);
				  $result1 = viewProjectDetails($sid);
                  $row1 = mysqli_fetch_array($result1);
				  //$row3 = mysqli_fetch_array($result3);
				  
				  $result_q6 = viewDocumentsDetails($sid);
				  $rw_q6 = mysqli_fetch_array($result_q6);
                  
                  ?>
			  </p>
			  <?php 	if($row1== NULL){
					 echo nl2br("\n <p><font color=blue>NO DOCUMENTS HAVE BEEN ENTERED YET !!</font>
					 <lottie-player src='vendor/lottie/72311-no-data-found.json' background='transparent'  speed='1'  style='width: 300px; height: 250px; margin-left: 35%;'  loop  autoplay></lottie-player></p>"); 
							} else { ?>
			  <p ><b style="color:brown;">Project Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row1['project_name']); ?></p>
			 <?php if($rw_q6['lastupdate_on']== NULL){?>
			   
			   <p class="text-info"  style="color: orange;padding-left:77%;"><?php echo "Not updated yet";?></p>
			   
			   
				<?php } 
				else{ ?>
			 <p class="text-info"  style="color: orange;padding-left:77%;">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw_q6['lastupdate_on']));?></p>
			    <?php }?>
				<table class="table  table-hover">
						 
						
						   <tr style="color:blue;" class="table-primary" >
							<th width="10%">Sl No</th>
							
							<th width="40%">Document Name</th>
							<th width="30%">File Name</th>
							<th width="20%"> Download</th>
							
						  </tr>
						  <tr class="table-secondary">
						  <?php 
						    $row_id=1;
							while($row3 = mysqli_fetch_array($result3)){						  
							?>
							<td ><?php echo ($row_id); ?></td>
							
							<td><?php echo ($row3['document_name']); ?></td>
							<td><?php echo ($row3['document']); ?></td>
							<td><a href="upload-document/<?php echo ($row3['document']); ?>" target="_blank" ><i class="fas fa-download" style="color:green"></i></a></td>
							
							<?php $row_id++;?>
							
						  </tr>
						  <?php  } ?>
						  
						 
							<?php }?>	  
				</table>
				
					 <!--<table>
						  <?php
				
						  //$sid = base64_decode($_GET['id']);
											
						  $result3 = viewDocuments($sid);
						  $row3 = mysqli_fetch_array($result3);
						  /*if($row1== NULL){
							 echo("NO PHYSICAL PROGRESS HAVE BEEN ENTERED YET !!"); 
						  }
						  else{*/
						  ?>
						  <!--<tr><th ><b>PROJECT NAME</b></th ><td><?php echo ($row3['project_name']); ?></td></tr>
						   <tr style="color:blue;">
							<th width="10%"><b>Sl No</b></th>
							
							<th width="40%"><b>Document Name</b></th>
							<th width="50%"><b>File</b>(Click on the File name to Download)</th>
							
						  </tr>
						  <tr>
						  <?php $row_id=1; ?>
							<td ><?php echo ($row_id); ?></td>
							
							<td><?php echo ($row3['document_name']); ?></td>
							<td><a href="upload-document/<?php echo ($row3['document']); ?>" target="_blank" rel="noopener noreferrer"><?php echo ($row3['document']); ?></a></td>
							
							<?php $row_id++;?>
							
						  </tr>
						 
						  
						 
						  
						</table>-->
					</div>
					<div id="Talking Points" class="tabcontent" >
					
					<main >
					
					<?php
				
						  //$sid = base64_decode($_GET['id']);
						  $timestamp = date("Y-m-d H:i:s");				
						  $result4 = viewChats($sid);
						  $i=0;
						  //$row4 = mysqli_fetch_array($result4);
						  //if($row4!= NULL){
							 
							//$row_id=1; 
							//$row_count=countChats($sid);
						  while($row4 = mysqli_fetch_array($result4)){
							  /*if($i==0){
								$i=5;
								$first=$row4;*/
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
								<?php echo ($row4['sent_by']); ?>,<?php echo date("d-m-Y H:i:s ",strtotime($row4['sent_time'])); ?>
								</span>
								</div>
								</div>
								<br/><br/>
									<?php
								/*	}
							else
								{
								if($row4['sent_by']!=$first['sent_by'])
								{
									?>
									<div id="triangle" class="triangle"></div>
									<div id="message" class="message">
									<span style="color:black;float:left;font-size:15px;">
									<?php echo ($row4['message']); ?></span> <br/>
									<div>
									<span style="color:black;float:right;
											font-size:10px;clear:both;">
									<?php echo ($row4['sent_by']); ?>,
											<?php echo ($row4['sent_time']); ?>
									</span>
									</div>
									</div>
									<br/><br/>
									<?php
								}else
									{
									?>
									<div id="triangle1" class="triangle1"></div>
									<div id="message1" class="message1">
									<span style="color:black;float:right;font-size:15px;">
									<?php echo ($row4['message']); ?></span> <br/>
									<div>
									<span style="color:black;float:left;
											font-size:10px;clear:both;">
										<?php echo ($row4['sent_by']); ?>,
											<?php echo($row4['sent_time']); ?>
									</span>
									</div>
									</div>
									<br/><br/>
									<?php
									}
									}*/
									 ?>		
									
									
					</div>
							<?php 
							
							}
						  
						  ?>
						
					
					
					<form class="" method="post" enctype="multipart/form-data" action="" autocomplete="off"> 
					<p>
                 <?php
				
                  $sid = base64_decode($_GET['id']);
                  //setStatus($sid);                 
                 // $result3 = viewDocuments($sid);
				  $result1 = viewProjectDetails($sid);
                  $row1 = mysqli_fetch_array($result1);
				  //$row3 = mysqli_fetch_array($result3);
                  
                  ?>
			  </p>
			  <p name="project_no" id="project_no" style='display:none;'><b style="color:brown;">Project No:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($row1['project_no']); ?></p><br><br>
					  <div class="form-row">
							<div class="col-md-2"><label for="talking_point" class="">Talking Point(if any):</label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col1">
										
										<textarea class="form-control" name="talking_point" id="talking_point" type="text" rows="5" required ></textarea>
									</div>
								</div>
					
					 </div>
					  <div class="form-row">
							<div class="col-md-2"><label for="sent_to" class="">Sent To:</label></div>
								<div class="col-md-10">
									<div class="position-relative form-group" id = "col1">
										<select  class="form-control multiple-select"  multiple id="sent_to[]" name="sent_to[]"  >
											<option value="<?php echo($row['project_manager']);?>" selected ><?php echo($row['project_manager']);?></option> 
											
											
											<?php
												$userList = getUsers();
												while($rw1 = mysqli_fetch_assoc($userList)){
													echo('<option value="'.$rw1['email_id'].'">'.$rw1['name'].'</option>');
												}
											?>
											
											
										</select>
										
									</div>
								</div>
					<!--<?php echo($row['project_manager']);
					echo($timestamp);?>-->
					 </div>
						 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Enter</button>
                                <!--<button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>-->
								
								
								<?php 
                                    if(isset($_POST['submit'])){
										
																				
										$project_no=$row1['project_no']; 
										$sent_by=$_SESSION['name']; 
										$talking_point=	$_POST['talking_point']; 
										//$timestamp = date("Y-m-d H:i:s");	
										
                                        $sent_to =$_POST['sent_to'];
										$status="unread";
										
										foreach($sent_to as $sent_row)
											{
												//echo ("hi");
												$query = "insert into `project_chats` (project_no,sent_by, message, sent_time, sent_to,status)
												values ('$project_no','$sent_by','$talking_point','$timestamp','$sent_row','$status')";
												
												$connection = openDBConnection();
																					
																					
												$queue=mysqli_query($connection,$query);
												
												
											}
										if($queue == TRUE){
						mysqli_commit($connection);
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
                                                window.location.replace('pms-project-details.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                            exit;
	
											}
	 
									else{
                                            
											
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
                                               window.location.replace('pms-project-details.php?id=".base64_encode($row['project_no'])."'); 
                                            });
											
                                        </script>");
                                        } 
	 
									/*foreach($sent_to as $sent_row)
										{
										//print_r($sent_row);
	
                                        //if(insertChat($row['project_no'],$_SESSION['name'],$_POST['talking_point'],$timestamp,$row['project_manager'],$status)){
                                       if(insertChat($row['project_no'],$_SESSION['name'],$_POST['talking_point'],$timestamp,$sent_row,$status)){
                                            
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
                                                window.location.replace('pms-project-details.php?id=".base64_encode($row['project_no'])."');
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
													text: 'Message not sent!!!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                               window.location.replace('pms-project-details.php?id=".base64_encode($row['project_no'])."'); 
                                            });
											
                                        </script>");
                                        }*/
										
                                    }
                                ?>
					</div>
					</form >
					
						
						
					</main>		
				</div><!--tabcontent-->
				 </div> 
				
              
            <!-- //card--> 
			</div>
</div>

</div>
		
	
</div><!--// container-->


<button id="goTop" class="go-top" title="Scroll To Top"><i class="fas fa-arrow-up"></i></button>
<br><br>
<footer class="page-footer font-small blue pt-4">
<div class="footer-style footer-copyright text-center py-3" style="height: 62px;">
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
function openCity(evt, actionName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(actionName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script>
function show_func(){

var element = document.getElementById("chathist");
	element.scrollTop = element.scrollHeight;

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
                    window.location.replace("pms-mainpage.php");
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
	<script src="plug/select2/select2.min.js"></script> 
	
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
	<!--<script>
	
	//$('#project_manager1').find(':selected');
	$('#sent_to').select2();
	$('#sent_to').val('<?php echo($row['project_manager']); ?>');
	$('#sent_to').trigger('change');
	</script>-->
	<script>
	$(".multiple-select").select2();
</script>
</body>
</html>
