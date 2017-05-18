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
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- Fixed navbar -->
        <?php
        if($id_name="fid"){
            include 'fnavbar.php';
        }
        elseif ($id_name="sid") {
            include 'navbar.php';
        }
        ?>
        <form method="get" action="mock_test/redirect.php">
        	<select name="test_type">
        		<option>Select</option>
        		<option value="new">New Test</option>
        		<option value="edit">Edit Old Test</option>
        	</select>
        	<input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>