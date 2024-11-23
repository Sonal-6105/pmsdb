<?php
	require 'functions.php';
	$id = explode("-", $_POST['key'])[1];
	$project_id = explode("-", $_POST['key'])[2];
	
	if($_POST['action'] == "true"){
		if(adSource($id,$project_id, 'Y')){
			echo('Source Activated');
			
			//echo($id);
			//echo($project_id);
		}
		else{
			echo('Failed to Activate Source');
		}
	}
	else{
		if(adSource($id,$project_id, 'N')){
			echo('Source Deactivated');
			
			//echo($id);
			//echo($project_id);
		}
		else{
			echo('Failed to Deactivate Source');
			//echo($id);
			//echo($project_id);
		}
	}
	
?>