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
$query="Select question,timestamp, prime_tag from student_questions where qid=".$_GET["q"];
$result = $con->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {        
        array_push($data, $row["question"]);
        array_push($data, $row["timestamp"]);
        array_push($data, $row["prime_tag"]);
    }
}
$question=$data[0];
$timestamp=$data[1];
$prime_tag=$data[2];
echo json_encode(array('question'=>$question,'timestamp'=>$timestamp,'prime_tag'=>$prime_tag));
?>