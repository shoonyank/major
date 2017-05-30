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
        if(isset($_SESSION["fid"])){
            include 'fnavbar.php';
        }
        if(isset($_SESSION["sid"])){
            include 'navbar.php';
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4" style="margin-top: 8%;">
                    <?php
                        if(isset($_SESSION["fid"])){
                            echo "<p><B>Note:</b>Only 'pdf' format files are allowed. Please try to upload your assignments in pdf format files.</p>
                <p>You will need Adobe Reader to view the assignment.</p>";
                            echo "<form action='./study_material/material_upload.php' method='post' enctype='multipart/form-data'>
                                Select <b>Study material</b> to upload:
                                <input type='file' name='assignment' id='assignment'>
                                <input type='submit' value='Upload File' name='submit'>
                                </form>";
                        }
                    ?>
                </div>
                <div class="col-sm-8" style="margin-top: 8%">
                    <?php
                        if(isset($_SESSION["fid"])){
                            //Assignments given by you
                            include 'database/dbconnect.php';
                            $filenames = array();
                            $a_name=array();
                            echo "<h3>Study Material uploaded by you</h3>";
                            $total="Select count(file_name) as total from material where fid=".$_SESSION["fid"];
                            $result_total=mysqli_query($con, $total);
                            if (mysqli_num_rows($result_total) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result_total)) {
                                    $total=$row["total"];
                                }
                            }
                            $sql = "SELECT file_name FROM material where fid=".$_SESSION["fid"]." order by time_stamp";
                            $result = $con-> query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    array_push($filenames, $row["file_name"]);
                                }
                                
                                for($i=0;$i<$total;$i++){
                                    $material_no=$i+1;
                                    echo "<a href='./study_material/books/".$filenames[$i]."'>Book:".$material_no."</a>";
                                    echo "<br>";
                                }
                            } else {
                                echo "No Books uploaded by you.";
                            }
                        }
                        else if(isset($_SESSION["sid"])) {
                            //Study Material
                            echo "<h3>Available Study Material</h3>";
                            include 'database/dbconnect.php';
                            $query="Select count(file_name) as total from material";
                            $result_query=$con->query($query);
                            if ($result_query->num_rows > 0) {
                                // output data of each row
                                while($row = $result_query->fetch_assoc()) {
                                    $total=$row["total"];
                                }
                            }
                            $materials=array();
                            $query = "SELECT file_name, time_stamp FROM material order by time_stamp desc";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    array_push($materials, $row["file_name"]);
                                }

                                for($i=0;$i<$total;$i++){
                                    $material_no=$i+1;
                                    echo "<br>";
                                    echo "<a href='study_material/books/".$materials[$i]."'> Book ".$material_no."</a>";
                                }
                            } else {
                                echo "<br>No Books Uploaded.";
                            }                            
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>