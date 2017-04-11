<?php
session_start();
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
if( isset($_GET["submit"])){
  $_SESSION["counter"]++;
}
else{
  $_SESSION["counter"]=1;
}
$_SESSION["limit"];
$query0="Select max(qid) from faculty_questions";
$result0 = $con->query($query0);
if ($result0->num_rows > 0) {    
    while($row0 = $result0->fetch_assoc()) {
        $_SESSION["limit"]=$row0["max(qid)"];
    }
} else {
    echo "0 results";
}
$_SESSION["lastlimit"]=$_SESSION["limit"]-5*$_SESSION["counter"];
$question=array();
$posted_by_id=array();
$timestamp=array();
$prime_tag=array();
$qid= array();
$faculty=array();
$query="Select qid,question, posted_by_id, timestamp, prime_tag from faculty_questions where shown_to in ('student','all') and qid between ".$_SESSION["lastlimit"]." and ".$_SESSION["limit"]." order by qid desc";
$result = $con->query($query);
if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {
      array_push($qid, $row["qid"]);
        array_push($question, $row["question"]);
        array_push($posted_by_id, $row["posted_by_id"]);
        array_push($timestamp, $row["timestamp"]);
        array_push($prime_tag, $row["prime_tag"]);
    }
}

$qidtoshow=array();
    $queryregulator="Select qid from faculty_questions where shown_to in ('student','all')";
    $resultregulator = $con->query($queryregulator);
    if ($resultregulator->num_rows > 0) {    
        while($rowregulator = $resultregulator->fetch_assoc()) {
           array_push($qidtoshow,$rowregulator["qid"]);
        }
    }

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
  <?php
  //facultybar
    $qidnum=array();
    $queryregulator="Select qid from faculty_questions where shown_to in ('student','all')";
    $resultregulator = $con->query($queryregulator);
    if ($resultregulator->num_rows > 0) {    
        while($rowregulator = $resultregulator->fetch_assoc()) {
          array_push($qidnum, $rowregulator["qid"]);
        }
    }
    //faculty bar
  ?>
  //faculty bar
  var qarray=<?php echo json_encode($qidnum)?>;
  qarray=qarray.reverse();
  var k=0;
  var questioncount=qarray[k];
  var lastelement=qarray[qarray.length-1];
  //faculty bar
    function getquestion(){
      if(questioncount>=lastelement){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data=JSON.parse(this.responseText);
                document.getElementById("prime_tag").innerHTML = data.prime_tag;
                document.getElementById("mainquestion").innerHTML = data.question;
                document.getElementById("maintimestamp").innerHTML = data.timestamp;
                document.getElementById("mainfaculty").innerHTML = data.posted_by;
            }
        };
        xmlhttp.open("GET", "./fetchquestionsfromfaculty.php?q=" + questioncount, true);
        xmlhttp.send();
        k++;
        questioncount=qarray[k];
      }
    }
      function gotoquespage(){
        var key=k-1;
        window.location.href = "./facultyquestionPage.php?q="+qarray[key];
      }
    function load_your_questions(){
      document.getElementById("main_content").innerHTML="load_your_questions";
    }
    function load_your_answers(){
      document.getElementById("main_content").innerHTML="load_your_answers";
    }
  </script>
</head>
<body onload="getquestion()">
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
            <li><a href="student_view.php">New Student Questions</a></li>
            <li class="active"><a href="student_fac_question_view.php">New Faculty Questions</a></li>
            <li><a href="#">Your Questions</a></li>
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
          <div class='panel-footer'>Posted by:<div id="mainfaculty"></div> On: <div id="maintimestamp"></div>
          <button onclick="gotoquespage()">View the question in detail</button>
          </div>
        </div>
        <button onclick="getquestion()">Next</button>
    </div>
</div>
</div>
<!--Vertical Navbar-->
<!--button onclick="getquestion()">Click me!</button-->
</body>
</html>