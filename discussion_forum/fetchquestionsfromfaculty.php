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

$data=array();
$query="Select qid,question, posted_by_id, timestamp, prime_tag from faculty_questions where qid=".$_GET["q"];
$result = $con->query($query);
if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {        
        array_push($data, $row["question"]);
        array_push($data, $row["posted_by_id"]);
        array_push($data, $row["timestamp"]);
        array_push($data, $row["prime_tag"]);
    }
}
$query2="Select name from faculty where fid=".$data[1];
$result2 = $con->query($query2);
if ($result2->num_rows > 0) {    
    while($row2 = $result2->fetch_assoc()) {        
        $posted_by=$row2["name"];
    }
}

$question=$data[0];
$timestamp=$data[2];
$prime_tag=$data[3];
echo json_encode(array('question'=>$question,'posted_by'=>$posted_by,'timestamp'=>$timestamp,'prime_tag'=>$prime_tag));
?>