<?php
session_start();
if(isset($_SESSION["sid"])){
}
else if(isset($_SESSION["fid"])){
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
                echo "<form action='notices/add_notice.php' method='post' enctype='multipart/form-data' style='margin-top: 10%;margin-left: 5%;'>
                        <input type'text' placeholder='Write your Notice here' name='notice' id='notice'>
                        <br><span><b>Attachment, if any</b></span><input type='file' name='file' id='file'>
                        <input type='submit' value='Notify' name='submit'>
                    </form>
                    <div id='noticeboard' style='margin-top: 5%;margin-left: 5%; width:80%;'>";
            }
            if(isset($_SESSION["sid"])){
                include 'navbar.php';
                echo "<div id='noticeboard' style='margin-top:5%;margin-left: 5%;width:80%;'>";
            }
        ?>

        <h3>NoticeBoard</h3>
            <?php
                include 'database/dbconnect.php';
                $getcurrnotices="SELECT * FROM notices order by time_stamp desc LIMIT 0,5";
                $result=$con->query($getcurrnotices);
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        echo "<div class='panel panel-default'>
                            <div class='panel-body'>".$row["notice"]."<br><a href='notices/attachment/".$row["attachment"]."'>".$row["attachment"]."</div>
                            </div>";
                    }
                }
            ?>
        </div>
    </body>
</html>