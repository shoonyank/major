<?php
function authorizationpage(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/forgotPassword/activate.php');
    exit;
  }
$activation_code=rand(1000, 9999);
$to=$_POST["email"];
$subject='Authentication Code';
$message='<h1>Your authentication code is'.$activation_code.'</h1>';
$headers="From:www.webcods.in\r\n";
$headers .="Reply-To:reply@webcods.in\r\n";
$headers .="Content-type:text/html\r\n";

mail($to,$subject,$message,$headers);
authorizationpage($_POST["email"],$_POST["table"])
?>