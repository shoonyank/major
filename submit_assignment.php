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
                <p><B>Note:</b>Only "pdf" format files are allowed. Please try to upload your assignments in pdf format files.</p>
                <p>You will need Adobe Reader to view the assignment.</p>
                    <?php
                        if(isset($_SESSION["fid"])){
                            echo "<form action='./assignment/faculty_assignment_upload.php' method='post' enctype='multipart/form-data'>
                                Select <b>assignment</b> to upload:
                                <input type='text' name='a_name' id='a_name' placeholder='Assignment Name'>
                                <input type='file' name='assignment' id='assignment'>
                                <input type='submit' value='Upload File' name='submit'>
                                </form>";
                        }
                        else if (isset($_SESSION["sid"])) {
                            echo "<form action='./assignment/student_assignment_upload.php' method='post' enctype='multipart/form-data'>
                                Select <b>assignment</b> to upload:
                                ";
                            echo "<select name='a_name'><option>Select</option>";
                            include 'database/dbconnect.php';
                            $total="Select count(file_name) as total from posted_assignments";
                            $result_total=mysqli_query($con, $total);
                            if (mysqli_num_rows($result_total) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result_total)) {
                                    $total=$row["total"];
                                }
                            }
                            $filenames=array();
                            $a_name=array();
                            $sql = "SELECT a_name,file_name FROM posted_assignments";
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    array_push($filenames, $row["file_name"]);
                                    array_push($a_name, $row["a_name"]);
                                }
                                for($i=0;$i<$total;$i++){
                                    echo "<option value='".$filenames[$i]."'>".$a_name[$i]."</option>";
                                }
                            } else {
                                echo "No assignments given yet.";
                            }

                            echo "</select>";
                            echo "
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
                            echo "<h3>Your Given Assignments</h3>";
                            $total="Select count(file_name) as total from posted_assignments where fid=".$_SESSION["fid"];
                            $result_total=mysqli_query($con, $total);
                            if (mysqli_num_rows($result_total) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result_total)) {
                                    $total=$row["total"];
                                }
                            }
                            $sql = "SELECT a_name,file_name FROM posted_assignments where fid=".$_SESSION["fid"]." order by timestamp";
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    array_push($filenames, $row["file_name"]);
                                    array_push($a_name, $row["a_name"]);
                                }
                                
                                for($i=0;$i<$total;$i++){
                                    echo "<a href='assignment/assignment_question/".$filenames[$i]."'>".$a_name[$i]."</a>";
                                    echo "<br>";
                                }
                            } else {
                                echo "No assignments given yet.";
                            }
                        }
                        else if(isset($_SESSION["sid"])) {
                            //Assignments submitted by you
                            echo "Assignments submitted by you.";
                            include 'database/dbconnect.php';
                            $query="Select count(file_name) as total from submitted_assignments where sid=".$_SESSION["sid"];
                            $result_query=$con->query($query);
                            if ($result_query->num_rows > 0) {
                                // output data of each row
                                while($row = $result_query->fetch_assoc()) {
                                    $total=$row["total"];
                                }
                            }
                            $submitted_assignments=array();
                            $timestamp=array();
                            $query = "SELECT file_name, time_stamp  FROM submitted_assignments where sid=".$_SESSION["sid"]." order by time_stamp desc";
                            $result = $con->query($query);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    array_push($submitted_assignments, $row["file_name"]);
                                    array_push($timestamp, $row["time_stamp"]);
                                }

                                for($i=0;$i<$total;$i++){
                                        $assignment_no=$i+1;
                                    echo "<br>";
                                    echo "<a href='assignment/student_assignment/".$submitted_assignments[$i]."'>Assignment ".$assignment_no."  on ".$timestamp[$i]."</a>";
                                }
                            } else {
                                echo "<br>No assignments submitted";
                            }                            
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>