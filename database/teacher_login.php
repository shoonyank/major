<?php
function faculty_go(){
	header('Location: http://localhost/Online%20Exam%20Portal/faculty_page.php');
	exit;
}
include 'dbconnect.php';
$query="Select fid,name from faculty where email='".$_POST['email']."' and password='".$_POST['password']."'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {	
    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
    	session_start();
        $_SESSION["name"]=$row["name"];
        $_SESSION["fid"]=$row["fid"];        
    }
    /* free result set */
    $result->free();
}
else{
    include 'Login_Error.php';
}
faculty_go();

?>