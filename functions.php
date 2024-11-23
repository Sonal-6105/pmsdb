<?php
include_once('connection.php'); //include the connection file

function getUserDetails($email){
    $connection = openDBConnection();               //open connection
    $query = 'select u.name as name, u.id as uid, u.type as type,u.parent_id as parent_id,w.id as wing_id, w.name as wing, w.abbr as abbr, u.last_login as last_login, u.ip as ip, u.browser as browser
    from user u, wing w
    where u.wing_id = w.id
    and u.active = "Y"
    and u.email = "'.$email.'"';                    //prepare the query
    $result = mysqli_query($connection, $query);    //get result in associative array
    $data = array();                                //capture data in array
    foreach ($result as $row){
    $data[] = $row;
    }
    closeDBConnection($connection);
    return $data;                                   //return the array
}
function getProjectOwnerDetails($email){
    $connection = openDBConnection();               //open connection
    $query = 'select * from `project_details` where project_manager ='.$email;                    //prepare the query
    $result = mysqli_query($connection, $query);    //get result in associative array
    
	
	$data = array();                                //capture data in array
    foreach ($result as $row){
    $data[] = $row;
    }
    closeDBConnection($connection);
    return $data;                                   //return the array
}




function isValidUser($email,$password){
    //This function shall validate username and password through LDAP
	/*$bind_rdn = "uid=".$email.",ou=users,dc=optcl,dc=co,dc=in";
    $ldapconn = ldap_connect("10.2.16.54");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
   ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
    if($ldapconn){
        $ldapbind = ldap_bind($ldapconn, $bind_rdn, $password);
        if($ldapbind){
            return true;
        }else{
            return false;
        }
    }else{
        echo('<div class="text-center login-error"><i class="fas fa-exclamation-circle"></i> Authentication Server not Reachable!.</div>');
        return false;
    }*/
    return true;
}

function markLogin($user, $timestamp, $ip, $browser){
    $connection = openDBConnection();
    $query = 'update user
    set last_login = "'.$timestamp.'",
    ip = "'.$ip.'",
    browser = "'.$browser.'"
    where email = "'.$user.'"';
    mysqli_query($connection, $query);
    closeDBConnection($connection);
}

//retrieve list of Work types 

function getWorkTypes($department){
    $query = 'select typeid, work_details from `work-category` where wing_id ='.$department;

    $connection = openDBConnection();               //open connection
    $result = mysqli_query($connection, $query);    //get result in associative array
    closeDBConnection($connection);

    return $result;
}

function getWorkTypes1(){
    $query = 'select typeid, work_details from `work-category` ';

    $connection = openDBConnection();               //open connection
    $result = mysqli_query($connection, $query);    //get result in associative array
    closeDBConnection($connection);

    return $result;
}


//retrieve list of Zone types 

function getZoneTypes(){
    //$query = 'select * from `zone` where wing_id = "'.$department.'"';
	$query = 'select * from `zone` ';
    $connection = openDBConnection();               //open connection
    $result = mysqli_query($connection, $query);    //get result in associative array
    closeDBConnection($connection);

    return $result;
}

//retrieve list of Department  

function getDepartment(){
    $query = 'SELECT * FROM `wing` WHERE `id` NOT IN (7,8)';

    $connection = openDBConnection();               //open connection
    $result = mysqli_query($connection, $query);    //get result in associative array
    closeDBConnection($connection);

    return $result;
}

//retrieve list of Division types 

/*function getDivisionTypes($zone_id){
    $query = 'select * from `division` where zone_id = '.$zone_id ;
	//$query = 'select * from `division` ';
    $connection = openDBConnection();               //open connection
    $result = mysqli_query($connection, $query);    //get result in associative array
    closeDBConnection($connection);

    return $result;
}*/

//fetch Project count
function sourceCount(){
	$countQuery = "select count(*) as source_count from `project_details` ";
	$connection = openDBConnection();  
	//run query
	$result = mysqli_query($connection, $countQuery);
	closeDBConnection($connection);

	$row = mysqli_fetch_assoc($result);
	return($row['source_count']);
}

//fetch all Project from `project_details` table
function fetchAllSource(){
	$query = 'select * from `project_details` ORDER BY `project_no` desc ';
	
	//open database connection
	$connection = openDBConnection(); 

	//run query
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);

	return $result;
}
//fetch all Project from `project_details` table
function fetchLimitSource($work_category,$zone,$division){
	if($work_category=="4" && $zone=="3" && $division=="7"){
	$query = 'select * from `project_details`';	
	$connection = openDBConnection(); 

	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);

	return $result;
	}
	else {
	
	$query1 = 'select * from `project_details` where work_typeid="'.$work_category.'" and zone_id="'.$zone.'" and div_id="'.$division.'"';
	
	
	$connection = openDBConnection(); 

	
	$result = mysqli_query($connection, $query1);
	closeDBConnection($connection);

	return $result;
	
	}
}

function fetchAllDepartmentManager($wing_id){
	$query = 'select * from `project_details` where department_id ="'.$wing_id.'" ORDER BY `project_no` desc ';
	//$query = 'select * from `project_details` where project_manager ="'.$email.'"';
	//open database connection
	$connection = openDBConnection(); 

	//run query
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);

	return $result;
}
function fetchAllZoneManager($parent_id,$wing_id){
	$query = 'select * from `project_details` where zone_id ="'.$parent_id.'" and department_id="'.$wing_id.'"  ORDER BY `project_no` desc ';
	//$query = 'select * from `project_details` where project_manager ="'.$email.'"';
	//open database connection
	$connection = openDBConnection(); 

	//run query
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);

	return $result;
}



function fetchAllSourceManager($email){
	$query = 'select * from `project_details` where project_manager ="'.$email.'" or created_by="'.$email.'" ORDER BY `project_no` desc ';
	//$query = 'select * from `project_details` where project_manager ="'.$email.'"';
	//open database connection
	$connection = openDBConnection(); 

	//run query
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);

	return $result;
}


function getUnreadNotiCount($id,$name)
{
	$query = 'select count(*) as count from `project_chats` where status ="unread" and project_no ='. $id.' and sent_to="'.$name.'"';
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	$data = mysqli_fetch_assoc($result);
	closeDBConnection($connection);
	return $data['count'];
}


function setStatus($pid)
{
	$query = 'UPDATE `project_chats` SET status ="read" WHERE project_no = "' . $pid . '" and sent_to="'.$_SESSION['id'].'"';

	$connection = openDBConnection();
	if (mysqli_query($connection, $query)) {
		closeDBConnection($connection);
		return true;
	} else {
		closeDBConnection($connection);
		return false;
	}
}
//function which determines if a node is leaf node or not
function isLeaf($id){
    $query = 'select id from user where parent_id = '.$id.' and id < 10000';
    $connection = openDBConnection();
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 0){
        closeDBConnection($connection);
        return true;
    }else{
        closeDBConnection($connection);
        return false;
    }
}
function getSessionLeafNodes($id){
    if(isLeaf($id)){
        $_SESSION['nodes'] .= $id.'-';
    }else{
        $query = 'select id from user where parent_id = '.$id.' and id < 10000 order by id asc';
        $connection = openDBConnection();
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
            getSessionLeafNodes($row['id']);
        }
        closeDBConnection($connection);
    }
}


//function to get list of users for project manager
function getUsers(){
    $query = 'select * from `chat_list`';
    $connection = openDBConnection();               //open connection
    $result = mysqli_query($connection, $query);    //get result in associative array
    closeDBConnection($connection);

    return $result;
}

//function to insert a new project to project tables
function createProject($project_name, $department_id, $scheme_id, $phase,$package, $estimated_cost, $awarded_cost, $project_manager, $contact_no, $implementing_agengy,$division, $tentative_date,$loa_details,$remarks, $created_by){
    $query = 'insert into project (project_name,department_id, scheme_id, phase, package,estimated_cost, awarded_cost, project_manager, contact_no, implementing_agency,division,tentative_date_completion,loa_details,remarks, created_by)
    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "siiisssssssssss", $project_name, $department_id, $scheme_id, $phase,$package, $estimated_cost, $awarded_cost, $project_manager, $contact_no, $implementing_agengy,$division, $tentative_date,$loa_details,$remarks, $created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}
//----------------------------------------------------------------------------------------
//function to fetch details of the project

function viewProject($id)
{
	$query = "select * from `project_details` where project_no=". $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}
function viewDiv($id)
{
	$query = "select * from `division` where div_id=". $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	
	closeDBConnection($connection);
	return $result;
}




function viewProjectDetails($id)
{
	$query = "select * from project_particulars,project_details where project_particulars.project_no = project_details.project_no and project_particulars.project_no=". $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewDetails($id)
{
	$query = "SELECT *  FROM `project_particulars` WHERE `lastupdate_time` IN (SELECT max(`lastupdate_time`) FROM `project_particulars` GROUP BY `project_no`) and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}


function viewPhysicalProgress($id)
{
	$query = "select * from project_physical_progress,project_details,project_particulars where lastupdate_on IN (SELECT max(`lastupdate_on`) FROM `project_physical_progress` GROUP BY `project_no`) and project_physical_progress.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_physical_progress.project_no=". $id ;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewProjectDetailsMD($id)
{
	$query = "SELECT *  FROM `project_particulars` WHERE `lastupdate_time` IN (SELECT max(`lastupdate_time`) FROM `project_particulars` GROUP BY `project_no`) and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}





function viewPhysicalDetails($id)
{
	$query = "SELECT *  FROM `project_physical_progress` WHERE `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_physical_progress` GROUP BY `project_no`) and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}


function viewFinancialProgress($id)
{
	$query = "select * from project_financial_progress,project_details,project_particulars where `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_financial_progress` GROUP BY `project_no`)and project_financial_progress.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_financial_progress.project_no=". $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewFinancialDetails($id)
{
	$query = "SELECT *  FROM `project_financial_progress` WHERE `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_financial_progress` GROUP BY `project_no`) and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewBGDetails($id)
{
	$query = "SELECT *  FROM `project_bg_details` WHERE `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_bg_details` GROUP BY `project_no`) and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewBG($id)
{
	$query = 'select * from project_bg_details where project_no='. $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewBGreport($id)
{
	$query = 'select * from project_bg_details,project_details,project_particulars where project_bg_details.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_bg_details.project_no="'. $id.'" and project_bg_details.active ="Y" ORDER BY project_bg_details.id desc';
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewHindrances($id)
{
	//$query = "select * from project_hindrances,project_details,project_particulars where `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_hindrances` GROUP BY `project_no`)and project_hindrances.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_hindrances.project_no=". $id;
	$query = 'select * from project_hindrances,project_details,project_particulars where  project_hindrances.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_hindrances.project_no="'. $id.'" and project_hindrances.active ="Y" ORDER BY project_hindrances.id desc';
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}
function viewHindrancesonly($id)
{
	$query = 'select * from project_hindrances where project_no='. $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewHindrancesDetails($id)
{
	$query = "SELECT *  FROM `project_hindrances` WHERE `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_hindrances` GROUP BY `project_no`)  and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function viewDocuments($id)
{
	$query = 'select * from project_upload_document,project_details,project_particulars where project_upload_document.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_upload_document.project_no="'. $id.'" ORDER BY project_upload_document.id desc ';
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}


function viewPublishedDocuments()
{
	$query = "select * from `publish_document` ORDER BY `id` desc";
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}


function viewDocumentsDetails($id)
{
	$query = "SELECT *  FROM `project_upload_document` WHERE `lastupdate_on` IN (SELECT max(`lastupdate_on`) FROM `project_upload_document` GROUP BY `project_no`)  and `project_no`=".$id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}



/*function viewChats($id)
{
	$query = "select * from project_chats,project_details,project_particulars where project_chats.project_no = project_details.project_no and project_particulars.project_no = project_details.project_no and project_chats.project_no=". $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}*/
function viewChats($id)
{
	$query = "select DISTINCT`message`,`project_no`,`sent_by`,`sent_time` from project_chats where project_no=". $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	closeDBConnection($connection);
	return $result;
}

function countChats($id)
{
	$query = 'select count(*) as count from project_chats where project_no =' . $id;
	$connection = openDBConnection();
	$result = mysqli_query($connection, $query);
	$data = mysqli_fetch_assoc($result);
	closeDBConnection($connection);
	return $data['count'];
}
//function to insert a new project to project tables
function insertChat($project_no, $sent_by, $message, $sent_time, $sent_to,$status){
    $query = 'insert into `project_chats` (project_no,sent_by, message, sent_time, sent_to,status)
    values (?, ?, ?, ?, ?,?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "isssss", $project_no, $sent_by, $message, $sent_time, $sent_to,$status);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}





//function to insert a new project to project tables
function createNewProject($project_name,$project_phase,$project_description,$project_site,$project_line1,$project_line2,$project_line3, $department_id, $work_type, $zone,$division, $created_by){
    $query = 'insert into `project_details` (project_name,project_phase,project_description,project_site,project_line1,project_line2,project_line3,department_id, work_typeid, zone_id, div_id,created_by)
    values (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "sssssssiiiis", $project_name,$project_phase,$project_description,$project_site,$project_line1,$project_line2,$project_line3, $department_id, $work_type, $zone,$division, $created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}



//function to insert project details  to project tables
function insertProjectDetails($project_id, $scope_of_work, $fund_type,$budget_head,$agency_name,$woDetails,$loaDate ,$estimated_cost, $awarded_cost,$scheduled_date,$license_validity ,$created_by){
    $query = 'insert into  `project_particulars` (project_no, scope_of_work, fund_type, budget_head,agency_name,woDetails,loaDate,estimated_cost,awarded_cost,scheduled_date,license_validity,created_by)
    values (?,?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "isssssssssss", $project_id,$scope_of_work, $fund_type,$budget_head,$agency_name,$woDetails, $loaDate,$estimated_cost, $awarded_cost,$scheduled_date,$license_validity ,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}



//function to update Manager Details
function updateManagerDetails($project_id,$project_name,$project_phase,$project_description,$project_site,$project_line1,$project_line2,$project_line3,$department_id,$work_typeid,$zone_id,$div_id,$project_manager, $contact_no){
    $query = 'update `project_details` set project_name= "'.$project_name.'",project_phase= "'.$project_phase.'",project_description= "'.$project_description.'",project_site= "'.$project_site.'",project_line1= "'.$project_line1.'",project_line2= "'.$project_line2.'",project_line3= "'.$project_line3.'",department_id= "'.$department_id.'",work_typeid= "'.$work_typeid.'",zone_id= "'.$zone_id.'",div_id= "'.$div_id.'",project_manager = "'.$project_manager.'", contact_no = "'.$contact_no.'" where project_no = "'.$project_id.'"';
    $connection = openDBConnection();

    if(mysqli_query($connection, $query)){
        closeDBConnection($connection);
        return true;
    }else{
        closeDBConnection($connection);
        return false;
    }
}

function updateProjectDetails($project_id, $scope_of_work, $fund_type,$budget_head,$agency_name1,$woDetails1,$loaDate1 ,$estimated_cost, $awarded_cost,$scheduled_date,$license_validity ,$created_by,$timestamp){
   $query = 'update `project_particulars` set scope_of_work = "'.$scope_of_work.'", fund_type = "'.$fund_type.'", budget_head = "'.$budget_head.'", agency_name = "'.$agency_name1.'",woDetails = "'.$woDetails1.'",loaDate = "'.$loaDate1.'" ,estimated_cost = "'.$estimated_cost.'", awarded_cost = "'.$awarded_cost.'",scheduled_date = "'.$scheduled_date.'",license_validity = "'.$license_validity.'",lastupdate_time="'.$timestamp.'" where project_no = "'.$project_id.'"';
    $connection = openDBConnection();

    if(mysqli_query($connection, $query)){
        closeDBConnection($connection);
        return true;
    }else{
        closeDBConnection($connection);
        return false;
    }
}







//function to insert project details  to project tables-----------29
function physicalProgress($project_id,$substation_progress,$substation_progress_percent,$project_line1,$foundation_line1,$foundation_total_line1,$errection_line1,$errection_total_line1,$stringing_line1,$stringing_total_line1,$project_line2,$foundation_line2,$foundation_total_line2,$errection_line2,$errection_total_line2,$stringing_line2,$stringing_total_line2,$project_line3,$foundation_line3,$foundation_total_line3,$errection_line3,$errection_total_line3,$stringing_line3,$stringing_total_line3,$tentative_date,$progress_percent,$work_stage,$remarks,$created_by){
    $query = 'insert into  `project_physical_progress` (project_no,substation_progress,substation_progress_percent,project_line1,foundation_line1,foundation_total_line1,errection_line1,errection_total_line1,stringing_line1,stringing_total_line1,project_line2,foundation_line2,foundation_total_line2,errection_line2,errection_total_line2,stringing_line2,stringing_total_line2,project_line3,foundation_line3,foundation_total_line3,errection_line3,errection_total_line3,stringing_line3,stringing_total_line3, tentative_date,progress_percent,work_stage, remarks,created_by)
    values (?, ?, ?, ?, ?,?,?,?, ?, ?, ?, ?,?,?,?, ?, ?, ?, ?,?,?,?, ?, ?, ?, ?,?,?,?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "issssssssssssssssssssssssssss",$project_id,$substation_progress,$substation_progress_percent,$project_line1,$foundation_line1,$foundation_total_line1,$errection_line1,$errection_total_line1,$stringing_line1,$stringing_total_line1,$project_line2,$foundation_line2,$foundation_total_line2,$errection_line2,$errection_total_line2,$stringing_line2,$stringing_total_line2,$project_line3,$foundation_line3,$foundation_total_line3,$errection_line3,$errection_total_line3,$stringing_line3,$stringing_total_line3,$tentative_date,$progress_percent,$work_stage,$remarks,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}

//function to insert financialProgress details 
function financialProgress($project_id,$amended_cost,$expenditure_done,$invoices_raised,$remarks,$created_by){
    $query = 'insert into  `project_financial_progress` (project_no,amended_cost,expenditure_done,invoices_raised ,remarks,created_by)
    values (?, ?, ?, ?, ?,?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "isssss",$project_id,$amended_cost,$expenditure_done,$invoices_raised,$remarks,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}

//function to insert BG details 
function bgDetails($project_id,$bg_name,$bg_number,$issued_bank,$bg_amount,$issued_date,$expiry_date,$active,$created_by){
    $query = 'insert into  `project_bg_details` (project_no,bg_name,bg_number,issued_bank,bg_amount ,issued_date,expiry_date,active,created_by)
    values (?, ?, ?, ?, ?,?,?, ?,?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "issssssss",$project_id,$bg_name,$bg_number,$issued_bank,$bg_amount,$issued_date,$expiry_date,$active,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}




//function to insert project details  to project tables
function projectHindrance($project_id,$hindrance_nature,$occurence_date,$hindrance_details,$action_taken,$active,$created_by){
    $query = 'insert into  `project_hindrances` (project_no,hindrance_nature,occurence_date,hindrance_details, action_taken,active,created_by)
    values (?, ?, ?, ?, ?,?,?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "issssss",$project_id,$hindrance_nature,$occurence_date,$hindrance_details,$action_taken,$active,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}
//function to activate or deactivate source. called by api_ad_source
function adSource($id,$project_id, $status){
	$today = date("Y-m-d");


	$query = 'update `project_hindrances` set active="'.$status.'" where id="'.$id.'" and project_no="'.$project_id.'"';

	//open database connection
	$connection = openDBConnection();


	if(mysqli_query($connection, $query)){
		closeDBConnection($connection);
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}

}
//function to activate or deactivate source. called by api_ad_source
function adSource1($id,$project_id, $status){
	$today = date("Y-m-d");


	$query = 'update `project_bg_details` set active="'.$status.'" where id="'.$id.'" and project_no="'.$project_id.'"';

	//open database connection
	$connection = openDBConnection();


	if(mysqli_query($connection, $query)){
		closeDBConnection($connection);
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}

}
//function to insert project details  to project tables
function uploadDocument($project_id,$document_name,$fileName,$created_by){
    $query = 'insert into  `project_upload_document` (project_no,document_name,document,created_by)
    values (?, ?, ?, ?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "isss",$project_id,$document_name,$fileName,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}



//function to uploadDocument  to published documnet
function publishDocument($document_name,$fileName,$created_by){
    $query = 'insert into  `publish_document` (document_name,document,created_by)
    values (?, ?, ?)';

    $connection = openDBConnection();

    $insertStatement = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($insertStatement, "sss",$document_name,$fileName,$created_by);

    //execute prepared statement
	if(mysqli_stmt_execute($insertStatement)){
		closeDBConnection($connection);
		
		return true;
	}
	else{
		closeDBConnection($connection);
		return false;
	}
}



?>
