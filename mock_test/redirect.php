<?php
session_start();
if(isset($_SESSION["sid"])){
    $id_name="sid";
}
else if(isset($_SESSION["fid"])){
    $id_name="fid";
}
else{
    exit("Please Sign In to continue");
}

function new_test(){
	include 'new.php';
}

function edit_test(){
	include 'edit.php';
}

if ($_GET["test_type"]==new) {
	$activate=new_test();
}
if ($_GET["test_type"]==edit) {
	$activate=edit_test();
}

?>