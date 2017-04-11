<?php
session_start();
//establish connection
include 'dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}
//connection established
//check session
if (isset($_POST["newquestion"])) {
  $newquestion="Insert into student_questions(question,posted_by_id,prime_tag,shown_to) values(".$_POST["question"].",".$_SESSION["sid"].",".$_POST["prime_tag"].",".$_POST["shown_to"].")";
  if ($con->query($newquestion) === TRUE) {
    
  } else {
      echo "question : ".$_POST["question"];
      echo "Posted By: ".$_SESSION["sid"];
      echo "Related to : ".$_POST["prime_tag"];
      echo "Shown to : ".$_POST["shown_to"];
      echo "Try again";
  }
}
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
  $_SESSION["myqcounter"]++;
}
else{
  $_SESSION["myqcounter"]=1;
}
//counter value set
//set high limit
$_SESSION["myqlimit"];
$query0="Select max(qid) from student_questions";
$result0 = $con->query($query0);
if ($result0->num_rows > 0) {    
    while($row0 = $result0->fetch_assoc()) {
        $_SESSION["myqlimit"]=$row0["max(qid)"];
    }
} else {
    echo "0 results";
}
//high limit set
//set low limit
$_SESSION["myqlastlimit"]=$_SESSION["myqlimit"]-5*$_SESSION["myqcounter"];
//low limit set
//set arrays of questions timestamps prime_tags and qid
$question=array();
$timestamp=array();
$prime_tag=array();
$qid= array();
$query="Select qid,question, timestamp, prime_tag from student_questions where posted_by_id=".$_SESSION["sid"]." and qid between ".$_SESSION["myqlastlimit"]." and ".$_SESSION["myqlimit"]." order by qid desc";
$result = $con->query($query);
if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {
      array_push($qid, $row["qid"]);
      array_push($question, $row["question"]);      
      array_push($timestamp, $row["timestamp"]);
      array_push($prime_tag, $row["prime_tag"]);
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
  var qarray=<?php echo json_encode($qid)?>;
  var k=0;
  var questioncount=qarray[k];
  var lastelement=qarray[qarray.length-1];
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
                document.getElementById("mainstudent").value = <?php echo $student_name;?>;
            }
        };
        xmlhttp.open("GET", "fetchstudentsmyquestions.php?q=" + questioncount, true);
        xmlhttp.send();
        k++;
        questioncount=qarray[k];
      }
    }
      function gotoquespage(){
        var key=k-1;
        window.location.href = "./studentsmyquestionPage.php?q="+qarray[key];
      }
  </script>
</head>
<body onload="getquest()">
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
$query1="Select count(qid) from student_questions";
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
        <button onclick="getquest()">Next</button>
    </div>
</div>
</div>
<!--Vertical Navbar-->
<!--form for new question-->
<div><form method='post'><input type='text' name='question' placeholder='Your new question'><br><input type="text" name="prime_tag" placeholder="Related to Topic?"><br><select name="shown_to">
  <option value="faculty">Only Faculty</option>
  <option value="students">Only Students</option>
  <option value="all"> Everyone</option>
</select>
<br>
<input type='submit' name='newquestion' value='Submit'><br></form></div>
<!--form for new question ends-->
</body>
</html>