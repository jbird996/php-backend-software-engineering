<?php

// Initial sign up after creating local user.

$con=mysqli_connect("127.0.0.1", "phpuser", "chyour2016");

if(mysqli_connect_errno($con))
{
	echo '{"query_result":"ERROR"}';
}

$fullName = $_GET['fullname'];
$email = $_GET['email'];
$passWord = $_GET['password'];

$result = mysqli_query($con, "INSERT INTO usertbl (fullname, email, password) VALUES ('$fullName, '$email', '$passWord')");

if($result == true){
	echo '{"query_result":"SUCCESS"}';
}
else{
	echo '{"query_result":"FAILURE"}';
}
mysqli_close($con);

?>
