<?php 
session_start();
if(isset($_SESSION["fid"])){
}
else{
exit("Please Sign In to continue");
}
include 'database/dbconnect.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <!-- Fixed navbar -->
        <?php
        include './fnavbar.php';
        ?>

        <div class="container" style="margin-top: 5%;">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <!--Recent exam details-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h3>Exams</h3>
                                <?php
                                    $query="Select * from test where timestamp=(Select max(timestamp) from test where fid=".$_SESSION["fid"].") ";
                                    $result=$con->query($query);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "You recently added test :<b>" . $row["test_name"]. "</b> in list of exams";
                                        }
                                    } else {
                                        echo "No recent exams created";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Recent details about what you answered in forum-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h3>Forum Interactions</h3>
                                <?php
                                    $forumquery="Select * from questions where timestamp=(Select max(timestamp) from questions where posted_by_id=".$_SESSION["fid"]." and id_of='faculty') ";
                                    $forumresult=$con->query($forumquery);
                                    if ($forumresult->num_rows > 0) {
                                        while($frow = $forumresult->fetch_assoc()) {
                                            echo "You posted the question :<b>" . $frow["question"]. "</b> ;recently, in the forum.<br>";
                                        }
                                    } else {
                                        echo "You have not answered any questions in the forum.";
                                    }  
                                    $forumquery1="Select * from forum_answers where timestamp=(Select max(timestamp) from forum_answers where resolver_id=".$_SESSION["fid"]." and id_of='faculty') ";
                                    $forumresult1=$con->query($forumquery1);
                                    if ($forumresult1->num_rows > 0) {
                                        while($frow1 = $forumresult1->fetch_assoc()) {
                                            echo "You answered :<b>" . $frow1["answer"]. "</b> ;recently,to a question in the forum.<br>";
                                        }
                                    } else {
                                        echo "You have not answered any questions in the forum.";
                                    }  
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Recent details about submitted assignments-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h3>Assignments</h3>
                                <?php
                                    $submitquery="Select * from posted_assignments where timestamp=(Select max(timestamp) from posted_assignments where fid=".$_SESSION["fid"].") ";
                                    $submitresult=$con->query($submitquery);
                                    if ($submitresult->num_rows > 0) {
                                        while($srow = $submitresult->fetch_assoc()) {
                                            echo "You recently added an assignment of :<b>" . $srow["a_name"]."</b><br>";
                                        }
                                    } else {
                                        echo "You have not given any assignments.";
                                    }
                                     $profile_of='Faculty';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="<?php include './profile/get_dp.php';?>" style="width: 63%; margin-left: 30%;">
                </div>
            </div>
        </div>
    </body>
</html>
