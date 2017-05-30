<?php
include '../database/dbconnect.php';
$id=getq($_GET["testname"]);
$data=getquestiontosend($id,$_GET["qno"]);
echo json_encode($data);
function getq($testname){
    include '../database/dbconnect.php';
    
    $id=array();
    $query="Select id from test where test_name='".$testname."'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($id, $row["id"]);
        }
    }
    return $id;
}

function getquestiontosend($id,$qno){
	include '../database/dbconnect.php';
	$no=$qno-1;
	$query="Select question,option1,option2,option3,option4,rans from test where id=".$id[$no];
    $result = $con->query($query);
    if ($result->num_rows > 0) {    
        while($row = $result->fetch_assoc()) {
            $question=$row["question"];
            $option1=$row["option1"];
            $option2=$row["option2"];
            $option3=$row["option3"];
            $option4=$row["option4"];
            $rans=$row["rans"];
            if (isset($id[$qno])) {
            	$next="true";
            }
            else{
            	$next="false";
            }
        }
    }
    $data = array('question' =>$question , 'option1'=>$option1,'option2'=>$option2,'option3'=>$option3,'option4'=>$option4,'rans'=>$rans,'next'=>$next);
    return $data;
}
?>