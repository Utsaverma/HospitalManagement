<?php 

class Insurance implements PatientRecord{ 
	
	public $_id;
	public $patientId;
	public $iname;
	public $fromDate;
	public $toDate;
	
	function __construct($_id) {		
		$connection=new Connection();
		$conn=$connection->openConnection();
		if(mysqli_connect_errno($conn)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else{
			$query="select _id,patient_id,iname,from_date,to_date from insurance where _id='$_id'";
			$result=mysqli_query($conn,$query);
			if($result){
				$row=mysqli_fetch_assoc($result);
				$this->patientId = $row['patient_id'];
				$this->_id=$row['_id'];
				$this->iname = $row['iname'];
				$this->fromDate = $row['from_date'];
				$this->toDate = $row['to_date'];
				mysqli_free_result($result);
			}
		}
		$connection->closeConnection();
	}

    public  function getId() {  
		return $this->_id;
    }  
    public  function getPatientNumber(){  
		return $this->patientId;
    }
	public function isInsuranceValid($usFormatDate) {
		
		$timestamp = strtotime($usFormatDate);
		$new_date = date("Y-m-d", $timestamp); //yyyy-mm-dd
		if ($new_date >= $this->fromDate){
			if(isset($this->toDate)){
				if($new_date <= $this->toDate){
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return true;
			}
		}else{
			return false;
		}
	}
} 
  
?> 
