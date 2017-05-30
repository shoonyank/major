<?php
session_start();
if(isset($_SESSION["sid"])){
    $profile_of="Student";
    $table="student_details";
    $id_name="sid";
    $id=$_SESSION["sid"];
}
else if(isset($_SESSION["fid"])){
    $profile_of="Faculty";
    $table="faculty";
    $id_name="fid";
    $id=$_SESSION["fid"];
}
else{
    exit("Please Sign In to continue");
}
include 'database/dbconnect.php';
$query="SELECT * FROM ".$table." WHERE ".$id_name."=".$id;
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name=$row["name"];
            $email=$row["email"];
            $phone=$row["phone"];
            $username=$row["username"];
        }
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
        <h2 style="margin-top: 8%;"><?php echo $profile_of;?></h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?php include './profile/get_dp.php';?>" style="width: 86%;">
                    <form action="./profile/dp_upload.php" method="post" enctype="multipart/form-data">
                        Select new image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
                <div class="col-sm-8">
                    <h4>Name</h4><p><?php echo $name;?></p><br>
                    <h4>Email</h4><p><?php echo $email;?></p><br>
                    <h4>Phone</h4><p><?php echo $phone;?></p><br>
                    <h4>Username</h4><p><?php echo $username;?></p><br>
                </div>
            </div>
        </div>
    </body>
</html>