<?php
session_start();
if(isset($_SESSION["sid"])){
    $profile_of="Student";
}
else if(isset($_SESSION["fid"])){
    $profile_of="Faculty";
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
        include 'navbar.php';
        ?>
        <h2 style="margin-top: 8%;"><?php echo $profile_of;?></h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?php include './profile/get_dp.php';?>">
                    <form action="./profile/dp_upload.php" method="post" enctype="multipart/form-data">
                        Select new image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>