<?php
session_start();
include 'dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}
if(isset($_SESSION["sid"])){
}
else if(isset($_SESSION["fid"])){
}
else{
  exit("Please Sign In to continue");
}

include 'dbconnect.php';
$query="select question from questions where qid=".$_GET["q"];
$result = $con->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $question=$row["question"];
    }
} else {
    echo "Error 5990";
}

$query1="select resolver_id, id_of, answer, count(*) as total from forum_answers where qid=".$_GET["q"];
$result1 = $con->query($query1);

$name=array();
$answer=array();  

if ($result1->num_rows > 0) {
    // output data of each row
    while($row1 = $result1->fetch_assoc()) {
      if($row1["id_of"]=="student"){
        $query2="select name from student_details where sid=".$row1["resolver_id"];
        $result2=$con->query($query2);
        if($result2->num_rows>0){
          while($row2 = $result2->fetch_assoc()){
            array_push($name, $row2["name"]);
          }
        }
      }
      if($row1["id_of"]=="faculty"){
        $query2="select name from faculty where fid=".$row1["resolver_id"];
        $result2=$con->query($query2);
        if($result2->num_rows>0){
          while($row2 = $result2->fetch_assoc()){
            array_push($name, $row2["name"]);
          }
        }
      }
      array_push($answer, $row1["answer"]);
      $total=$row1["total"];
    }
} else {
    echo "Error 5990";
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>OEP</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
  if(isset($_SESSION["sid"])){
    include 'navbar.php';
  }
  if(isset($_SESSION["fid"])){
    include 'fnavbar.php';
  }
?>
<div class="panel-group" style="margin-top: 5%;">
  <div class="panel panel-default">
    <div class="panel-body"><?php echo $question;?>
    </div>
  </div>
  
  <?php
  if ($total>0) {
    for($i=0;$i<$total;$i++){
      echo "<div class='panel panel-default'>
        <div class='panel-body'>".$answer[$i]."<br> by    ".$name[$i]."</div>
      </div>";
    }
  }
  else{
    echo "<div class='panel panel-default'>
        <div class='panel-body'>No Answers yet.</div>
      </div>";
  }
  ?>
</div>
</body>
</html>
