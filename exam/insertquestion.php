<?php
session_start();
function error(){
	header("http://localhost/Major%20Project/Online%20Exam%20Portal/Error.html");
}
if(isset($_SESSION["fid"])){
}
else{
error();
}
include '../database/dbconnect.php';
$testname=$_GET["testname"];
$question=$_GET["q"];
$op1=$_GET["op1"];
$op2=$_GET["op2"];
$op3=$_GET["op3"];
$op4=$_GET["op4"];
$rans=$_GET["rans"];
/*
echo "testname:".$testname."<br>";
echo "question:".$question."<br>";
echo "op1:".$op1."<br>";
echo "op2:".$op2."<br>";
echo "op3:".$op3."<br>";
echo "op4:".$op4."<br>";
echo "rans:".$rans."<br>";
*/

$total = "SELECT count(*) as total FROM test where test_name='".$testname."'";
$result = $con->query($total);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $totalq=$row["total"];
    }
} else {
    echo "Error:6697";
}

$totalq=$totalq+1;

$insert="insert into test(test_name,question,option1,option2,option3,option4,rans,fid) values('".$testname."','".$question."','".$op1."','".$op2."','".$op3."','".$op4."','".$rans."',".$_SESSION["fid"].")";
if ($con->query($insert) === TRUE) {
    echo $totalq." questions successfully added";
} else {
    echo "Error:6697";
}

?>