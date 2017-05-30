<?php
$call=$_GET["fname"];

if($call=="getqid"){
    $a=$_GET["a"];
    $snf=$_GET["snf"];
    $data = getqid($a,$snf);
    echo json_encode($data);
}

else if($call=="fetchquestion"){
    $q=$_GET["q"];
    $data = fetchquestion($q);
    echo json_encode($data);
}

else{
    echo "Error no:8881";
}

function getqid($a,$snf){
    include 'dbconnect.php';
    if($con->connect_error)
    {
        echo "Error: could not establish database connection";
    }

    $qid=array();
    $query="Select qid from questions where page=".$a." and shown_to='".$snf."'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {    
        while($row = $result->fetch_assoc()) {
            array_push($qid, $row["qid"]);
        }
    }
    return $qid;
}

function fetchquestion($q){
    include 'dbconnect.php';
    if($con->connect_error)
    {
        echo "Error: could not establish database connection";
    }

    $data=array();
    $query="Select question, posted_by_id,id_of, timestamp, prime_tag from questions where qid=".$q;
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($data, $row["question"]);
            array_push($data, $row["posted_by_id"]);
            array_push($data, $row["id_of"]);
            array_push($data, $row["timestamp"]);
            array_push($data, $row["prime_tag"]);
        }
    }
    if($data[2]=='student'){
        $query2="Select name from student_details where sid=".$data[1];
        $result2 = $con->query($query2);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $posted_by=$row2["name"];
            }
        }
    }
    else if($data[2]=='faculty'){
        $query2="Select name from faculty where fid=".$data[1];
        $result2 = $con->query($query2);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $posted_by=$row2["name"];
            }
        }
    }
    $question=$data[0];
    $timestamp=$data[3];
    $prime_tag=$data[4];

    $value=array('question'=>$question,'posted_by'=>$posted_by,'timestamp'=>$timestamp,'prime_tag'=>$prime_tag);
    return $value;
}
?>