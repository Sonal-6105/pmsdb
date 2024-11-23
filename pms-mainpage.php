<?php
	
	error_reporting();
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mainpage |  e - NIRMAN</title>
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
.notif-surround{
  overflow:hidden;
  display: inline-block;
}
</style>

<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
<script src="plug/bs4.5/js/jquery-3.5.1.min.js"></script>
<script src="vendor/jquery/jquery-3.5.1.js"></script>
<!--<script >
        $(document).ready(function(){

            $("#zone,#work_category").change(function(){
                var zoneid = $(this).val();
				var workid = $(this).val();
                $.ajax({
                    url: "getDivision.php",
                    type: "post",
                    data: {zone:zoneid},
                    dataType: "json",
                    success:function(response){

                        var len = response.length;
						//alert(zoneid);
						//alert(workid);
						//alert(response);
                        $("#division").empty();
						
						
						$("#division").prepend("<option value=''>Select Division</option>");
						$("#division").append("<option value='7'>All Division</option>");
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
	-->

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
                    url: "getZone.php",
                    type: "post",
                    //data: {dept:deptid},
                    dataType: "json",
					cache: false,
                    success:function(response){

                        var len = response.length;
						//alert(zoneid);
						//alert(workid);
						//alert(response);
                        $("#zone").empty();
						
						//$("#work_category").html(response);
						$("#zone").prepend("<option value=''>Select Zone</option>");
						//$("#division").append("<option value='7'>All Division</option>");
                      for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
														
                            $("#zone").append("<option value='"+id+"'>"+name+"</option>");

                        }
						//$('#city-dropdown').html('<option value="">Select State First</option>'); 
                    }
                });
				
				 }
				 else{
				//$("#work_category").empty();
				$('select[name="zone"]').empty();
				}
				
            });

        });
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
			if($_SESSION['type'] == ""){
				echo('
					<ul class="navbar-nav hvr-underline-from-center">
						<li class="nav-item">
						<a class="nav-link" href="heatmap.php">Heatmap</a>
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

			
<div class="container">
	<div class="row">
	  <div class="col-auto mr-auto"><span class="welcome-heading">Welcome , Administrator!</span></div>
		
	</div>
	
	
<!--========================================================= HEADING END ======================================================-->
	<div class="row m-t-30 m-b-20">
		<div class="col-sm-12 vr col-sm-auto text-left small text-muted">
		  <form class="" method="post" enctype="multipart/form-data" action="" id ="#myform"> 
			  
			   <div class="form-row">
			   <div class="col-md-1"><label for="department" class="control-label"><b>Department:</b></label></div>
								<div class="col-md-3" >
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
			   <div class="col-md-1"><label for="zone" class="control-label"><b>Zone:</b></label></div>
								<div class="col-md-3"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" required >
                                    <option value="" >--Select Department First--</option>
                                    <!--<?php
										
                                        $typeList = getZoneTypes();
										//echo('<option value="3">All Zone</option>');
                                        while($row = mysqli_fetch_assoc($typeList)){
											//echo('<option value="">'.$row['zone-id'].'</option>');
                                            echo('<option value="'.$row['zone-id'].'">'.$row['zone-name'].'</option>');
                                        }

                                    ?>-->
                                </select>
								</div>
								
								
								
							<div class="col-md-1"><label for="division" class=""><b>Division:</b></label></div>
							
								<div class="col-md-3"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division"  >
                                    <option value="" >--Select Zone First--</option>
                                    
									</select>
								</div>	
								
								
								
							 <!--<?php echo($_SESSION['id']);
							 
							 ?>	
								
							<div class="col-md-1"><label for="work_category" class="">Type of Work:</label></div>
								<div class="col-md-3" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="work_category" name="work_category">
                                    <option value="0" selected>Select Work Category</option>
                                    <?php
										
										
                                        $typeList = getWorkTypes1();
										
										echo('<option value="4">All Work</option>');
                                        while($row = mysqli_fetch_assoc($typeList)){
											//echo('<option value="4">'.$row['typeid'].'</option>');
                                            echo('<option value="'.$row['typeid'].'">'.$row['work_details'].'</option>');
                                        }

                                    ?>
                                </select>
								
								</div>
								
						<div class="col-md-1"><label for="zone" class="">Zone:</label></div>
								<div class="col-md-3"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" >
                                    <option value="0" selected>Select Zone</option>
                                    <?php
										
                                        $typeList = getZoneTypes();
										echo('<option value="3">All Zone</option>');
                                        while($row = mysqli_fetch_assoc($typeList)){
											//echo('<option value="">'.$row['zone-id'].'</option>');
                                            echo('<option value="'.$row['zone-id'].'">'.$row['zone-name'].'</option>');
                                        }

                                    ?>
                                </select>
								</div>
								
						<div class="col-md-1"><label for="division" class="">Division:</label></div>
							
								<div class="col-md-3"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division" >
                                    <option value="0" selected>Select Division</option>
                                    
									</select>
								</div>	-->
					
							
				</div>
				
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm m-t-5 m-r-50" onclick="showOrHideDiv()" >Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return clearForm(this.form);">Clear</button>
				
				</div><br>
				<?php 
						
                                    if(isset($_POST['submit'])){
										$table_datax = fetchLimitSource($_POST['work_category'], $_POST['zone'],$_POST['division']);								
										
                                   echo('
								   
						<div class="col-sm-12" id="mtable1" >
						<div class="card text-center">
							<h5 class="card-header card-heading">Project List</h5>
							<div class="card-body" id="Grid">
							<table class="table table-sm table-bordered table-striped" id="dataTableX">
								<thead class="table-primary">
									<tr>
										<th scope="col">#</th>
										<th scope="col">Project Name</th>
										<th scope="col">Action</th>
										
									</tr>
								</thead>
							');
							echo('<tbody class="table-data">');
							$floor_id=1;
							while($floor = mysqli_fetch_assoc($table_datax)){
								$unreadNotiCount=getUnreadNotiCount($floor['project_no'],$_SESSION['id']);
								echo('<tr>');
								echo('<td>'.$floor_id.'</td>');
								echo('<td id="stdname" style="text-align:left;vertical-align:middle">'.$floor['project_name'].'</td>');
								echo('<td  data-toggle="tooltip" >
								<a href="pms-project-details.php?id='.base64_encode($floor['project_no']).'" rel="noopener noreferrer" title="View Project details"><span class="action-history"><i class="fas fa-stream" style="color:black"></i></span></a>
								<?php if('.$unreadNotiCount.'){?>
							<p class="notif-surround" style="color:red";><b>'.$unreadNotiCount.'</b></p>
						<?php	} ?>
								</td>');
								
								echo('</tr>');
								$floor_id++;
							}
							echo('</tbody>');
							echo('</table>');

				echo('</div></div></div>');
									}	
                                       
                        ?>
				
								
				
				<br><br>
				
				
			</form>	
		</div>
		
		<div class="col-sm-12" id="mtable" >
			<div class="card text-center ">
				<h5 class="card-header card-heading">All Project List</h5>
				<div class="card-body" id="Grid">
					<?php
					
							
						
					$id=sourceCount();
						if($id ==0){
							echo('
							<img src="images/paper-plane.svg" class="svg-opacity" alt="admin home" width="250" height="250">
							<h5 class="m-t-20">No sources defined in the system yet!</h5>
							');
						}
						else{
							$table_data = fetchAllSource();
							echo('
							<table class="table table-sm table-bordered table-striped" id="dataTable">
								<thead class="table-primary">
									<tr>
										<th scope="col">#</th>
										<th scope="col">Project Name</th>
										<th scope="col">Action</th>
										
									</tr>
								</thead>
							');
							echo('<tbody class="table-data">');
							$row_id=1;
							while($row = mysqli_fetch_assoc($table_data)){
								$unreadNotiCount=getUnreadNotiCount($row['project_no'],$_SESSION['id']);
								
								echo('<tr>');
								echo('<td>'.$row_id.'</td>');
								echo('<td id="stdname" style="text-align:left;vertical-align:middle">'.$row['project_name'].'</td>');
								echo('<td  data-toggle="tooltip" >
								<a href="pms-project-details.php?id='.base64_encode($row['project_no']).'" rel="noopener noreferrer" title="View Project details"><span class="action-history"><i class="fas fa-stream" style="color:black"></i></span></a>
								<?php if('.$unreadNotiCount.'){?>
							<p class="notif-surround" style="color:red";><b>'.$unreadNotiCount.'</b></p>
						<?php	} ?>
								<!--<a href="pms-physical-progress.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="View Physical Proress"><span class="action-history"><i class="fas fa-stream" style="color:green"></i></span></a>
								<a href="pms-financial-progress.php?id='.base64_encode($row['project_no']).'" rel="noopener noreferrer" title="View Financial Proress"><span class="action-history"><i class="fa fa-university"  style="color:#0099ff"></i></span></a>
								<a href="pms-constraints.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="View Hindrances"><span class="action-history"><i class="fa fa-exclamation-triangle" style="color:red"></i></span></a>
								<a href="pms-documents.php?id='.base64_encode($row['project_no']).'"  rel="noopener noreferrer" title="View Documents"><span class="action-history"><i class="fas fa-folder-open" style="color: #dde01d"></i></span></a>-->
								</td>');
								
								echo('</tr>');
								$row_id++;
							}
							echo('</tbody>');
							echo('</table>');
						}
					?>
				</div>
				
			</div>
		</div><!--mtable-->


 <?php echo($unreadNotiCount);?>

	</div>
	
</div> 
					
			
		


<br><br>
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
  
        /* Initialization of datatable */
        $(document).ready(function() {
            $('#dataTable,#dataTableX').DataTable({ 
			//$("#stdname").addClass("highlighted");
			
			});
        });
    
</script>
<script>		
$(document).ready(function() {
    $("#myform").submit(function(e) {
        $("#mtable").hide();
        
    });
});
</script>	

<script>
    function showOrHideDiv() {
        var v = document.getElementById("showOrHide");
        if (v.style.display === "none") {
            v.style.display = "block";
        } else {
            v.style.display = "none";
        }
    }
</script>	
</body>
</html>


