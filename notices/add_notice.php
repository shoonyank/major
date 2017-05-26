<?php
session_start();

function generate_filename(){
    include 'dbconnect.php';
    $no=rand();
    while(!(isset($file_name))){
        $query2="Select * from posted_assignments where file_name='".$no.".pdf'";
        $result = mysqli_query($con, $query2);
        if (mysqli_num_rows($result) > 0) {
        }
        else{
            $file_name=$no.".pdf";
            break;
        }
    }
    return $file_name;
}
function backtopavillion(){
    header('Location: http://localhost/Major%20Project/Online%20Exam%20Portal/noticeboard.php');
    exit;
}

if (isset($_SESSION["fid"])) {
    $notice=$_POST["notice"];
    echo $notice;

    $target_dir = "attachment/";
    $filename=generate_filename();
    $target_file = $target_dir . basename($filename);
    $uploadOk = 1;
    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    // Allow certain file formats
    if($FileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Error Code: 1122";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            //Inserting name into db
            include 'dbconnect.php';
            $query="Insert into notices(notice,attachment) values('".$notice."','".$filename."')";
            if ($con->query($query) === TRUE) {                
            } else {
                echo "Error Code: 1122";
            }
            backtopavillion();
            } else {
            echo "Error Code: 1122";
        }
    }
}
else{
    exit("Please Sign In to continue");
}

?>