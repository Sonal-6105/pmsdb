<?php
	require 'functions.php';
	$id = explode("-", $_POST['key'])[1];
	$project_id = explode("-", $_POST['key'])[2];
	
	if($_POST['action'] == "true"){
		if(adSource1($id,$project_id, 'Y')){
			echo('Source Activated');
		}
		else{
			echo('Failed to Activate Source');
		}
	}
	else{
		if(adSource1($id,$project_id, 'N')){
			echo('Source Deactivated');
		}
		else{
			echo('Failed to Deactivate Source');
		}
	}
	
?>