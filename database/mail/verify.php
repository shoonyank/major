<?php
session_start();
function insert_go(){
	header('Location: http://localhost/Online%20Exam%20Portal/activate.php');
	exit;
}

$to=$_SESSION['email'];
$subject='Activation Code';
$message='<h1>Your verification code is'.$_SESSION['activation_code'].'</h1>';
$headers="From:www.webcods.in\r\n";
$headers .="Reply-To:reply@webcods.in\r\n";
$headers .="Content-type:text/html\r\n";

mail($to,$subject,$message,$headers);
?>