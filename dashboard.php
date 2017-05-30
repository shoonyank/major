<?php
session_start();
if(isset($_SESSION["sid"])){
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
        include './navbar.php';
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
                                    $query="Select * from ans_table where time_stamp=(Select max(time_stamp) from ans_table where sid=".$_SESSION["sid"].") ";
                                    $result=$con->query($query);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "You recently scored :<b>" . $row["score"]. "</b> in test: <b>" . $row["test_name"]. "</b><br>";
                                        }
                                    } else {
                                        echo "No recent exams given";
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
                                    $forumquery="Select * from forum_answers where timestamp=(Select max(timestamp) from forum_answers where resolver_id=".$_SESSION["sid"]." and id_of='student') ";
                                    $forumresult=$con->query($forumquery);
                                    if ($forumresult->num_rows > 0) {
                                        while($frow = $forumresult->fetch_assoc()) {
                                            echo "You answered :<b>" . $frow["answer"]. "</b> ;recently,to a question in the forum.<br>";
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
                                    $submitquery="Select * from posted_assignments where a_id=(Select a_id from submitted_assignments where time_stamp=(Select max(time_stamp) from submitted_assignments where sid=".$_SESSION["sid"].")) ";
                                    $submitresult=$con->query($submitquery);
                                    if ($submitresult->num_rows > 0) {
                                        while($srow = $submitresult->fetch_assoc()) {
                                            echo "You recently submitted an assignment for :<b>" . $srow["a_name"]."</b><br>";
                                        }
                                    } else {
                                        echo "You have not submitted any assignments.";
                                    }
                                     $profile_of='Student';
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
