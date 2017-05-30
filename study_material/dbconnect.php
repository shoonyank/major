<?php
$server	    = 'localhost';
$username	= 'root';
$password	= '';
$database	= 'onlineexamportal';
$con=new mysqli($server,$username,$password,$database);

if($con->connect_error)
{
 	echo "Error: could not establish database connection";
}

?>