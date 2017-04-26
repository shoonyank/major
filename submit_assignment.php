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
        if($table="faculty"){
            include 'fnavbar.php';
        }
        elseif ($table="student_details") {
            include 'navbar.php';
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4" style="margin-top: 16%;">
                    <form action='./assignment/faculty_assignment_upload.php' method='post' enctype='multipart/form-data'>
                    Select file to upload:
                    <input type='file' name='assignment' id='assignment'>
                    <input type='submit' value='Upload File' name='submit'>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>