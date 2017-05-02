<?php
session_start();
if(isset($_SESSION["sid"])){
    $id_name="sid";
}
else{
    exit("Please Sign In to continue");
}
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

if(isset($_SESSION["sid"])){
    $id=$_SESSION["sid"];
    $target_dir = "student_assignment/";
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
        echo "Error Code: 1882";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["assignment"]["name"]). " has been uploaded.";
            //Inserting name into db
            include 'dbconnect.php';
            $query3="Select a_id from posted_assignments where file_name='".$_POST["a_name"]."'";
            
            $result = $con->query($query3);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        $a_id=$row["a_id"];
                    }
                }
                else{
                    echo "Error Code: 1882";
                }
            
            $query2="insert into submitted_assignments(a_id,file_name,sid) values(".$a_id.",'".$filename."',".$_SESSION["sid"].")";
            if ($con->query($query2) === TRUE) {                
            } else {
                echo "Error Code: 1882";
            }
        } else {
            echo "Error Code: 1882";
        }
    }
    backtopavillion();
}
else{
    exit("Please Sign In to continue");
}
?>