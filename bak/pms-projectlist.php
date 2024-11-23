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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mainpage| Project Management System</title>
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
</head>


<body style="padding-top:80px; background:#f8f9fc;">
<nav class="navbar navbar-expand-sm bg-light fixed-top shadow-sm">
	<a class="navbar-brand p-l-20" href="dashboard.php">
		<img src="images/logo.jpg" width="40" height="40" alt="GRIDCO" loading="lazy">
		<span class="brand-title p-l-10">Project Management System</span>
	</a>
    <div class="navbar-collapse justify-content-end">
		<ul class="navbar-nav hvr-underline-from-center p-r-5">
			<li class="nav-item">
			<a class="nav-link current-page" href="dashboard.php">Dashboard</a>
			</li>
		</ul>
		<!--<ul class="navbar-nav hvr-underline-from-center">
			<li class="nav-item">
			<a class="nav-link" href="#">Reports</a>
			</li>
		</ul>-->

		<?php
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
			/*if($_SESSION['type'] == ""){
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
			}*/
		?>
		<!--<i class="fas fa-user-circle fa-2x separator-left p-l-5 nav-profile"></i>-->
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
                    <p class="dropdown-item nav-drop-ip"><b>Wing:</b> <?php echo($_SESSION['abbr']); ?></p>
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
	  <div class="col-auto mr-auto"><span class="welcome-heading">Hello Administrator!</span></div>
		
	</div>
	
	<hr>
<!--========================================================= HEADING END ======================================================-->
	<div class="row m-t-30 m-b-20">
		<div class="col-sm-4 vr col-sm-auto text-left small text-muted">
		  <form class="" method="post" enctype="multipart/form-data" action=""> 
			  
			   <div class="form-row">
							<div class="col-md-3"><label for="work_category" class="">Type of Work:</label></div>
								<div class="col-md-9" >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="work_category" name="work_category">
                                    <option value="0" selected>Select Work Category</option>
                                    <?php
										
										
                                        $typeList = getWorkTypes();
										
                                        while($row = mysqli_fetch_assoc($typeList)){
											
                                            echo('<option value="'.$row['typeid'].'">'.$row['work_details'].'</option>');
                                        }

                                    ?>
                                </select>
								
								</div>
								
							
				</div>
				
				<div class="form-row">
							<div class="col-md-3"><label for="zone" class="">Zone:</label></div>
								<div class="col-md-9"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="zone" name="zone" >
                                    <option value="0" selected>Select Zone</option>
                                    <?php
										
                                        $typeList = getZoneTypes();
										
                                        while($row = mysqli_fetch_assoc($typeList)){
											
                                            echo('<option value="'.$row['zone-id'].'">'.$row['zone-name'].'</option>');
                                        }

                                    ?>
                                </select>
								</div>
								
								
				</div>
				<br>
				
				<div class="form-row">
							<div class="col-md-3"><label for="division" class="">Division:</label></div>
							
								<div class="col-md-9"  >
									<select class="form-control form-control-sm form-mandatory m-t-5" id="division" name="division" >
                                    <option value="0" selected>Select Division</option>
                                    
									</select>
								</div>
								
								
				</div>
				 <div class="m-t-20 d-flex justify-content-center" style="text-align:center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-sm m-t-5 m-r-50">Submit</button>
                                <button type="button" name="cancel" class="btn btn-sm btn-danger m-t-5 m-r-50" onclick="return clearForm(this.form);">Clear</button>
				</div>
			</form>	
		</div>
		<div class="col-sm-8" id="mtable" >
			<div class="card text-center">
				<h5 class="card-header card-heading">Project List</h5>
				<div class="card-body" id="Grid">
					<?php
					/*$countQuery = "select count(*) as source_count from `project_details` ";
					$connection = openDBConnection();  
					//run query
					$result = mysqli_query($connection, $countQuery);
					closeDBConnection($connection);

					$row = mysqli_fetch_assoc($result);
					echo($row['source_count']);*/
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
								echo('<tr>');
								echo('<td>'.$row_id.'</td>');
								echo('<td style="text-align:left;vertical-align:middle">'.$row['project_name'].'</td>');
								echo('<td style=" text-align: center;" data-toggle="tooltip" data-placement="top" title="View Project details"><a href="#?id='.base64_encode($row['project_no']).'" target="_blank" rel="noopener noreferrer"><span class="action-history"><i class="fas fa-stream"></i></span></a></td>');
								
								echo('</tr>');
								$row_id++;
							}
							echo('</tbody>');
							echo('</table>');
						}
					?>
				</div><!--grid-->
				
			</div>
		</div>

	</div>
	<hr>
</div>
					
			
		


<br><br>
<footer class="page-footer font-small blue pt-4">
<div class="footer-style footer-copyright text-center py-3">
	<span>&#169;2020 Copyright: OPTCL Ltd.</span><br>
	<span>Recommended Browsers: Chrome 80.0+ Firefox 80.0+</span>
</div>
</footer>







<!--==================================================================================JQUERY JS=============
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>-->
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
<!--==================================================================================DATA TABLES JS=============
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<!--==================================================================================DATA TOGGLE JS=============
	<script src="vendor/toggle/bootstrap4-toggle.min.js"></script>-->


<!--

	<script>
		$('.dropdown-toggle').click(function () {
			$(this).next('.dropdown-menu').slideToggle(400);
		});

		$('.dropdown-toggle').focusout(function () {
			$(this).next('.dropdown-menu').slideUp(400);
		});
	</script>-->
	<script>
  
        /* Initialization of datatable */
        $(document).ready(function() {
            $('#dataTable').DataTable({ });
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


