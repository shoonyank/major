<?php
include '../database/dbconnect.php';
$testname=$_GET["testname"];
$score=$_GET["score"];
$sid=$_GET["sid"];

$query = "INSERT INTO ans_table(test_name, score, sid) VALUES ('".$testname."', ".$score.", ".$sid.")";

if ($con->query($query) === TRUE) {
    echo "Score saved successfully";
} else {
    echo "Error: 1122";
}
?>