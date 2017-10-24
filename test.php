<?php

class dbConnect{
	private $conn;
	
	public function connect(){
	
		//Open connection to database
		$this->conn = new mysqli_connect("127.0.0.1", "phpuser", "chyour2016");
		$db_found = mysqli_select_db($this->conn,chyourDB);
		if($db_found){
			print "Database found";
		}
		return $this->conn;
	
	}

}

?>
