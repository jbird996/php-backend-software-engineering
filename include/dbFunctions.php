<?php

// Common functions for DB operation

class dbFunctions {
 
    	private $conn;

	// Constructor

    	function __construct() {
		$username = "phpuser";
   		$password = "chyour2016";
    		$database = "chyourDB";
		$server = "127.0.0.1";

		$this->conn = mysqli_connect($server,$username,$password);
		$db_found = mysqli_select_db($this->conn,$database);
    	}
    	
    	// Destructor

    	function __destruct() {
    	
	}

	// Attempt to store user in database
    
	public function storeUser($fullname, $email, $password, $verified) {
        	//$uuid = uniqid('', true);
 
	        $stmt = $this->conn->prepare("INSERT INTO usersTBL(fullname, email, password, verified) VALUES(?, ?, ?, ?)");
        	$stmt->bind_param('sssi', $fullname, $email, $password, $verified);
        	$result = $stmt->execute();
        	$stmt->close();
		 
	        // Check for successful store

        	if ($result) {
            		$stmt = $this->conn->prepare("SELECT * FROM usersTBL WHERE email = ?");
            		$stmt->bind_param('s', $email);
            		$stmt->execute();
            		$user = $stmt->get_result()->fetch_assoc();
            		$stmt->close();
			return $user;
        	} else {
            		return false;
        	}
	}
     
	// Check if user exists
     
	public function userExists($email) {
	        $stmt = $this->conn->prepare("SELECT email from usersTBL WHERE email = ?");
        	$stmt->bind_param("s", $email);
	        $stmt->execute();
	        $stmt->store_result();
 
        	if ($stmt->num_rows > 0) {
            		// user exists 
            		$stmt->close();
            		return true;
        	} else {
         	   	// user does not exist
            		$stmt->close();
            		return false;
        	}
    	}

	public function checkUser($email, $password){

		$stmt = $this->conn->prepare("SELECT * FROM usersTBL WHERE email = ?");
		$stmt->bind_param("s", $email);

		$result = $stmt->execute();
		if($result){
			$user = $stmt->get_result()->fetch_assoc();

			$stmt->close();
			
			$pass = $user['password'];
			if($pass == $password){
				return $user;
			}
		} else {
			return NULL;
		}	
	}
	
	public function badEmail($email){
		
		if(strpos($email, '@') == false || strpos($email, '.') == false){
			return true;
		}

	}
	
	public function addTask($uid, $title, $desc, $datee, $addr, $range,  $lat, $long) {
			
	    $stmt = $this->conn->prepare("INSERT INTO tasksTBL(userID, taskTitle, description, date, address, taskRange, latitude, longitude)
			 VALUES(?,?,?,?,?,?,?,?)");
            $stmt->bind_param('issssiii', $uid, $title, $desc, $datee, $addr, $range, $lat, $long);
            $result = $stmt->execute();
            $stmt->close();
	    
	    if($result){
		return true;
	    } else {
		return false;
	    }
	}

	public function deleteUser($uid){
	
		$stmt = $this->conn->prepare("DELETE FROM usersTBL WHERE userID = ?");
		$stmt->bind_param('i', $uid);
		$result = $stmt->execute();	
		$stmt->close();
		
		if($result){ 
			$stmt = $this->conn->prepare("DELETE FROM tasksTBL WHERE userID = ?");
                	$stmt->bind_param('i', $uid);
                	$result = $stmt->execute();
                	$stmt->close();
			return true;
		} else {
			return false;
		}

	}
	
	// Function to verify user in Database - Jason

	public function verify($uid){
	
	        $stmt = $this->conn->prepare("UPDATE usersTBL set verified='1' WHERE userID = ?");
        	$stmt->bind_param("i", $uid);
	        $result = $stmt->execute();
	        $stmt->close();

		if($result){ 
			return true;
		} else {
			return false;
		}
 
	}
	public function badUser($fullname, $password){

		if(empty($fullname) || empty($password)){
			return true;
		} else {
			return false;
		}
	}
	
	public function deleteTask($tid, $uid){

		$stmt = $this->conn->prepare("DELETE FROM tasksTBL WHERE taskID = ? AND userID = ?");
		$stmt->bind_param('ii', $tid, $uid);
		$result = $stmt->execute();
		$stmt->close();
		if($result){
			return $result;
		} else {
			return false;
		}
	}	
}

?>
