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
$query="Select * from ".$_REQUEST["table"]." where username='".$_REQUEST["q"]."'";
$result=mysqli_query($con, $query);
if(mysqli_num_rows($result)>0){
	$return="Username not available";
}
else{
	$return="Username available";
}
echo $return;
?>