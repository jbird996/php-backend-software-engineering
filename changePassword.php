<?php

// Initiate Password change - passwrd is reset and email instructions sent.

require_once 'include/dbFunctions.php'
$db = new dbFunctions();

// json response array
$response = array("error" => FALSE);

if($db->changePassword($email, $password)){
	$response["error"] = False;
	$response["error_msg"] = 'Successfully changed your password';
} else {
	$response["error"] = TRUE;
	$response["error_msg"] = 'Error occurred, please try again';
}

?>
