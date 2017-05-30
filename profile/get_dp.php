<?php
if(isset($_SESSION["sid"])){
}
else if(isset($_SESSION["fid"])){
}
else{
    exit("Please Sign In to continue");
}
function get_dp($table,$id,$id_name){
	include 'dbconnect.php';
	$query="SELECT ifNull(image,'default.jpg') as image FROM ".$table." WHERE ".$id_name."=".$id;
	$result = $con->query($query);
	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
    	    $img=$row["image"];
    	}
	}
	echo "profile/img/".$img;
}
if($profile_of=="Student"){
	$table="student_details";
	$id=$_SESSION["sid"];
	$id_name="sid";
	get_dp($table,$id,$id_name);
}
if($profile_of=="Faculty"){
	$table="faculty";
	$id=$_SESSION["fid"];
	$id_name="fid";
	get_dp($table,$id,$id_name);
}
?>