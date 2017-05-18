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
        <script type="text/javascript">
        	$(document).ready(function(){
			    $("#btn1").click(function(){
			        $("#questions").append(" <br><input type='text' name='question' placeholder='Question'><input type='text' name='op1' placeholder='Option 1'><input type='text' name='op2' placeholder='Option 2'><input type='text' name='op3' placeholder='Option 3'><input type='text' name='op4' placeholder='Option 4'><input type='text' name='rans' placeholder='Right Option No'>");
			    });
			});
        </script>
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
        	<input type="text" name="testname" placeholder="Test Name"><br>
        	<span id="questions">
	        	<input type="text" name="question" placeholder="Question">
	        	<input type="text" name="op1" placeholder="Option 1">
	        	<input type="text" name="op2" placeholder="Option 2">
	        	<input type="text" name="op3" placeholder="Option 3">
	        	<input type="text" name="op4" placeholder="Option 4">
	        	<input type="text" name="rans" placeholder="Right Option No">
        	</span>
        	<button id="btn1">Add Question</button>
        	<input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>