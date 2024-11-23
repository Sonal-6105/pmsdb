<?php
	
	error_reporting(0);
	require 'connection.php';
	require 'functions.php';
	session_name('pms');
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
	<title>Dashboard | Project Management System</title>
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
<!--===============================================================================================-->

<script src="plug/sweet-alert/sweetalert2.all.min.js"></script>
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

<div class="container-fluid p-l-50 p-r-50">
<!--=============================================== ROW-1 ==========================================-->
	<div class="d-flex justify-content-between" style="border-bottom: 1px #d9d9d9 solid;">
		<div class="p-2">
			<div class="wrapper">
				<div class="typing-effect" style="width:600px">
					Welcome! <b><?php echo($_SESSION['name']); ?></b>
				</div>
			</div>
		</div>
		<div class="p-2 dash-info">
			
			<a href="pms-new-scheme.php" class="btn btn-info" role="button">ADD NEW SCHEME</a>
			
		</div>
	</div>


<div class="row">
<div class="col-md-12">
			<div class="badge badge-light">
				<br>
				<br>
                
                <h4><span class="badge badge-primary wrapper ">List of Schemes:</span></h4>
                <br>
				<br>
                <?php
                    //$_SESSION['nodes'] = '';
                    //getSessionLeafNodes($_SESSION['wing_id']);
                    //$nodes = array_filter(explode('-', $_SESSION['nodes']));
                    //$projects = getUserProjects($nodes);
					
					$query='select * from scheme where wing_id = '.$_SESSION['wing_id'];
					$connection = openDBConnection();
					$projects=mysqli_query($connection,$query);
  
					// Return the number of rows in result set
					$rowcount=mysqli_num_rows($projects);
					//echo($_SESSION['wing_id']);
					//echo "<br>";
					//echo($rowcount);
					//echo "<br>";
					//echo("Hi");
					//echo "<br>";
                    if(mysqli_num_rows($projects) == 0){
                        echo('No Schemes have been added yet.');
                    }else{
                        echo('<table class="table table-sm table-bordered table-striped" id="dataTable" style="border: solid 1px #00643a; font-size: 13px;">');
                        echo('<thead>
                        <tr class="table-success">
                            <th scope="col" style="border: solid 1px #00643a;">#</th>
                            <th scope="col" style="border: solid 1px #00643a;">Scheme Name</th>
							<th scope="col" style="border: solid 1px #00643a;">Objective</th>
							<th scope="col" style="border: solid 1px #00643a;">Department</th>
							<th scope="col" style="border: solid 1px #00643a;">Executive Head</th>
                            <th scope="col" style="border: solid 1px #00643a;">Estimated Cost</th>
							<th scope="col" style="border: solid 1px #00643a;">Sanctioned Cost</th>
							<th scope="col" style="border: solid 1px #00643a;">Funding Mechanism</th>
							<th scope="col" style="border: solid 1px #00643a;">Target Date of Completion</th>
							<th scope="col" style="border: solid 1px #00643a;">Expenditure Till Date</th>
							<th scope="col" style="border: solid 1px #00643a;">Status</th>
							<th scope="col" style="border: solid 1px #00643a;">Remarks</th>
							<th scope="col" style="border: solid 1px #00643a;">View Details</th>
							<th scope="col" style="border: solid 1px #00643a;">Actions</th>
                        </tr>
                        </thead>');
                        echo('<tbody style="font-size:12px; text-align: left;">');
                        $row_id=1;
                        while($row = mysqli_fetch_assoc($projects)){
                            echo('<tr>');
                            echo('<td style="border: solid 1px #00643a;">'.$row_id.'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['scheme_name'].'</td>');
                            echo('<td style="border: solid 1px #00643a; width: 25%;">'.$row['objective'].'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['wing_id'].'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['executive_head'].'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['estimated_cost'].'</td>');
							echo('<td style="border: solid 1px #00643a;">'.$row['sanctioned_cost'].'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['funding_mechanism'].'</td>');
							echo('<td style="border: solid 1px #00643a;">'.$row['target_completion'].'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['expenditure_till_date'].'</td>');
							echo('<td style="border: solid 1px #00643a;">'.$row['progress'].'</td>');
                            echo('<td style="border: solid 1px #00643a;">'.$row['remarks'].'</td>');
							echo('<td style="border: solid 1px #00643a; text-align: center;" data-toggle="tooltip" data-placement="top" title="View scheme details"><a href="pms-view-scheme.php?id='.base64_encode($row['id']).'" target="_blank" rel="noopener noreferrer"><span class="action-history"><i class="fas fa-stream"></i></span></a></td>');
							echo('<td style="border: solid 1px #00643a; text-align: center;" data-toggle="tooltip" data-placement="top" title="Add project"><a href="pms-new-project.php?id='.base64_encode($row['id']).'" target="_blank" rel="noopener noreferrer"><span class=""><i class="fa fa-plus"></i></span></a></td>');
                            echo('</tr>');
                            $row_id++;
                        }
                        echo('</tbody>');
                    echo('</table>');
                    }
                
                
                
                ?>
			</div>
		</div>

</div>
		
	
</div>

<br><br>
<footer class="page-footer font-small blue pt-4">
<div class="footer-style footer-copyright text-center py-3">
	<span>&#169;2020 Copyright: OPTCL Ltd.</span><br>
	<span>Recommended Browsers: Chrome 80.0+ Firefox 80.0+</span>
</div>
</footer>


<!--==================================================================================JQUERY JS=============-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
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
</body>
</html>
