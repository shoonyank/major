<?php
session_start();
//establish connection
include 'dbconnect.php';
//connection established
//check session
if(isset($_SESSION["sid"])){
}
else{
  exit("Please Sign In to continue");
}
//session checked
//get name of student
$student_name;
$querya="Select name from student_details where sid=".$_SESSION["sid"];
$resulta = $con->query($querya);
if ($resulta->num_rows > 0) {    
    while($rowa = $resulta->fetch_assoc()) {
      $student_name=$rowa["name"];
    }
}
//got student's name

//set counter value
if( isset($_GET["submit"])){
  $_SESSION["myanscounter"]++;
}
else{
  $_SESSION["myanscounter"]=1;
}
//counter value set
//set high limit
$_SESSION["myanslimit"];
$query0="Select com_id from student_comments where posted_by_id=".$_SESSION["sid"]." order by posted_by_id limit 1";
$result0 = $con->query($query0);
if ($result0->num_rows > 0) {    
    while($row0 = $result0->fetch_assoc()) {
        $_SESSION["myanslimit"]=$row0["com_id"];
    }
} else {
    echo "0 results";
}
//high limit set
//set low limit
$_SESSION["myanslastlimit"]=$_SESSION["myanslimit"]-5*$_SESSION["myanscounter"];
//low limit set
//set arrays of questions timestamps prime_tags and qid
$comment=array();
$query="Select com_id from student_comments where posted_by_id=".$_SESSION["sid"]." and com_id between ".$_SESSION["myanslastlimit"]." and ".$_SESSION["myanslimit"]." order by com_id desc";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($comid, $row["com_id"]);
    }
}
//arrays of questions timestamps prime_tags and qid set


?>
<!DOCTYPE html>
<html>
<head>
  <title>Student View</title>
  <!-- Latest compiled and minified CSS -->
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
  <script type="text/javascript">  
  //student bar
  var comarray=<?php echo json_encode($comid)?>;
  var k=0;
  var comcount=comarray[k];
  var lastelement=comarray[comarray.length-1];
  //student bar
    function getquest(){
      console.log("quest started");
      console.log(questioncount);
      console.log(lastelement);
      if(questioncount>=lastelement){
        console.log("in first if");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data=JSON.parse(this.responseText);
                console.log("in the if statement");
                document.getElementById("prime_tag").innerHTML = data.prime_tag;
                document.getElementById("mainquestion").innerHTML = data.question;
                document.getElementById("maintimestamp").innerHTML = data.timestamp;
                document.getElementById("mainstudent").value = data.posted_by_id;
                document.getElementById("maincomment").value = data.comment;
            }
        };
        xmlhttp.open("GET", "fetchstudentsmyanswers.php?q=" + comcount, true);
        xmlhttp.send();
        k++;
        comcount=comarray[k];
      }
    }
  </script>
</head>
<body onload="getquest()">
        <!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #335571;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color: white;">WebCods</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="dashboard.php">Home</a></li>
        <li><a href="profile.php" style="color: white;">Profile</a></li>        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Academics<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="submit_assignments.php" style="color: black;">Submit Assignments</a></li>
            <li><a href="noticeboard.php" style="color: black;">NoticeBoard</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header" style="color: black;">Give Mock Tests</li>
            <li><a href="mock_test.php" style="color: black;">Do a Mock test</a></li>
            <li><a href="get_results.php" style="color: black;">Get Results</a></li>
          </ul>
        </li>
        <li><a href="database/logout.php" style="color: white;">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
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
            <li><a href="student_view.php">New Student Questions</a></li>
            <li><a href="student_fac_question_view.php">New Faculty Questions</a></li>
            <li class="active"><a href="yourquestions.php">Your Questions</a></li>
            <li><a href="#">Your answers</a></li>
            <li><a href="#">Total Questions <span class="badge">
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
          <div class='panel-heading'>Related to:<div id="prime_tag"></div></div>
          <div class='panel-body'>Question:<div id="mainquestion"></div></div>
          <div class='panel-footer'>Posted by:<div id="mainstudent"></div> On: <div id="maintimestamp"></div>
          </div>
        </div>
        <div class='panel panel-default'>
          <div class='panel-body'>Your Answer:<div id="maincomment"></div></div>
          </div>
        </div>
        <button onclick="getquest()">Next</button>
    </div>
</div>
</div>
<!--Vertical Navbar-->
<!--button onclick="getquestion()">Click me!</button-->
</body>
</html>