<?php 
include('PatientRecord.php');
include('Connection.php');
include('Insurance.php');
class Patient implements PatientRecord{ 
	
	public $_id;
	public $pn;
	public $first;
	public $last;
	public $dob;
	public $insuranceList;
	
	function __construct($pn) {
		$connection=new Connection();
		$conn=$connection->openConnection();
		if(mysqli_connect_errno($conn)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else{
			$query="select _id,first,last,dob from patient where pn='$pn'";
			$result=mysqli_query($conn,$query);
			if($result){	
				$row=mysqli_fetch_assoc($result);
				$this->_id=$row['_id'];
				$this->pn = $pn;
				$this->first = $row['first'];
				$this->last = $row['last'];
				$this->dob = $row['dob'];
				mysqli_free_result($result);
			}
			$this->insuranceList=[];
			$query="select _id from insurance where patient_id='$this->pn'";
			$result=mysqli_query($conn,$query);
			if($result){
				while($row=mysqli_fetch_assoc($result)){
					$insurance=new Insurance($row['_id']);
					$this->insuranceList[]=$insurance;
				}
				mysqli_free_result($result);
			}
		}
		$connection->closeConnection();
	}

    public  function getId() {  
		return $this->_id;
    }  
    public  function getPatientNumber(){  
		return $this->pn;
    }  
	public function getPatientName() {
		return $this->first." ".$this->last;
	}
	public function getPatientInsuaranceRec() {
		return $this->insuranceList;
	}
	public function returnInsuaranceDetails($usFormatDate) {
		foreach ($this->getPatientInsuaranceRec() as $ins) {
			$insValid="";
			if($ins->isInsuranceValid($usFormatDate)){
				$insValid="Yes";
			}
			else{
				$insValid="No";
			}
			printf("%s,%s,%s,%s\n",$this->getPatientNumber(),$this->getPatientName(),$ins->iname,$insValid);
		}
		
	}
} 
  
?> 
