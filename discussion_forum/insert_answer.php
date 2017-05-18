<?php
session_start();
include 'dbconnect.php';
function backtopavillion($url){
	header($url);
	exit;
}
if (isset($_SESSION["sid"])) {
	$resolver_id=$_SESSION["sid"];
	$id_of="student";
}
if (isset($_SESSION["fid"])) {
	$resolver_id=$_SESSION["fid"];
	$id_of="faculty";
}

$qid=$_GET["q"];
$answer=$_GET["answer"];

//echo "resolver_id:".$resolver_id."<br>";
//echo "id_of:".$id_of."<br>";
//echo "qid:".$qid."<br>";
//echo "answer:".$answer;

$query="Insert into forum_answers(qid,resolver_id,id_of,answer) values(".$qid.",".$resolver_id.",'".$id_of."','".$answer."')";
	if ($con->query($query) === TRUE) {
		if (isset($_SESSION["sid"])){
			$url="Location: http://localhost/Major%20Project/Online%20Exam%20Portal/student_view.php";
			backtopavillion($url);
		}
	    if (isset($_SESSION["fid"])){
	    	$url="Location: http://localhost/Major%20Project/Online%20Exam%20Portal/faculty_view.php";
			backtopavillion($url);
		}
	} else {
	    echo "Error 5412";
	}
?>