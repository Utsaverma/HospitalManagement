<?php

class Connection{
	public $user;
	public $pass;
	public $db;
	public $conn;
	
	function __construct() {
		$this->db='raintree';
		$this->pass='';
		$this->user='root';
	}
	
	public  function openConnection(){  
		$this->conn=mysqli_connect('localhost',$this->user,$this->pass,$this->db);
		return $this->conn;
	}
	public function closeConnection(){
		mysqli_close($this->conn);
	}
}

?>