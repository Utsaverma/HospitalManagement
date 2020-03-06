<?php

$user='root';
$pass='';
$db='raintree';

$conn=mysqli_connect('localhost',$user,$pass,$db);
if (mysqli_connect_errno($conn)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
else{
	$query="select Concat(first, last) full_name from patient; ";
	$result=mysqli_query($conn,$query);
	if($result){
		$fullString="";
		$fullStringLength=0;
		while($row=mysqli_fetch_assoc($result)){
			$fullString=$fullString.$row['full_name'];
		}
		$fullString=strtoupper($fullString);
		$fullStringLength=strlen($fullString);
		foreach (count_chars($fullString, 1) as $i => $val) {
			$percentVal=round(($val*100)/$fullStringLength,2);
			
		   echo chr($i) ,"\t",$val,"\t",$percentVal,"\n";
		}
		mysqli_free_result($result);
	}
}
mysqli_close($conn)
?>