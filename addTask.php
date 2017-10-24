<?php
 
// Code to add a new task ot the DB

require_once 'include/dbFunctions.php';
$db = new dbFunctions();
 
// json response array
$response = array("error" => FALSE);

if (isset($_GET['userID']) && isset($_GET['description']) && isset($_GET['date']) && isset($_GET['address']) &&
	isset($_GET['taskTitle']) && isset($_GET['taskRange']) &&  isset($_GET['latitude']) && isset($_GET['longitude']) ) {
    	
    // receiving the post params
    $uid = $_GET['userID'];
    $title = $_GET['taskTitle'];
    $desc = $_GET['description'];
    $datee = $_GET['date'];
    $addr = $_GET['address'];
    $range = $_GET['taskRange'];
    $lat = $_GET['latitude'];
    $long = $_GET['longitude'];

    // store task to the server 
   if($db->addTask($uid, $title, $desc, $datee, $addr, $range, $lat, $long)){
	
	$response["error"] = false;
	$response["error_msg"] = "Successfully added task";
	echo json_encode($response);

   } else {
	
	$response["error"] = true;
	$response["error_msg"] = "Unable to store task";
	echo json_encode($response);
   }

} else {
	 
	$response["error"] = true;
	$response["error_msg"] = "Missing parameter";
	echo json_encode($response);
}

?>
