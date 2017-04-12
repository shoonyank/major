<?php
include '../dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}

$qid=array();
$query="Select qid from questionstest where page=".$_GET["a"]." and shown_to='".$_GET["snf"]."'";
$result = $con->query($query);
if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {
        array_push($qid, $row["qid"]);
    }
}
echo json_encode(array('qid'=>$qid));
echo $qid[0];
?>