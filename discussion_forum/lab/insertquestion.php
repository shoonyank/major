<?php
session_start();
include '../dbconnect.php';

$question=$_GET["question"];
$prime_tag=$_GET["prime_tag"];
$shown_to=$_GET["shown_to"];

function getpageno($shown_to){
	include '../dbconnect.php';
	$query="Select max(page) from questionstest where shown_to='".$shown_to."'";
	$result = $con->query($query);
	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
    	    $highest=$row["max(page)"];
    	    echo "highest:".$highest;
    	}
	}
    $query1="Select count(*) as total from questionstest where shown_to='".$shown_to."'";
	$result1 = $con->query($query1);
	if ($result1->num_rows > 0) {
    	while($row1 = $result1->fetch_assoc()) {
        	$total=$row1["total"];
        	echo "total:".$total;
    	}
	}
    $ans=($highest*5)-$total;
    if($ans==0){
    	$page=$highest+1;
    	echo "page:".$page;
    }
    else{
    	$page=$highest;
    	echo "page:".$page;
    }
    return $page;
}
function insert($question,$posted_by_id,$id_of,$prime_tag,$shown_to){
	include '../dbconnect.php';
	$page=getpageno($shown_to);
	$query2="Insert into questionstest(question,posted_by_id,id_of,prime_tag,shown_to,page) values('".$question."',".$posted_by_id.",'".$id_of."','".$prime_tag."','".$shown_to."',".$page.")";
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