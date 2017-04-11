<?php
session_start();
include '../dbconnect.php';

$question=$_GET["question"];
$prime_tag=$_GET["prime_tag"];
$shown_to=$_GET["shown_to"];

function getpageno(){
	include '../dbconnect.php';
	$query="Select max(page) from questionstest";
	$result = $con->query($query);
	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
    	    $highest=$row["max(page)"];
    	}
	}
    $query1="Select count(*) as total from questionstest";
	$result1 = $con->query($query1);
	if ($result1->num_rows > 0) {
    	while($row1 = $result1->fetch_assoc()) {
        	$total=$row1["total"];
    	}
	}
    $ans=($highest*5)-$total;
    if($ans==0){
    	$page=$highest+1;
    }
    else{
    	$page=$highest;
    }
    return $page;
}
function insert($question,$posted_by_id,$id_of,$prime_tag,$shown_to){
	include '../dbconnect.php';
	$page=getpageno();
	$query2="Insert into questions(question,posted_by_id,id_of,prime_tag,shown_to,page) values('".$question."',".$posted_by_id.",'".$id_of."','".$prime_tag."','".$shown_to."',".$page.")";
	if ($con->query($query2) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error";
	}
}
if(isset($_SESSION["sid"])){
	$posted_by_id=$_SESSION["sid"];
	$id_of="student";
	insert($question,$posted_by_id,$id_of,$prime_tag,$shown_to);
}
else if(isset($_SESSION["fid"])){
	$posted_by_id=$_SESSION["sid"];
	$id_of="faculty";
	insert($question,$posted_by_id,$id_of,$prime_tag,$shown_to);
}
else{
	echo "Error code: 5204";
}
?>