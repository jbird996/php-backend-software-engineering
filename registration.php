<?php

//New user registration

require_once 'include/dbFunctions.php';
$db = new dbFunctions();
 
// json response array
$response = array("error" => FALSE);


if (isset($_GET['fullname']) && isset($_GET['email']) && isset($_GET['password'])) {
    
    // receiving the post params
    $verified = '0';
    $fullname = $_GET['fullname'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    
    // check if user is already exists with the same email
    if ($db->userExists($email)) {
        // user already exists
        $response["error"] = TRUE;
        $response["error_msg"] = "User already exists with email address " . $email;
        echo json_encode($response);

    } else if($db->badEmail($email)){
	
	$response["error"] = TRUE;
	$response["error_msg"] = "Bad Email! Does not contain '@' or '.'";
	echo json_encode($response); 
    
   } else if($db->badUser($fullname, $password)){
	
	$response["error"] = TRUE;
	$response["error_msg"] = "Either username or password is empty!";
	echo json_encode($response);

    } else {
        // create a new user
        $user = $db->storeUser($fullname, $email, $password, $verified);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["userID"];
            //$response["user"]["fullname"] = $user["fullname"];
            //$response["user"]["email"] = $user["email"];
	    
	    // Generate verification email - Jason

	    $to = $email;
	    $subject = "Please Verify Your chYOUR Account";
	    $message = "Thanks for creating an account with us!  Please verify your account by following the link below: \r\n\r\nhttp://128.205.44.23/chyour/verify.php?userID=" . $user["userID"];
	    $headers = "From: chyourapp@gmail.com" . "\r\n";
	    mail($to,$subject,$message,$headers);

	    echo json_encode($response);
	    
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Failed to store user";
            echo json_encode($response);
        }
    } 
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (fullname, email or password) is missing!";
    echo json_encode($response);
}

?>
