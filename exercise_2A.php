<?php

$user='root';
$pass='';
$db='raintree';

$conn=mysqli_connect('localhost',$user,$pass,$db);
if (mysqli_connect_errno($conn)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
else{
	$query="select pt.pn,pt.last,pt.first,ins.iname,DATE_FORMAT(ins.from_date,'%m-%d-%y') start_Date,DATE_FORMAT(ins.to_date, '%m-%d-%y') end_Date from patient pt inner Join insurance ins on pt._id=ins.patient_id order by ins.patient_id desc,ins.from_date asc";
	$result=mysqli_query($conn,$query);
	if($result){
		while($row=mysqli_fetch_assoc($result)){
			printf("%s,%s,%s,%s,%s,%s\n", $row['pn'], $row['last'],$row['first'],$row['iname'],$row['start_Date'],$row['end_Date']);
		}
		mysqli_free_result($result);
	}
}
mysqli_close($conn)
?>