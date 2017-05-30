<?php
include '../database/dbconnect.php';
$test=$_GET["testname"];
$sid=$_GET["sid"];
$query="Select score from ans_table where sid=".$sid." and test_name='".$test."' and time_stamp=(Select max(time_stamp) from ans_table where test_name='".$test."' AND sid=".$sid.")";
$result=$con->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $score=$row["score"];
    }
}
$query1="Select COUNT(question) as total from test where test_name='".$test."'";
$result1=$con->query($query1);
if ($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()) {
        $total=$row1["total"];
    }
}
if(isset($score) && isset($total)){
	$text="<b>Right Answers: </b>". $score . " <br><b>Total Questions: </b>".$total;
	$data = array('text' => $text);
	echo json_encode($data);
}

if(!(isset($score) && isset($total))){
	$text="You have not given this exam.";
	$data = array('text' => $text);
	echo json_encode($data);
}
?>