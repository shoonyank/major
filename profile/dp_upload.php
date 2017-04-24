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
function backtopavillion(){
    header('Location: http://localhost/Major%20Project/Online%20Exam%20Portal/profile.php');
    exit;
}
function upload($table,$id_type,$id){
    $target_dir = "img/";
    $target_file = $target_dir . basename($table.$id.".png");
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";        
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Allow certain file formats
    if($imageFileType != "png") {
        echo "Sorry, only PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //Inserting name into db
            include 'dbconnect.php';
            $query2="Update ".$table." set image='".$table."".$id.".png' where ".$id_type."=".$id;
            if ($con->query($query2) === TRUE) {
                backtopavillion();
            } else {
                echo "Error Code: 1112";
            }
            backtopavillion();
        } else {
            echo "Error Code: 1112";
        }
    }
}

if(isset($_SESSION["sid"])){
    $table="student_details";
    $id_type="sid";
    upload($table,$id_type,$_SESSION["sid"]);
}
if (isset($_SESSION["fid"])) {
    $table="faculty";
    $id_type="fid";
    upload($table,$id_type,$_SESSION["fid"]);
}
else{
    echo "Error Code: 1112";
}
?>