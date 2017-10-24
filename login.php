<?php

// User login

require_once 'include/dbFunctions.php';

$db = new dbFunctions();

//json response array
$response = array("error" => FALSE);

if(isset($_GET['email']) && isset($_GET['password'])){
	//receiving parameters
	$email = $_GET['email'];
	$password = $_GET['password'];
	
	$user = $db->checkUser($email, $password);
	
	//check if user is found
	if($user != false){
		
		$response["error"] = FALSE;
		$response["userID"] = $user["userID"];
		//$response["user"]["fullname"] = $user["fullname"];
		//$response["user"]["email"] = $user["email"];
		echo json_encode($response);
	} else {	
		//user not found with email or password
		$response["error"] = TRUE;
		$response["error_msg"] = "Email or Password is wrong. Try again.";
		echo json_encode($response);
	}
} else {
	//credential is missing
	$response["error"] = TRUE;
	$response["error_msg"] = "Email or Password is missing.";
	echo json_encode($response);
}

?>  
