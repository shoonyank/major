<?php
$server     = 'localhost';
$username = 'root';
$password = '';
$database = 'testportal2';
$con=new mysqli($server,$username,$password,$database);

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}

$comment;
$timestamp;
$question_by;
$qid;
$query0="Select comment,timestamp,fqid,qid from student_comments where com_id=".$_GET["q"];
$result0 = $con->query($query0);
if ($result0->num_rows > 0) {
    while($row0 = $result0->fetch_assoc()) {        
        $comment=$row0["comment"];
        $timestamp=$row0["timestamp"];
        if($row0["fqid"]===NULL){
        	$question_by="s";
        	$qid=$row["fqid"]
        }
        else{
        	$question_by="f";
        	$qid=$row["qid"];
        }
    }
}

$posted_by_id;
$data=array();
if($question_by=="s"){
	$query1="Select question,timestamp, prime_tag, posted_by_id from student_questions where qid=".$qid;
	$result1 = $con->query($query1);
	if ($result1->num_rows > 0) {
	    while($row1 = $result1->fetch_assoc()) {        
	        array_push($data, $row1["question"]);
	        array_push($data, $row1["timestamp"]);
	        array_push($data, $row1["prime_tag"]);
	        //$posted_by_id=$row["posted_by_id"];
	        $query2="Select name student_details where qid=".$row1["posted_by_id"];
			$result2 = $con->query($query2);
			if ($result2->num_rows > 0) {
			    while($row2 = $result2->fetch_assoc()) {        
			        array_push($data, $row2["name"]);
			    }
			}
	    }
	}
}
else if($question_by=="f"){
	$query1="Select question,timestamp, prime_tag, posted_by_id from faculty_questions where qid=".$qid;
	$result1 = $con->query($query1);
	if ($result1->num_rows > 0) {
	    while($row1 = $result1->fetch_assoc()) {        
	        array_push($data, $row1["question"]);//data0
	        array_push($data, $row1["timestamp"]);//data1
	        array_push($data, $row1["prime_tag"]);//data2
	        //$posted_by_id=$row["posted_by_id"];
	        $query2="Select name from faculty where qid=".$row["posted_by_id"];
			$result2 = $con->query($query2);
			if ($result2->num_rows > 0) {
			    while($row2 = $result2->fetch_assoc()) {        
			        array_push($data, $row2["name"]);//data3
			    }
			}
	    }
	}
}
$question=$data[0];
$timestamp=$data[1];
$prime_tag=$data[2];
$name=$data[3];

echo json_encode(array('question'=>$question,'timestamp'=>$timestamp,'prime_tag'=>$prime_tag,'comment'=>$comment,'posted_by'=>$name));
?>