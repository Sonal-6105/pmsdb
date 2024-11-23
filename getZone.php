<?php

	
	error_reporting(1);
	require 'connection.php';
	require 'functions.php';
	//session_name('pmsdb');
	//session_start();
	date_default_timezone_set("Asia/Kolkata");
	
	
//$departmentid = $_POST['dept'];

//$workid = $_POST['work'];
/*if(isset($_POST['zone'])){
   $zoneid = mysqli_real_escape_string($_POST['zon']); // department id
}*/

$users_arr = array();


    $sql = 'select * from `zone` ';
	$connection = openDBConnection();   
    $result = mysqli_query($connection,$sql);
    
    while( $row = mysqli_fetch_array($result) ){
        $userid = $row['zone-id'];
        $name = $row['zone-name'];
    
        $users_arr[] = array("id" => $userid, "name" => $name);
    }


// encoding array to json format
echo json_encode($users_arr);