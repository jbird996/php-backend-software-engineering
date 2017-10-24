<?php

// User deletion

require_once 'include/dbFunctions.php';
$db = new dbFunctions();

//json response array
$response = array("error" => FALSE);

if(isset($_GET['userID'])){

        $uid = $_GET['userID'];
        if($db->deleteUser($uid)){
                $response["error"] = FALSE;
                $response["error_msg"] = "User successfully deactivated and removed";
                echo json_encode($response);
        } else {
                //user failed to be removed
                $response["error"] = TRUE;
                $response["error_msg"] = "Failed to remove user";
                echo json_encode($response);
        }
} else {
	//userId didnt send
	$response["error"] = TRUE;
	$response["error_msg"]= "UserID failed to send";	
}

?>

