<?php
session_start();
include 'dbconnect.php';
function generate_filename($id){
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
    header('Location: http://localhost/Major%20Project/Online%20Exam%20Portal/submit_assignment.php');
    exit;
}

if(isset($_SESSION["fid"])){
    $id=$_SESSION["fid"];
    $target_dir = "assignment_question/";
    $filename=generate_filename($id);
    $target_file = $target_dir . basename($filename);
    $uploadOk = 1;
    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Allow certain file formats
    if($FileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Error Code: 1345";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["assignment"]["name"]). " has been uploaded.";
            //Inserting name into db
            include 'dbconnect.php';
            $query2="insert into posted_assignments(fid,file_name,a_name) values(".$id.",'".$filename."','".$_POST["a_name"]."')";
            if ($con->query($query2) === TRUE) {                
            } else {
                echo "Error Code: 1345";
            }
        } else {
            echo "Error Code: 1345";
        }
    }
    backtopavillion();
}
else{
    exit("Please Sign In to continue");
}
?>