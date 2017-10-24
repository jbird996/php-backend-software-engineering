<?php			

// Existing user check.

require_once 'include/dbFunctions.php';
$db = new dbFunctions();
 
if (isset($_GET['userID'])) {
    
	
    // receiving the post params
    $uid = $_GET['userID'];
    
    // check if user is already exists with the same email
    if ($db->verify($uid)) {
	echo "Account verification successful!  Please log into the chYOUR app to continue.";

    } else {
	echo "Account verification unsuccessful!  Please contact us at chyourapp@gmail.com for further assistance.";
    }
     
} else {
    echo "Account verification unsuccessful!  Please contact us at chyourapp@gmail.com for further assistance/";
}

?>
