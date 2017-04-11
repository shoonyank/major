<?php
session_start();
include '../dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}
if(isset($_SESSION["sid"])){
}
else{
  exit("Please Sign In to continue");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to the lab</title>
</head>
<body>
<a href="studentindex.php">Go to Student Lab</a><br>
<a href="facultyindex.php">Go to Faculty Lab</a>
</body>
</html>