<?php
function go(){
	header('Location: http://localhost/Major%20Project/Online%20Exam%20Portal/index.php');
	exit;
}
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
go();
?>