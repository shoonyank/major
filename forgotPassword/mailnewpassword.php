<?php
function gotoindex(){
    header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/index.php');
    exit;
}
$to=$_COOKIE[$cookie_name1];
$subject='Authentication Code';
$message='<h1>Your new password is '.$_GET["newpassword"].'</h1>';
$headers="From:www.webcods.in\r\n";
$headers .="Reply-To:noreply@webcods.in\r\n";
$headers .="Content-type:text/html\r\n";

mail($to,$subject,$message,$headers);
gotoindex();
?>