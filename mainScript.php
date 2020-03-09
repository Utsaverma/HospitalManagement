<?php 
include('Patient.php');

$patientNumber='000000001';
$usShortDate='02/02/2009';


$patient=new Patient($patientNumber);
$patient->returnInsuaranceDetails($usShortDate);

?> 
