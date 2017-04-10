<?php
$server	    = 'localhost';
$username	= 'root';
$password	= '';
$database	= 'online_exam_portal';
$con=new mysqli($server,$username,$password,$database);

if($con->connect_error)
{
 	echo "Error: could not establish database connection";
}
	$counterPhone=0;
function phoneNumber(){
	$queryStud="Select * from student_details where phone='".$_REQUEST["q"]."'";
	$resultStud=$con->query($queryStud);
	if($resultStud->num_rows > 0){
		//code if mail already exists
		$counterPhone=1;
	}
	$queryFac="Select * from faculty where phone='".$_REQUEST["q"]."'";
	$resultFac=$con->query($queryFac);
	if($resultFac->num_rows > 0){
		//code if mail already exists
		$counterPhone=1;
	}
}

if($counterPhone>0){
	$return="Phone Number already used";
}
else{
	$return="";
}
echo $return;
?>