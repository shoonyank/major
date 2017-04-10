<?php
include 'dbconnect.php';
$d=strtotime("today");
date_default_timezone_set("Asia/Kolkata");
$timestamp=date("Y-m-d h:i:s", $d);
$query="Select sid,username from student_details where email='".$_POST['email']."' and password='".$_POST['password']."'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	
    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
    	session_start();
        $_SESSION["username"]=$row["username"];
        $_SESSION["sid"]=$row["sid"];
        $_SESSION["login"]=$timestamp;
        include 'take2dashboard.php';
    }

    /* free result set */
    $result->free();
}
else{
    include 'Login_Error.php';
}

?>