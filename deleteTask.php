<?php

// Task Deletion

require_once 'include/dbFunctions.php';
$db = new dbFunctions();

//json response array
$response = array("error" => FALSE);

if(isset($_GET['taskID']) && isset($_GET['userID'])){
	
	$uid = $_GET['userID'];
	$tid = $_GET['taskID'];
	
	
	if($db->deleteTask($tid, $uid)){
		$response["error"] = FALSE;
		$response["error_msg"] = "Task successfully deleted";
		echo json_encode($response);
	} else {
		$response["error"] = TRUE;
		$response["error_msg"] = "Failed to delete task";
		echo json_encode($response);
	}
} else {
	
	$response["error"] = TRUE;
	$response["error_msg"] = "userID or taskID invalid";
	echo json_encode($response);
}

?>
	
