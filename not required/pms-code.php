<?php 
	error_reporting(1);
	require 'connection.php';
	require 'functions.php';
	session_name('pmsdb');
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	
 if(isset($_POST['submit'])){


//if(insertChat($row['project_no'],$_SESSION['name'],$_POST['talking_point'],$timestamp,$sent_row,$status)){

$project_no=$_POST['project_no']; 
$sent_by=$_SESSION['name']; 
$talking_point=	$_POST['talking_point']; 
$timestamp = date("Y-m-d H:i:s");	
$sent_to =$_POST['sent_to'];
$status="unread";

echo ($project_no."\n");

foreach($sent_to as $sent_row)
{
	//echo ($sent_row);
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
	 
	 
	 
	 
 }




?>