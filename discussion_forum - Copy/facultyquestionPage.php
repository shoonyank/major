<?php
session_start();
$qid=$_GET["q"];
include 'dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}
if(isset($_SESSION["sid"])){
}
else{
  exit("Please Sign In to continue");
}

//commenting
if(isset($_GET['submit'])){
  $comment="Insert into student_comments(comment,posted_by_id,fqid) values('".$_GET['newcomment']."',".$_SESSION['sid'].",".$qid.")";
  if ($con->query($comment)===TRUE) {     
  }
}
//commenting
$data=array();
$query="Select question, posted_by_id, timestamp, prime_tag from faculty_questions where qid=".$qid;
$result = $con->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($data, $row["question"]);
        array_push($data, $row["posted_by_id"]);
        array_push($data, $row["timestamp"]);
        array_push($data, $row["prime_tag"]);
    }
}
$query2="Select name from faculty where fid=".$data[1];
$result2 = $con->query($query2);
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {        
        $posted_by=$row2["name"];
    }
}
$question=$data[0];
$timestamp=$data[2];
$prime_tag=$data[3];

//previous code ends here, till here code is same as try.php

$student_comment=array();
$student_name=array();
$student_id=array();
$comments_by_sid=array();
$query3="Select comment,posted_by_id from student_comments where fqid=".$qid." order by timestamp desc";
$result3 = $con->query($query3);
if ($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
      array_push($student_comment, $row3["comment"]);
      array_push($comments_by_sid, $row3["posted_by_id"]);
    $query4="Select name from student_details where sid=".$row3["posted_by_id"];
    $result4 = $con->query($query4);
    if ($result4->num_rows > 0) {
        while($row4 = $result4->fetch_assoc()) {
          array_push($student_name, $row4["name"]);
        }
    }        
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Question Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    /* make sidebar nav vertical */ 
  @media (min-width: 768px) {
    .sidebar-nav .navbar .navbar-collapse {
      padding: 0;
      max-height: none;
    }
    .sidebar-nav .navbar ul {
      float: none;
      display: block;
    }
    .sidebar-nav .navbar li {
      float: none;
      display: block;
    }
    .sidebar-nav .navbar li a {
      padding-top: 12px;
      padding-bottom: 12px;
    }
  }
  </style>
</head>
<body>
       <!-- Fixed navbar -->
<?php
include 'navbar.php';
?>
<!--Navbar-->
<!--Vertical Navbar-->
<div class="container" style="margin-top: 5%;">
<div class="row">
  <div class="col-sm-3">
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="student_view.php">New Student Questions</a></li>
            <li><a href="student_fac_question_view.php">New Faculty Questions</a></li>
            <li><a href="#">Your Questions</a></li>
            <li><a href="#">Your answers</a></li>
            <li><a href="#">Total Questions <span class="badge">
            <!--get the total number of questions-->
            <?php
        $total;
        $query="Select count(qid) from student_questions";
        $result = $con->query($query);
        if ($result->num_rows > 0) {    
            while($row = $result->fetch_assoc()) {
                $total=$row["count(qid)"];
            }
        }
        $query1="Select count(qid) from faculty_questions";
        $result1 = $con->query($query1);
        if ($result1->num_rows > 0) {    
            while($row1 = $result1->fetch_assoc()) {
                $total=$total+$row1["count(qid)"];
            }
        }
        echo $total;
            ?>              
            </span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>    
  </div>  
  <div class="col-sm-9" id="main_content">
        <div class='panel panel-primary'>
          <div class='panel-heading'>Related to:<div id="prime_tag"><?php echo $prime_tag;?></div></div>
          <div class='panel-body'>Question:<div id="mainquestion"><?php echo $question;?></div></div>
          <div class='panel-footer'>Posted by:<div id="mainstudent"><?php echo $posted_by;?></div> On <div id="maintimestamp"><?php echo $timestamp;?></div></div>
        </div>
        <div class='panel panel-default'>
          <?php
          for($i=0;$i<sizeof($student_name);$i++){
              echo "<div class='panel-heading'>Comment by:<div id='name'>".$student_name[$i]."</div></div>
              <div class='panel-body'>Comment:<div id='comment'>".$student_comment[$i]."</div></div>";
          }
          ?>
        </div>
    </div>
</div>
</div>
<!--Vertical Navbar-->
<!--Your comment-->
<?php
echo "<div style='margin-left:30%;'><h3>Comment</h3><form method='get'><input type='text' style='height:100px;width:900px;' name='newcomment'><br><input class='btn btn-success' type='submit' name='submit' value='Submit'><input name='q' value=".$qid." style='visibility:hidden;'></form></div>";
?>
<!--/Your comment-->

</body>
</html>