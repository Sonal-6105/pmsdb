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
	
	$documentid = base64_decode($_GET['id']);
                                    
     $result = viewDocumentsDetails($documentid);
     $rw = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Documents | e - NIRMAN</title>
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
		<i class="fas fa-user-circle fa-2x separator-left p-l-5 nav-profile"></i>-->
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
					<h5>Enter Document Details:</h5>
				</div>
			</div>
		</div>
		<?php if($rw!= NULL){ ?>
		<div class="text-info ">
			
			<p style="color: orange;font-weight:bold">Last Updated On  <?php echo date("d-m-Y, H:i:s ",strtotime($rw['lastupdate_on']));?></p>
			<a href="pms-documents-view.php?id='.<?php echo base64_encode($rw['project_no'])?>.'"  rel="noopener noreferrer" >Click Here to View All documents</a>
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
                  $row = mysqli_fetch_array($result);
                  if($row== NULL){
					 //echo nl2br("PROJECT DETAILS HAVE NOT BEEN ENTERED YET !! \n Kindly Enter Project Details First."); 
					 echo('<lottie-player src="vendor/lottie/72311-no-data-found.json"
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
							<div class="col-md-3"><label for="document_name" class=""><b>Document Name:</b></label></div>
								<div class="col-md-9" >
									<div class="position-relative form-group" id = "col2">
										<input name="document_name" id="document_name" type="text"  class="form-control" required />
										
									</div>
								</div>
							
								
				</div>
				
				
				<div class="form-row">
							<div class="col-md-3"><label for="upload_document" class=""><b>Attach Document :</b> </label></div>
								<div class="col-md-6">
								<div class="position-relative form-group" id = "col0">	
									<input type="file" name="upload_document" id="upload_document" onchange="uploadFile()"  required><br>
									<progress id="progressBar" value="0" max="100" style="width:300px;height:25px;"></progress>
									  <h3 id="status"></h3>
									  <p id="loaded_n_total"></p>
									<!--<input type="text" id="eid" name="eid" class="form-control"   maxlength= "5" title="Employee Id should be of 5 characters" onkeypress="return isNumber(event)" value="" onblur="getEmployee(this.value)" placeholder="Enter Employee Id" autofocus autocomplete="off" required />									
									&nbsp;
									<span id="eid_msg"  style="color:red" ></span>-->
								</div>	
								</div>
							
								
								
				</div>
				
				
				
				
				
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return cancelClick()">Cancel</button>
								<?php 
                                    if(isset($_POST['submit'])){
                                        
                                       if (isset($_FILES)) {
										
										
										$errors = [];
										$fileExtensionsAllowed = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv' ); // Allowed file extensions // These will be the only file extensions allowed
										//$fileExtensionsAllowed = ['jpeg','jpg','png']; 
										//$fileTmpLoc = $_FILES["F2_form"]["tmp_name"];
										
										//$filename = $_FILES['upload_document']['name'];
										$fileName=$_FILES['upload_document']['name'];
										$fileSize = $_FILES['upload_document']['size'];
										$fileTmpLoc  = $_FILES['upload_document']['tmp_name'];
										$fileType = $_FILES['upload_document']['type'];
										$fileExtension = strtolower(end(explode('.',$fileName)));
										$folder_name = 'upload-document';
										$destination = $folder_name .'/'.$fileName;

										 

										

										  if (! in_array($fileExtension,$fileExtensionsAllowed)) {
											$errors[] = "This file extension is not allowed. ";
										  }

										  if ($fileSize > 4000000) {
											$errors[] = "File exceeds maximum size (4MB)";
										  }
										
										
										
										 if (empty($errors)) {
											$didUpload = move_uploaded_file($fileTmpLoc, $destination);
											//$check="insert into ne_flow(reportingId,reportingName,employeeId,employeeName,aperiod,category,fromDate,toDate,reviewingId,reviewingName) ". "VALUES('$reportid','$reportname','$ne_empid','$ne_empname','$ne_period','$ne_category','".$fdateFormat."','".$tdateFormat."','$ne_cid','$ne_cname')";
											
											
											if(uploadDocument($row['project_no'],$_POST['document_name'], $fileName, $_SESSION['name'])){
                                            
											echo ("<script>
                                           
											   Swal.fire(
												  {
													icon: 'success',
													title: 'Success',
													text: 'Document has been succesfully uploaded!',
													
													buttons: {
															confirm: {
																className : 'btn btn-success'
															}
														}
												  }
												).then(function() {
                                                 window.location.replace('pms-documents-entry.php?id=".base64_encode($row['project_no'])."');
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
													text: 'Your Document has Not been uploaded!',
													
													buttons: {
															confirm: {
																className : 'btn btn-danger'
															}
														}
												  }
												).then(function() {
                                                 window.location.replace('pms-documents-entry.php?id=".base64_encode($row['project_no'])."');
                                            });
											
                                        </script>");
                                        }
											
										
									
									   }
                                    }
									}
                                ?>
				</div>
				<?php } ?>
                </div>
                </form > <!-- //card--> 
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
                    window.location.replace("pms-dashboard.php.php");
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
	<script>
	
	function _(el) {
  return document.getElementById(el);
}
	function uploadFile() {
  var file = _("upload_document").files[0];
  // alert(file.name+" | "+file.size+" | "+file.type);
  var formdata = new FormData();
  formdata.append("upload_document", file);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "file_upload_parser.php"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
  //use file_upload_parser.php from above url
  ajax.send(formdata);
}

function progressHandler(event) {
  _("loaded_n_total").innerHTML = "Attached " + event.loaded + " bytes of " + event.total;
  var percent = (event.loaded / event.total) * 100;
  _("progressBar").value = Math.round(percent);
  _("status").innerHTML = Math.round(percent) + "% attached... please wait";
}

function completeHandler(event) {
  _("status").innerHTML = event.target.responseText;
  _("progressBar").value = 100; //wil clear progress bar after successful upload
}

function errorHandler(event) {
  _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
  _("status").innerHTML = "Upload Aborted";
}
</script>
</body>
</html>
